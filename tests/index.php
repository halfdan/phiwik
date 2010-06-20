<?php

require_once( __DIR__ .'/../Piwik.php');

$sitesManager = Piwik::factory('SitesManager');

var_dump($sitesManager);

$piwik = new Piwik('http://localhost/Piwik', 'anonymous');
$sitesId = $piwik->SitesManager->getAllSitesId('php');

var_dump($sitesId);

?>
