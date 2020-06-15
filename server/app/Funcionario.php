<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    public $timestamps = false;
    protected $table = 'funcionarios';
    protected $primaryKey = 'id_funcionario';
    protected $fillable = ['id_funcionario', 'nome_funcionario', 'email_funcionario', 'cpf_funcionario', 'rg_funcionario', 'pis_funcionario', 'carteira_trabalho_funcionario', 'telefone', 'celular', 'salario', 'banco', 'agencia', 'conta', 'cargo', 'status'];

    public function pedidos()
    {
        return $this->hasMany(Pedidos::class);
    }
}
