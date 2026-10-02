<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySalesPerformance extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'date',
        'target_sales',
        'actual_sales',
        'achievement_percentage'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
