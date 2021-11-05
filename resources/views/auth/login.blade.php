@extends('layouts.app')

@section('content')
<main class="page-center">
  <article class="sign-up">
    <h1 class="sign-up__title">{{ __('Repasses') }}</h1>
    <p class="sign-up__subtitle">{{ __('Controle de Acesso')}}</p>
    <form method="POST" action="{{ route('login') }}" class="sign-up-form form">
                        @csrf
      <label class="form-label-wrapper">
        <p class="form-label">{{ __('E-mail Cadastrado') }}</p>
        <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </label>
      <label class="form-label-wrapper">
        <p class="form-label">{{ __('Senha') }}</p>
        <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
      </label>
      @if (Route::has('password.request'))
        <a class="link-info forget-link" href="{{ route('password.request') }}">
            {{ __('Esqueceu sua senha?') }}
        </a>
      @endif
      <a class="link-info forget-link" href="##">Forgot your password?</a>
      <label class="form-checkbox-wrapper">
        <input class="form-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <span class="form-checkbox-label">{{ __('Lembrar-me') }}</span>
      </label>
      <button class="form-btn primary-default-btn transparent-btn">{{ __('Entrar') }}</button>
    </form>
  </article>
</main>
@endsection
