<?php

namespace MarsRobotMission\Domain;

use MarsRobotMission\Shared\Exceptions\OutOfBoundsException;

class Position
{
    private int $x;
    private int $y;

    public function __construct(int $x, int $y)
    {
        if ($x < 0 || $x > 199 || $y < 0 || $y > 199) {
            throw new OutOfBoundsException("La posición ($x, $y) está fuera del área permitida (0-199).");
        }

        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function withNewCoordinates(int $x, int $y): self
    {
        return new self($x, $y);
    }

    public function equals(Position $other): bool
    {
        return $this->x === $other->getX() && $this->y === $other->getY();
    }

    public function __toString(): string
    {
        return "({$this->x}, {$this->y})";
    }
}
