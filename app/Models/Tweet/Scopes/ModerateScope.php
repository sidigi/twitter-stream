<?php
declare(strict_types=1);

namespace App\Models\Tweet\Scopes;

trait ModerateScope
{
    public function scopeApproved($query, $value = true)
    {
        return $query->where('approved', $value);
    }

    public function scopeModerated($query, $value = true)
    {
        return $query
            ->where('moderated', $value);
    }
}