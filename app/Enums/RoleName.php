<?php

namespace App\Enums;

enum RoleName: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case COACH = 'coach';
    case TRAINING = 'training';
}
