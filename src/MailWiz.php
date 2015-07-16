<?php namespace Fahim\Mailwiz;


use MailWizzApi\Endpoint\ListSubscribers;
use MailWizzApi\Json;

use MailWizzApi\Base;
use MailWizzApi\Config;

class Mailwiz {

	protected $apiUrl;

	protected $publicKey;

	protected $privateKey;

	protected $userKey;

	public function subscribe($email = null , $FNAME = null , $LNAME = null)
	{

		// configuration object
		$config = new Config(array(
		    'apiUrl'        => $this->apiUrl,
		    'publicKey'     => $this->publicKey,
		    'privateKey'    => $this->privateKey
		    
		));

		// now inject the configuration and we are ready to make api calls
		Base::setConfig($config);

		// start UTC
		date_default_timezone_set('UTC');

		// and if it is and we have post values, then we can proceed in sending the subscriber.
		if (!empty($_POST)) {

		    $listUid    = $this->userKey;// you'll take this from your customers area, in list overview from the address bar.
		    $endpoint   = new ListSubscribers();
		    $response   = $endpoint->create($listUid, array(
		        'EMAIL' => $email,
		        'FNAME' => $FNAME,
		        'LNAME' => $LNAME,
		    ));
		    $response   = $response->body;
		    
		    // if the returned status is success, we are done.
		    if ($response->itemAt('status') == 'success') {
		        exit(Json::encode(array(
		            'status'    => 'success',
		            'message'   => 'Thank you for joining our email list. Please confirm your email address now!'
		        )));
		    }
		    
		    // otherwise, the status is error
		    exit(Json::encode(array(
		        'status'    => 'error',
		        'message'   => $response->itemAt('error')
		    )));
		}


	}

	public function setApiUrl($apiUrl)
	{
		return $this->apiUrl = $apiUrl;
	}

	public function setPublicKey($publicKey)
	{
		return $this->publicKey = $publicKey;
	}

	public function setPrivateKey($privateKey)
	{
		return $this->privateKey = $privateKey;
	}

	public function setUserKey($userKey)
	{
		return $this->userKey = $userKey;
	}


}