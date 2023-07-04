<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    protected $fillable = [
        "role_id",
        "permission",
        "dependency"
    ];

    public function role()
    {
        return $this->belongsTo(Roles::class);
    }
}
