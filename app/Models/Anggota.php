<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'Anggota';
    protected $fillable = ['nik', 'nama', 'jenis_kelamin', 'grup_id', 'alamat', 'foto'];

    public function grup(): BelongsTo
    {
        return $this->belongsTo(Grup::class);
    }
}
