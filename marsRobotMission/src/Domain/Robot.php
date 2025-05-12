<?php

namespace MarsRobotMission\Domain;

use MarsRobotMission\Shared\Exceptions\OutOfBoundsException;

class Robot
{
    private Position $position;
    private Direction $direction;
    private bool $blocked = false;
    private ?string $motivoParada = null;

    private array $obstacles = [
        [2, 2],
        [4, 2],
        [0, 3],
    ];

    public function __construct(Position $position, Direction $direction)
    {
        $this->position = $position;
        $this->direction = $direction;
    }

    public function moveForward(): void
    {
        $this->mover($this->getForwardDelta());
    }

    public function moveLeft(): void
    {
        $this->mover($this->getLeftDelta());
    }

    public function moveRight(): void
    {
        $this->mover($this->getRightDelta());
    }

    private function mover(array $delta): void
    {
        if ($this->blocked) return;

        $newX = $this->position->getX() + $delta[0];
        $newY = $this->position->getY() + $delta[1];

        if ($newX < 0 || $newX > 199 || $newY < 0 || $newY > 199) {
            $this->blocked = true;
            $this->motivoParada = "🛑 El robot ha salido del área en ($newX, $newY) y se ha detenido.";
            return;
        }

        foreach ($this->obstacles as [$ox, $oy]) {
            if ($newX === $ox && $newY === $oy) {
                $this->blocked = true;
                $this->motivoParada = "🛑 Obstáculo detectado en ($newX, $newY). El robot se ha detenido.";
                return;
            }
        }

        $this->position = $this->position->withNewCoordinates($newX, $newY);
    }

    private function getForwardDelta(): array
    {
        return match ($this->direction->getValue()) {
            'NORTE' => [0, 1],
            'SUR'   => [0, -1],
            'ESTE'  => [1, 0],
            'OESTE' => [-1, 0],
        };
    }

    private function getLeftDelta(): array
    {
        return match ($this->direction->getValue()) {
            'NORTE' => [-1, 0],
            'SUR'   => [1, 0],
            'ESTE'  => [0, 1],
            'OESTE' => [0, -1],
        };
    }

    private function getRightDelta(): array
    {
        return match ($this->direction->getValue()) {
            'NORTE' => [1, 0],
            'SUR'   => [-1, 0],
            'ESTE'  => [0, -1],
            'OESTE' => [0, 1],
        };
    }

    public function isBlocked(): bool
    {
        return $this->blocked;
    }

    public function getStatus(): string
    {
        return "Posición final: {$this->position}" .
            ($this->blocked ? PHP_EOL . $this->motivoParada : '');
    }
}
