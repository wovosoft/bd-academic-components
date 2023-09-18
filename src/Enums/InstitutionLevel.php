<?php

namespace Wovosoft\BdAcademicComponents\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum InstitutionLevel: string
{
    use HasEnumExtensions;

    case GOVT_PRIMARY     = "govt_primary";
    case JUNIOR_SECONDARY = "junior_secondary";
    case SECONDARY        = "secondary";
    case HIGHER_SECONDARY = "higher_secondary";
    case DEGREE_PASS      = "degree_pass";
    case DEGREE_HONOURS   = "degree_honours";
    case MASTERS          = "masters";

    public static function fromRaw(?string $value = null): ?InstitutionLevel
    {
        return match (trim($value)) {
            "DEGREE (PASS)" => self::DEGREE_PASS,
            "DEGREE (HONORS)" => self::DEGREE_HONOURS,
            "GOVT. PRIMARY (PRE TO FIVE)" => self::GOVT_PRIMARY,
            "JUNIOR SECONDARY" => self::JUNIOR_SECONDARY,
            "SECONDARY" => self::SECONDARY,
            "HIGHER SECONDARY" => self::HIGHER_SECONDARY,
            "MASTERS " => self::MASTERS,
            default => null
        };
    }
}
