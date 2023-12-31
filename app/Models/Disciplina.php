<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'created_by',
        'updated_by'
    ];

    public function curso_disciplina(){
        return $this->hasMany(CursoDisciplina::class);
    }

    public function cursos(){
        return $this->belongsToMany(Curso::class);
    }

}
