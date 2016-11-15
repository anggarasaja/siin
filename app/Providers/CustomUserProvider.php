<?php

namespace App\Providers;
use App\User; 
use Carbon\Carbon;
use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomUserProvider implements UserProvider {

/**
 * Retrieve a user by their unique identifier.
 *
 * @param  mixed $identifier
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
public function retrieveById($identifier)
{
    // TODO: Implement retrieveById() method.


    $qry = User::where('id','=',$identifier);

    if($qry->count() >0)
    {
        $user = $qry->select('id', 'name', 'username', 'email', 'password', 'jenis')->first();

        $attributes = array(
            'id' => $user->id,
            'username' => $user->username,
            'password' => $user->password,
            'email' => $user->email,
            'name' => $user->name,
            'jenis' => $user->jenis,
        );

        return $user;
    }
    return null;
}

/**
 * Retrieve a user by by their unique identifier and "remember me" token.
 *
 * @param  mixed $identifier
 * @param  string $token
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
public function retrieveByToken($identifier, $token)
{
    // TODO: Implement retrieveByToken() method.
    $qry = User::where('id','=',$identifier)->where('remember_token','=',$token);

    if($qry->count() >0)
    {
        $user = $qry->select('id', 'name', 'username', 'email', 'password', 'jenis')->first();

        $attributes = array(
            'id' => $user->id,
            'username' => $user->username,
            'password' => $user->password,
            'email' => $user->email,
            'name' => $user->name,
            'jenis' => $user->jenis,
        );

        return $user;
    }
    return null;



}

/**
 * Update the "remember me" token for the given user in storage.
 *
 * @param  \Illuminate\Contracts\Auth\Authenticatable $user
 * @param  string $token
 * @return void
 */
public function updateRememberToken(Authenticatable $user, $token)
{
    // TODO: Implement updateRememberToken() method.
    $user->setRememberToken($token);

    $user->save();

}

/**
 * Retrieve a user by the given credentials.
 *
 * @param  array $credentials
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
public function retrieveByCredentials(array $credentials)
{

    // TODO: Implement retrieveByCredentials() method.
    $qry = User::where('username','=',$credentials['username']);

    if($qry->count() > 0)
    {
        $user = $qry->select('id','username','email','password','jenis')->first();


        return $user;
    }

    return null;


}

/**
 * Validate a user against the given credentials.
 *
 * @param  \Illuminate\Contracts\Auth\Authenticatable $user
 * @param  array $credentials
 * @return bool
 */
public function validateCredentials(Authenticatable $user, array $credentials)
{
    // TODO: Implement validateCredentials() method.
    // we'll assume if a user was retrieved, it's good

    // DIFFERENT THAN ORIGINAL ANSWER
    if($user->username == $credentials['username'] && Hash::check($credentials['password'], $user->getAuthPassword()))//$user->getAuthPassword() == md5($credentials['password'].\Config::get('constants.SALT')))
    {


        //$user->last_login_time = Carbon::now();
        $user->save();

        return true;
    }
    return false;


}
}