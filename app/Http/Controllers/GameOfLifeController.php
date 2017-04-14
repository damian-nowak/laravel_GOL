<?php

namespace App\Http\Controllers;

use App\GameOfLife;
use App\GolStarts;
use App\GoLGenerator;
use Illuminate\Http\Request;

class GameOfLifeController extends Controller {

    /**
     * generate first generation based on selected seed
     * 
     * @param type $type
     * @return type
     */
    public function start($type) {

        if ($type == 'Random') {
            $startGen = new GolGenerator();
            $startGen->randomStart();
            
            $inputIntoDB = GameOfLife::updateOrCreate(
                            ['id' => 1], ['id' => 1,
                        'date_of_game' => new \DateTime(),
                        'state_of_game' => json_encode($startGen->getPrevGameField())]
            );
            return view('seed', ['data' => $startGen->getPrevGameField(), 'id' => 1]);
        } else {
            $seed = GolStarts::where('seed_name', $type)->first();

            $startGen = new GoLGenerator(json_decode($seed->seed_data, true));
            $inputIntoDB = GameOfLife::updateOrCreate(
                            ['id' => 1], ['id' => 1,
                        'date_of_game' => new \DateTime(),
                        'state_of_game' => json_encode($startGen->getGameField())]
            );
            return view('seed', ['data' => $startGen->getPrevGameField(), 'id' => 1]);
        }
    }

    /**
     * loading next generation
     * 
     * @param Request $request
     * @return type
     */
    public function next(Request $request) {
        $id = $request->segment(2);
        $prevGen = GameOfLife::find($id);
        if (!$prevGen) {
            return back()->withInput();
        }

        $newGen = new GoLGenerator(json_decode($prevGen->state_of_game, true));
        $inputIntoDB = GameOfLife::updateOrCreate(
                        ['id' => $id + 1], ['id' => $id + 1,
                    'date_of_game' => new \DateTime(),
                    'state_of_game' => json_encode($newGen->getGameField())]
        );
        return view('game', ['data' => $newGen->getGameField(), 'id' => $id, 'next'=>$id+1]);
    }

    /**
     * loading previous generation
     * 
     * @param Request $request
     * @return type
     */
    public function prev(Request $request) {
        $id = $request->segment(2);
        $prevGen = GameOfLife::find($id - 1);
        if (!$prevGen) {
            return redirect('/');
        } else {
            return view('game', ['data' => json_decode($prevGen->state_of_game, true), 'id' => $prevGen->id, 'next'=>$id]);
        }
    }

}
