<?php
function IsWorcesterUnderwater()
{
	return False;
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

	echo "Raw Response" . $response;

	$decodedResponse = json_decode($response, true);
	echo $decodedResponse;
	echo "Items:" . $decodedResponse['items'];
	/*echo "Station Reference:" . $decodedResponse['items'][0]['stationReference'];
	echo "Water Level:" . $decodedResponse['items'][0]['latestReading']['value'];*/
	return 3;
}
?>
