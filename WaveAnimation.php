<?php

/*class coord
{
    public float $x;
    public float $y;

    function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    function translate(coord $translation)
    {
        $this->x += $translation->x;
        $this->y += $translation->y;
    }

    function multiply(float $scale)
    {
        return new coord($this->x * $scale, $this->y * $scale);
    }

    function AsString()
    {
        return $this->x . "% " . $this->y; 
    }
}

class key_frame
{
    public array $points = array();

    function __clone()
    {
        $clonedArray = array();
        for($i = 0; $i < count($this->points); $i++)
        {
            array_push($clonedArray, clone $this->points[$i]);
        }
        $this->points = $clonedArray;
    }

    function AppendPoint(coord $point)
    {
        array_push($this->points, $point);
    }

    function RemovePoint(int $index)
    {
        \array_splice($this->points, $index, 1);
    }

    function Size()
    {
        return count($this->points);
    }
}*/

// Waves need to be on a line that is at an angle. So We gotta interpolate a bunch of 
// heights and then generate 4 sets of keyframes to use for the animation
function GenerateWaveKeyframeHeights($leftHeight, $rightHeight)
{
    echo "soup";
    /*$keyFrames = GenerateKeyframes($leftHeight, $rightHeight, 1);

    EchoKeyframesAsCssVariables($keyFrames);*/
}

/*function GenerateKeyframes($leftHeight, $rightHeight, $waveHeight)
{
    $numOfPoints = 40;
    $coreWave = GenerateWave($leftHeight, $rightHeight, $waveHeight, $numOfPoints);

    $translationBetweenFrames = new coord(100/($numOfPoints - 1), ($rightHeight - $leftHeight) / ($numOfPoints - 1));

    $keyFrames = array();
    for($i = 0; $i < $numOfPoints; $i++)
    {
        $newKeyFrame = clone $coreWave;
        $newKeyFrame = MoveKeyframePoints($newKeyFrame, $translationBetweenFrames->multiply($i * -1));
        $newKeyFrame = CycleKeyframePoints($newKeyFrame, $translationBetweenFrames);
        array_push($keyFrames, $newKeyFrame);
    }
    return $keyFrames;
}

function GenerateWave($leftHeight, $rightHeight, $waveHeight, $numOfPoints)
{
    $wave = InterpolateLine($leftHeight, $rightHeight, $numOfPoints);

    for($i = 0; $i < $wave->Size(); $i++)
    {
        if(($i % 4) == 0) $wave->points[$i]->y += $waveHeight;
        else if(($i % 2) == 0)  $wave->points[$i]->y -= $waveHeight;
    }
    
    return $wave;
}

function InterpolateLine($leftHeight, $rightHeight, $numOfPoints)
{
    $heightDiffBetweenPoints = ($rightHeight - $leftHeight) / ($numOfPoints - 1);
    $widthDiffBetweenPoints = 100/($numOfPoints - 1);

    $keyPoints = new key_frame();
    for($i = 0; $i < $numOfPoints; $i++)
    {
        $keyPoints->AppendPoint(new coord($widthDiffBetweenPoints * $i, $leftHeight + ($heightDiffBetweenPoints * $i)));
    }

    return $keyPoints;
}

function MoveKeyframePoints($keyFrame, coord $translation)
{
    for($i = 0; $i < $keyFrame->Size(); $i++)
    {
        $keyFrame->points[$i]->translate($translation);
    }
    return $keyFrame;
}

// Move any key frame points that got shifted too far left back around to be on the right
function CycleKeyframePoints($keyFrame, $translation)
{
    for($i = 0; $i < $keyFrame->Size(); $i++)
    {
        if($keyFrame->points[$i]->x < 0)
        {
            $movingPoint = clone $keyFrame->points[$i];
            $keyFrame->RemovePoint($i);
            $movingPoint->translate($translation->multiply($keyFrame->Size() + 1));
            $keyFrame->AppendPoint($movingPoint);
            $i--;
        }
    }
    return $keyFrame;
}

function EchoKeyframesAsCssVariables($keyFrames)
{
    for($i = 0; $i < count($keyFrames); $i++)
    {
        $keyFrame = $keyFrames[$i];
        $keyframeString = "--Keyframe" . $i . ":";
        for($j = 0; $j < $keyFrame->Size(); $j++)
        {
            $keyframeString = $keyframeString . $keyFrame->points[$j]->AsString() . "%";
            if($j < $keyFrame->Size() - 1)
            {
                $keyframeString = $keyframeString . ", ";
            }
        }

        echo $keyframeString . ";\n";
    }
}*/
?>