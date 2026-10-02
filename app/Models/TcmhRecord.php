<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TcmhRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'date',
        'store_type',
        'target_tcmh',
        'actual_tcmh'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
