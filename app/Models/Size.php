<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable=['size_in_inches','size_in_mm','stitching_area_inches','stitching_area_mm'];
}
