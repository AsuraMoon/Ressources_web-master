<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Page Title</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/megrim" type="text/css"/>
        <link id="link" rel='stylesheet' type='text/css' media='screen' href='denis.css'>
        <script src='manon.js' defer></script>
    </head>
    <body>
        
        <div class="wrapper">
            
            <div class="tout">
                <button id="toggle_css">CSS</button>
                <h1>Formulaire d'Inscription</h1>
                
                <form action="traitement_inscription.php" method="POST">
                    <label for="nom">Nom</label>
                    <input type="text" placeholder="Nom" name="nom" required>
                    <br/>
                    <label for="prenom">Prenom</label>
                    <input type="text" placeholder="Prenom" name="prenom" id="prenom" required>
                    <br/>
                    <label for="pseudo">Pseudo</label>
                    <input type="text" id="pseudo" name="pseudo" placeholder="pseudo">
                    <br/>
                    <label for="password">mot de passe</label>
                    <input id="password" type="password" name="password" placeholder="password">
                    <br/>
                    <label for="verif_password">confirmez le mot de passe</label>
                    <input id="verif_password" type="password" placeholder="confirmez le password" name="verif_password" required>
                    <br/>
                    <label for="email">Adresse e-mail :</label>
                    <input id="email" type="email" name="email" placeholder="E-mail" required>
                    <br/>
                    <label for="mobile">Numéro de mobile :</label>
                    <input id="mobile" type="tel" name="mobile" placeholder="Mobile">
                    <br/>
                    <label for="naissance">Date de naissance :</label>
                    <input id="naissance" type="date" name="naissance" placeholder="Date de naissance">
                    <br/>
                    <input type="submit" name="inscription" value="S'inscrire">
                </form>
            </div>
            <?php 
                // Si la session 'error' existe
                if (!empty($_SESSION['error'])) {
                    // alors on affiche un message
                    printf('<div id="error">%s</div><br/>',$_SESSION['error']) ;
                    unset($_SESSION['error']);
                }

                var_dump($_POST);
            ?>
            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </body>
</html>