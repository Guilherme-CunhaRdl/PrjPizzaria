<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    use HasFactory;

    protected $table = 'itens_pedido';

    protected $fillable = ['idPedido', 'idPizza', 'idBebida', 'idSobremesa', 'idAcompanhamento', 'quantidade', 'precoTotal'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'idPedido');
    }

    public function pizza()
    {
        return $this->belongsTo(Pizza::class, 'idPizza');
    }

    public function bebida()
    {
        return $this->belongsTo(Bebida::class, 'idBebida');
    }

    public function sobremesa()
    {
        return $this->belongsTo(Sobremesa::class, 'idSobremesa');
    }

    public function acompanhamento()
    {
        return $this->belongsTo(Acompanhamento::class, 'idAcompanhamento');
    }
}
