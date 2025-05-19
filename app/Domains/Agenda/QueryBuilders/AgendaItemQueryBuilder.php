<?php

declare(strict_types=1);

namespace App\Domains\Agenda\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Made\Cms\Shared\QueryBuilders\HasPublishingStatusColumn;

class AgendaItemQueryBuilder extends Builder
{
    use HasPublishingStatusColumn;
}
