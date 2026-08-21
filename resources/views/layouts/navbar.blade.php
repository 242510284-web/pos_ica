<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">POS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">Users</a>
        </li>
      </ul>
      <form action="{{ route('logout') }}" method="POST" class="d-flex">
        @csrf
        <button type="submit" class="btn btn-danger me-2">Logout</button>
      </form>
    </div>
  </div>
</nav>
@if(auth()->user()->role?->name == 'admin')
<h3> Admin - {{ auth()->user()->name }}</h3>
  @else
  <h3>Kasir - {{ auth()->user()->name }}</h3>
 @endif                              