<?php

/**
 * Modelo el usuario
 * 
 * Role
 * ^ Belongs to many throu
 * | UserRoles
*! User
 * | Belongs to many through
 * V UserInTeam
 * Team
 * 
 */

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;


class User extends Authenticatable implements \Czim\Paperclip\Contracts\AttachableInterface
{
    /**
     * Trait que permite la verificion de correo electronico
     */
    use Notifiable;
    /**
     * Trait que permite que el usuario tenga roles
     */
    use HasRoles;
    /**
     * Trait que permite implementar soft delete
     */
    use SoftDeletes;
    /**
     * Trait que permite tener foto de perfil
     */
    use \Czim\Paperclip\Model\PaperclipTrait;

    /**
     * Metodo constructor que define los formatos que se guardaran de la imagen de perfil
     * 
     * @return void
     */
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
     * Propiedad que almacena los campos que se pueden actualizar "en masa"
     * 
     * @var Array[String]
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'height', 'weight', 'birthdate', 'career', 'semester', 'account_number',
        'curp', 'address', 'medical_service', 'blood_type', 'medical_card_no', 'phone_number', 'password', 'username'
    ];

    /**
     * Propiedad que almacena los campos que se oculataran cuando se serialice el usuario
     * 
     * @var Array[String]
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Metodo que devuelve la edad del usuario
     * 
     * @return Integer
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    /**
     * Metodo que devuelve la ruta de la imagen de perfil o la imagen por defecto
     * 
     * @return String
     */
    public function avatarPath(){
        $avatarUrl = str_replace('public/', '', $this->avatar->url());
        return $avatarUrl;
        if(file_exists($avatarUrl))
            return $avatarUrl;
        else return asset('images/missing_avatar.png');
    }

    /**
     * Metodo que devuelve la ruta publica de la imagen de perfil o la imagen por defecto
     * esta ruta es necesaria en la generacion de un PDF
     * 
     * @return String
     */
    public function avatarPublicPath(){
        $avatarUrl = public_path(str_replace('public/', 'storage/', $this->avatar->path()));
        if(file_exists($avatarUrl))
            return $avatarUrl;
        else return public_path('images/missing_avatar.png');
    }

    /**
     * Metodo que devuelve los equipos a los que pertence junto con sus compañeros 
     * y las solicitudes en caso de ser capitan
     * 
     * @return 
     *  Array[
     *    <UserInTeam
     *       <Team
     *          <User(capitan)>
     *          <User(compañeros)>
     *          <Branch
     *              <Tournament>
     *          >
     *       >
     *    >
     *  ]
     * 
     */
    public function teams(){
        $teams = UserInTeam::where('user_id', $this->id)->with('team.accepted_users')->with('team.captain')->with('team.branch.tournament')->get();
        foreach ($teams as $team) {
            if($team->isCaptain()){
                $team->team->requests = \App\UserInTeam::where([
                    ['team_id', $team->team->id],
                    ['status', 'pending']
                ])->with('user')->get();
            }
        }

        return $teams;
    }
}
