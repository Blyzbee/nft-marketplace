<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nft;

class HomeController extends Controller
{
    public function index()
    {
        $nfts = Nft::whereNull('owner_id')->get(); // Récupère les NFTs sans propriétaire

        return view('home', compact('nfts'));
    }
}
