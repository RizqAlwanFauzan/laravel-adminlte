<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grup extends Model
{
    use HasFactory;

    protected $table = 'grup';
    protected $fillable = ['kode', 'nama', 'deskripsi'];

    protected static function booted()
    {
        static::creating(function ($grup) {
            $grup->kode = 'GRP-' . time();
        });
    }

    public function anggota(): HasMany
    {
        return $this->hasMany(Anggota::class);
    }
}
