<?php

namespace DDD\Domain\Base\Users\Enums;

enum RoleEnum: string
{
    case Admin = 'admin';
    case Editor = 'editor';
}
