<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItensPedido extends Model
{
    protected $table = 'itens_pedido';
    protected $primaryKey = 'id_item_produto';
    protected $fillable = ['id_item_produto', 'id_produto', 'id_pedido', 'avaliacao_produto'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
