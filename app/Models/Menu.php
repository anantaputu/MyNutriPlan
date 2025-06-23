<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FoodMaterial;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'recipe',
        'photo',
        'calories',
        'meal_type',
        'slug',
    ];

    public function foodMaterials()
    {
        return $this->belongsToMany(FoodMaterial::class, 'menu_food_material')
                    ->withPivot('quantity_grams'); // <-- Wajib ada untuk mengambil jumlah gram
    }
}