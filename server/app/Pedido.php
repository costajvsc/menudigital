<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';
    protected $fillable = ['id_pedido', 'nome_cliente', 'cpf_cliente', 'email_cliente', 'telefone', 'status', 'id_funcionario', 'avaliacao_funcionario'];

    public function itens()
    {
        return $this->hasMany(ItensPedido::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}
