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

    protected $hidden = [
        'user_id',
    ];

    public static function createUserPersonalDetail(array $data)
    {
        return self::create($data);
    }

    public static function getUserPersonalDetailById(string $id)
    {
        return self::find($id);
    }

    public static function updateUserPersonalDetail(string $id, array $data)
    {
        $userPersonalDetail = self::find($id);
        if ($userPersonalDetail) {
            $userPersonalDetail->update($data);
            return $userPersonalDetail;
        }
        return null;
    }
    public static function deleteUserPersonalDetail(string $id)
    {
        $userPersonalDetail = self::find($id);
        if ($userPersonalDetail) {
            return $userPersonalDetail->delete();
        }
        return false;
    }

    /**
     * Get the user that owns the personal detail.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
