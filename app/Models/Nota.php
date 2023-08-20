<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'curso_disciplina_id',
        'aluno_id',
        'nota_primeira',
        'nota_segunda',
        'nota_terceira',
        'nota_final',
        'created_by',
        'updated_by'
    ];

    public function aluno(){
        return $this->belongsTo(Aluno::class);
    }

    public function curso_disciplina(){
        return $this->hasOne(CursoDisciplina::class,'id','curso_disciplina_id');
    }

}
