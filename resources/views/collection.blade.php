@extends('layouts')

@section('content')
<div class="container">
  <h1>Ma Collection de NFT</h1>

  @if (count($userNfts) > 0)
  <div>
    @foreach ($userNfts as $nft)
    <div class="card">
      <img src="{{ asset('storage/' . $nft->image) }}" class="card-img-top" alt="{{ $nft->title }}">
      <div class="card-body">
        <h5 class="card-title">{{ $nft->title }}</h5>
        <p class="card-text">Artiste : {{ $nft->artist }}</p>
        <p class="card-text">Prix : {{ $nft->price }} ETH</p>

        <!-- Bouton de revente -->
        <form method="POST" action="{{ route('nfts.sell', $nft->id) }}">
          @csrf
          <button type="submit" class="btn btn-primary">Revendre ce NFT</button>
        </form>

      </div>
      @endforeach
    </div>
    @else
    <p>Votre collection de NFT est vide.</p>
    @endif
  </div>
  @endsection