<?php
declare(strict_types=1);

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Contentable
{
    public function content(): MorphMany;
}