<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    protected $model = Photo::class;

    public function definition()
    {
        return [
            'user_id' => 1, // Burada user_id'yi sabit bir değere ayarladım. İhtiyacınıza göre değiştirebilirsiniz.
            'file_path' => 'photos/' . $this->faker->unique()->numberBetween(1, 10000) . '.png', // 'photos/' ile başlayan ve '.png' ile biten bir dosya yolu oluşturur.
            'description' => $this->faker->sentence(), // Sahte bir cümle oluşturur.
        ];
    }
}
