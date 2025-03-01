<?php

namespace App\Enums;

enum StatusPost: string
{
    case PUBLISHED  = 'published';
    case DRAFT  = 'draft';
    case SCHEDULE  = 'schedule';

    public function label() {
        return match ($this) {
            self::PUBLISHED => 'Published',
            self::DRAFT => 'Draft',
            self::SCHEDULE => 'Schedule',
        };
    }
}
