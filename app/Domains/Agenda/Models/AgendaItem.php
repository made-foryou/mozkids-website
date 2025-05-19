<?php

declare(strict_types=1);

namespace App\Domains\Agenda\Models;

use App\Domains\Agenda\QueryBuilders\AgendaItemQueryBuilder;
use Database\Factories\AgendaItemFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Made\Cms\Language\Models\Language;
use Made\Cms\Models\User;
use Made\Cms\Shared\Contracts\DefinesCreatedByContract;
use Made\Cms\Shared\Observers\CreatedByDefiningObserver;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Carbon;
use Made\Cms\Shared\Enums\PublishingStatus;

/**
 * @property-read int $id
 * @property string $name
 * @property int|null $language_id
 * @property int|null $translated_from_id
 * @property string $status
 * @property string $description
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property int $created_by
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon|null $deleted_at
 */
#[ObservedBy([CreatedByDefiningObserver::class])]
class AgendaItem extends Model implements DefinesCreatedByContract, HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'language_id' => 'integer',
        'translated_from_id' => 'integer',
        'name' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => PublishingStatus::class,
        'description' => 'string',
        'created_by' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $fillable = [
        'language_id',
        'translated_from_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'created_by'
    ];

    public function translatedFrom(): BelongsTo
    {
        return $this->belongsTo(
            related: AgendaItem::class,
            foreignKey: 'translated_from_id',
        );
    }

    public function translations(): HasMany
    {
        return $this->hasMany(
            related: AgendaItem::class,
            foreignKey: 'translated_from_id',
        );
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(
            related: Language::class,
            foreignKey: 'language_id',
            ownerKey: 'id',
        );
    }

    /**
     * Defines the relationship between this model and the User model.
     *
     * This method establishes a "belongs to" relationship, indicating that this model is associated with an instance of the User model through the 'author' foreign key.
     *
     * @return BelongsTo The relationship instance between this model and the User model.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    /**
     * Registers media collections for the model.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image');
    }

    /**
     * Registers media conversions for the model, defining transformation settings for the media.
     *
     * @param  Media|null  $media  An optional Media instance to which the conversions apply.
     * @return void No return value.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->width(300)
            ->height(300)
            ->sharpen(10);
    }

    protected static function newFactory(): AgendaItemFactory
    {
        return AgendaItemFactory::new();
    }

    public function newEloquentBuilder($query): AgendaItemQueryBuilder
    {
        return new AgendaItemQueryBuilder($query);
    }
}
