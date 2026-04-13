<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\AppendTrait;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

#[Fillable(['name', 'role', 'email','phone', 'password'])]
#[Hidden(['password', 'remember_token'])]
#[Appends(['firstname', 'surname', 'fullname', 'online', 'last_session',])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    use AppendTrait;

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

    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Each User may have [*] Session */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    /*----------------------------------------------------------------------------------------------------------------
    | GETTERS AND SETTERS
    |----------------------------------------------------------------------------------------------------------------*/
    /**
    * Get Surname
    * @return string
    */
    public function getSurnameAttribute(){

        return self::lastName($this->name);
    }

    /**
    * Get Firstname
    * @return string
    */
    public function getFirstnameAttribute(){

        return self::firstName($this->name);
    }

    /**
    * Get Fullname
    * @return string
    */
    public function getFullnameAttribute(){

        return self::fullName($this->name);
    }

    /**
    * Check weather the user is online or not
    * @return string
    */
    public function getOnlineAttribute(){

        return DB::table('sessions')
            ->where('user_id', $this->id)
            ->where('last_activity', '>=', now()->subMinutes(5)->getTimestamp())
            ->exists();
    }

    /**
    * Get last session time
    * @return string
    */
    public function getLastSessionAttribute(){

        $result= null;
        if($this->sessions->count()){
            $la= $this->sessions->max('last_activity');
            $result= $this->sessions->where('last_activity', $la)->first();
        }
        return $result;
    }
}
