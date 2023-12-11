<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{   
    use HasFactory;
    public function user(){
        return $this->BelongsTo(User::class,'id_user','id');
    }
    public function horario(){
        return $this->BelongsTo(Horario::class,'id_horario','id');
    }
}
