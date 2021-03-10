<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  use HasFactory;


  protected $fillable = [
    "name", "price", "user_id"
  ];

  // protected $dispatchesEvents  = [
  //   'created' => App\Events\CreatedNewCheapestItem::class,
  // ];
}
