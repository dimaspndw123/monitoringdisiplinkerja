<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'monitoring';
    protected $fillable = ['tanggal', 'jammasuk', 'jampulang', 'tugas', 'kendala', 'lama'];
}
