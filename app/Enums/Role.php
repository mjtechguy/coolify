<?php

namespace App\Enums;

enum Role: string
{
    case MEMBER = 'member';
    case ADMIN = 'admin';
    case OWNER = 'owner';
    case VIEWER = 'viewer';
    case LAUNCHER = 'launcher';

    public function rank(): int
    {
        return match ($this) {
            self::VIEWER => 1,
            self::LAUNCHER => 2,
            self::MEMBER => 3,
            self::ADMIN => 4,
            self::OWNER => 5,
        };
    }

    public function lt(Role|string $role): bool
    {
        if (is_string($role)) {
            $role = Role::from($role);
        }

        return $this->rank() < $role->rank();
    }

    public function gt(Role|string $role): bool
    {
        if (is_string($role)) {
            $role = Role::from($role);
        }

        return $this->rank() > $role->rank();
    }
}
