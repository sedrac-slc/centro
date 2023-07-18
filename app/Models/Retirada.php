<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retirada extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'medicamento_id',
        'quantidade_inicial',
        'quantidade_retirada',
        'quantidade_stock',
        'created_by',
        'updated_by'
    ];

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function items(){
        return $this->hasMany(ItemRetirada::class);
    }

    public function medicamento(){
        return $this->belongsTo(Medicamento::class);
    }

}
