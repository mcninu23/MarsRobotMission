<?php

namespace MarsRobotMission\Domain;

use MarsRobotMission\Shared\Exceptions\InvalidInputException;

class Direction
{
    private const VALID_DIRECTIONS = ['NORTE', 'SUR', 'ESTE', 'OESTE'];

    private string $value;

    public function __construct(string $direction)
    {
        $direction = strtoupper($direction);
        if (!in_array($direction, self::VALID_DIRECTIONS)) {
            throw new InvalidInputException("Dirección inválida: $direction. Usa NORTE, SUR, ESTE u OESTE.");
        }

        $this->value = $direction;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
