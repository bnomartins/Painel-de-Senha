<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulatorio extends Model
{ 
    use HasFactory;

    protected $guarded = ['id'];

    public function clinicos(){
        return $this->hasMany(Clinico::class);
    }

    public function clinico(){
        return $this->belongsTo(Clinico::class);
    }

    public function procedimentos(){
        return $this->hasMany(Procedimento::class, 'id', 'procedimento_id');
    }

    public function medicamentos(){
        return $this->belongsToMany(Medicamento::class, 'rel_proc_meds')->withPivot(['observacao']);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function user_solicitacao(){
        return $this->belongsTo(User::class, 'solicitacao_id', 'id');
    }

}
