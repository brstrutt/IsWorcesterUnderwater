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

	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => $root . $measuresExtension,
		CURLOPT_POST => True,
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err)
	{
		echo "CURL Error #:" . $err;
	}
	else
	{
		$resArr = json_decode($response);
		echo "<pre>"; print_r($resArr); echo "</pre>";
	}

	return 3;
}
?>
