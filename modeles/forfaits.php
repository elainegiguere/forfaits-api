<?php

include_once "./include/config.php";


class modele_etablissement {
    public $nom;
    public $description;
    public $coordonnees;

    public function __construct($nom, $description, $adresse, $ville, $telephone, $courriel, $site_web) {
        $this->nom = $nom;
        $this->description = $description;

        $this->coordonnees = new modele_coordonnees($adresse, $ville, $telephone, $courriel, $site_web);
        
    }
}

class modele_coordonnees {
    public $adresse;
    public $ville;
    public $telephone;
    public $courriel;
    public $siteWeb;

    public function __construct($adresse, $ville, $telephone, $courriel, $site_web) {
       $this->adresse = $adresse;
       $this->ville = $ville;
       $this->telephone = $telephone;
       $this->courriel = $courriel;
       $this->siteWeb = $site_web;
        // ...
    }
}

class modele_forfait {
    public $id;
    public $image;
    public $nom; 
    public $description;
    public $code;
    public $statut;
    public $etablissement;

    public $dateDeDebut;
    public $dateDefin;
    public $prix;
    public $nouveauPrix;

    public function __construct($id, $image, $nom, $description, $code, $statut,$nom_etablissement,$adresse, $ville, $telephone, $courriel, $site_web, $description_etablissement, $date_debut, $date_fin, $prix, $nouveau_prix) {
        $this->id = $id;
        $this->image = $image;
        $this->nom = $nom;
        $this->description = $description;
        $this->code = $code;
        $this->statut = $statut;
        $this->etablissement = new modele_etablissement($nom_etablissement, $description_etablissement, $adresse, $ville, $telephone, $courriel, $site_web);
        /*$this->nom_etablissement = $nom_etablissement;
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->telephone = $telephone;
        $this->courriel = $courriel;
        $this->site_web = $site_web;
        $this->description_etablissement = $description_etablissement;*/
        $this->dateDeDebut = $date_debut;
        $this->dateDeFin = $date_fin;
        $this->prix = $prix;
        $this->nouveauPrix = $nouveau_prix;
    }

    

    static function connecter() {
        
        $mysqli = new mysqli(Db::$host, Db::$username, Db::$password, Db::$database);

       // Vérifier la connexion
       if ($mysqli -> connect_errno) {
        http_response_code(500); // Envoi un code 500 au serveur
        $erreur = new stdClass();
        $erreur->message = "DEBOGAGE : Échec de connexion à la base de données MySQL: ";
        $erreur->error = $mysqli -> connect_error;
        echo json_encode($erreur);
        exit();
    } 


        return $mysqli;
    }


  // Fonction pour obtenir tout les forfaits

    public static function ObtenirTous() {
        $liste = [];
        $mysqli = self::connecter();

        $resultatRequete = $mysqli->query("SELECT * FROM forfaits ORDER BY id;");

        foreach ($resultatRequete as $enregistrement) {
            $liste[] = new modele_forfait($enregistrement['id'], $enregistrement['image'], $enregistrement['nom'], $enregistrement['description'], $enregistrement['code'], $enregistrement['statut'],$enregistrement['nom_etablissement'], $enregistrement['adresse'], $enregistrement['ville'], $enregistrement['telephone'], $enregistrement['courriel'], $enregistrement['site_web'], $enregistrement['description_etablissement'], $enregistrement['date_debut'], $enregistrement['date_fin'], $enregistrement['prix'], $enregistrement['nouveau_prix'] );
        }

        return $liste;
    }

 
    /***
     * Fonction permettant de récupérer un forfait en fonction de son identifiant
     */
    public static function ObtenirUn($id) {
        $resultat = new stdClass();

        $mysqli = self::connecter();

        if ($requete = $mysqli->prepare("SELECT * FROM forfaits WHERE id=?")) {  // Création d'une requête préparée 
            $requete->bind_param("s", $id); // Envoi des paramètres à la requête

            $requete->execute(); // Exécution de la requête

            $resultat_requete= $requete->get_result(); // Récupération de résultats de la requête¸
            
            if($enregistrement = $resultat_requete->fetch_assoc()) { // Récupération de l'enregistrement
                $forfait = new modele_forfait($enregistrement['id'], $enregistrement['image'], $enregistrement['nom'], $enregistrement['description'], $enregistrement['code'], $enregistrement['statut'], $enregistrement['nom_etablissement'], $enregistrement['adresse'], $enregistrement['ville'], $enregistrement['telephone'], $enregistrement['courriel'], $enregistrement['site_web'], $enregistrement['description_etablissement'], $enregistrement['date_debut'], $enregistrement['date_fin'], $enregistrement['prix'], $enregistrement['nouveau_prix'] );
            } else {
                http_response_code(404); // Envoi un code 404 au serveur
                $resultat->message = "Erreur: Aucun produit trouvé";

                return $resultat;
            }   
            
            $requete->close(); // Fermeture du traitement 
            return $forfait;
        } else {
            http_response_code(500); // Envoi un code 500 au serveur
            $resultat->message = "Une erreur a été détectée dans la requête utilisée : ";
            $resultat->erreur = $mysqli->error;
            return $resultat;
        }

    }



/* POST Fonction permettant d'ajouter un forfait*/


   public static function ajouter( $image, $nom, $description, $code, $statut, $nom_etablissement, $adresse, $ville, $telephone, $courriel, $site_web, $description_etablissement, $date_debut, $date_fin, $prix, $nouveau_prix) {
    $resultat = new stdClass();

    $mysqli = self::connecter();
    
    // Création d'une requête préparée
    if ($requete = $mysqli->prepare("INSERT INTO forfaits( image, nom, description, code, statut, 
        nom_etablissement, description_etablissement, adresse, ville, telephone, courriel, site_web, 
        date_debut, date_fin, prix, nouveau_prix) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {      

    /************************* ATTENTION **************************/
    /* On ne fait présentement peu de validation des données.     */
    /* On revient sur cette partie dans les prochaines semaines!! */
    /**************************************************************/

    $requete->bind_param("sssissssssssssii", $image, $nom, $description, $code, $statut, $nom_etablissement, $adresse, $ville, $telephone, $courriel, $site_web, $description_etablissement, $date_debut, $date_fin, $prix, $nouveau_prix);

    if($requete->execute()) { // Exécution de la requête
        $resultat->message  = "Forfait ajouté";  // Message ajouté dans la page en cas d'ajout réussi
    } else {
        http_response_code(500); // Envoi un code 500 au serveur
        $resultat->message =  "Une erreur est survenue lors de l'ajout";  // Message ajouté dans la page en cas d’échec
        $resultat->erreur = $requete->error;    }

    $requete->close(); // Fermeture du traitement

    } else  {
        http_response_code(500); // Envoi un code 500 au serveur
            $resultat->message = "Une erreur a été détectée dans la requête utilisée : ";
            $resultat->erreur = $mysqli->error;
    }

    return $resultat;
}



  /***
     * Fonction permettant de modifier un forfait
     */
    public static function modifier($id, $image, $nom, $description, $code, $statut, $nom_etablissement, $description_etablissement, $adresse, $ville, $telephone, 
        $courriel, $site_web, $date_debut, $date_fin, $prix, $nouveau_prix) {

        $resultat = new stdClass();

        $mysqli = self::connecter();
        
        // Création d'une requête préparée
        if ($requete = $mysqli->prepare("UPDATE forfaits SET image=?, nom=?, description=?, code=?, statut=? ,nom_etablissement=?, description_etablissement=?, adresse=?, ville=?, telephone=?, 
            courriel=?, site_web=?, date_debut=?, date_fin=?, prix=?, nouveau_prix=? WHERE id=?")) {      

        /************************* ATTENTION **************************/
        /* On ne fait présentement peu de validation des données.     */
        /* On revient sur cette partie dans les prochaines semaines!! */
        /**************************************************************/

        $requete->bind_param("sssissssssssssiii", $image, $nom, $description, $code, $statut, $nom_etablissement, $description_etablissement, $adresse, $ville, $telephone, 
            $courriel, $site_web, $date_debut, $date_fin, $prix, $nouveau_prix, $id);

        if($requete->execute()) { // Exécution de la requête
            $resultat->message = "Forfait modifié";  // Message ajouté dans la page en cas d'ajout réussi
        } else {
            http_response_code(500); // Envoi un code 500 au serveur
            $resultat->message =  "Une erreur est survenue lors de l'édition: ";  // Message ajouté dans la page en cas d’échec
            $resultat->erreur = $requete->error;        }

        $requete->close(); // Fermeture du traitement

        } else  {
            http_response_code(500); // Envoi un code 500 au serveur
            $resultat->message = "Une erreur a été détectée dans la requête utilisée : ";
            $resultat->erreur = $mysqli->error;
        }

        return $resultat;
    }


  /***
     * Fonction permettant de supprimer un forfait
     */

    
    public static function supprimer($id) {
        $resultat = new stdClass();

        $mysqli = self::connecter();
        
        // Création d'une requête préparée
        if ($requete = $mysqli->prepare("DELETE FROM forfaits WHERE id=?")) {      

        /************************* ATTENTION **************************/
        /* On ne fait présentement peu de validation des données.     */
        /* On revient sur cette partie dans les prochaines semaines!! */
        /**************************************************************/

        $requete->bind_param("i", $id);

        if($requete->execute()) { // Exécution de la requête
            $resultat->message = "Forfait supprimé";  // Message ajouté dans la page en cas d'ajout réussi
        } else {
            http_response_code(500); // Envoi un code 500 au serveur
            $resultat->message = "Une erreur est survenue lors de la suppression: ";  // Message ajouté dans la page en cas d’échec
            $resultat->erreur = $requete->error;        
        }

        $requete->close(); // Fermeture du traitement

        } else  {
            http_response_code(500); // Envoi un code 500 au serveur
            $resultat->message = "Une erreur a été détectée dans la requête utilisée : ";
            $resultat->erreur = $mysqli->error;

        }

        return $resultat;
    }


}
?>