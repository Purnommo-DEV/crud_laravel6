@extends('layouts/master')

@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="panel">

								<div class="panel-heading">
                                    <h3 class="panel-title">Data Siswa</h3>
                                    <img src="{{$siswa->getAvatar()}}" class="img-circle" alt="Avatar">
                                    <div class="right">
                                    <a href="/siswa/exportExel">Eksport</a>
                                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                                        <i class="lnr lnr-plus-circle"></i>
                                    </button>
                                    </div>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
                                        <th> Nama Depan</th>
                                        <th> Nama Belakang</th>
                                        <th> Jenis Kelamin</th>
                                        <th> Agama</th>
                                        <th> Alamat</th>
                                        <th> Aksi</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($data_siswa as $siswa)
                                        <tr>
                                            <td>{{$siswa->nama_depan}}</td>
                                            <td>{{$siswa->nama_belakang}}</td>
                                            <td>{{$siswa->jenis_kelamin}}</td>
                                            <td>{{$siswa->agama}}</td>
                                            <td>{{$siswa->alamat}}</td>
                                            <td>
                                            <a href="/siswa/{{$siswa->id}}/profil" class = "btn btn-info btn-sm">Lihat</a>
                                            <a href="/siswa/{{$siswa->id}}/edit" class = "btn btn-warning btn-sm">Edit</a>
                                            <a href="#" class = "btn btn-danger btn-sm delete" 
                                            siswa-id = "{{$siswa->id}}">Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
										</tbody>
									</table>
                                    {{$data_siswa->links()}}
								</div>
							</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
    <form action = "/siswa/create" method = "POST" enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
            <label for="exampleInputEmail1">Nama Depan</label>
            <input name="nama_depan" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            value = "{{old('nama_depan')}}"> <!-- Merekam inputan sebelumnya agar tidak hilang saat POP UP di tutup -->
            @if($errors->has('nama_depan'))
                <span class="help-block">{{$errors->first('nama_depan')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nama Belakang</label>
            <input  name="nama_belakang" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            value = "{{old('nama_belakang')}}">
        </div>
        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
            <label for="exampleInputEmail1">E-mail</label>
            <input  name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            value = "{{old('email')}}">
            @if($errors->has('email'))
                <span class="help-block">{{$errors->first('email')}}</span>
            @endif    
        </div>
        <div class="form-group {{$errors->has('jenis_kelamin') ? 'has-error' : ''}}">
        <label for="exampleFormControlSelect1">Jenis Kelamin</label>
            <select  name="jenis_kelamin"  class="form-control" id="exampleFormControlSelect1">
            <option value ="L"{{(old('jenis_kelamin') == 'L') ? 'selected' : ''}}>Laki-laki</option>
            <option value ="P"{{(old('jenis_kelamin') == 'P') ? 'selected' : ''}}>Perempuan</option>
            </select>
            @if($errors->has('jenis_kelamin'))
                <span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
            @endif    
        </div>
        <div class="form-group {{$errors->has('agama') ? 'has-error' : ''}}">
            <label for="exampleInputEmail1">Agama</label>
            <input  name="agama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            value = "{{old('agama')}}">
            @if($errors->has('agama'))
                <span class="help-block">{{$errors->first('agama')}}</span>
            @endif    
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Alamat</label>
            <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('alamat')}}</textarea>
        </div>
        <div class="form-group {{$errors->has('avatar') ? 'has-error' : ''}}">
            <input type="file" name="avatar" class="form-control" id="exampleCheck1"
            value = "{{old('agama')}}">
            @if($errors->has('avatar'))
                <span class="help-block">{{$errors->first('avatar')}}</span>
            @endif  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        </div>
        </div>
    </div>
@stop

@section('footer')
    <script>
    //Jika ada class yang bernama delete lalu di klik maka jalankan function() dan tampilkan alert(1) atau pesan
    $('.delete').click(function(){
        //Buat variabel baru siswa_id, This mengacu pada clas yang di klik yaitu .delete kemudia ambil attributnya yaitu siswa_id
        var siswa_id = $(this).attr('siswa-id');
        swal({
        title: "Yakin ?",
        text: "Menghapus data siswa dengan id"+ siswa_id +"?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location = "/siswa/"+siswa_id+"/delete";
        }
        });
            });
    </script>
@stop