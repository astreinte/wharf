<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Bonjour {{ $firstname }} {{ $lastname }}, votre compte extranet a été créé</h2>
 
        <div>
            Voici vos identifiants, connectez vous sur {{ HTML::link('login')}}
        </div>
        <div>Identifiant : <strong>{{ $login }}</strong></div>
        <div>Mot de Passe <strong>{{ $password }}</strong></div>
    </body>
</html>