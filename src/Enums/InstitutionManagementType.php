<?php

namespace Wovosoft\BdAcademicComponents\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum InstitutionManagementType: string
{
    use HasEnumExtensions;

    case PUBLIC        = "public";
    case PRIVATE       = "private";
    case INTERNATIONAL = "intl";

    public static function fromRaw(?string $value = null): ?InstitutionManagementType
    {
        return match ($value) {
            "PUBLIC", "GOVERNMENT PRIMARY" => self::PUBLIC,
            "PRIVATE" => self::PRIVATE,
            "INTERNATIONAL" => self::INTERNATIONAL,
            default => null
        };
    }
}
