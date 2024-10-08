<?php

namespace App\Models;

use App\Models\User;
use App\Models\ListingImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['beds','baths','area','city','code','street','street_nr','price'];

    protected $sortable = [
        'price', 'created_at'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class,'by_user_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }

    // start with 'scope' followed by method name
    // scopeFilter -> filter()
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when(
                $filters['priceFrom'] ?? false,
                fn ($query, $value) => $query->where('price', '>=', $value)
            )
            ->when(
                $filters['priceTo'] ?? false,
                fn ($query, $value) => $query->where('price', '<=', $value)
            )
            ->when(
                $filters['beds'] ?? false,
                fn ($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value)
            )
            ->when(
                $filters['baths'] ?? false,
                fn ($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
            )
            ->when(
                $filters['areaFrom'] ?? false,
                fn ($query, $value) => $query->where('area', '>=', $value)
            )
            ->when(
                $filters['areaTo'] ?? false,
                fn ($query, $value) => $query->where('area', '<=', $value)
            )
            ->when(
                $filters['deleted'] ?? false,
                fn ($query, $value) => $query->onlyTrashed()
            )
            ->when(
                $filters['by'] ?? false,
                fn ($query, $value) => !in_array($value, $this->sortable) ? $query : $query->orderBy($value, $filters['order'] ?? 'desc')
            );
    }
}
