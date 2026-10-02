<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrowthComparison extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'month_year',
        'sales_last_year',
        'sales_current_year',
        'growth_percentage'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
