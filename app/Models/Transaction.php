<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    //nama tabel transaction jika tidak dibuat maka dia membaca default jamak menjadi transactions
    protected $table = 'transaction';

    protected $fillable = [
        'uuid', 'name', 'email', 'number', 'address',
        'transaction_total', 'transaction_status'
    ];

    protected $hidden = [];

    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id');
    }
}
