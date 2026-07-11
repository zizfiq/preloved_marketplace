<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'category',
        'condition',
        'image',
        'stock',
        'status',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
    ];

    /**
     * Relasi ke User.
     * Satu produk dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Payment.
     * Satu produk dapat memiliki banyak pembayaran.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Format harga Rupiah.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * URL gambar produk.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && file_exists(storage_path('app/public/' . $this->image))) {
            return asset('storage/' . $this->image);
        }

        // Jika tidak ada gambar upload, gunakan gambar sesuai kategori
        switch ($this->category) {
            case 'Fashion':
                return asset('images/fashion.jpg');

            case 'Elektronik':
                return asset('images/elektronik.jpg');

            case 'Sepatu':
                return asset('images/sepatu.jpg');

            case 'Tas':
                return asset('images/tas.jpg');

            case 'Aksesoris':
                return asset('images/aksesoris.jpg');

            default:
                return asset('images/no-image.png');
        }
    }
}