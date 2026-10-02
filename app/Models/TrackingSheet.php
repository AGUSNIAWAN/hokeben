<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingSheet extends Model
{
    use HasFactory;

    protected $table = 'tracking_sheets';

    protected $guarded = [];
}
