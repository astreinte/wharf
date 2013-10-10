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
                color:rgb(182, 85, 85);
                font-weight: bold;
                text-decoration: none;
                text-shadow: 2px 2px 0px rgba(255, 1, 0, 0.1);
            }
            h1{
                font-size: 22px;
                font-weight: normal;
                color:rgb(48, 46, 46);
                text-shadow: 2px 2px 0px rgba(150, 150, 150, 0.10);
            }
            p{
                font-size: 14px
            }
            .header{
                padding-bottom: 10px;
                border-bottom: 1px dotted rgb(243, 231, 231);
            }
            .it{
                font-style: italic;
            }
    </style>
    <body>
        @include('emails.parts.header')
        <h2>Confirmation d'inscription sur l'extranet de Wharf</h2>
        <p>
            Bonjour <strong>{{$firstname}} {{$lastname}}</strong>, votre compte extranet a bien été créé.
        </p>
        <p>
            Connectez vous sur {{HTML::link('login')}} grâce à ces identifiants :
        </p>
        <p class="it">Login : <strong>{{$login}}</strong></p>
        <p class="it">Mot de passe : <strong>{{$password}}</strong></p>
        <p>Merci pour votre inscription.</p>
        <p>Cordialement,</p>
        <p>L'equipe Wharf.</p>
    </body>
</html>