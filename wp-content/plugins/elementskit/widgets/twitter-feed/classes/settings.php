<?php

Class Ekit_twitter_settings{

	/**
	* Account Name
	*/
	public $ekit_account_name = '@xpeedstudio';
	/**
	* Access token key
	*/
	public $ekit_token_key = '';
	/**
	* Access token secret key
	*/
	public $ekit_token_secret = '';

	/**
	* Access token secret key
	*/
	public $ekit_consumer_key = '';

	/**
	* Access token secret key
	*/
	public $ekit_consumer_secret = '';

	private $exchange;


	// setup
	public function setup(array $config){
		$settings = [];
		$settings['oauth_access_token'] 		= strlen($config['access_token']) > 5 ? $config['access_token'] : $this->ekit_token_key;
		$settings['oauth_access_token_secret']  = strlen($config['access_token_secret']) > 5 ? $config['access_token_secret'] : $this->ekit_token_secret;
		$settings['consumer_key']  				= strlen($config['consumer_key']) > 5 ? $config['consumer_key'] : $this->ekit_consumer_key;
		$settings['consumer_secret']  			= strlen($config['consumer_secret']) > 5 ? $config['consumer_secret'] : $this->ekit_consumer_secret;

		$this->exchange = new \TwitterAPIExchange($settings);

		$this->ekit_account_name = isset($config['name']) ? $config['name'] : $this->ekit_account_name;
	}

	public function timeline_feed_user($getcount = 20){

		$getfield = '?screen_name='.$this->ekit_account_name.'&count='.$getcount;

		$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$requestMethod = 'GET';

		$outPut = json_decode($this->exchange->setGetfield($getfield)->buildOauth($url, $requestMethod)
		->performRequest(),$assoc = TRUE);

		return $outPut;
	}

}