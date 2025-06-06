<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

/**
 * @property-read int $id
 * @property Carbon $year
 * @property string $title
 * @property string | null $description
 * @property string $file
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon | null $deleted_at
 */
class YearReport extends Model
{
    /** @use HasFactory<\Database\Factories\YearReportFactory> */
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ["year", "title", "description", "file"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "id" => "integer",
            "year" => "string",
            "title" => "string",
            "description" => "string",
            "file" => "string",
            "created_at" => "datetime",
            "updated_at" => "datetime",
            "deleted_at" => "datetime",
        ];
    }

    public function fileSize(): Attribute
    {
        return new Attribute(
            get: fn($value, array $attributes): string => Number::fileSize(
                filesize(storage_path("app/public/{$attributes["file"]}"))
            )
        );
    }
}
