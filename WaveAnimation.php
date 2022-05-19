<?php
// Waves need to be on a line that is at an angle. So We gotta interpolate a bunch of 
// heights and then generate 4 sets of keyframes to use for the animation
function GenerateWaveKeyframeHeights($leftHeight, $rightHeight)
{
    $keyHeights = InterpolateLine($leftHeight, $rightHeight, 5);

    $keyFrames = array();

    for($i = 0; $i < 4; $i++)
    {
        array_push($keyFrames, GenerateKeyframe($keyHeights, $i, 2));
    }

    EchoKeyframesAsCssVariables($keyFrames);
}

function InterpolateLine($leftHeight, $rightHeight, $numOfKeyHeights)
{
    $heightDiffBetweenPoints = ($rightHeight - $leftHeight) / ($numOfKeyHeights - 1);
    $keyHeights = array();

    for($i = 0; $i < $numOfKeyHeights; $i++)
    {
        array_push($keyHeights, $leftHeight + ($heightDiffBetweenPoints * $i));
    }

    return $keyHeights;
}

function GenerateKeyframe($originalHeights, $keyframeNum, $waveHeight)
{
    $keyFrame = $originalHeights;
    switch($keyframeNum)
    {
        case 0:
            $keyFrame[0] += $waveHeight;
            $keyFrame[2] -= $waveHeight;
            $keyFrame[4] += $waveHeight;
            break;
        case 1:
            $keyFrame[1] -= $waveHeight;
            $keyFrame[3] += $waveHeight;
            break;
        case 2:
            $keyFrame[0] -= $waveHeight;
            $keyFrame[2] += $waveHeight;
            $keyFrame[4] -= $waveHeight;
            break;
        case 3:
            $keyFrame[1] += $waveHeight;
            $keyFrame[3] -= $waveHeight;
            break;
    }
    return $keyFrame;
}

/*function InterpolateBetweenKeyPoints($keyPoints)
{
    $expandedPointset = array();

    for($i = 0; $i < count($keyPoints) - 1; $i++)
    {
        array_push($expandedPointset, $keyPoints[$i]);

        $diff
    }

    array_push($expandedPointset, $keyPoints[count($keyPoints) - 1]);
    return $expandedPointset;
}*/

function EchoKeyframesAsCssVariables($keyFrames)
{
    for($i = 0; $i < count($keyFrames); $i++)
    {
        $keyframeString = "--Keyframe" . $i . ":";
        $widthDifferenceBetweenPoints = 25;
        for($j = 0; $j < count($keyFrames[$i]); $j++)
        {
            $keyframeString = $keyframeString . ($widthDifferenceBetweenPoints * $j) . "% " . $keyFrames[$i][$j] . "%";
            if($j < count($keyFrames[$i]) - 1)
            {
                $keyframeString = $keyframeString . ", ";
            }
        }

        echo $keyframeString . ";";
    }
}
?>