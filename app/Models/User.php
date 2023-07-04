<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasMany(Roles::class, "id")->with("permission");
    }

    public static function authChecker($requiredPermissions)
    {
        $Role = Roles::firstWhere('id', auth()->user()->role);
        if (auth()->user() and $Role){
            $userPermissions = Permissions::where("role_id", auth()->user()->role)->pluck("permission")->toarray();
            $state = true;
            foreach ($requiredPermissions as $permission){
                !in_array($permission, $userPermissions)? $state = false: null;
            }
//            dd($state, ["userHave" => $userPermissions], ["systemRequire" => $requiredPermissions]);
            return $state;
        }
        return false;
    }
}
