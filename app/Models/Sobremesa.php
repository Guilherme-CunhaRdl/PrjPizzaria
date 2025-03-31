<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sobremesa extends Model
{
    use HasFactory;

    protected $table = 'sobremesas';

    protected $fillable = ['nomeSobremesa', 'precoSobremesa'];

    public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class, 'idSobremesa');
    }
}
