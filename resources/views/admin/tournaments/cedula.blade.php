<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante</title>
    <link rel="stylesheet" href="{{public_path('css/bootstrap.min.css')}}">
    <style>
        
    </style>
</head>
<body class="px-4">
    <div class="row justify-content-between " style="height: 90px">
        <div class="col">
            <img src="{{public_path('images/logo_unam.png')}}" alt="Logo UNAM" height="90" class="d-inline-block">
            <img src="{{public_path('images/logo_fi.png')}}" alt="Logo FI" height="90" class="d-inline-block">
        </div>
    </div>
    <div>
        <h2 class="d-block text-right">
            {{$tournament->name}}
        </h2>
    </div>
    
    <div class="mt-4">
        @if(count($users)>0)
            <div class="">
                @foreach ($users as $i=>$user)
    
                    <?php $user = $user->user ?>
                    <div class="d-inline-block p-2 mb-2 mr-1" style="border: 1px solid black; width: 45%; height: 90px;"> 
                        <div class="col-4 d-inline-block">
                            <img src="{{$user->avatarPublicPath()}}" alt="Logo FI" height="60" class="mt-3">
                            <i>
                                {{$user->curp}}
                            </i>
                        </div>

                        
                        <div class="col-7 d-inline-block">
                            {{$user->name}}
                            {{$user->last_name}}
                            <br>
                            <b>
                                {{$user->account_number}}
                            </b>
                        </div>
                    
                    </div>
                    @if($i % 2 == 1)
                        <br>
                    @endif
                @endforeach
            </div>
        @else
                <h2 class="d-block text-center">No hay nadie inscrito aún.</h2>

        @endif
        
    </div>

    
</body>
</html>