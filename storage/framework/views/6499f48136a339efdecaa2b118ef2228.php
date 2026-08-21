<?php $__env->startSection('title', 'Tambah Produk'); ?>

<?php $__env->startSection('content'); ?>
<h4>Tambah Produk</h4>
<form action="<?php echo e(route('produk.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo $__env->make('produk._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\pos_ica\aplikasi-pos\resources\views/produk/create.blade.php ENDPATH**/ ?>