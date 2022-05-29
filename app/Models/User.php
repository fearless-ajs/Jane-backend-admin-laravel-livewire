<?php

namespace App\Models;

use App\Traits\CompanyRoleBasedAccessControl;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable, CompanyRoleBasedAccessControl;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'Company-worker',
        'company_id',
        'password',
        'verification_token',
        'enabled',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'verification_token',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function getUserImageAttribute(){
        if (!empty($this->image)){
            return asset("uploads/img/$this->image");
        }else{
            return "https://ui-avatars.com/api/?name=$this->lastname&color=FFFFFF&background=563C5C";
        }
    }

    public function company (){
        return $this->belongsTo(Company::class);
    }

    public function userRoles()
    {
        return $this->hasMany(CompanyRoleUser::class);
    }

    public function userPermissions()
    {
        return $this->hasMany(CompanyPermissionUser::class);
    }

    public function userTeams()
    {
        return $this->hasMany(CompanyTeamUser::class);
    }

    public function worker(){
        return $this->hasOne(Worker::class, 'user_id', 'id');
    }

    public function contact(){
        return $this->hasOne(Contact::class, 'user_id', 'id');
    }



}
