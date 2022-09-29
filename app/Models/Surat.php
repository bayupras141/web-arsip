<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    
    protected $table = 'tb_surat';

    protected $fillable = [
        'nomor_surat',
        'kategori',
        'judul',
        'waktu_pengarsipan',
        'file',
    ];
}
