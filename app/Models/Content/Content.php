<?php
declare(strict_types=1);

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function contentable()
    {
        return $this->morphTo();
    }
}