<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'short_description',
        'full_description',
        'main_image',
        'is_featured',
        'status',
        'sort_order',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function specifications(): HasMany
    {
        return $this->hasMany(ProductSpecification::class)->orderBy('sort_order');
    }

    public function applications(): BelongsToMany
    {
        return $this->belongsToMany(Application::class, 'application_product')->withTimestamps();
    }

    public function quoteRequests(): HasMany
    {
        return $this->hasMany(QuoteRequest::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('status', 'published')->where('is_featured', true);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->main_image && (str_starts_with($this->main_image, 'http://') || str_starts_with($this->main_image, 'https://'))) {
            return $this->main_image;
        }
        if ($this->main_image && file_exists(public_path('storage/' . $this->main_image))) {
            return asset('storage/' . $this->main_image);
        }
        if ($this->main_image && file_exists(public_path($this->main_image))) {
            return asset($this->main_image);
        }
        // Fallback default image based on category
        $catSlug = $this->category ? $this->category->slug : 'product';
        return asset('images/products/' . $catSlug . '.jpg');
    }

    public function getWhatsAppMessageAttribute(): string
    {
        $company = Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED');
        $text = "Hello {$company}, I am interested in your {$this->name}. Please provide more information, technical specifications and pricing.";
        return urlencode($text);
    }
}
