<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    
    protected $fillable = ['cliente_id','produto_id','quantidade','valor_total','assinatura','status','signed_at',];

    protected $casts = ['signed_at' => 'datetime',
    
    ];

    // Um pedido pertence a um cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function produto() 
    {
        return $this->belongsTo(Product::class);
    }      

}

