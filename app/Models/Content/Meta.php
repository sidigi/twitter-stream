<?php
declare(strict_types=1);

namespace App\Models\Content;

use Carbon\Carbon;

/**
 * @property boolean             $default
 * @property Carbon              $date_from
 * @property Carbon              $date_to
 */
class Meta
{
    public $default;
    public $dateFrom;
    public $dateTo;

    /**
     * Meta constructor.
     * @param Carbon $dateFrom
     * @param Carbon $dateTo
     * @param bool $default
     */
    public function __construct(Carbon $dateFrom, Carbon $dateTo, bool $default = false)
    {
        $this->default = $default;
        $this->date_from = $dateFrom;
        $this->date_to = $dateTo;
    }
}