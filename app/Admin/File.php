<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'url', 'user_id'
    ];

    /**
     * Get the user that owns the file.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
