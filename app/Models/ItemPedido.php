<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    use HasFactory;

    protected $table = 'itens_pedido';

    protected $fillable = ['idPedido', 'idPizza', 'tamanho', 'quantidade', 'preco_unitario'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'idPedido');
    }

    public function pizza()
    {
        return $this->belongsTo(Pizza::class, 'idPizza');
    }


}
