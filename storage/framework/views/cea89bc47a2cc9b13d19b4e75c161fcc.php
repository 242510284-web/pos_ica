<?php $__env->startSection('title', 'Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container mt-4">
    <!-- Header Halaman -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">Halaman Produk</h2>
            <p class="text-muted small mb-0">Kelola katalog produk, harga, dan ketersediaan stok</p>
        </div>
        <!-- Tombol Create Produk -->
        <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Create
        </a>
    </div>

    <!-- Form Search -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form action="<?php echo e(route('produk.index')); ?>" method="GET">
                <div class="input-group">
                    <input 
                        type="text" 
                        name="search" 
                        value="<?php echo e(request('search')); ?>" 
                        class="form-control border-primary-subtle" 
                        placeholder="Search nama produk..."
                    >
                    <button class="btn btn-primary px-4" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Produk -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary text-primary">
                        <tr>
                            <th scope="col" class="py-3 px-3">#</th>
                            <th scope="col" class="py-3">User</th>
                            <th scope="col" class="py-3">Foto</th>
                            <th scope="col" class="py-3">Nama</th>
                            <th scope="col" class="py-3">Harga Beli</th>
                            <th scope="col" class="py-3">Harga Jual</th>
                            <th scope="col" class="py-3 text-center">Stok</th>
                            <th scope="col" class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-3 fw-semibold text-secondary">
                                <?php echo e(method_exists($produk, 'firstItem') ? $produk->firstItem() + $index : $index + 1); ?>

                            </td>
                            <td class="text-secondary small"><?php echo e($item->user->name ?? $item->user_id); ?></td>
                            <td>
                                <?php if($item->foto): ?>
                                    <img src="<?php echo e(asset('storage/' . $item->foto)); ?>" alt="<?php echo e($item->nama); ?>" class="rounded border" style="width: 48px; height: 48px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-light rounded border d-flex align-items-center justify-content-center text-muted" style="width: 48px; height: 48px; font-size: 0.7rem;">
                                        No Image
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold text-dark"><?php echo e($item->nama); ?></td>
                            <td class="text-secondary">Rp. <?php echo e(number_format($item->harga_beli, 0, ',', '.')); ?></td>
                            <td class="fw-semibold text-primary">Rp. <?php echo e(number_format($item->harga_jual, 0, ',', '.')); ?></td>
                            <td class="text-center">
                                <span class="badge <?php echo e($item->stok > 10 ? 'bg-info-subtle text-info-emphasis border border-info-subtle' : 'bg-warning-subtle text-warning-emphasis border border-warning-subtle'); ?> px-2 py-1">
                                    <?php echo e($item->stok); ?>

                                </span>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo e(route('produk.edit', $item->id)); ?>" class="btn btn-sm btn-info text-white me-1">
                                    Edit
                                </a>
                                <form action="<?php echo e(route('produk.destroy', $item->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-muted text-center py-4">
                                Data produk tidak ditemukan.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination (jika controller menggunakan paginate) -->
    <?php if(method_exists($produk, 'links')): ?>
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($produk->links()); ?>

        </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\pos_ica\aplikasi-pos\resources\views/produk/index.blade.php ENDPATH**/ ?>