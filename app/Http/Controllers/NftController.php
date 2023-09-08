<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nft;
use App\Models\User;

class NftController extends Controller
{
    // Affiche la liste des NFT
    public function index()
    {
        $nfts = Nft::all();
        return view('nfts.index', compact('nfts'));
    }

    // Affiche les détails d'un NFT
    public function show($id)
    {
        $nft = Nft::findOrFail($id);
        return view('nfts.show', compact('nft'));
    }

    // Effectue un achat de NFT
    public function purchase(Request $request, $id)
    {
        $nft = Nft::findOrFail($id);

        // Vérifie si l'utilisateur est connecté
        if (auth()->check()) {
            $user = auth()->user();

            // Vérifie si l'utilisateur possède suffisamment de fonds pour acheter le NFT
            if ($user->wallet >= $nft->price) {
                // Effectue l'achat : ajoute le NFT à la collection de l'utilisateur
                $user->nfts()->attach($nft);
                // Soustrait le prix du NFT du portefeuille de l'utilisateur
                $user->decrement('wallet', $nft->price);

                return redirect()->route('collection')->with('success', 'Achat réussi !');
            } else {
                return redirect()->back()->with('error', 'Fonds insuffisants pour acheter ce NFT.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Vous devez vous connecter pour acheter des NFTs.');
        }
    }

    // Vendre un NFT
    public function sell(Request $request, $id)
    {
        // Assurez-vous que l'utilisateur est connecté
        if (auth()->check()) {
            $nft = Nft::findOrFail($id);
            $user = auth()->user();

            // Vérifiez si l'utilisateur possède ce NFT
            if ($user->nfts->contains($nft)) {
                // Remet le NFT en vente en le détachant de la collection de l'utilisateur
                $user->nfts()->detach($nft);
                // Crédite le prix du NFT au portefeuille de l'utilisateur
                $user->increment('wallet', $nft->price);

                return redirect()->route('collection')->with('success', 'Le NFT a été remis en vente avec succès.');
            } else {
                return redirect()->back()->with('error', 'Vous ne possédez pas ce NFT.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Vous devez vous connecter pour vendre un NFT.');
        }
    }
}
