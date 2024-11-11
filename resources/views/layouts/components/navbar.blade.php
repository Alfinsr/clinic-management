<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item d-none d-sm-inline-block">
      <!-- Form logout dengan metode POST -->
      <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="nav-link" style="background:none; border:none; color: inherit;">
          Logout
        </button>
      </form>
    </li>
  </ul>
</nav>
