<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'aluno_id',
        'preco',
        'prestacao',
        'troco',
        'comprovativo',
        'is_pago_terminado',
        'created_by',
        'updated_by'
    ];

    public function aluno(){
        return $this->belongsTo(Aluno::class);
    }

}
