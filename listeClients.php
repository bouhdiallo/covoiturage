<?php
// ListeClients.php
//require('taxibokko.php');

class ListeClients {
    // Propriétés si nécessaires
    public $nom;
    public $prenom;

//constructeur
    public function __construct($leNom,$lePrenom) {
        $this->nom = $leNom;
        $this->prenom = $lePrenom;
    }
// Méthode pour afficher la liste des clients
      public function afficherListeClients() {
                // Connexion à la base de données (utilisez vos informations de connexion)
                $bdd = new PDO('mysql:host=localhost;dbname=taxibokko', 'root', '');
                // Requête SQL pour récupérer les informations des clients
                $sql = "SELECT nom, prenom FROM inscription";
                // Exécutez la requête.
              //j'utilise query pour exécuter des requêtes SQL qui retournent des résultats
                $stmt = $bdd->query($sql);
                // Récupérez tous les résultats dans un tableau associatif
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Vérifiez s'il y a des clients à afficher
                    if (count($clients) > 0) {
                        echo "<h1>Liste des clients :</h1>";
                        echo "<ul>";
                        // Utilisez une boucle foreach pour parcourir les clients
                        foreach ($clients as $client) {
                            echo "<li>{$client['prenom']} {$client['nom']}</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "Aucun client trouvé.";
                    }
                  }
               }
      //création une instance de la classe listeClients.
      $listeClients = new listeClients("","");
      // Appelez la méthode pour afficher la liste des clients
      $listeClients->afficherListeClients();

?>



   




