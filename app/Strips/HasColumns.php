<?php

declare(strict_types=1);

namespace App\Strips;

use App\Schemas\ButtonSchema;
use App\Schemas\ColumnSchema;

trait HasColumns
{
    public static function resolveAttributes(array $attributes): array
    {
        $attributes['live'] = true;

        if (isset($attributes['left_columns'])) {
            foreach ($attributes['left_columns'] as &$column) {
                $column = ButtonSchema::resolveViewAttributes($column);
                $column = ColumnSchema::resolveViewAttributes($column);
            }
        }

        if (isset($attributes['middle_columns'])) {
            foreach ($attributes['middle_columns'] as &$column) {
                $column = ButtonSchema::resolveViewAttributes($column);
                $column = ColumnSchema::resolveViewAttributes($column);
            }
        }

        if (isset($attributes['right_columns'])) {
            foreach ($attributes['right_columns'] as &$column) {
                $column = ButtonSchema::resolveViewAttributes($column);
                $column = ColumnSchema::resolveViewAttributes($column);
            }
        }

        return $attributes;
    }
}
