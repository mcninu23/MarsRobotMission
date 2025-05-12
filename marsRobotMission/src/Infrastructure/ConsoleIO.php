<?php

namespace MarsRobotMission\Infrastructure;

use MarsRobotMission\Domain\Position;
use MarsRobotMission\Domain\Direction;
use MarsRobotMission\Shared\Exceptions\InvalidInputException;
use MarsRobotMission\Shared\Exceptions\OutOfBoundsException;

class ConsoleIO
{
    public function getInitialPosition(): Position
    {
        while (true) {
            try {
                echo "Indica la posición inicial X (0–199): ";
                $x = trim(fgets(STDIN));
                echo "Indica la posición inicial Y (0–199): ";
                $y = trim(fgets(STDIN));

                if (!is_numeric($x) || !is_numeric($y)) {
                    throw new InvalidInputException("Las coordenadas deben ser numéricas.");
                }

                $x = (int)$x;
                $y = (int)$y;

                return new Position($x, $y);
            } catch (InvalidInputException | OutOfBoundsException $e) {
                echo "❌ " . $e->getMessage() . "\n";
            }
        }
    }

    public function getInitialDirection(): Direction
    {
        while (true) {
            try {
                echo "Indica la orientación inicial (NORTE, SUR, ESTE, OESTE): ";
                $input = strtoupper(trim(fgets(STDIN)));
                return new Direction($input);
            } catch (InvalidInputException $e) {
                echo "❌ " . $e->getMessage() . "\n";
            }
        }
    }

    public function getCommandSequence(): string
{
    while (true) {
        echo "Introduce órdenes (ej: ffrlff). Escribe 'salir' para terminar.\n";
        echo "Órdenes: ";
        $input = trim(fgets(STDIN));

        if (strtolower($input) === 'salir') {
            return 'salir';
        }

        if (!preg_match('/^[flrFLR]+$/', $input)) {
            echo "❌ Comando inválido. Solo se permiten las letras 'f', 'l', 'r' (sin espacios ni otros caracteres).\n";
            continue;
        }

        return strtolower($input); // Limpio y en minúsculas
    }
}

    public function print(string $message): void
    {
        echo $message;
    }
}
