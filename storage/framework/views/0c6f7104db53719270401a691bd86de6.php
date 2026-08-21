<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container my-4">

    <!-- Section 1: Today's Sales -->
    <div class="row mb-4">
        <div class="col-md-12 mb-3 text-center">
            <h1 class="fw-bold text-primary">
                Ringkasan Hari Ini 
                <span class="text-secondary opacity-75" style="font-size: 1.1rem;">
                    (<?php echo e($tanggalHariIni->translatedFormat('l, j F Y')); ?>)
                </span>
            </h1>
        </div>

        <div class="col-md-12 mb-3">
            <h4 class="fw-bold text-primary border-start border-4 border-primary ps-2">Today's Sales</h4>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Models\User::class)): ?>
        <div class="col-md-6 mb-3">
            <div class="card h-100 border-0 shadow-sm rounded-3" style="background-color: #f0f7ff;">
                <div class="card-header bg-primary text-white fw-semibold rounded-top-3">
                    Total Nilai Penjualan Hari ini
                </div>
                <div class="card-body d-flex align-items-center justify-content-center py-4">
                    <h3 class="card-title m-0 fw-bold text-primary">Rp <?php echo e(number_format($ringkasan['total_penjualan'] ?? 0)); ?></h3> 
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-md-6 mb-3">
            <div class="card h-100 border-0 shadow-sm rounded-3" style="background-color: #f0f7ff;">
                <div class="card-header bg-primary text-white fw-semibold rounded-top-3">
                    Jumlah Transaksi Hari ini
                </div>
                <div class="card-body d-flex align-items-center justify-content-center py-4">
                    <h3 class="card-title m-0 fw-bold text-primary"><?php echo e($ringkasan['total_transaksi'] ?? 0); ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Cash & Payment Status -->
    <div class="row mb-4">
        <div class="col-md-12 mb-3">
            <h4 class="fw-bold text-primary border-start border-4 border-primary ps-2">Cash & Payment Status</h4>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Models\User::class)): ?>
        <div class="col-md-6 mb-3">
            <div class="card h-100 border-0 shadow-sm rounded-3" style="background-color: #e6f0fa;">
                <div class="card-header text-white fw-semibold rounded-top-3" style="background-color: #0284c7;">
                    Total Pembayaran Tunai
                </div>
                <div class="card-body d-flex align-items-center justify-content-center py-4">
                    <h3 class="card-title m-0 fw-bold" style="color: #0369a1;">Rp <?php echo e(number_format($ringkasan['total_cash'] ?? 0)); ?></h3>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-md-6 mb-3">
            <div class="card h-100 border-0 shadow-sm rounded-3" style="background-color: #e6f0fa;">
                <div class="card-header text-white fw-semibold rounded-top-3" style="background-color: #0284c7;">
                    Total Pembayaran Non-Tunai
                </div>
                <div class="card-body d-flex align-items-center justify-content-center py-4">
                    <h3 class="card-title m-0 fw-bold" style="color: #0369a1;">Rp <?php echo e(number_format($ringkasan['total_non_tunai'] ?? 0)); ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 3: Critical Inventory Status -->
    <div class="row mb-4">
        <div class="col-md-12 mb-3">
            <h4 class="fw-bold text-primary border-start border-4 border-primary ps-2">Critical Inventory Status</h4>
        </div>

        <!-- Kolom Kiri: Daftar Produk Stok Rendah -->
        <div class="col-md-6 mb-3">
            <div class="p-3 bg-white shadow-sm rounded-3 border">
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-exclamation-triangle"></i> Daftar Produk Stok Rendah</h5>
                <table class="table table-hover align-middle">
                    <thead class="table-primary text-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col" class="text-center">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $produkStokRendah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($produkStokRendah->firstItem() + $index); ?></td>
                                <td class="fw-semibold text-secondary"><?php echo e($produk->nama); ?></td>
                                <td class="text-center"><span class="badge bg-warning text-dark px-2 py-1"><?php echo e($produk->stok); ?></span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" class="text-muted text-center py-3">
                                    Seluruh produk berada dalam kondisi stok aman.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <?php echo e($produkStokRendah->links()); ?>

                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Produk Habis Stok -->
        <div class="col-md-6 mb-3">
            <div class="p-3 bg-white shadow-sm rounded-3 border">
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-x-circle"></i> Produk Habis Stok</h5>
                <table class="table table-hover align-middle">
                    <thead class="table-primary text-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col" class="text-center">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $produkStokHabis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($produkStokHabis->firstItem() + $index); ?></td>
                                <td class="fw-semibold text-secondary"><?php echo e($produk->nama); ?></td>
                                <td class="text-center"><span class="badge bg-danger px-2 py-1"><?php echo e($produk->stok); ?></span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" class="text-muted text-center py-3">
                                    Tidak ada produk yang habis stok.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <?php echo e($produkStokHabis->links()); ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Section 4: Best Seller Products -->
    <div class="row">
        <div class="col-md-12 mb-3">
            <h4 class="fw-bold text-primary border-start border-4 border-primary ps-2">Best Seller Products</h4>
        </div>
        <div class="col-md-12">
            <div class="p-3 bg-white shadow-sm rounded-3 border">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary text-primary">
                        <tr>
                            <th scope="col">Nama Produk</th>
                            <th scope="col" class="text-center">Sisa Stok</th>
                            <th scope="col" class="text-center">Unit Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $produkTerlaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="fw-bold text-primary"><?php echo e($produk->nama); ?></td>
                                <td class="text-center"><span class="badge bg-info text-white"><?php echo e($produk->stok); ?></span></td>
                                <td class="text-center fw-bold text-success"><?php echo e($produk->total_terjual ?? 0); ?> Unit</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" class="text-muted text-center py-3">
                                    Belum ada data penjualan produk.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\pos_ica\aplikasi-pos\resources\views/dashboard.blade.php ENDPATH**/ ?>