<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRetirada extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'retirada_id',
        'codigo',
        'data_validade',
        'medicamento_id',
        'created_by',
        'updated_by'
    ];

    protected $table = "item_retirada";

    public function medicamento(){
        return $this->belongsTo(Medicamento::class,"medicamento_id");
    }

}
