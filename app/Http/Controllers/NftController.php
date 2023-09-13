<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nft;
use App\Models\User;
use Mockery\Undefined;

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
        $isOwner = false;
        $userBalance = null;

        if (auth()->check()) {
            $user = auth()->user();
            $isOwner = $user->nfts->contains($nft);
            $userBalance = $user->wallet;
        }

        return view('show', compact('nft', 'isOwner', 'userBalance'));
    }

    public function collection()
    {
        // Vérifiez si l'utilisateur est connecté
        if (auth()->check()) {
            $user = auth()->user();

            // Récupérez les NFT de l'utilisateur
            $userNfts = $user->nfts;

            return view('collection', compact('userNfts'));
        }

        // Redirigez si l'utilisateur n'est pas connecté
        return redirect()->route('login')->with('error', 'Vous devez vous connecter pour accéder à votre collection de NFT.');
    }


    public function showAddForm()
    {
        return view('addNft');
    }

    // Traite la soumission du formulaire et ajoute le NFT
    public function addNft(Request $request)
    {
        // Validez les données du formulaire
        $validatedData = $request->validate([
            'title' => 'required|string',
            'artist' => 'required|string',
            'description' => 'required|string',
            'contract_address' => 'required|string',
            'token_standard' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string',
        ]);

        // Gérez le téléchargement de l'image
        $imagePath = $request->file('image')->store('nft_images', 'public');

        // Créez un nouvel objet Nft avec les données validées
        $nft = new Nft([
            'title' => $validatedData['title'],
            'artist' => $validatedData['artist'],
            'description' => $validatedData['description'],
            'contract_address' => $validatedData['contract_address'],
            'token_standard' => $validatedData['token_standard'],
            'price' => $validatedData['price'],
            'image' => $imagePath, // Chemin de l'image téléchargée
            'category' => $validatedData['category'],
        ]);

        // Enregistrez le NFT dans la base de données
        $nft->save();

        // Redirigez l'utilisateur vers une page de confirmation ou une autre page
        return redirect()->route('home')->with('success', 'Le NFT a été ajouté avec succès.');
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
                // Met à jour le propriétaire du NFT
                $nft->update(['owner_id' => $user->id]);
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
                // Remet le NFT en vente
                $nft->update(['owner_id' => null]);
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
