<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'description',
        'unit_price',
        'category',
        'image_url',
        'user_id',
        // add all other fields
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    protected $table = 'products';

    public function scopeFilter($query, $search)
    {
        if ($search) {
            $query->where(function ($query) use ($search) {
                if (is_array($search)) {
                    foreach ($search as $term) {
                        $query->where('product_name', 'LIKE', '%' . $term . '%')
                              ->orWhere('category', 'LIKE', '%' . $term . '%')
                              ->orWhere('description', 'LIKE', '%' . $term . '%')
                              ->orWhere('unit_price', 'LIKE', '%' . $term . '%');
                    }
                } else {
                    $query->where('product_name', 'LIKE', '%' . $search . '%')
                          ->orWhere('category', 'LIKE', '%' . $search . '%')
                          ->orWhere('description', 'LIKE', '%' . $search . '%')
                          ->orWhere('unit_price', 'LIKE', '%' . $search . '%');
                }
            });
        }
    }
    

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
