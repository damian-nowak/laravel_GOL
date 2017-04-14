
@extends('layouts.layout')

@section('gameField')

<div class="jumbotron">
    <div class="container text-center">
        <h1>Hello, world!</h1>
        <p>Welcome to The Game of Life! In this simple web application, one can follow adventures of brave cells living and dying according to a certain set of rules...</p>
        <p>Below one can find out why this web app was created or select in what way start a new game! </p>
        <p><a class="btn btn-primary btn-lg" href="https://itchallenges.me/" target="_blank" role="button">Learn more &raquo;</a></p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4 text-center">
            <h2>Plain 4x4</h2>
            <p> <img src="{{asset("images/GoL4x4.jpg")}} "width="200px" height="100px"> </p>
            <p><a class="btn btn-default" href="{{url("start/Plain")}}" role="button">Start game &raquo;</a></p>
        </div>
        <div class="col-md-4 text-center">
            <h2>Fancy 5x5</h2>
            <p> <img src="{{asset("images/GoL5x5.jpg")}} "width="200px" height="100px"> </p>
            <p><a class="btn btn-default" href="{{url("start/Fancy")}}" role="button">Start game &raquo;</a></p>
        </div>
        <div class="col-md-4 text-center">
            <h2>Random...</h2>
            <p> <img src="{{asset("images/GoLRandom.jpg")}} "width="100px" height="100px"> </p>
            <p><a class="btn btn-default" href="{{url("start/Random")}}" role="button">Start game &raquo;</a></p>
        </div>
    </div>
</div>
@endsection

