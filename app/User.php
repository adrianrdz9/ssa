<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;


class User extends Authenticatable implements \Czim\Paperclip\Contracts\AttachableInterface
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use \Czim\Paperclip\Model\PaperclipTrait;

    public function __construct(array $attributes = [])
    {
        $this->hasAttachedFile('avatar', [
            'variants' => [
                'medium' => [
                    'resize'      => ['dimensions' => '300x300'],
                ],
                'thumb' => '100x100',
            ],
            'attributes' => [
                'variants' => true,
            ],
        ]);

        parent::__construct($attributes);   
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'height', 'weight', 'birthdate', 'career', 'semester', 'account_number',
        'curp', 'address', 'medical_service', 'blood_type', 'medical_card_no', 'phone_number', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function avatarPath(){
        $avatarUrl = str_replace('public/', '', $this->avatar->url());
        return $avatarUrl;
        if(file_exists($avatarUrl))
            return $avatarUrl;
        else return asset('images/missing_avatar.png');
    }

    public function avatarPublicPath(){
        $avatarUrl = public_path(str_replace('public/', 'storage/', $this->avatar->path()));
        if(file_exists($avatarUrl))
            return $avatarUrl;
        else return public_path('images/missing_avatar.png');
    }
}
