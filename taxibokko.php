<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'taxibokko';

//on etablie la connexion
$conn = new PDO ("mysql:host=$servername;dbname=$database", $username,$password);

//on verifie si les champs sont definis
if(isset($_POST['sinscrire'])){
    $nom = $_POST['nom'];
    $prenom =  $_POST['prenom'];
    $telephone =  $_POST['telephone'];
    $email =  $_POST['email'];
    $mot_de_pass =  $_POST['mot_de_pass'];

$sql = ("INSERT INTO `inscription`(`nom`, `prenom`, `telephone`, `email`, `mot_de_pass`) VALUES (:nom,:prenom,:telephone,:email,:mot_de_pass)");
// on prepare la requete sql
 $a = $conn ->prepare($sql);
//on lie les espaces reservés a l'aide des marqeurs avec des valeuurs 
 $a-> bindParam(':nom',$nom);
 $a-> bindParam(':prenom',$prenom);
 $a-> bindParam(':telephone',$telephone);
 $a-> bindParam(':email',$email);
 $a-> bindParam(':mot_de_pass',$mot_de_pass);
 //on execute la requete
 $a->execute();
};

//on verifie si les champs sont definis
if(isset($_POST['connexion'])){
    $mail = $_POST['email'];
    $mot_de_pass =  $_POST['mot_de_pass'];

   $sql2 = ("SELECT  `email`, `mot_de_pass` FROM `inscription` WHERE email = :email AND mot_de_pass = :mot_de_pass");
// on prepare la requete sql
   $b = $conn->prepare($sql2);
//on lie les espaces reservés a l'aide des marqeurs avec des valeuurs 
   $b->bindParam(':email',$mail);
   $b->bindParam(':mot_de_pass',$mot_de_pass);
    //on execute la requete
   $b->execute();

   //on recupere les resultats 
   $resultat=$b->fetch(PDO::FETCH_ASSOC); 
  
   if($resultat) {
    echo "ce compte existe";
    header('location:acceuil.php');
   } else {
    echo "ce compte n'existe pas";
   }
}
?>

<?php

/*
// Vérifier que tous les champs sont remplis
if (empty($nom) || empty($prenom) || empty($telephone) || empty($email) || empty($mot_de_pass)) {
    echo "Tous les champs doivent être remplis.";
} else {
    // Vérifier que le nom et le prénom contiennent que des lettres et ne dépassent pas 10 caractères
    if (ctype_alpha($nom) && ctype_alpha($prenom) && strlen($nom) <= 10 && strlen($prenom) <= 10) {
        // Vérifier que le numéro de téléphone ne dépasse pas 9 chiffres et commence par "7"
        if (is_numeric($telephone) && strlen($telephone) <= 9 && substr($telephone, 0, 1) == "7"){ 

        } 

// Vérifiez que les noms et prénoms ne contiennent que du texte
if (ctype_alpha($nom) && ctype_alpha($prenom)) {
    echo "<br>" ;
}else{ 
    echo "Les noms et prénoms ne doivent contenir que des lettres.";
}
    // Vérifiez que les noms et prénoms ne dépassent pas 10 caractères
    if (strlen($nom) > 10 && strlen($prenom) > 10) {
        echo "Les noms et prénoms ne doivent pas dépasser 10 caractères chacun.";
    }
        //verifer que le numero est numerique
 if(is_numeric($telephone) && substr($telephone, 0, 1) == "7"){ 
    echo "le numero de telephone est valide";
 } else {
    echo "le numero de telephone doit etre numerique et doit imperativement commencer par un '7'";
 }

} 
if(empty($nom)|| empty($prenom)|| empty($telephone)|| empty($email)|| empty($mot_de_pass)){
    echo "tous les champs sont obliagtoires";
} else{ 

}*/

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
                <input type="text" placeholder="********" id="mtp" name = "retaper">

            <p><img src="images/delete_forever_FILL0_wght400_GRAD0_opsz24.png" alt="icons"> <a href="#">Ajouter un code promo</a></p>
            
            <input type="submit" class="inscription" name= "sinscrire" value="sinscrire">
            </div>
          </div>
        </form>
</body>
</html>