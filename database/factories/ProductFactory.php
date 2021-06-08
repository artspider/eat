<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word();
        return [
            'name' => $name,
            'category_id' => $this->faker->randomElement([2,3,4,5,6,7,8,9]),
            'unit_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9]),
            'price' => $this->faker->numberBetween($min = 50, $max = 2000),
            'stock' => $this->faker->numberBetween($min = 2, $max = 100),
            'supplier_id' => $this->faker->randomElement([1,2,3,4]),
            'slug' => Str::slug($name,'-'),
            'presentation' => $this->faker->randomElement(['Granel','Caja', 'Enlatado', 'Botella de vidrio', 'Botella de plástico', 'Bolsa de plástico']),
            'brand' => $this->faker->company(),
        ];
    }
}
