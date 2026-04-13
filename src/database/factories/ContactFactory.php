<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $types = [
            1 => '商品のお届けについて',
            2 => '商品の交換について',
            3 => '商品トラブル',
            4 => 'ショップへのお問い合わせ',
            5 => 'その他',
        ];
        
        $categoryId = $this->faker->numberBetween(1, 5);

        return [
            'category_id' => $categoryId,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'email' => $this->faker->unique()->safeEmail(),
            'tel1' => (string) $this->faker->numberBetween(10, 999),
            'tel2' => (string) $this->faker->numberBetween(100, 9999),
            'tel3' => (string) $this->faker->numberBetween(1000, 9999),
            'address' => $this->faker->address(),
            'building' => $this->faker->optional()->secondaryAddress(),
            'type' => $types[$categoryId],
            'detail' => $this->faker->realText(50),
        ];
    }
}
