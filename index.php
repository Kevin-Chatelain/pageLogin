<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="info">
                <h1>Page d'inscription</h1>
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
                <input type="submit" value="S'inscrire" name="inscr">
                <a href="login.php">Connexion</a>
            </div>



            <?php 

                if (isset($_POST["inscr"])) {
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

                        $id_connex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $reponse = $id_connex->query("SELECT id FROM client WHERE id = '$nom'");

                        $ligne = $reponse->fetch(PDO::FETCH_ASSOC);

                        if ($ligne == false) {

                            try {
                                $requete = "INSERT INTO client(id, mdp) VALUES('$nom', '$mdp')";
                                $id_connex->exec($requete);
                                echo "Utilisateur ajouté avec succès !";
                            }
    
                            catch (PDOException $e) {
                                die('Erreur : '.$e->getMessage());
                            }
    
                            $id_connex = null;
    
                            header('Location: login.php');
                        }

                        else {
                            echo "Ce nom d'utilisateur est déjà utilisé";
                        }

                    }

                    else {
                        echo "Il manque des informations";
                    }
                }

                            
            ?>
    </form>

</body>
</html>