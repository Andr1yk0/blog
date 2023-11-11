<?php

namespace App\Enums;

enum ConfigTypeEnum: int
{
    case STRING = 1;
    case INT = 2;
    case BOOL = 3;
    case ARRAY = 4;
}
