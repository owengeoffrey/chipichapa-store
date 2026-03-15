<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'nama_barang',
        'harga_barang',
        'jumlah_barang',
        'foto_barang',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function fakturItems()
    {
        return $this->hasMany(FakturItem::class);
    }
}
