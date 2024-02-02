<?php

namespace App\Models;
use App\Models\Atendimento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function atendimentos(){
        return $this->hasMany(Atendimento::class);
    }
}
