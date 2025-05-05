<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable
{
    use Notifiable, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function createUser(array $data)
    {
        return self::create($data);
    }

    public static function getUserById(string $id)
    {
        return self::find($id);
    }

    public static function updateUser(string $id, array $data)
    {
        $user = self::find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public static function deleteUser(string $id)
    {
        $user = self::find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
    public function personalDetails()
    {
        return $this->hasOne(UserPersonalDetail::class);
    }

    public function progresses()
    {
        return $this->hasMany(UserProgress::class);
    }
}
