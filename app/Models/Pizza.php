<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $table = 'pizzas';

    protected $fillable = [
        'nomePizza',
        'valorPequenaPizza',
        'valorMediaPizza', 
        'valorGrandePizza',
        'ingredientesPizza',
        'categoriaPizza',
        'imgPizza',
        'destaque',
        'promocao',
        'disponivel'
    ];

    public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class, 'idPizza');
    }


}
