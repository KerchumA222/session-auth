<?php
namespace KerchumA222\SessionAuth\Services;

interface SessionAuthServiceContract {
	/**
	 * Checks if the current user has a subscription to the specified module.
	 * @param $moduleName
	 *
	 * @return bool
	 */
	public function userHasModuleSubscription($moduleName);

	/**
	 * Checks if the current user has a specified role in the specified module.
	 * @param $moduleName
	 * @param $roleName
	 *
	 * @return bool
	 */
	public function userHasRoleForModule($moduleName, $roleName);
}