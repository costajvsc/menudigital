<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id_produto';
    protected $fillable = ['id_produto', 'nome_produto', 'descricao', 'categoria', 'status'];

    public function item()
    {
        return $this->belongsTo(ItensPedido::class);
    }
}
