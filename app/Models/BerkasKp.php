<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasKp extends Model
{
    use HasFactory;
    protected $table = "berkas_kp";
    protected $primaryKey = "id_berkas_kp";
    protected $guarded = [];
}
