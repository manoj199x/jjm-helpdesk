<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'help_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'contact_number',
        'user_type',
        'fcm_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    protected $with = ['role_user'];
//    public function __construct(array $attributes=[]){
//        parent::__construct($attributes);
//        self::created(function (User $user){
//            if(!$user->roles()->get()->contains(2)){
//                $user->roles()->attach(2);
//            }
//        });
//    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    public function division_users(){
        return $this->belongsTo(DivisionUser::class,'id','user_id');
    }
    public function circle_users(){
        return $this->belongsTo(CircleUser::class,'id','user_id');
    }
    public function zone_users(){
        return $this->belongsTo(ZoneUser::class,'id','user_id');
    }

    public function hasAnyRole($roles)
    {   
        return $this->role_user->role->whereIn('title', $roles)->exists();
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class,'user_type','id');
    }

    public function role_user()
    {
        return $this->belongsTo(RoleUser::class,'id','user_id');
    }
}
