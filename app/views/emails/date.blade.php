<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
    </head>

    <style type="text/css">
            body{
                font-family: helvetica neue, helvetica, arial;
                font-size: 16px;
                background-color:url(../img/fd.png);
            }
            a{
                color:rgb(182, 85, 85)!important;
                font-weight: bold;
                text-decoration: none;
                text-shadow: 2px 2px 0px rgba(255, 1, 0, 0.1)!important;
            }
            h1{
                font-size: 22px!important;
                font-weight: normal!important;
                color:rgb(48, 46, 46)!important;
                text-shadow: 2px 2px 0px rgba(150, 150, 150, 0.10)!important;
            }
            p{
                font-size: 13px!important
            }
            .header{
                padding-bottom: 10px;
                 border-bottom: 1px dotted rgb(243, 231, 231)!important;
            }
            .it{
                font-style: italic;
            }
    </style>
    <body>
        @include('emails.parts.header')
        <h1>Rappel : {{$msg->content}} / {{$msg->date->name}}</h1>
        <div style="font-size: 13px">
            <p>Vous avez reçu un rappel pour ce rendez-vous du {{$msg->date->start}}</p>
        </div>
    </body>
</html>