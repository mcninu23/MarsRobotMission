<?php

// index.php (punto de entrada)

require_once 'src/Infrastructure/ConsoleIO.php';
require_once 'src/Application/RobotInitializer.php';
require_once 'src/Application/CommandProcessor.php';
require_once 'src/Domain/Robot.php';
require_once 'src/Domain/Position.php';
require_once 'src/Domain/Direction.php';
require_once 'src/Shared/Exceptions/InvalidInputException.php';
require_once 'src/Shared/Exceptions/OutOfBoundsException.php';

use MarsRobotMission\Infrastructure\ConsoleIO;
use MarsRobotMission\Application\RobotInitializer;
use MarsRobotMission\Application\CommandProcessor;

$io = new ConsoleIO();

try {
    $position = $io->getInitialPosition();
    $direction = $io->getInitialDirection();
    $robot = RobotInitializer::initialize($position, $direction);

    while (true) {
        $commandString = $io->getCommandSequence();

        if (strtolower($commandString) === 'salir') {
            $io->print("Finalizando.\n");
            break;
        }

        $processor = new CommandProcessor($robot);
        $processor->run($commandString);

        $io->print($robot->getStatus() . "\n");

        if ($robot->isBlocked()) {
            break;
        }
    }
} catch (Exception $e) {
    $io->print("Error: " . $e->getMessage() . "\n");
    exit(1);
}
