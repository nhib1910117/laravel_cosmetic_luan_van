<?php

namespace App\Models;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'brand';
    public function Blog(){
        return $this->hasMany(Product::class);
    }
}
