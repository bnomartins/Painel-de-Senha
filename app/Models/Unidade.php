<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function servicos(){
        return $this->belongsToMany(Servico::class, RelUnidServ::class)->withPivot('user_id')->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany(User::class, RelUnidServ::class)->withPivot('user_id')->withTimestamps();
    }
}
