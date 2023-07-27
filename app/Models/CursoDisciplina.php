<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoDisciplina extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'curso_id',
        'disciplina_id',
        'created_by',
        'updated_by'
    ];

    protected $table = "curso_disciplina";

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function disciplina(){
        return $this->belongsTo(Disciplina::class);
    }

}
