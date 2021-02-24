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
	$measuresExtension = "/id/stations/" . strval(stationId) . "/measures";

	$response = file_get_contents($root . $measuresExtension);
	/*$curl = curl_init($root . $measuresExtension);

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);*/
	echo "Results:" . $response;
	return 3;
}
?>
