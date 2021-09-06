<style>
  .bi-arrow-repeat {
    animation: spin 2s linear infinite;
    font-size: 20px;
    top: 10px !important;
  }

  @media (min-width: 576px) {
    #search-all {
      margin-top: 10px;
    }

    .search-wrapper.focused {
      width: 100%;
    }
  }
</style>
<header class="blog-header py-3">
  <div class="row justify-content-between align-items-center">
    <div class="d-none d-md-block col-4 pt-1">
      <a class="link-secondary" href="#"></a>
    </div>
    <div class="col-md-4 col-sm-12 text-center">
      <a class="blog-header-logo text-dark" href="/">Chia sẻ lập trình</a>
    </div>
    <div class="col-md-4 col-sm-12 d-flex justify-content-end align-items-center" id="search-all">
      @if(request()->route()->getName() != 'search')
        <livewire:component.search-all />
      @endif
      @auth
      <div>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('dashboard') }}">Goto admin</a>
      </div>
      @endauth
    </div>
  </div>
</header>
