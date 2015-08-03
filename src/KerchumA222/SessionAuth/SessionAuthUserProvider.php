<?php
namespace KerchumA222\SessionAuth;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Session;

/**
 * Class to build array to send to GenericUser
 * This allows the fields in the array to be
 * accessed through the Auth::user() method
 */
class SessionAuthUserProvider implements UserProvider
{

	/**
	 * DI in adLDAP object for use throughout
	 *
	 */
	public function __construct()
	{

	}

	/**
	 * Retrieve a user by their unique identifier.
	 *
	 * @param  mixed  $identifier
	 *
	 * @return \Illuminate\Auth\GenericUser|null
	 */
	public function retrieveByID($identifier)
	{
		//laravel calls this on every request as it stores userid in session on its own
		if(Session::get('currentUser.id') == $identifier){
			return new GenericUser(Session::get('currentUser'));
		}

	}

	/**
	 * Retrieve a user by by their unique identifier and "remember me" token.
	 *
	 * @param  mixed  $identifier
	 * @param  string  $token
	 * @return \Illuminate\Auth\GenericUser|null
	 */
	public function retrieveByToken($identifier, $token)
	{
		$user = new GenericUser(Session::get('currentUser'));
		if($user->id == $identifier && $user->getRememberToken()){
			return $user;
		}
		return null;
	}

	/**
	 * Update the "remember me" token for the given user in storage.
	 *
	 * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
	 * @param  string  $token
	 * @return void
	 */
	public function updateRememberToken(Authenticatable $user, $token)
	{
		Session::put('currentUser.remember_token', $token);
	}

	/**
	 * Retrieve a user by the given credentials.
	 *
	 * @param  array  $credentials
	 * @return null
	 */
	public function retrieveByCredentials(array $credentials)
	{
		//not supported
		return null;
	}

	/**
	 * Validate a user against the given credentials.
	 *
	 * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
	 * @param  array  $credentials
	 * @return bool
	 */

	public function validateCredentials(Authenticatable $user, array $credentials)
	{
		//not supported
		return false;
	}

    /**
     * @return string
     */
    protected function getUsernameField()
	{
		return isset($this->config['username_field'])?$this->config['username_field']:'username';
	}

	/**
     * @return string
     */
    protected function getIdentifierField()
	{
		return isset($this->config['identifier_field'])?$this->config['identifier_field']:'id';
	}
}
