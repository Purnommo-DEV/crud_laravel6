<?php $__env->startSection('content'); ?>

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="panel">
								<div class="panel-heading">
                                    <h3 class="panel-title">Post</h3>
                                    <div class="right">
                                    <a href="<?php echo e(route('posts.add')); ?>">Post</a>
                                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                                        <i class="lnr lnr-plus-circle"></i>
                                    </button>
                                    </div>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
                                        <th> Id</th>
                                        <th> Title</th>
                                        <th> User</th>
                                        <th> Aksi</th>
											</tr>
										</thead>
										<tbody>
                                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($post->id); ?></td>
                                            <td><?php echo e($post->title); ?></td>
                                            <td><?php echo e($post->user->name); ?></td>
                                            <td>
                                            <a href="<?php echo e(route('site.single.post',$post->slug)); ?>" target= "_blank" 
                                            class = "btn btn-danger btn-sm info">Lihat</a>
                                            <a href="" class = "btn btn-warning btn-sm">Edit</a>
                                            
                                            </td>
                                        </tr>
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

<!-- Modal -->
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
<?php echo $__env->make('layouts/master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crud_laravel\resources\views/posts/index.blade.php ENDPATH**/ ?>