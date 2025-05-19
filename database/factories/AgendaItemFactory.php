<?php

namespace Database\Factories;

use App\Domains\Agenda\Models\AgendaItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Made\Cms\Language\Models\Language;
use Made\Cms\Models\User;
use Made\Cms\Shared\Enums\PublishingStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AgendaItem>
 */
class AgendaItemFactory extends Factory
{
    protected $model = AgendaItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->title,
            'language_id' => Language::factory(),
            'status' => PublishingStatus::Draft->value,
            'start_date' => $this->faker->date(),
            'description' => $this->faker->paragraphs(3, true),
            'created_by' => User::factory(),
        ];
    }

    public function draft(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => PublishingStatus::Draft->value,
            ];
        });
    }

    public function published(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => PublishingStatus::Published->value,
            ];
        });
    }
}
