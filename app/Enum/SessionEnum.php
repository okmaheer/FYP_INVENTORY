<?php

declare(strict_types=1);

namespace App\Enum;

class SessionEnum extends AbstractEnum
{
    public const SESSION_BUSINESS_ID = 'business_id';
    public const SESSION_LOCATION_ID = 'location_id';

    public static function getValues(): array
    {
        return [];
    }

    public static function getTranslationKeys(): array
    {
        return [

        ];
    }
}
