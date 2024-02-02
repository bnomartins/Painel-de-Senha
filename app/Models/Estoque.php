<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function produto(){
        return $this->belongsTo(Produto::class);
    }
    public function identificacao_estoque(){
        return $this->belongsTo(IdentificacaoEstoque::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function lote(){
        return $this->hasMany(Lote::class);
    }
}
