<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Atendimento extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
   
    public function senha(){
        return $this->belongsTo(Senha::class);
    }
   
    public function triagem(): HasMany
    {
        return $this->hasMany(Triagem::class);
    }

    public function clinico(): HasMany
    {
        return $this->hasMany(Clinico::class);
    }

    public function exames(): HasManyThrough
    {
        return $this->hasManyThrough(Exame::class, Clinico::class);
    }
    }

