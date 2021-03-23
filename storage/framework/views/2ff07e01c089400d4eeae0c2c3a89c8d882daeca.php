<?php $__env->startSection('content'); ?>

<section class="banner-area relative about-banner" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Pendaftaran				
							</h1>	
							<p class="text link-nav"><a href="index.html">Home </a>  
                            <span class="lnr lnr-arrow-right"></span>  <a href="about.html"> Pendaftaran</a></p>
						</div>	
					</div>
				</div>
			</section>

<section class="search-course-area relative" style = "background:unset;">
				<div class="container">
					<div class="row justify-content-between align-items-center">
						<div class="col-lg-6 col-md-6 search-course-left">
							<h1 class="text">
								Pendaftaran Online<br>
								Ayo bergabung!
							</h1>
							<p>
								inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach.
							</p>
						</div>
						<div class="col-lg-49 col-md-6 search-course-right section-gap">
                        <?php echo Form::open(['url' => '/postregister', 'class'=> 'form-wrap']); ?>

								<h4 class="text pb-20 text-center mb-30">Formulir Pendaftaran</h4>
                                <?php echo Form::text('nama_depan','',['class' => 'form-control','placeholder'=>'Nama Depan']); ?>

                                <?php echo Form::text('nama_belakang','',['class' => 'form-control','placeholder'=>'Nama Belakang']); ?>	
                                <?php echo Form::text('agama', '',['class' => 'form-control','placeholder'=>'Agama']); ?>

                                <?php echo Form::textarea('alamat', '',['class' => 'form-control','placeholder'=>'Alamat']); ?>

                                <div class="form-select" id="service-select">
                                <?php echo Form::select('jenis_kelamin', ['value'=>'Pilih Jenis Kelamin','L' => 'Laki-laki', 'P' => 'Perempuan'],'L');; ?>		
								</div>
                                <?php echo Form::email('email', '',['class' => 'form-control','placeholder'=>'Email']); ?>

                                <?php echo Form::password('password',['class' => 'form-control','placeholder'=>'Password']); ?>


								<input class="primary-btn text-uppercase" type = "submit" value="Kirim" style ="text-align:center;"></button>
                        <?php echo Form::close(); ?>

						</div>
					</div>
				</div>	
			</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\crud_laravel\resources\views/site/register.blade.php ENDPATH**/ ?>