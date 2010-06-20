<?php

require_once(__DIR__ . '/plugins/Plugin.php');

class Piwik {

	const VERSION = '0.6.2';
	protected $tokenAuth = 'anonymous';
	protected $piwikUrl = 'http://localhost/piwik';
	protected $pluginInstances = array();

	public function __construct($piwikUrl, $tokenAuth) {
		$this->piwikUrl = $piwikUrl;
		$this->tokenAuth = $tokenAuth;
	}

	/*
	 * Allows to get a specific Plugin object without
	 * the need of creating a Piwik object first.
	 *
	 * Example: Piwik::factory('SitesManager');
	 */

	public static function factory($plugin) {
		if (include_once __DIR__ . '/plugins/' . $plugin . '.php') {
			$classname = 'Piwik_' . $plugin;
			return new $classname;
		} else {
			throw new Exception('Plugin not found');
		}
	}

	/*
	 * Allows to dynamically call methods on
	 * Plugin objects.
	 *
	 * Example:
	 * $piwik = new Piwik($url, $token);
	 * $piwik->SitesManager->getSites();
	 */

	public function __get($plugin) {
		if (array_key_exists($plugin, $this->pluginInstances)) {
			return $this->pluginInstances[$plugin];
		} else {
			$pluginObj = self::factory($plugin);
			$pluginObj->setTokenAuth($this->tokenAuth);
			$pluginObj->setPiwikUrl($this->piwikUrl);
			$this->pluginInstances[$plugin] = $pluginObj;
			return $pluginObj;
		}
	}

}