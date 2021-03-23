@extends('layouts/master')

@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-download"></i></span>
                    <p>
                        <span class="number">{{totalSiswa()}}</span>
                        <span class="title">Total Siswa</span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-download"></i></span>
                    <p>
                        <span class="number">{{totalGuru()}}</span>
                        <span class="title">Total Guru</span>
                    </p>
                </div>
            </div>
                <div class="col-md-12">
                <div class="panel">
            
								<div class="panel-heading">
                                    <h3 class="panel-title">Rangking 5 Besar Siswa</h3>
                                    <div class="right">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                                        <i class="lnr lnr-plus-circle"></i>
                                    </button>
                                    </div>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
                                        <th> Rangking </th>
                                        <th> Nama</th>
                                        <th> Nilai</th>
										</thead>
										<tbody>
                                        @php
                                            $rangking = 1;
                                        @endphp
                                       @foreach (rangking5Besar() as $pur)
                                        <tr>
                                            <td>{{$rangking}}</td>
                                            <td>{{$pur->nama_lengkap()}}</td>
                                            <td>{{$pur->rataRataNilai()}}</td>
                                            
                                        </tr>
                                        @php
                                            $rangking++;
                                        @endphp
                                       @endforeach
										</tbody>
									</table>
								</div>
							</div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop