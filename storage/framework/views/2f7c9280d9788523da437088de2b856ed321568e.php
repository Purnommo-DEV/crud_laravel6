<?php $__env->startSection('content'); ?>

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-download"></i></span>
                    <p>
                        <span class="number"><?php echo e(totalSiswa()); ?></span>
                        <span class="title">Total Siswa</span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-download"></i></span>
                    <p>
                        <span class="number"><?php echo e(totalGuru()); ?></span>
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
                                        <?php
                                            $rangking = 1;
                                        ?>
                                       <?php $__currentLoopData = rangking5Besar(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($rangking); ?></td>
                                            <td><?php echo e($pur->nama_lengkap()); ?></td>
                                            <td><?php echo e($pur->rataRataNilai()); ?></td>
                                            
                                        </tr>
                                        <?php
                                            $rangking++;
                                        ?>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
								</div>
							</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crud_laravel\resources\views/dashboard/index.blade.php ENDPATH**/ ?>