<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'data_inicio',
        'data_termino',
        'hora_entrada',
        'hora_termino',
        'sala',
        'created_by',
        'updated_by'
    ];

    public function curso_disciplina(){
        return $this->hasMany(CursoDisciplina::class);
    }

    public function alunos(){
        return $this->hasMany(Aluno::class);
    }

}
