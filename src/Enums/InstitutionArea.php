<?php

namespace Wovosoft\BdAcademicComponents\Enums;

use Wovosoft\LaravelCommon\Traits\HasEnumExtensions;

enum InstitutionArea: string
{
    use HasEnumExtensions;

    case RURAL             = "rural";
    case UPAZILA_POURA     = "upazila_poura";
    case UPAZILA_NOT_POURA = "upazila_not_poura";
    case CITY_CORPORATION  = "city_corporation";
    case DISTRICT_POURA    = "district_poura";

    public static function fromRaw(?string $value = null): ?InstitutionArea
    {
        return match ($value) {
            "RURAL" => self::RURAL,
            "UPAZILA SADAR PORA" => self::UPAZILA_POURA,
            "UPAZILA SADAR NOT POURA" => self::UPAZILA_NOT_POURA,
            "CITY CORPORATION" => self::CITY_CORPORATION,
            "DISTRICT SADAR POURA" => self::DISTRICT_POURA,
            default => null
        };
    }
}
