<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'description',
        'unit_price',
        'category',
        'image_url',
        'availableQty',
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

    public function favorites()
    {
        return $this->hasMany(Favorites::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }


    public function isLikedByUser($userId)
    {
        return $this->favorites()->where('user_id', $userId)->exists();
    }

    public function isAddedtoCart($userId)
    {
        return $this->cart()->where('user_id', $userId)->exists();
    }

}
