<?php

use Illuminate\Database\Seeder;
use App\Models\Nft;

class NftsTableSeeder extends Seeder
{
    public function run()
    {
        // Créer 5 NFTs de test
        for ($i = 1; $i <= 5; $i++) {
            Nft::create([
                'title' => 'NFT test ' . $i,
                'artist' => 'Artist ' . $i,
                'description' => 'Description of NFT ' . $i,
                'contract_address' => 'Contract Address ' . $i,
                'token_standard' => 'ERC-721',
                'price' => 0.1 * $i,
                'image' => 'path/to/image' . $i . '.jpg',
                'category' => 'collectible',
            ]);
        }
    }
}
