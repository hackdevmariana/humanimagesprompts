<?php

namespace App\Enum;

enum CompositionStatusEnum: string
{
    case DRAFT = 'DRAFT';
    case COMPILED = 'COMPILED';
    case ARCHIVED = 'ARCHIVED';
}
