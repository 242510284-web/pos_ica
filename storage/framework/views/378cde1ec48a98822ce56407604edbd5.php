<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Isi title yang kita kirimkan dari views lain-->
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- memanggil Link bootstraps-->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>

<div class="container">

    <?php if(session('success')): ?>
       <div class="alert alert-success">
        <?php echo e(session('success')); ?>

       </div>
    <?php endif; ?>
    
    <!-- Isi konten yang kita kirimkan dari views lain-->
    <?php echo $__env->yieldContent('content'); ?>

</div>

</body>
</html><?php /**PATH C:\pos_ica\aplikasi-pos\resources\views/layouts/app.blade.php ENDPATH**/ ?>