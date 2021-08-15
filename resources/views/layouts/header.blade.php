<style>
  .bi-arrow-repeat {
    animation: spin 2s linear infinite;
    font-size: 20px;
    top: 10px !important;
  }

  .dropdown-item {
    max-width: 300px;

  }
</style>
<header class="blog-header py-3">
  <div class="row flex-nowrap justify-content-between align-items-center">
    <div class="col-4 pt-1">
      <a class="link-secondary" href="#"></a>
    </div>
    <div class="col-4 text-center">
      <a class="blog-header-logo text-dark" href="/">Chia sẽ lập trình</a>
    </div>
    <div class="col-4 d-flex justify-content-end align-items-center">
      <livewire:component.search-all />
      @auth
      <div>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('dashboard') }}">Goto admin</a>
      </div>
      @endauth
    </div>
  </div>
</header>
