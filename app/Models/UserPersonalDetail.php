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
    // This method defines the inverse relationship between UserPersonalDetail and User
    // It indicates that each UserPersonalDetail belongs to a single User
    // The 'user_id' foreign key in the UserPersonalDetail table references the id in the User table
    // This allows you to access the User associated with a UserPersonalDetail instance
    // For example, if you have a UserPersonalDetail instance $detail, you can get the associated User with $detail->user
    // The 'user' method defines the relationship between UserPersonalDetail and User
    // The 'user' method returns the User model associated with the UserPersonalDetail instance
    // This method is used to define the relationship between UserPersonalDetail and User
    // The 'user' method is used to define the relationship between UserPersonalDetail and User
   

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
