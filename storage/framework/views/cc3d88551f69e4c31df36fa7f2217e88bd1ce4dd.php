

<?php $__env->startSection('content'); ?>
    <!-- Hero -->
    <div class="hero bg-white overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <h1 class="font-w700 mb-2">
                    Dash<span class="text-primary">mix</span> <span class="font-w300">+ Laravel <span class="text-danger">7</span></span>
                </h1>
                <h2 class="h4 font-w400 text-muted mb-4 invisible" data-toggle="appear" data-timeout="150">
                    Welcome to the starter kit! Build something amazing!
                </h2>
                <span class="m-2 d-inline-block invisible" data-toggle="appear" data-timeout="300">
                    <a class="btn btn-alt-primary px-4 py-3" href="/dashboard">
                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Enter Dashboard
                    </a>
                </span>
            </div>
        </div>
    </div>
    <!-- END Hero -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.simple', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\Neumaconce\resources\views/landing.blade.php ENDPATH**/ ?>