<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'medicamento_id',
        'codigo',
        'data_validade',
        'created_by',
        'updated_by'
    ];

    public function medicamento(){
        return $this->belongsTo(Medicamento::class);
    }

}
