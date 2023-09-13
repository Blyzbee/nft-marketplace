@extends('layouts')

@section('content')
<div class="container">
  <h1>NFTs disponibles à la vente</h1>

  <div class="row">
    @if(auth()->check() && auth()->user()->isAdmin)
    <a href="{{ route('addNft') }}">Ajouter un NFT</a>
    @endif
    @foreach ($nfts as $nft)
    <div class="col-md-4 mb-4">
      <div class="card">
        <img src="{{ asset('storage/' . $nft->image) }}" class="card-img-top" alt="{{ $nft->title }}">
        <div class="card-body">
          <h5 class="card-title">{{ $nft->title }}</h5>
          <p class="card-text">Artiste: {{ $nft->artist }}</p>
          <p class="card-text">Prix: {{ $nft->price }} ETH</p>
          <a href="{{ route('nfts.show', ['id' => $nft->id]) }}" class="btn btn-primary">Détails</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection