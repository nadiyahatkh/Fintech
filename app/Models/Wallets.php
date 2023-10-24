<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'credit',
        'debit',
        'status',
        'description',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
