<?php

namespace Wovosoft\BdAcademicComponents\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum StudyType: string
{
    use HasEnumExtensions;

    case CO_EDUCATION_JOINT = "joint";
    case GIRLS              = "girls";
    case BOYS               = "boys";

    public static function fromRaw(?string $value = null): ?StudyType
    {
        return match ($value) {
            "GIRLS" => self::GIRLS,
            "BOYS" => self::BOYS,
            "CO-EDUCATION JOINT" => self::CO_EDUCATION_JOINT,
            default => null
        };
    }
}
