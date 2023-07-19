<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'quantidade_minino_stock',
        'created_by',
        'updated_by'
    ];

    public function user(){
        return $this->belongsTo(User::class,'id','created_by');
    }

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function retiradas(){
        return $this->hasMany(Retirada::class);
    }

}
