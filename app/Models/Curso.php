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
        'preco',
        'data_inicio',
        'data_termino',
        'hora_entrada',
        'hora_termino',
        'sala',
        'is_terminado',
        'created_by',
        'updated_by'
    ];

    public function curso_disciplina(){
        return $this->hasMany(CursoDisciplina::class,'curso_id','id');
    }

    public function alunos(){
        return $this->hasMany(Aluno::class);
    }

    public function disciplinas(){
        return $this->belongsToMany(Disciplina::class);
    }

}
