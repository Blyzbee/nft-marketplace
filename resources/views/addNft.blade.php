@extends('layouts')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Ajouter un NFT') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('addNft') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label for="title">{{ __('Titre') }}</label>
              <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus>
              @error('title')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="artist">{{ __('Artiste') }}</label>
              <input id="artist" type="text" class="form-control @error('artist') is-invalid @enderror" name="artist" value="{{ old('artist') }}" required>
              @error('artist')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="description">{{ __('Description') }}</label>
              <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') }}</textarea>
              @error('description')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="contract_address">{{ __('Adresse du contrat') }}</label>
              <input id="contract_address" type="text" class="form-control @error('contract_address') is-invalid @enderror" name="contract_address" value="{{ old('contract_address') }}" required>
              @error('contract_address')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="token_standard">{{ __('Standard de token') }}</label>
              <input id="token_standard" type="text" class="form-control @error('token_standard') is-invalid @enderror" name="token_standard" value="{{ old('token_standard') }}" required>
              @error('token_standard')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="price">{{ __('Prix') }}</label>
              <input id="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>
              @error('price')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="image">{{ __('Image') }}</label>
              <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*" required>
              @error('image')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="category">{{ __('Catégorie') }}</label>
              <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}" required>
              @error('category')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                {{ __('Ajouter le NFT') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection