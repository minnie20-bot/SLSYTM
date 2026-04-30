<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'status',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    

    static public function getSingle($id)
    {
        return User::find($id);
    }

    static public function getAdmin()
    {
        $return = self::select('*');
            if(!empty(Request::get('id')))
            {
                $return = $return->where('id', '=', Request::get('id'));
            }

            if(!empty(Request::get('is_admin')))
            {
                $return = $return->where('is_admin', '=', Request::get('is_admin'));
            }

            if(!empty(Request::get('name')))
            {
                $return = $return->where('name', 'like', '%' .Request::get('name'). '%');
            }

            if(!empty(Request::get('email')))
            {
                $return = $return->where('email', 'like', '%' .Request::get('email'). '%');
            }

            if(!empty(Request::get('address')))
            {
                $return = $return->where('address', 'like', '%' .Request::get('address'). '%');
            }

            if(!empty(Request::get('status')))
            {
                $status = Request::get('status');
                if($status == 100)
                {
                    $status = 0;
                }

                $return->where('status', $status);
            }

        $return = $return->whereIn('is_admin', array('1', '2'))
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->Paginate(10);
        return $return;
    }

    static public function getSchool()
    {
        $return = self::select('*');
            if(!empty(Request::get('id')))
            {
                $return = $return->where('id', '=', Request::get('id'));
            }

            if(!empty(Request::get('name')))
            {
                $return = $return->where('name', 'like', '%' .Request::get('name'). '%');
            }

            if(!empty(Request::get('email')))
            {
                $return = $return->where('email', 'like', '%' .Request::get('email'). '%');
            }

            if(!empty(Request::get('address')))
            {
                $return = $return->where('address', 'like', '%' .Request::get('address'). '%');
            }

            if(!empty(Request::get('status')))
            {
                $status = Request::get('status');
                if($status == 100)
                {
                    $status = 0;
                }

                $return->where('status', $status);
            }

        $return = $return->where('is_admin', '=', 3)
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return $return;
    }

    public function getProfile()
    {
        if(!empty($this->profile_pic) && file('upload/profile/'.$this->profile_pic))
            {
                return url('upload/profile/'.$this->profile_pic);
            }
            else
            {
                return "";
            }
    }

}
