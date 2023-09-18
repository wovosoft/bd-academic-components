<?php

namespace Wovosoft\BdAcademicComponents\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum InstitutionGeography: string
{
    use HasEnumExtensions;

    case PLAIN_LAND      = "plain_land";
    case TEA_GARDEN      = "tea_garden";
    case HILLY_AREA      = "hilly_area";
    case COASTAL_AREA    = "coastal_area";
    case RIVER_SIDE_CHAR = "river_side_char";
    case HAOUR_BILL      = "haour_bill";
    case INDUSTRIAL_AREA = "industrial_area";

    public static function fromRaw(?string $value): ?InstitutionGeography
    {
        return match ($value) {
            "PLAIN LAND" => self::PLAIN_LAND,
            "TEA GARDEN" => self::TEA_GARDEN,
            "HILLY AREA" => self::HILLY_AREA,
            "COASTAL AREA" => self::COASTAL_AREA,
            "RIVER SIDE/CHAR" => self::RIVER_SIDE_CHAR,
            "HAOUR/BIL" => self::HAOUR_BILL,
            "INDUSTRIAL AREA" => self::INDUSTRIAL_AREA,
            default => null
        };
    }
}
