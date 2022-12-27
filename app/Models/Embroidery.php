<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embroidery extends Model
{
    use HasFactory;

    protected $fillable=[
        'file_name','product_id','format_id'
    ];
}
