<?php
//require('ListeClients.php');

// Classe pour gérer l'inscription
class Inscription {
//propriete pour inscription
private $nom;
private $prenom;
private $phone;
private $mail;
private $mtp;

//constructeur
public function __construct($monNom,$monPrenom,$numeroPhone,$email,$monMtp) {
    
        $this->nom = $monNom;
        $this->prenom = $monPrenom;
        $this->phone = $numeroPhone;
        $this->mail = $email;
        $this->mtp = $monMtp;
    }

    public function getNom(){
        return $this->nom;
    }
    
    public function setNom($nouveauNom){
        if (is_string($nouveauNom)) {
            $this->nom = $nouveauNom;
        }else {
            throw new exception("le nom doit etre une chaine de caractere");
        }
    }
    
    public function getPrenom(){
        return $this->prenom;
    }
    
    public function setPrenom($nouveauPrenom){
        if (is_string($nouveauPrenom)) {
            $this->prenom = $nouveauPrenom;
        }else {
            throw new exception("le prenom doit etre une chaine de caractere");
        }
    }

    public function getPhone(){
        return $this->phone;
    }
    
    public function setPhone($nouveauPhone){
        if (is_numeric($nouveauPhone)) {
            $this->phone = $nouveauPhone;
        }else {
            throw new exception("le numero doit etre numerique");
        }
    }

    public function getMail(){
        return $this->mail;
    }
    
    public function setMail($nouveauMail){
        if (is_string($nouveauMail)) {
            $this->nom = $nouveauMail;
        }else {
            throw new exception("l'email doit etre une chaine de caractere");
        }
    }

    public function getMtp(){
        return $this->mtp;
    }
    
    public function setMtp($nouveauMtp){
        if (is_string($nouveauMtp)) {
            $this->mtp = $nouveauMtp;
        }else {
            throw new exception("le mtp doit etre une chaine de caractere");
        }
    }
    
    // Méthode pour soumettre le formulaire d'inscription
    public function inscriptionUsers() {
        if (isset($_POST['sinscrire'])) {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $telephone = $_POST['telephone'];
            $email = $_POST['email'];
            $mot_de_pass = $_POST['mot_de_pass'];
            $retaper = $_POST['retaper'];
            
            // vérifier que les champs ne sont pas vides et que les mots de passe correspondent
            if (!empty($prenom) && !empty($nom) && !empty($telephone) && !empty($email) && !empty($mot_de_pass) && $mot_de_pass == $retaper) {
                // Connexion a la base de données.
                $bdd = new PDO('mysql:host=localhost;dbname=taxibokko', 'root', '');
                // Inséreons les données dans la table "connexion". 
                // [$prenom, $nom, $telephone, $email, $mot_de_pass] est un tableau contenant les valeurs à insérer dans la requête préparée. 
                //Ces valeurs remplacent les ? dans la requête préparée.  
                $stmt = $bdd->prepare("INSERT INTO inscription (prenom, nom, telephone, email, mot_de_pass) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$prenom, $nom, $telephone, $email, $mot_de_pass]);
                
                echo "l'inscription a reussi";
            } else {
                echo "veuillez remplir tous les champs et verifier si les mots de pass sont bien identiques";

            }
        }
    }
        }
      //création instance de la classe Inscription
        $inscription = new Inscription("","","","","");
        $inscription->inscriptionUsers();



/*
    // Classe pour gérer la connexion
          class Connexion {
            //propriete
           public $email;
           public $motpass;

           public function __construct($monEmail,$monMotpass) {
        $this->email =$monEmail ;
        $this->motpass =$monMotpass ;
    }
    // Méthode pour soumettre le formulaire de connexion
    public function connexionUsers() {
        if(isset($_POST['connexion'])){
            $adressMail = $_POST['email'];
            $motdepass = $_POST['mot_de_pass'];
            // on verifie si le champs adressemail et motdepas ne sont pas vides
             if(!empty($adressMail) && !empty($motdepass)){
                 // Connexion à la base de données
                 $bdd = new PDO('mysql:host=localhost;dbname=taxibokko', 'root', '');

                 $stmt1 = $bdd->prepare("SELECT * FROM inscription");
                  $stmt1->execute();
                 // Redirigez l'utilisateur vers la page listeClients.php
                  header('location:listeClients.php'); 
              } else {  
                echo "veuillez remplir tous les champs";
                } 
            }
        }
    }

       //création d'une instance de la classe Connexion
         $connexion = new Connexion("","");
      // Appelez la méthode pour afficher la liste des connectes
         $connexion->connexionUsers();
*/
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