<?php
namespace KerchumA222\SessionAuth\Services;

use Illuminate\Contracts\Auth\Guard;

class SessionAuthService implements SessionAuthServiceContract {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Checks if the current user has a subscription to the specified module.
	 * @param $moduleName
	 *
	 * @return bool
	 */
	public function userHasModuleSubscription($moduleName){
		return array_key_exists($moduleName, $this->auth->user()->moduleSubscriptions);
	}

	/**
	 * Checks if the current user has a specified role in the specified module.
	 * @param $moduleName
	 * @param $roleName
	 *
	 * @return bool
	 */
	public function userHasRoleForModule($moduleName, $roleName){
		if($this->userHasModuleSubscription($moduleName)){
			return array_key_exists($roleName, $this->auth->user()->moduleSubscriptions[$moduleName]);
		}
		else {
			return false;
		}
	}

}