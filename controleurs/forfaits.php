<?php

require_once './modeles/forfaits.php';

class ControleurForfait {

    /***
     * Fonction permettant de récupérer l'ensemble des forfaits et de les afficher au format JSON
     */
    function afficherJSON() {
        $resultat = modele_forfait::ObtenirTous();
        echo json_encode($resultat);
    }
    
    /***
     * Fonction permettant de récupérer un des forfaits et de les afficher au format JSON
     */
    function afficherFicheJSON($id) {
        $resultat = modele_forfait::ObtenirUn($id);
        echo json_encode($resultat);
    }

    /***
     * Fonction permettant d'ajouter un forfait reçu au format JSON
     */
    function ajouterJSON($data) {
        $resultat = new stdClass();

        if( isset($data['nom']) 
            && isset($data['description']) 
            && isset($data['code']) 
            && isset($data['statut']) 
            && isset($data['etablissement']['nom']) 
            && isset($data['etablissement']['description']) 
            && isset($data['etablissement']['coordonnees']['adresse']) 
            && isset($data['etablissement']['coordonnees']['ville']) 
            && isset($data['etablissement']['coordonnees']['telephone']) 
            && isset($data['etablissement']['coordonnees']['courriel']) 
            && isset($data['etablissement']['coordonnees']['siteWeb']) 
            && isset($data['dateDeDebut']) && isset($data['dateDeFin']) 
            && isset($data['prix']) && isset($data['nouveauPrix'])) {
            $resultat = modele_forfait::ajouter('', 
                $data['nom'], 
                $data['description'], 
                $data['code'], 
                $data['statut'], 
                $data['etablissement']['nom'],
                $data['etablissement']['description'], 
                $data['etablissement']['coordonnees']['adresse'], 
                $data['etablissement']['coordonnees']['ville'], 
                $data['etablissement']['coordonnees']['telephone'], 
                $data['etablissement']['coordonnees']['courriel'], 
                $data['etablissement']['coordonnees']['siteWeb'], 
                $data['dateDeDebut'], $data['dateDeFin'], $data['prix'], 
                $data['nouveauPrix']);
        } else {
            http_response_code(500); // Envoi un code 500 au serimage
            $resultat->message = "Impossible d'ajouter un produit. Des informations sont manquantes";
        }
        echo json_encode($resultat);
    }

    /***
     * Fonction permettant de modifier un forfait reçu au format JSON
     */
    function modifierJSON($data) {
        $resultat = new stdClass();
        if(isset($_GET['id'])) {
            if(isset($data['image']) 
            && isset($data['nom']) 
            && isset($data['description']) 
            && isset($data['code']) 
            && isset($data['statut']) 
            && isset($data['etablissement']['nom']) 
            && isset($data['etablissement']['description']) 
            && isset($data['etablissement']['coordonnees']['adresse']) 
            && isset($data['etablissement']['coordonnees']['ville']) 
            && isset($data['etablissement']['coordonnees']['telephone']) 
            && isset($data['etablissement']['coordonnees']['courriel']) 
            && isset($data['etablissement']['coordonnees']['siteWeb']) 
            && isset($data['dateDeDebut']) 
            && isset($data['dateDeFin']) 
            && isset($data['prix']) 
            && isset($data['nouveauPrix'])) {
                $resultat = modele_forfait::modifier($_GET['id'], 
                $data['image'], 
                $data['nom'], 
                $data['description'], 
                $data['code'], 
                $data['statut'], 
                $data['etablissement']['nom'],
                $data['etablissement']['description'], 
                $data['etablissement']['coordonnees']['adresse'], 
                $data['etablissement']['coordonnees']['ville'], 
                $data['etablissement']['coordonnees']['telephone'], 
                $data['etablissement']['coordonnees']['courriel'], 
                $data['etablissement']['coordonnees']['siteWeb'], 
                $data['dateDeDebut'], 
                $data['dateDeFin'], 
                $data['prix'], 
                $data['nouveauPrix']);
            } else {
                http_response_code(500); // Envoi un code 500 au serveur
                $resultat = "Impossible de modifier le forfait. Des informations sont manquantes";
            }
            
        } else {
            http_response_code(500); // Envoi un code 500 au serveur
            $resultat->message = "ID manquant";
        }  
        echo json_encode($resultat);     
    }
    
/***
     * Fonction permettant de modifier un forfait reçu au format JSON
     */
    function supprimerJSON() {
        $resultat = new stdClass();
        if(isset($_GET['id'])) {
            $resultat = modele_forfait::supprimer($_GET['id']);
        } else {
            http_response_code(500); // Envoi un code 500 au serveur
            $resultat->message = "ID manquant";
        }  
        echo json_encode($resultat);
    }
}

?>