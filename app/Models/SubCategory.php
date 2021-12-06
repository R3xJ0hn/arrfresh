<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'subcategory_name',
        'subcategory_slug',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    
}
