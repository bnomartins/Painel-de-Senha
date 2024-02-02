<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelUnidServ extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function unidades(){
        return $this->hasMany(Unidade::class)->withTimestamps();
    }

    public function servicos(){
        return $this->hasMany(Servico::class)->withTimestamps();
    }
}
