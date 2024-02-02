<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function clinicos(){
        return $this->hasMany(Clinico::class);
    }

    public function clinico(){
        return $this->belongsTo(Clinico::class);
    }

    public function imagem_auxes(){
        return $this->hasMany(ImagemAux::class, 'id', 'imagem_aux_id');
    }

    public function procedimentos(){
        return $this->hasMany(Procedimento::class, 'id', 'procedimento_id');
    }

    public function user_solicitacao(){
        return $this->belongsTo(User::class, 'solicitacao_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }



}
