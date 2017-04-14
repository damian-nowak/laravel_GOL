<?php

namespace App;

class GoLGenerator {

    private $prevGameField = [];
    private $gameFieldSize = 0;
    private $gameField = [];
    private $nextGameField = [];

    public function __construct($prevGameField, $gameFieldSize = 0, $gameField = [], $nextGameField = []) {
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
                $this->gameField[$row][$col] = ['blue' => 0, 'green' => 0, 'status' => 'new'];
            };
        };

        $checkedPrevGameField = $this->healthCheck($this->prevGameField);

        // putting adjusting game field with prev game values (aka seed in 1st game)
        for ($row = 0; $row < sizeof($this->prevGameField); $row++) {
            for ($col = 0; $col < sizeof($this->prevGameField[$row]); $col++) {
                if (isset($checkedPrevGameField[$row][$col])) {
                    $value = $checkedPrevGameField[$row][$col];
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


                // checking adjacent cells for colors
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
                if ($sumOfNeighbours >= 1) {
                    if ($this->gameField[$row][$col]['status'] == 'new' && $greenNeighbours > $blueNeighbours) {
                        $this->nextGameField[$row][$col]['blue'] = 0;
                        $this->nextGameField[$row][$col]['green'] = 1;
                        $this->nextGameField[$row][$col]['status'] = 'alive';
                    }
                    if ($this->gameField[$row][$col]['status'] == 'new' && $greenNeighbours <= $blueNeighbours) {
                        $this->nextGameField[$row][$col]['blue'] = 1;
                        $this->nextGameField[$row][$col]['green'] = 0;
                        $this->nextGameField[$row][$col]['status'] = 'alive';
                    }
                }
            };
        };
        $this->gameField = $this->nextGameField;
        return $this->gameField;
    }

    /**
     * checks every cell on gamefield and sets proper status
     * 
     * @param type $array
     * @return type
     */
    private function healthCheck($array) {

        $tempArray = [];

        for ($row = 0; $row < sizeof($array); $row++) {
            for ($col = 0; $col < sizeof($array); $col++) {
                $sumOfNeighbours = 0;

                // checking adjacent cells and counting neighbours
                for ($adjacentRow = $row - 1; $adjacentRow <= $row + 1; $adjacentRow++) {
                    for ($adjacentCol = $col - 1; $adjacentCol <= $col + 1; $adjacentCol++) {

                        if (isset($array[$adjacentRow][$adjacentCol])) {
                            if ($adjacentRow == $row && $adjacentCol == $col) {
                                
                            } elseif ($array[$adjacentRow][$adjacentCol]['status'] == 'alive') {
                                $sumOfNeighbours++;
                            }
                        }
                    }
                }
                
                // setting proper status for existing cells
                if ($array[$row][$col]['status'] == 'alive') {
                    if ($sumOfNeighbours > 3) {
                        $tempArray[$row][$col]['status'] = 'dead';
                        $tempArray[$row][$col]['blue'] = $array[$row][$col]['blue'];
                        $tempArray[$row][$col]['green'] = $array[$row][$col]['green'];
                    } elseif ($sumOfNeighbours < 2) {
                        $tempArray[$row][$col]['status'] = 'dead';
                        $tempArray[$row][$col]['blue'] = $array[$row][$col]['blue'];
                        $tempArray[$row][$col]['green'] = $array[$row][$col]['green'];
                    } else {
                        $tempArray[$row][$col]['status'] = 'alive';
                        $tempArray[$row][$col]['blue'] = $array[$row][$col]['blue'];
                        $tempArray[$row][$col]['green'] = $array[$row][$col]['green'];
                    }
                }
                if ($array[$row][$col]['status'] == 'dead') {
                    if ($sumOfNeighbours == 3) {
                        $tempArray[$row][$col]['status'] = 'alive';
                        $tempArray[$row][$col]['blue'] = $array[$row][$col]['blue'];
                        $tempArray[$row][$col]['green'] = $array[$row][$col]['green'];
                    } else {
                        $tempArray[$row][$col]['status'] = $array[$row][$col]['status'];
                        $tempArray[$row][$col]['blue'] = $array[$row][$col]['blue'];
                        $tempArray[$row][$col]['green'] = $array[$row][$col]['green'];
                    }
                }
            }
        }
        $array = $tempArray;
        return $array;
    }

    function getGameField() {
        return $this->gameField;
    }

    function getPrevGameField() {
        return $this->prevGameField;
    }

}
