<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserPersonalDetail extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'profile_picture',
        'age',
        'gender',
        'weight',
        'height',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
