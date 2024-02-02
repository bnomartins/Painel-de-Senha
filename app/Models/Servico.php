<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function unidades(){
        return $this->belongsToMany(Unidade::class,  RelUnidServ::class)->withPivot('user_id')->withTimestamps();
    }    

    public function users(){
        return $this->belongsToMany(User::class, RelUnidServ::class)->withPivot('user_id')->withTimestamps();
    }    
}
