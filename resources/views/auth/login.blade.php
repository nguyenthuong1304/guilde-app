@extends('layouts.auth')
@section('main')
<main class="form-signin">
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <img class="mb-4" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="floatingInput" placeholder="email@example.com">
      <label for="floatingInput" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
      @error('email')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="form-floating">
      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="floatingPassword" placeholder="Password">
      <label for="floatingInput" class="col-form-label text-md-right">{{ __('Password') }}</label>
      @error('password')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="checkbox mb-3">
      <label>
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">
          {{ __('Remember Me') }}
        </label>
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">{{ __('Login') }}</button>
    @if (Route::has('password.request'))
    <a class="btn btn-link" href="{{ route('password.request') }}">
      {{ __('Forgot Your Password?') }}
    </a>
    @endif
  </form>
</main>
@endsection
