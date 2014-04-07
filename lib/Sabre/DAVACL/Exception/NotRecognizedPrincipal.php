<?php

/**
 * Sabre_DAVACL_Exception_NotRecognizedPrincipal
 *
 * @package Sabre
 * @subpackage DAVACL
 * @copyright Copyright (C) 2007-2014 fruux GmbH (https://fruux.com/).
 * @author Evert Pot (http://evertpot.com/)
 * @license http://sabre.io/license/ Modified BSD License
 */
class Sabre_DAVACL_Exception_NotRecognizedPrincipal extends Sabre_DAV_Exception_PreconditionFailed {

    /**
     * Adds in extra information in the xml response.
     *
     * This method adds the {DAV:}recognized-principal element as defined in rfc3744
     *
     * @param Sabre_DAV_Server $server
     * @param DOMElement $errorNode
     * @return void
     */
    public function serialize(Sabre_DAV_Server $server,DOMElement $errorNode) {

        $doc = $errorNode->ownerDocument;

        $np = $doc->createElementNS('DAV:','d:recognized-principal');
        $errorNode->appendChild($np);

    }

}
