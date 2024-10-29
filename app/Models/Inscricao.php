<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'curso_id', 'phone', 'nome', 'email', 'birthday', 'gender'
    ];

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

}
