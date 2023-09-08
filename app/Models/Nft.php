<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nft extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'artist',
    'owner_id',
    'description',
    'contract_address',
    'token_standard',
    'price',
    'image',
    'category',
  ];

  public function owner()
  {
    return $this->belongsTo(User::class, 'owner_id');
  }
}
