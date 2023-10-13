<?php

namespace Tine20\DAV\Exception;

/**
 * NotImplemented
 *
 * This exception is thrown when the client tried to call an unsupported HTTP method or other feature
 *
 * @copyright Copyright (C) 2007-2015 fruux GmbH (https://fruux.com/).
 * @author Evert Pot (http://evertpot.com/)
 * @license http://sabre.io/license/ Modified BSD License
 */
class NotImplemented extends \Tine20\DAV\Exception {

    /**
     * Returns the HTTP statuscode for this exception
     *
     * @return int
     */
    public function getHTTPCode() {

        return 501;

    }

}
