<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class expense extends Model
{
    protected $fillable = ['expense', 'img', 'date', 'agent', 'price'];

    public function user()
    {
        return $this->belongsTo(user::class, 'agent');
    }
}
