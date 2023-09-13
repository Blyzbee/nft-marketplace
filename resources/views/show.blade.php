@extends('layouts')

@section('content')
<div class="container">
  @if (auth()->check())
  <p>Solde de votre portefeuille : {{ $userBalance }} ETH</p>
  @endif
  <div class="card">
    <img src="{{ asset('storage/' . $nft->image) }}" class="card-img-top" alt="{{ $nft->title }}">
    <div class="card-body">
      <h5 class="card-title">{{ $nft->title }}</h5>
      <p class="card-text">Artiste : {{ $nft->artist }}</p>
      <p class="card-text">Prix : {{ $nft->price }} ETH</p>

      @auth
      @if ($isOwner)
      <!-- Bouton de revente -->
      <form method="POST" action="{{ route('nfts.sell', $nft->id) }}">
        @csrf
        <button type="submit" class="btn btn-primary">Revendre ce NFT</button>
      </form>
      @else
      <!-- Bouton d'achat -->
      <form method="POST" action="{{ route('nfts.purchase', $nft->id) }}">
        @csrf
        <button type="submit" class="btn btn-success">Acheter ce NFT</button>
      </form>
      @endif
      @else
      <p>Connectez-vous pour acheter ou vendre ce NFT.</p>
      <a href="{{ route('login') }}" class="btn btn-primary">Connexion</a>
      @endauth
    </div>
  </div>
</div>
@endsection