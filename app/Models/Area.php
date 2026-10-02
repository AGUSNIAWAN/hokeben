<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['area_name', 'regional_name'];

    public function dailySalesPerformances()
    {
        return $this->hasMany(DailySalesPerformance::class);
    }

    public function growthComparisons()
    {
        return $this->hasMany(GrowthComparison::class);
    }

    public function tcmhRecords()
    {
        return $this->hasMany(TcmhRecord::class);
    }
}
