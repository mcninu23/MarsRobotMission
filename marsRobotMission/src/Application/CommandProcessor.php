<?php

namespace MarsRobotMission\Application;

use MarsRobotMission\Domain\Robot;

class CommandProcessor
{
    private Robot $robot;

    public function __construct(Robot $robot)
    {
        $this->robot = $robot;
    }

    public function run(string $commands): void
    {
        $commands = strtolower($commands);

        for ($i = 0; $i < strlen($commands); $i++) {
            if ($this->robot->isBlocked()) {
                break;
            }

            $this->ejecutarOrden($commands[$i]);
        }
    }

    private function ejecutarOrden(string $orden): void
    {
        match ($orden) {
            'f' => $this->robot->moveForward(),
            'l' => $this->robot->moveLeft(),
            'r' => $this->robot->moveRight(),
            default => null
        };
    }
}
