<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="info">
                <h1 id="login">Page de connexion</h1>
                <p>Entrez votre Nom d'utilisateur et Mot de passe</p>
            </div>


            <div class="entre">
                <div class="bloc">
                    <img src="img/icon-homme.png">
                    <input type="text" name="nom">
                </div>
                

                <div class="bloc">
                    <img src="img/icon-cadenas.png">
                    <input type="password" name="mdp">
                </div>
            </div>

            <div class="boutons">
                <input type="submit" value="Se Connecter" name="conn">
                <a href="index.php">Inscription</a>
            </div>


            <?php 

                if (isset($_POST["conn"])) {
                    if (!empty($_POST["nom"]) && !empty($_POST["mdp"])) {

                        $nom = $_POST["nom"];
                        $mdp = $_POST["mdp"];

                        try {
                            $id_connex = new PDO('mysql:host=localhost;dbname=utilisateurs', 'root', '',
                            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                        }

                        catch (PDOException $e) {
                            die('Erreur : '.$e->getMessage());
                        }

                        $reponse = $id_connex->query("SELECT id, mdp FROM client WHERE id = '$nom'");

                        $ligne = $reponse->fetch(PDO::FETCH_ASSOC);

                        if ($ligne['mdp'] == $_POST['mdp']) {
                            echo 'Connexion Réussie';
                            header('Location: accueil.html');
                        }

                        else {
                            echo 'Connexion impossible <br>';
                            echo 'Essayez une autre mot de passe <br>';
                            echo "Revenir à la page <a href='inscription.php'>d'inscription</a>";

                        }
                        
                        $id_connex = null;
                    }

                    else {
                        echo "Il manque des informations";
                    }
                }

                

            ?>

    

    </form>


</body>
</html>