<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Clinico extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function atendimento(): HasOne
    {
        return $this->hasOne(Atendimento::class, 'id', 'atendimento_id');
    }
    function exames(){
        return $this->hasMany(Exame::class);
    }
    function imagems(){
        return $this->hasMany(Imagem::class);
    }
    function ambulatorios(){
        return $this->hasMany(Ambulatorio::class);
    }
    function prescricaos(){
        return $this->hasMany(Prescricao::class);
    }
    function documentos(){
        return $this->hasMany(Documento::class);
    }
    function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
