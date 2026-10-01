<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_SUPER_ADMIN = 'super_admin';
    public const ROLE_CONTENT_MANAGER = 'content_manager';
    public const ROLE_SALES_MANAGER = 'sales_manager';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isContentManager(): bool
    {
        return $this->role === self::ROLE_CONTENT_MANAGER || $this->isSuperAdmin();
    }

    public function isSalesManager(): bool
    {
        return $this->role === self::ROLE_SALES_MANAGER || $this->isSuperAdmin();
    }

    public function canManageProducts(): bool
    {
        return $this->isSuperAdmin() || $this->role === self::ROLE_CONTENT_MANAGER;
    }

    public function canManageQuotes(): bool
    {
        return $this->isSuperAdmin() || $this->role === self::ROLE_SALES_MANAGER;
    }

    public function canManageSettings(): bool
    {
        return $this->isSuperAdmin();
    }
}
