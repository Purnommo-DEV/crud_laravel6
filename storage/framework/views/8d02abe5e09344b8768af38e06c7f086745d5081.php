<?php $__env->startSection('content'); ?>

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="panel">
								<div class="panel-heading">
                                    <h3 class="panel-title">Data Siswa</h3>
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
                                        <?php $__currentLoopData = $data_siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($siswa->nama_depan); ?></td>
                                            <td><?php echo e($siswa->nama_belakang); ?></td>
                                            <td><?php echo e($siswa->jenis_kelamin); ?></td>
                                            <td><?php echo e($siswa->agama); ?></td>
                                            <td><?php echo e($siswa->alamat); ?></td>
                                            <td>
                                            <a href="/siswa/<?php echo e($siswa->id); ?>/profil" class = "btn btn-info btn-sm">Lihat</a>
                                            <a href="/siswa/<?php echo e($siswa->id); ?>/edit" class = "btn btn-warning btn-sm">Edit</a>
                                            <a href="#" class = "btn btn-danger btn-sm delete" 
                                            siswa-id = "<?php echo e($siswa->id); ?>">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
                                    <?php echo e($data_siswa->links()); ?>

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
    <?php echo e(csrf_field()); ?>

        <div class="form-group <?php echo e($errors->has('nama_depan') ? 'has-error' : ''); ?>">
            <label for="exampleInputEmail1">Nama Depan</label>
            <input name="nama_depan" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            value = "<?php echo e(old('nama_depan')); ?>"> <!-- Merekam inputan sebelumnya agar tidak hilang saat POP UP di tutup -->
            <?php if($errors->has('nama_depan')): ?>
                <span class="help-block"><?php echo e($errors->first('nama_depan')); ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nama Belakang</label>
            <input  name="nama_belakang" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            value = "<?php echo e(old('nama_belakang')); ?>">
        </div>
        <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
            <label for="exampleInputEmail1">E-mail</label>
            <input  name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            value = "<?php echo e(old('email')); ?>">
            <?php if($errors->has('email')): ?>
                <span class="help-block"><?php echo e($errors->first('email')); ?></span>
            <?php endif; ?>    
        </div>
        <div class="form-group <?php echo e($errors->has('jenis_kelamin') ? 'has-error' : ''); ?>">
        <label for="exampleFormControlSelect1">Jenis Kelamin</label>
            <select  name="jenis_kelamin"  class="form-control" id="exampleFormControlSelect1">
            <option value ="L"<?php echo e((old('jenis_kelamin') == 'L') ? 'selected' : ''); ?>>Laki-laki</option>
            <option value ="P"<?php echo e((old('jenis_kelamin') == 'P') ? 'selected' : ''); ?>>Perempuan</option>
            </select>
            <?php if($errors->has('jenis_kelamin')): ?>
                <span class="help-block"><?php echo e($errors->first('jenis_kelamin')); ?></span>
            <?php endif; ?>    
        </div>
        <div class="form-group <?php echo e($errors->has('agama') ? 'has-error' : ''); ?>">
            <label for="exampleInputEmail1">Agama</label>
            <input  name="agama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            value = "<?php echo e(old('agama')); ?>">
            <?php if($errors->has('agama')): ?>
                <span class="help-block"><?php echo e($errors->first('agama')); ?></span>
            <?php endif; ?>    
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Alamat</label>
            <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo e(old('alamat')); ?></textarea>
        </div>
        <div class="form-group <?php echo e($errors->has('avatar') ? 'has-error' : ''); ?>">
            <input type="file" name="avatar" class="form-control" id="exampleCheck1"
            value = "<?php echo e(old('agama')); ?>">
            <?php if($errors->has('avatar')): ?>
                <span class="help-block"><?php echo e($errors->first('avatar')); ?></span>
            <?php endif; ?>  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crud_laravel\resources\views/siswa/index.blade.php ENDPATH**/ ?>