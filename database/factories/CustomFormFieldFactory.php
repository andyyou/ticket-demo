<?php

namespace Database\Factories;

use App\Models\CustomForm;
use App\Models\CustomFormField;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomFormField>
 */
class CustomFormFieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fieldTypes = ['text', 'number', 'select', 'checkbox', 'radio', 'date', 'textarea'];
        $type = fake()->randomElement($fieldTypes);
        
        $options = null;
        if (in_array($type, ['select', 'radio'])) {
            $count = fake()->numberBetween(2, 5);
            $options = [];
            for ($i = 0; $i < $count; $i++) {
                $options[] = [
                    'value' => "option_{$i}",
                    'label' => fake()->word()
                ];
            }
        } elseif ($type === 'checkbox') {
            $options = [
                ['value' => '1', 'label' => '是']
            ];
        }

        return [
            'id' => Str::uuid(),
            'custom_form_id' => CustomForm::factory(),
            'label' => fake()->word(),
            'type' => $type,
            'options' => $options,
            'is_required' => fake()->boolean(70),
            'placeholder' => fake()->sentence(3),
            'help_text' => fake()->boolean(50) ? fake()->sentence() : null,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }

    /**
     * 設置為文本輸入欄位
     */
    public function text(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'text',
            'options' => null,
        ]);
    }

    /**
     * 設置為數字輸入欄位
     */
    public function number(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'number',
            'options' => null,
        ]);
    }

    /**
     * 設置為日期欄位
     */
    public function date(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'date',
            'options' => null,
        ]);
    }

    /**
     * 設置為選擇欄位
     */
    public function select(array $customOptions = null): static
    {
        $options = $customOptions ?? [
            ['value' => 'option_1', 'label' => '選項一'],
            ['value' => 'option_2', 'label' => '選項二'],
            ['value' => 'option_3', 'label' => '選項三'],
        ];

        return $this->state(fn (array $attributes) => [
            'type' => 'select',
            'options' => $options,
        ]);
    }

    /**
     * 設置為單選欄位
     */
    public function radio(array $customOptions = null): static
    {
        $options = $customOptions ?? [
            ['value' => 'option_1', 'label' => '選項一'],
            ['value' => 'option_2', 'label' => '選項二'],
        ];

        return $this->state(fn (array $attributes) => [
            'type' => 'radio',
            'options' => $options,
        ]);
    }

    /**
     * 設置為多行文本欄位
     */
    public function textarea(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'textarea',
            'options' => null,
        ]);
    }
} 