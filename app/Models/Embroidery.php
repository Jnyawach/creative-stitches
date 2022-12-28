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

    public function format(){
        return $this->belongsTo(Format::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
