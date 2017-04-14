<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <title>The Game Of Life </title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    </head>
    <body>
        <style>
            .blue {background-color: lightblue}
            .green {background-color: lightgreen}
            .panel {
                width: auto;
                height: auto;
            }
            .table {
                /*width: 99%;*/
                /*height: 99%;*/
                font-size: 12px;
                text-align: center;
            }
            table td {
                width: 15px;
            }
            .col-md-8 {
                width: 100%;
                height: 100%;
            }
        </style>               
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">

                    @section('gameField')

                    @show

                    @section('intro')

                    @show

                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <script src="{{asset('js/jquery.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
    </body>
</html>
