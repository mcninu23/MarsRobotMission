<?php

namespace MarsRobotMission\Application;

use MarsRobotMission\Domain\Robot;
use MarsRobotMission\Domain\Position;
use MarsRobotMission\Domain\Direction;

class RobotInitializer
{
    public static function initialize(Position $position, Direction $direction): Robot
    {
        return new Robot($position, $direction);
    }
}
