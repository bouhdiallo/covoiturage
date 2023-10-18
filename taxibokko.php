<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'taxibokko';

//on etablie la connexion
$conn = new PDO ("mysql:host=$servername;dbname=$database", $username,$password);

//on verifie si les chapms sont definis
if(isset($_POST['sinscrire'])){

    $nom = $_POST['nom'];
    $prenom =  $_POST['prenom'];
    $telephone =  $_POST['telephone'];
    $email =  $_POST['email'];
    $mot_de_pass =  $_POST['mot_de_pass'];


//on fait une insertion 
$sql = ("INSERT INTO `inscription`(`nom`, `prenom`, `telephone`, `email`, `mot_de_pass`) VALUES (:nom,:prenom,:telephone,:email,:mot_de_pass)");
// on cree une requete preparée
 $a = $conn ->prepare($sql);
//on lie les marqueurs avec des valeuurs 
 $a-> bindParam(':nom',$nom);
 $a-> bindParam(':prenom',$prenom);
 $a-> bindParam(':telephone',$telephone);
 $a-> bindParam(':email',$email);
 $a-> bindParam(':mot_de_pass',$mot_de_pass);
 //on execute la requete
 $a->execute();

};




if(isset($_POST['connexion'])){
    $mail = $_POST['email'];
    $mot_de_pass =  $_POST['mot_de_pass'];


   $sql2 = ("SELECT  `email`, `mot_de_pass` FROM `inscription` WHERE email = :email AND mot_de_pass = :mot_de_pass");

   $b = $conn->prepare($sql2);

   $b->bindParam(':email',$mail);
   $b->bindParam(':mot_de_pass',$mot_de_pass);
   $b->execute();

   $resultat=$b->fetch(PDO::FETCH_ASSOC);
  
   if($resultat) {
    echo "ce compte existe";
    header('location:acceuil.php');
   } else {
    echo "ce compte n'existe pas";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
        <form method="post" action="">
            <div id="general">
            <div id="etape1">
                <h1>Connexion</h1>
                <p>Votre chauffeur en un clic!</p>

                <button id="button">Continuer avec facebook</button><br><br>
                
                <div class="hr"><p>ou</p></div>
                
                <label for="email">email</label><br>
                <input type="text" placeholder="mara@gmail.com" id="mail" name="email"><br><br>
                <label for="psw">Mot de pass</label><br>
                <input type="text" placeholder="********" id="mtp" name="mot_de_pass"><br><br><br><br>

              <a href="">j'ai deja un compte</a>
              <input type="submit" class="inscription" name= "connexion" value="connexion">
            </div>
            </form>

            <form method="post" action="">

            <div id="etape2">
                <h1>Inscription</h1>
                <p>Finaliser votre inscription en renseignants les informations manquantes</p><br><br>
                
                <label for="prenom">Prenom</label>
                <input type="text" placeholder="mara" name="prenom">
                <label for="nom">Nom</label>
                <input type="text" placeholder="fall" name="nom"><br><br>
                <label for="numero">Telephone</label><br><br>
                <span>sénégal  +221</span>
                <input type="number" placeholder="77 000 00 00" id="phone" name = "telephone"><br><br><br>
                <label for="email">Email</label>
                <input type="text" placeholder="mara10@gmail.com" class="email" name = "email"><br><br><br>
                <label for="psw">Mot de pass</label><br>
                <input type="text" placeholder="********" id="mtp" name = "mot_de_pass"><br><br>
                <label for="psw">Confirmmer mot de pass</label><br>
                <input type="text" placeholder="********" id="mtp" name = "mot_de_pass">

            <p><img src="images/delete_forever_FILL0_wght400_GRAD0_opsz24.png" alt="icons"> <a href="#">Ajouter un code promo</a></p>
            
            <input type="submit" class="inscription" name= "sinscrire" value="sinscrire">
            </div>
          </div>
        </form>
</body>
</html>