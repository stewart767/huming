<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteRequest extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'new';
    public const STATUS_REVIEWING = 'reviewing';
    public const STATUS_CONTACTED = 'contacted';
    public const STATUS_QUOTED = 'quoted';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'quote_number',
        'full_name',
        'company_name',
        'email',
        'phone',
        'country',
        'location',
        'product_id',
        'product_name',
        'quantity',
        'preferred_unit',
        'message',
        'attachment',
        'preferred_contact_method',
        'status',
        'internal_notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($quote) {
            if (empty($quote->quote_number)) {
                $quote->quote_number = 'QR-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
            }
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300',
            self::STATUS_REVIEWING => 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300',
            self::STATUS_CONTACTED => 'bg-purple-100 text-purple-800 dark:bg-purple-900/40 dark:text-purple-300',
            self::STATUS_QUOTED => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-300',
            self::STATUS_COMPLETED => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300',
            self::STATUS_CANCELLED => 'bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-300',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
        };
    }

    public function getAttachmentUrlAttribute(): ?string
    {
        if ($this->attachment && file_exists(public_path('storage/' . $this->attachment))) {
            return asset('storage/' . $this->attachment);
        }
        return null;
    }
}
