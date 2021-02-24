<?php
function IsWorcesterUnderwater()
{
	return False;
}

function GetBarbourneRiverLevel()
{
	return GetMonitoringStationRiverLevel(2092);
}

function GetDiglisRiverlLevel()
{
	return GetMonitoringStationRiverLevel(2039);
}

function GetMonitoringStationRiverLevel(stationId)
{
	$root = "http://environment.data.gov.uk/flood-monitoring";
	//$measuresExtension = "/id/stations/" . strval(stationId) . "/measures";

	return 3;
}
?>
