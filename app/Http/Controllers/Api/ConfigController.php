<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Config;
use App\Models\Option\Option;

class ConfigController
{
    public function get(): Config
    {
        return new Config([
            'mode' => Option::get('mode')
        ]);
    }
}