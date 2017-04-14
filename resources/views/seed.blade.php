
@extends('layouts.layout')

@section('gameField')

<div class="panel panel-default">

    <div class="panel-heading text-center"><h2>Starting Seed</h2>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2">
                <form action="/prev/{{ $id }}" method="POST" class="form-inline">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-info" type="submit" >Prev generation</button>
                </form>
            </div>
            <div class="col-md-2">
                <span class="text-center"><a href="{{url("/")}}"><button class="btn btn-danger">Restart</button></a></span>
            </div>
            <div class="col-md-2">
                <form action="/next/{{ $id }}" method="POST" class="form-inline">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-info" type="submit" >Next generation</button>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="table table-responsive table-condensed center-block">
        <table class="table table-bordered table-striped text-center">
            <thead></thead>
            <tbody >
                @foreach($data as $key => $seed)
                <tr>
                    @foreach($seed as $key => $value)
                    @if($value['blue'] == 1)
                    <td class="text-center blue">
                        <p>{{$value['status']}}</p>
                    </td>
                    @elseif($value['green'] == 1)
                    <td class="green">
                        <p>{{$value['status']}}</p>
                    </td>
                    @else
                    <td>
                    </td>
                    @endif                                
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

