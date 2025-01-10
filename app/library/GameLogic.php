<?php

namespace App;

class GameLogic
{
    private array $matrix;

    public function __construct(array $matrix)
    {
        if (empty($matrix)) {
            throw new \LogicException('Matrix could not be empty.');
        }

        foreach ($matrix as $row) {
            if (!is_array($row)) {
                throw new \LogicException('Multidimensional matrix is expected.');
            }
            if (count($matrix) !== count($row)) {
                throw new \LogicException('Square matrix is expected.');
            }
        }

        if (count($matrix) < 3) {
            throw new \LogicException('Square matrix should be bigger than 2.');
        }

        $this->matrix = $matrix;
    }

    /**
     * Good enough for MVP.
     * No one will notice.
     * 
     * @Mathew - reduced unwanted call stack and remove $gridSize calculation from repeated calls.
     */
    public function makeMove(): array
    {
        $availableMoves = [];

        foreach ($this->matrix as $rowIndex => $row) {
            foreach ($row as $colIndex => $cell) {
                if ($cell === '') {
                    $availableMoves[] = [$rowIndex, $colIndex];
                }
            }
        }

        $computer_plays = array_rand($availableMoves);

        $this->setComputersMove($availableMoves[$computer_plays][0], $availableMoves[$computer_plays][1]);
        
        return $availableMoves[$computer_plays];
    }

    public function setComputersMove(int $row, int $col): void
    {
        $this->matrix[$row][$col] = 'O';
    }

    public function isGameOver(): bool
    {
        return !$this->isFreeCellsLeft() || $this->doWeHaveWinner();
    }

    /**
     * @Mathew
     * Modified the function to make it smaller. It uses inbuilt functions to avoid unnecessary manual loops.
     * 
     * Inbuilt functions are faster as they are written in C.
     */
    public function isFreeCellsLeft(): bool
    {
        $rows_that_have_at_least_one_empty_cell = array_filter($this->matrix, fn($row) => in_array('', $row));

        return count($rows_that_have_at_least_one_empty_cell) > 0;
    }
        }
        return false;
    }

    /**
     * I just copypasted what ChatGPT gave me. Have no idea how it's working.
     * Need to write tests... Maybe.
     */
    public function doWeHaveWinner(): bool
    {
        // Check rows
        for ($i = 0; $i < count($this->matrix); $i++) {
            if (count(array_unique($this->matrix[$i])) === 1 && $this->matrix[$i][0] !== '') {
                return true;
            }
        }

        // Check columns
        for ($col = 0; $col < count($this->matrix); $col++) {
            $column = [];
            for ($row = 0; $row < count($this->matrix); $row++) {
                $column[] = $this->matrix[$row][$col];
            }
            if (count(array_unique($column)) === 1 && $column[0] !== '') {
                return true;
            }
        }

        // Check main diagonal
        $mainDiagonal = [];
        for ($i = 0; $i < count($this->matrix); $i++) {
            $mainDiagonal[] = $this->matrix[$i][$i];
        }
        if (count(array_unique($mainDiagonal)) === 1 && $mainDiagonal[0] !== '') {
            return true;
        }

        // Check anti-diagonal
        $antiDiagonal = [];
        for ($i = 0; $i < count($this->matrix); $i++) {
            $antiDiagonal[] = $this->matrix[$i][count($this->matrix) - $i - 1];
        }
        if (count(array_unique($antiDiagonal)) === 1 && $antiDiagonal[0] !== '') {
            return true;
        }

        // No winner
        return false;
    }
}
