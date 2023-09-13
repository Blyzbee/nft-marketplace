@extends('layouts')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Inscription') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
              <label for="name">{{ __('Nom') }}</label>
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="email">{{ __('Adresse Email') }}</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="password">{{ __('Mot de passe') }}</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="password-confirm">{{ __('Confirmer le mot de passe') }}</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                {{ __("S'inscrire") }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection