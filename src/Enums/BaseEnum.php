<?php

namespace Wovosoft\BdAcademicComponents\Enums;
trait BaseEnum
{
    public static function toOptions(): array
    {
        return array_map(fn($op) => [
            "text" => str($op->name)->title()->replace("_", " "),
            "value" => $op->value
        ], self::cases());
    }

    public function toJson(): string
    {
        return json_encode(self::toOptions());
    }
}
