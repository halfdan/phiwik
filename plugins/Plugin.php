<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Piwik_Plugin
 *
 * @author halfdan
 */
abstract class Piwik_Plugin {

	protected $tokenAuth;
	protected $piwikUrl;
	protected $period;
	protected $format;

	public function __construct($piwikUrl = 'http://localhost', $tokenAuth = 'anonymous') {
		$this->piwikUrl = $piwikUrl;
		$this->tokenAuth = $tokenAuth;
		$this->format = 'json';
		$this->period = 'day';
	}

	public function setTokenAuth($tokenAuth) {
		$this->tokenAuth = $tokenAuth;
	}

	public function setPiwikUrl($piwikUrl) {
		$this->piwikUrl = $piwikUrl;
	}

	public function setDefaultFormat($format) {
		$this->format = $format;
	}

	public function setDefaultPeriod($period) {
		$this->period = $period;
	}

	protected function sendHttpRequest($params) {
		$params['token_auth'] = $this->tokenAuth;

		$url = $this->piwikUrl . '/?module=API';
		foreach ($params as $key => $value) {
			if(!empty($value)) {
				$url .= "&" . $key . "=" . $value;
			}
		}

		$ch = @curl_init();

		$curl_options = array(
			// curl options (sorted oldest to newest)
			CURLOPT_URL => $url,
			CURLOPT_USERAGENT => 'PHP-Piwik/' . Piwik::VERSION,
			CURLOPT_HEADER => false,
			CURLOPT_RETURNTRANSFER => true,
		);
		@curl_setopt_array($ch, $curl_options);

		ob_start();
		$response = @curl_exec($ch);
		ob_end_clean();

		@curl_close($ch);
		unset($ch);

		return $params['format']=='php'? unserialize($response) : $response;
	}

}
?>
