<?php

namespace Tine20\CalDAV\Principal;

use Tine20\DAVACL;

/**
 * ProxyRead principal interface
 *
 * Any principal node implementing this interface will be picked up as a 'proxy
 * principal group'.
 *
 * @copyright Copyright (C) 2007-2015 fruux GmbH (https://fruux.com/).
 * @author Evert Pot (http://evertpot.com/)
 * @license http://sabre.io/license/ Modified BSD License
 */
interface IProxyRead extends DAVACL\IPrincipal {

}