<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'curso_id',
        'created_by',
        'updated_by'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

}
