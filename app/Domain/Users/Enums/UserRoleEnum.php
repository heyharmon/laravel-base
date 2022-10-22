<?php

namespace DDD\Domain\Users\Enums;

enum UserRoleEnum: string
{
    case Admin = 'admin';
    case Editor = 'editor';
}
