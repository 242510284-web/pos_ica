<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">POS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php echo e(Request::is('dashboard') ? 'active' : ''); ?>" aria-current="page" href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(Request::is('admin/users*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.users')); ?>">Users</a>
        </li>
      </ul>
      <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-flex">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-danger me-2">Logout</button>
      </form>
    </div>
  </div>
</nav>
<?php if(auth()->user()->role?->name == 'admin'): ?>
<h3> Admin - <?php echo e(auth()->user()->name); ?></h3>
  <?php else: ?>
  <h3>Kasir - <?php echo e(auth()->user()->name); ?></h3>
 <?php endif; ?>                              <?php /**PATH C:\pos_ica\aplikasi-pos\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>