<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model {
    use SoftDeletes;

    protected $fillable = [
        "label", "currency", "value", "user_id"
    ];

    public function owner() {
        return $this->belongsTo("App\Models\User");
    }
}
