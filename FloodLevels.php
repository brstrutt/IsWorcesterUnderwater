<?php
// Eyeball standard river levels and "might be starting to flood" river levels from the following sites
// https://flood-warning-information.service.gov.uk/station/2092 and https://flood-warning-information.service.gov.uk/station/2039

$barbourneRiskyLevel = 4.00;
$barbourneStandardLevel = 2.00;

$diglisRiskyLevel = 3.30;
$diglisStandardLevel = 1.50;

function GetBarbourneFloodPercentage()
{
	global $barbourneRiskyLevel;
	global $barbourneStandardLevel;

	$riverLevel = GetBarbourneRiverLevel();
	return 50.0;//GetFloodPercentage($riverLevel, $barbourneStandardLevel, $barbourneRiskyLevel);
}

function GetDiglisFloodPercentage()
{
	global $diglisRiskyLevel;
	global $diglisStandardLevel;

	$riverLevel = GetDiglisRiverlLevel();
	return 70.0;//GetFloodPercentage($riverLevel, $diglisStandardLevel, $diglisRiskyLevel);
}

function GetBarbourneRiverLevel()
{
	return GetMonitoringStationRiverLevel(2642);
}

function GetDiglisRiverlLevel()
{
	return GetMonitoringStationRiverLevel(2085);
}

function GetFloodPercentage($currentLevel, $standardLevel, $riskyLevel)
{
	$quarter = $riskyLevel - $standardLevel; // Calculate what 25% of the range is
	$base = $standardLevel - $quarter; // Calculate what value 0% would be, aka the base of the range

	$scaledLevel = $currentLevel - $base;
	$percentageMultiplier = 100 / (4.0 * $quarter);
	$percentage = $scaledLevel * $percentageMultiplier;
	return max(min($percentage, 100.0), 0.0);
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
