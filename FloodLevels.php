<?php
// Flooding levels chosen by adding 1.20m to the "minor flooding is possible" level (values eyeballed)
// see for those numbers https://flood-warning-information.service.gov.uk/station/2092 and https://flood-warning-information.service.gov.uk/station/2039
$barbourneFloodingLevel = 4.50;
$diglisFloodingLevel = 3.50;

function IsWorcesterUnderwater()
{
	return IsBarbourneFlooding() && IsDiglisFlooding();
}

function IsBarbourneFlooding()
{
	$currentLevel = GetBarbourneRiverLevel();
	return $currentLevel >= $GLOBALS['barbourneFloodingLevel'];
}

function IsDiglisFlooding()
{
	$currentLevel = GetDiglisRiverlLevel();
	return $currentLevel >= $GLOBALS['diglisFloodingLevel'];
}

function GetBarbourneRiverLevel()
{
	return GetMonitoringStationRiverLevel(2642);
}

function GetDiglisRiverlLevel()
{
	return GetMonitoringStationRiverLevel(2085);
}

function GetMonitoringStationRiverLevel($stationId)
{
	$root = "http://environment.data.gov.uk/flood-monitoring";
	$measuresExtension = "/id/stations/" . strval($stationId) . "/measures";
	$apiAccessUrl = $root . $measuresExtension;

	$response = file_get_contents($apiAccessUrl);
	$decodedResponse = json_decode($response, true);

	$riverLevel = $decodedResponse['items'][0]['latestReading']['value'];
	return floatval($riverLevel);
}
?>
