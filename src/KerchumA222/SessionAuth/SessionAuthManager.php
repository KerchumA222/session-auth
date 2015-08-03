<?php
namespace KerchumA222\LdapAuth;

use Illuminate\Auth\Guard;
use Illuminate\Auth\AuthManager;

/**
 * Class SessionAuthManager
 * @package KerchumA222\SessionAuth
 */
class SessionAuthManager extends AuthManager
{
    /**
     * 
     * @return \Illuminate\Auth\Guard
     */
    protected function createSessionDriver()
    {
        $provider = $this->createSessionProvider();
        
        return new Guard($provider, $this->app['session.store']);
    }
    
    /**
     * 
     * @return \Illuminate\Contracts\Auth\UserProvider
     */
    protected function createSessionProvider()
    {
        return new SessionAuthUserProvider();
    }
}