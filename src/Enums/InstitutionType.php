<?php

namespace Wovosoft\BdAcademicComponents\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum InstitutionType: string
{
    use HasEnumExtensions;

    case SCHOOL             = "school";
    case COLLEGE            = "college";
    case SCHOOL_AND_COLLEGE = "school_and_college";
    case UNIVERSITY         = "university";

    public static function fromRaw(?string $value = null): ?InstitutionType
    {
        return match ($value) {
            "COLLEGE" => self::COLLEGE,
            "SCHOOL" => self::SCHOOL,
            "SCHOOL & COLLEGE" => self::SCHOOL_AND_COLLEGE,
            "UNIVERSITY" => self::UNIVERSITY,
            default => null
        };
    }
}
