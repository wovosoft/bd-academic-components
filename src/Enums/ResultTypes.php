<?php

namespace Wovosoft\BdAcademicComponents\Enums;
enum ResultTypes: int
{
    use BaseEnum;

    case NOT_DEFINED = 0;
    case DIVISION = 1;
    case CLASSIFIED = 2;
    case GPA_SCALE_5 = 3;
    case GPA_SCALE_4 = 4;
}
