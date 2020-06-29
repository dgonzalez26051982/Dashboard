@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html class=''>

<head>
    <!--link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'-->

    <link rel="stylesheet" type="text/css" href="css/reset.min.css">
    <link rel="stylesheet" type="text/css" href="css/libAwesome/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    
</head>

<body>

    <div id="frame">
        <div id="sidepanel">
            <div id="profile">
                <div class="wrap">
                    <img id="profile-img" src="images/agente.png" class="online" alt="" />
                    <p>Agente</p>
                </div>
            </div>
            <div id="search"></div>

            <!--Auqui se muestra si existe un cliente o no...-->
            <div class="contacts" id="contacts">
                <ul>
                    <!--li class="contact">
                        <div class="wrap">
                            <span class="contact-status online"></span>
                            <img src="images/Cliente.png" alt="" />
                            <div class="meta">
                                <p class="name">Cliente</p>
                            </div>
                        </div>
                    </li-->
                </ul>
            </div>
        </div>

        <div class="content" id="content">
            <div class="contact-profile">
                <!--img src="images/Cliente.png" alt="" />
                <p>Cliente</p-->
            </div>

            <div class="messages">
                <ul>
                    <!--li class="sent">
					<img src="images/agente.png" src="" alt="" />
					<p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
				</li>
                    <li class="replies">
                        <img src="images/Cliente.png" alt="" />
                        <p>When you're backed against the wall, break the god damn thing down.</p>
                    </li-->
                </ul>
            </div>

            <div class="message-input">
                <div class="wrap">
                    <input id="inputText" type="text" placeholder="Ingrese su mensaje aqui..." readonly/>
                    <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>

    
    <!--script src="js/libs/jquery.min.js"></script-->
    <!--script src="js/libsocketio/socket.io.js"></script>
    <script src="js/socket-ChatAgente.js"></script>
    <script src="js/socket-ChatAgenteJquery_1.js" type="text/javascript"></script-->

</body>

@endsection
