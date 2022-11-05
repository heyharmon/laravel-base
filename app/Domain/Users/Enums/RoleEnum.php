<?php

namespace DDD\Domain\Users\Enums;

enum RoleEnum: string
{
    case Admin = 'admin';
    case Editor = 'editor';
}
