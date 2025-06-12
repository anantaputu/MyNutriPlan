<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'calories', 'protein', 'fat', 
        'carbohydrates', 'fiber', 'vitamins', 'minerals'
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_food_material')
                    ->withPivot('quantity_grams');
    }
}