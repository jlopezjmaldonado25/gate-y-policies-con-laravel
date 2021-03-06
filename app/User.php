<?php

namespace App;

//use App\Post;
use Bouncer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function isAdmin()
    {

        return $this->isAn('admin'); //isA('manager') // Cuando los roles comienzan con consonantes

        //return Bouncer::is($this)->an('admin'); //a('manager')

    }

    public function owns(Model $model, $foreignKey = 'user_id')
    {
        return $this->id === $model->$foreignKey;
    }
}
