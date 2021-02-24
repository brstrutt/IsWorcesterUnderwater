<?php
// Flooding levels chosen by adding 1m to the "minor flooding is possible" level
// see for those numbers https://flood-warning-information.service.gov.uk/station/2092 and https://flood-warning-information.service.gov.uk/station/2039
$barbourneFloodingLevel = floatval(4.35);
$diglisFloodingLevel = floatval(3.80);

function IsWorcesterUnderwater()
{
	return IsBarbourneFlooding() && IsDiglisFlooding();
}

function IsBarbourneFlooding()
{
	$currentLevel = GetBarbourneRiverLevel();
	$isFlooding = $currentLevel >= $barbourneFloodingLevel;
	echo "CURRENT LEVEL:" . strval($currentLevel);
	echo "FLOOD LEVEL:" . strval($barbourneFloodingLevel);
	echo "IS FLOODING: " . strval($isFlooding);
	return $isFlooding;
}

function IsDiglisFlooding()
{
	$currentLevel = GetDiglisRiverlLevel();
	return $currentLevel >= $diglisFloodingLevel;
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
