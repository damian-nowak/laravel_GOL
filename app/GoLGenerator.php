<?php

namespace App;

class GoLGenerator {

    private $prevGameField = [];
    private $gameFieldSize = 0;
    private $gameField = [];
    private $nextGameField = [];

    public function __construct($prevGameField = [], $gameFieldSize = 0, $gameField = [], $nextGameField = []) {
        $this->prevGameField = $prevGameField;
        $this->gameFieldSize = $gameFieldSize;
        $this->gameField = $gameField;
        $this->nextGameField = $nextGameField;
        $this->createGameField();
        $this->createNextGen();
    }

    /**
     * creates and adjusts game field
     */
    private function createGameField() {

        $this->gameFieldSize = sizeof($this->prevGameField) + 2;

        // creating new game field
        for ($row = 0; $row < $this->gameFieldSize; $row++) {
            for ($col = 0; $col < $this->gameFieldSize; $col++) {
                $this->gameField[$row][$col] = ['blue' => 0, 'green' => 0, 'status' => 'dead'];
            };
        };

        // putting adjusting game field with prev game values (aka seed in 1st game)
        for ($row = 0; $row < sizeof($this->prevGameField); $row++) {
            for ($col = 0; $col < sizeof($this->prevGameField[$row]); $col++) {
                if (isset($this->prevGameField[$row][$col])) {
                    $value = $this->prevGameField[$row][$col];
                    $this->gameField[$row + 1][$col + 1] = $value;
                };
            };
        };
        $this->prevGameField = $this->gameField;
    }

    /**
     * creates next generation
     * 
     * @return type
     */
    public function createNextGen() {

        $this->nextGameField = $this->gameField;

        for ($row = 0; $row < $this->gameFieldSize; $row++) {
            for ($col = 0; $col < $this->gameFieldSize; $col++) {
                $greenNeighbours = 0;
                $blueNeighbours = 0;


                // checking adjacent cells for colors and neighbours count
                for ($adjacentRow = $row - 1; $adjacentRow <= $row + 1; $adjacentRow++) {
                    for ($adjacentCol = $col - 1; $adjacentCol <= $col + 1; $adjacentCol++) {
                        if (isset($this->gameField[$adjacentRow][$adjacentCol])) {
                            if ($adjacentRow == $row && $adjacentCol == $col) {
                                
                            } elseif ($this->gameField[$adjacentRow][$adjacentCol]['status'] == 'alive') {
                                $greenNeighbours += $this->gameField[$adjacentRow][$adjacentCol]['green'];
                                $blueNeighbours += $this->gameField[$adjacentRow][$adjacentCol]['blue'];
                            }
                        }
                    }
                }
                $sumOfNeighbours = $greenNeighbours + $blueNeighbours;

                // setting proper status for existing cells               
                if ($this->gameField[$row][$col]['status'] == 'dead' && $sumOfNeighbours == 3) {
                    if (($this->gameField[$row][$col]['blue'] == 0 && $this->gameField[$row][$col]['green'] == 0) && $greenNeighbours > $blueNeighbours) {
                        $this->nextGameField[$row][$col]['blue'] = 0;
                        $this->nextGameField[$row][$col]['green'] = 1;
                        $this->nextGameField[$row][$col]['status'] = 'alive';
                    } elseif (($this->gameField[$row][$col]['blue'] == 0 && $this->gameField[$row][$col]['green'] == 0) && $greenNeighbours <= $blueNeighbours) {
                        $this->nextGameField[$row][$col]['blue'] = 1;
                        $this->nextGameField[$row][$col]['green'] = 0;
                        $this->nextGameField[$row][$col]['status'] = 'alive';
                    } else {
                        $this->nextGameField[$row][$col]['blue'] = $this->gameField[$row][$col]['blue'];
                        $this->nextGameField[$row][$col]['green'] = $this->gameField[$row][$col]['green'];
                        $this->nextGameField[$row][$col]['status'] = 'alive';
                    }
                }


                if ($this->gameField[$row][$col]['status'] == 'alive') {
                    if ($sumOfNeighbours > 3) {
                        $this->nextGameField[$row][$col]['status'] = 'dead';
                        $this->nextGameField[$row][$col]['blue'] = $this->gameField[$row][$col]['blue'];
                        $this->nextGameField[$row][$col]['green'] = $this->gameField[$row][$col]['green'];
                    } elseif ($sumOfNeighbours < 2) {
                        $this->nextGameField[$row][$col]['status'] = 'dead';
                        $this->nextGameField[$row][$col]['blue'] = $this->gameField[$row][$col]['blue'];
                        $this->nextGameField[$row][$col]['green'] = $this->gameField[$row][$col]['green'];
                    } else {
                        $this->nextGameField[$row][$col]['status'] = 'alive';
                        $this->nextGameField[$row][$col]['blue'] = $this->gameField[$row][$col]['blue'];
                        $this->nextGameField[$row][$col]['green'] = $this->gameField[$row][$col]['green'];
                    }
                }
            };
        };
        $this->prevGameField = $this->gameField;
        $this->gameField = $this->nextGameField;
        return $this->gameField;
    }

    public function randomStart() {
        $this->gameFieldSize = rand(3, 9);

        //creating matrix skeleton with above size
        for ($row = 0; $row < $this->gameFieldSize; $row++) {
            for ($col = 0; $col < $this->gameFieldSize; $col++) {
                $this->prevGameField[$row][$col] = [rand(1, 3)];
            };
        };

        //populating matrix fields based on number
        $temp = [];
        for ($row = 0; $row < $this->gameFieldSize; $row++) {
            for ($col = 0; $col < $this->gameFieldSize; $col++) {
                if ($this->prevGameField[$row][$col][0] == 1) {
                    $temp[$row][$col] = ['blue' => 0, 'green' => 0, 'status' => 'dead'];
                };
                if ($this->prevGameField[$row][$col][0] == 2) {
                    $temp[$row][$col] = ['blue' => 1, 'green' => 0, 'status' => 'alive'];
                };
                if ($this->prevGameField[$row][$col][0] == 3) {
                    $temp[$row][$col] = ['blue' => 0, 'green' => 1, 'status' => 'alive'];
                };
            };
        };
        $this->prevGameField = $temp;
    }

    function getGameField() {
        return $this->gameField;
    }

    function getPrevGameField() {
        return $this->prevGameField;
    }

}
