<?php

/**
 * @package php-piwik
 * @subpackage Plugin
 *
 * @author halfdan
 */
class Piwik_SitesManager extends Piwik_Plugin {

	public function getJavascriptTag($idSite, $piwikUrl = '', $actionName = '', $format = null) {
		$params = array(
			"method" => substr(strstr(get_class($this), '_'), 1) . '.' . __FUNCTION__,
			"format" => is_null($format) ? $this->format : $format,
			"idSite" => $idSite,
			"piwikUrl" => $piwikUrl,
			"actionName" => $actionName,
		);

		return $this->sendHttpRequest($params);
	}

	public function getSiteFromId($idSite, $format = null) {
		$params = array(
			"method" => substr(strstr(get_class($this), '_'), 1) . '.' . __FUNCTION__,
			"format" => is_null($format) ? $this->format : $format,
			"idSite" => $idSite,
		);

		return $this->sendHttpRequest($params);
	}

	public function getSiteUrlsFromId($idSite, $format = null) {
		$params = array(
			"method" => substr(strstr(get_class($this), '_'), 1) . '.' . __FUNCTION__,
			"format" => is_null($format) ? $this->format : $format,
			"idSite" => $idSite,
		);

		return $this->sendHttpRequest($params);
	}
	
	public function getSiteUrlsFromId($url, $format = null) {
		$params = array(
			"method" => substr(strstr(get_class($this), '_'), 1) . '.' . __FUNCTION__,
			"format" => is_null($format) ? $this->format : $format,
			"idSite" => $idSite,
		);

		return $this->sendHttpRequest($params);
	}

	public function __call($method, $args) {
		$methods = array(
			'getAllSitesId',
			'getSitesWithAdminAccess',
			'getSitesWithViewAccess',
			'getSitesWithAtLeastViewAccess',
			'getSitesIdWithAdminAccess',
			'getSitesIdWithViewAccess',
			'getSitesIdWithAtLeastViewAccess',
			'getExcludedQueryParametersGlobal',
			'getExcludedIpsGlobal',
			'getDefaultCurrency',
			'getDefaultTimezone',
			'getCurrencyList',
			'getCurrencySymbols',
			'getTimezonesList'
		);

		if (in_array($method, $methods)) {
			$params = array(
				"method" => substr(strstr(get_class($this), '_'), 1) . '.' . $method,
				"format" => is_null($args) ? $this->format : $args[0],
			);

			return $this->sendHttpRequest($params);
		}
	}

}
?>
