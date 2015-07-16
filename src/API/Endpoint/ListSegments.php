<?php
/**
 * This file contains the list segments endpoint for MailWizzApi PHP-SDK.
 *
 * @author    Serban George Cristian <cristian.serban@mailwizz.com>
 * @link      http://www.mailwizz.com/
 * @copyright 2013-2014 http://www.mailwizz.com/
 */
namespace Fahim\MailWiz\API\Endpoint;

use Fahim\MailWiz\API\Base;
use Fahim\MailWiz\API\Http\Client;
use Fahim\MailWiz\API\Http\Response;

/**
 * Fahim\MailWiz\API\Endpoint\ListSegments handles all the API calls for handling the list segments.
 *
 * @author     Serban George Cristian <cristian.serban@mailwizz.com>
 * @package    Fahim\MailWiz\API
 * @subpackage Endpoint
 * @since      1.0
 */
class ListSegments extends Base {
    /**
     * Get segments from a certain mail list
     *
     * Note, the results returned by this endpoint can be cached.
     *
     * @param string $listUid
     * @param integer $page
     * @param integer $perPage
     * @return Response
     */
    public function getSegments ($listUid, $page = 1, $perPage = 10) {
        $client = new Client(array(
                                 'method'      => Client::METHOD_GET,
                                 'url'         => $this->config->getApiUrl(sprintf('lists/%s/segments', $listUid)),
                                 'paramsGet'   => array(
                                     'page'     => (int) $page,
                                     'per_page' => (int) $perPage
                                 ),
                                 'enableCache' => true,
                             ));

        return $response = $client->request();
    }
}