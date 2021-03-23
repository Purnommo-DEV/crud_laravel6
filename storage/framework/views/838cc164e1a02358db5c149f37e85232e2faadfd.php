<?php $__env->startSection('header'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin/assets/vendor/bootstrap/css/bootstrap-editable.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<?php if(session('sukses')): ?>
						<div class="alert alert-success" role="alert">
						<?php echo e(session('sukses')); ?>

						</div>
					<?php endif; ?>
					<?php if(session('error')): ?>
						<div class="alert alert-warning" role="alert">
						<?php echo e(session('error')); ?>

						</div>
					<?php endif; ?>
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="<?php echo e($siswa->getAvatar()); ?>" class="img-circle" alt="Avatar">
										<h3 class="name"><?php echo e($siswa->nama_depan); ?></h3>
										<span class="online-status status-available">Available</span>
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
												<?php echo e($siswa->mapel->count()); ?><span>Mata Pelajaran</span>
											</div>
											<div class="col-md-4 stat-item">
												<?php echo e($siswa->rataRataNilai()); ?><span>Rata-rata Nilai</span>
											</div>
											<div class="col-md-4 stat-item">
												2174 <span>Points</span>
											</div>
										</div>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Detail Data Diri</h4>
										<ul class="list-unstyled list-justify">
                                            <li>Jenis Kelamin <span><?php echo e($siswa->jenis_kelamin); ?></span></li>
											<li>Agama <span><?php echo e($siswa->agama); ?></span></li>
											<li>Alamat <span><?php echo e($siswa->alamat); ?></span></li>
										</ul>
									</div>
									<div class="text-center"><a href="/siswa/<?php echo e($siswa->id); ?>/edit" class="btn btn-warning">Edit</a></div>
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<!-- END AWARDS -->
								<!-- TABBED CONTENT -->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Tambah Nilai
								</button>
								<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Mata Pelajaran</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Kode</th>
												<th>Nama</th>
												<th>Semester</th>
												<th>Nilai</th>
												<th>Guru</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php $__currentLoopData = $siswa->mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mapel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e($mapel -> kode); ?></td>
												<td><?php echo e($mapel -> nama); ?></td>
												<td><?php echo e($mapel -> semester); ?></td>
												<td><a href="#" class="nilai" data-type="text" data-pk="<?php echo e($mapel->id); ?>" 
													data-url="/api/siswa/<?php echo e($siswa->id); ?>/editnilai" data-title="Masukkan Nilai"><?php echo e($mapel->pivot->nilai); ?></a>
												</td>
												<td><a href="/guru/<?php echo e($mapel->guru_id); ?>/profil"><?php echo e($mapel->guru->nama); ?></a></td>
												<td>
												<a href="/siswa/<?php echo e($siswa->id); ?>/<?php echo e($mapel->id); ?>/deletenilai" class = "btn btn-danger btn-sm" 
                                            	onclick="return confirm('Yakin ingin di hapus?')">Hapus</a>
												</td>
											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
								</div>
								<div class="panel">
									<div id="chartNilai"></div>
								</div>
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
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
    <form action = "/siswa/<?php echo e($siswa->id); ?>/addnilai" method = "POST" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

		<div class="form-group">
        <label for="mapel">Mata Pelajaran</label>
			<select class="form-control" id="mapel" name="mapel">
            <?php $__currentLoopData = $matapelajaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($mp->id); ?>"><?php echo e($mp->nama); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>  
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nilai</label>
            <input name="nilai" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            value = "<?php echo e(old('nilai')); ?>"> <!-- Merekam inputan sebelumnya agar tidak hilang saat POP UP di tutup -->
            <?php if($errors->has('nilai')): ?>
                <span class="help-block"><?php echo e($errors->first('nilai')); ?></span>
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
<script src="<?php echo e(asset('admin/assets/scripts/bootstrap-editable.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/assets/scripts/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/assets/scripts/highcharts.js')); ?>"></script>
<script>
Highcharts.chart('chartNilai', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Laporan Data Siswa'
    },
    xAxis: {
        categories: <?php echo json_encode($categories); ?>,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Nilai'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Nilai',
        data:  <?php echo json_encode($data); ?>,
    }]
});

$(document).ready(function() {
    $('.nilai').editable();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crud_laravel\resources\views/siswa/profil.blade.php ENDPATH**/ ?>