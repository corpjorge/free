<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Model\Usuario\Users_detalle;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Notifiable, Authenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'social_name', 'email', 'password','social_id','avatar', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function usuario_rol()
    {
        return $this->belongsTo('App\Model\Sistema\Rol','role_id');
    }

    public function usuario_detalle()
    {
        return $this->hasMany('App\Model\Usuario\Users_detalle');
    }

    public static function detalle()
    {
        return Users_detalle::where('user_id',Auth::user()->id)->first();
    }

    public function usuario_telefono()
    {
        return $this->hasMany('App\Model\Usuario\Telefono', 'user_id');
    }

    public function usuario_ventas_boletas()
    {
        return $this->hasMany('App\Model\Boleteria\Venta', 'user_id');
    }
}
