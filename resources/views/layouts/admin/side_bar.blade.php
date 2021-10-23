<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <div class="nav">
        <div class="sb-sidenav-menu-heading">Core</div>
        <a class="nav-link" href="/admin">
          <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
          Trang Chủ
        </a>
        <a class="nav-link" href="{{ route('category_index') }}">
          <div class="sb-nav-link-icon"><i class="bi bi-list-nested"></i></div>
          Danh mục
        </a>
        <a class="nav-link" href="{{ route('post_index') }}">
          <div class="sb-nav-link-icon"><i class="bi bi-file-text-fill"></i></div>
          Bài viết
        </a>
        <a class="nav-link" href="{{ route('mini_tips') }}">
          <div class="sb-nav-link-icon"><i class="bi bi-code-square"></i></div>
          Mini tips
        </a>
        <a class="nav-link" href="{{ route('configs') }}">
          <div class="sb-nav-link-icon"><i class="bi bi-gear-fill"></i></div>
          Cài đặt
        </a>
      </div>
    </div>
  </nav>
</div>
