<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;
use Made\Cms\Shared\Enums\PublishingStatus;

return new class extends Migration
{
    use HasDatabaseTablePrefix;

    public function up(): void
    {
        Schema::create('agenda_items', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->foreignId('language_id')
                    ->nullable()
                    ->references('id')
                    ->on($this->prefixTableName('languages'))
                    ->nullOnDelete();

            $table->string('status')
                    ->default(
                        PublishingStatus::Draft->value
                    );

            $table->text('description')
                ->nullable();

            $table->date('start_date')
                ->default(now());

            $table->date('end_date')
                ->nullable();

            /**
             * Filled as soon as the model is saved. This tracks who
             * modified/created this part.
             */
            $table->foreignId('created_by')
                ->references('id')
                ->on($this->prefixTableName('users'))
                ->restrictOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::table(
            table: 'agenda_items',
            callback: function (Blueprint $table) {
                $table->foreignId('translated_from_id')
                    ->nullable()
                    ->after('language_id')
                    ->references('id')
                    ->on('agenda_items')
                    ->nullOnDelete();
            }
        );
    }
};
