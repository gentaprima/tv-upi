<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBeritaUsers extends Model
{
    protected $table = "tbl_berita_like";
    protected $guarded = [];
    public $timestamps = false;
}
