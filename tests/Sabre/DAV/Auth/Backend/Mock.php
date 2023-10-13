<?php

namespace Tine20\DAV\Auth\Backend;

use Tine20\DAV;

class Mock implements BackendInterface {

    protected $currentUser;

    public $defaultUser = 'admin';

    /**
     * @param Tine20\DAV\Server $server
     * @param string $realm
     * @throws Tine20\DAV\Exception\NotAuthenticated
     */
    function authenticate(DAV\Server $server, $realm) {

        if ($realm=='failme') throw new DAV\Exception\NotAuthenticated('deliberate fail');
        $this->currentUser = $this->defaultUser;

    }

    function setCurrentUser($user) {

        $this->currentUser = $user;

    }

    function getCurrentUser() {

        return $this->currentUser;

    }

}
