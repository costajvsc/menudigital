<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';
    protected $primaryKey = 'id_endereco';
    protected $fillable = ['id_endereco', 'cep', 'logradouro', 'complemento', 'bairro', 'localidade', 'uf'];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class);
    }
}
