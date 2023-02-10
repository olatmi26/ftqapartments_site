<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ContactUs;

class ContactUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactUs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->safeEmail,
            'fullName' => $this->faker->word,
            'message' => $this->faker->text,
            'subject' => $this->faker->word,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
