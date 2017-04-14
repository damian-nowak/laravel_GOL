<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameOfLife extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $table = 'game_of_lives';
    protected $fillable = array('id','created_at','updated_at','date_of_game','state_of_game');
}
