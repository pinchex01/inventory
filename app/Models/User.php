<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        // only mutate if $value is not null
        $this->attributes['password'] = (empty($value) || strlen($value) == 60) ? $value : bcrypt($value);
    }

    public static function add($email, array $params = null):self
    {
        $user  = self::query()->where('email', $email)->first();
        if($user)
            return $user;

        $user = new self($params);

        //generate user password if no password was provided
        $password  =  Arr::get($params, 'password');
        if (!$password) {
            $password = Str::random(7);
            $user->password = $password;
        }
        // save record
        $user->save();

        return $user;
    }
}
