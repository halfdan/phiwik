<?php

/**
 * @package php-piwik
 * @subpackage Plugin
 *
 * @author halfdan
 */
class Piwik_VisitFrequency extends Piwik_Plugin {

	/*
	 *
	 */
	public function get($idSite, $period = null, $date = null, $format = null) {
		$params = array(
			"method" => substr(strstr(get_class($this), '_'), 1) . '.' . __FUNCTION__,			
			"idSite" => $idSite,
			"period" => is_null($period) ? $this->period : $period,
			"date" => is_null($date) ? $this->date : $date,
			"format" => is_null($format) ? $this->format : $format,
		);

		return $this->sendHttpRequest($params);
	}

	/*
	 *
	 */
	public function __call($method, $args) {
		$methods = array(
			'getVisitsReturning',
			'getActionsReturning',
			'getMaxActionsReturning',
			'getSumVisitsLengthReturning',
			'getBounceCountReturning',
			'getConvertedVisitsReturning',
		);

		$params = array(
			"method" => substr(strstr(get_class($this), '_'), 1) . '.' . $method,
		);

		$params['idSite'] = $args[0];
		$params['period'] = count($args) >= 2 ? $args[1] : $this->period;
		$params['date'] = count($args) >= 3 ? $args[2] : $this->date;
		$params['format'] = count($args) == 4 ? $args[3] : $this->format;

		if (in_array($method, $methods)) {
			return $this->sendHttpRequest($params);
		} else {
			throw new Exception("Unknown API call.");
		}
	}

}
?>
