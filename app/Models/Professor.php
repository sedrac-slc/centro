<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'curso_disciplina_id',
        'user_id',
        'created_by',
        'updated_by'
    ];

    protected $table = "professores";

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function curso_disciplina(){
        return $this->hasMany(CursoDisciplina::class,'id','curso_disciplina_id');
    }

}
