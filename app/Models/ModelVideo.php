<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelVideo extends Model
{
    protected $table = "tbl_video";
    protected $guarded = [];
    public $timestamps = false;
}
