<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Votre nouveau mot de passe a été créé</h2>
         <div>Votre nouveau Mot de Passe :<strong>{{ $password }}</strong></div>
        <div>
            Cconnectez vous sur {{ HTML::link('login')}}
        </div>
    </body>
</html>