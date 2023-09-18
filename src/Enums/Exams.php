<?php

namespace Wovosoft\BdAcademicComponents\Enums;

enum Exams: int
{
    use BaseEnum;

    case BELLOW_SSC            = 0;
    case SSC                   = 1;
    case HSC                   = 2;
    case DAKHIL                = 3;
    case FAZIL                 = 4;
    case ALIM                  = 5;
    case GRADUATION_HONOURS    = 6;
    case GRADUATION_PASS       = 7;
    case PHD                   = 8;
    case MPHIL                 = 9;
    case MBBS                  = 10;
    case MASTERS_OR_EQUIVALENT = 11;
}
