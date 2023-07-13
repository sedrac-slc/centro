<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'nome',
        'descricao',
        'quantidade_stock',
        'quantidade_minino_stock',
        'data_validade',
        'created_by',
        'updated_by'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
