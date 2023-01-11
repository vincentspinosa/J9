<?php

// Pour uploader un fichier
function upload_file() {
    // On crée une variable globale accessible en dehors de la fonction
    global $fichierCible;
    // On spécifie notre répertoire cible
    $repertoireCible = 'img/';
    // On spécifie le nom du fichier à créer
    // Basename retourne la composante finale d'un chemin, ici le fichier à uploader
    $fichierCible = $repertoireCible . basename($_FILES["photo"]["name"]);
    // On regarde si le fichier existe déjà
    if (file_exists($fichierCible)) {
        return false;
    }
    // On regarde si le fichier n'est pas trop gros
    if ($_FILES["photo"]["size"] > 50000) {
        return false;
    }
    // On regarde si le fichier est d'un type accepté
    $imageFileType = strtolower(pathinfo($fichierCible, PATHINFO_EXTENSION));
    if($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg") {
        return false;
    }
    // On a passé les tests, on upload le fichier
    // Pour les utilisateurs de Mac, vérifier qu'on a bien le droit d'écrire dans le répertoire cible
        // Dans le terminal :
            // Vérifier qu'on est dans le bon dossier
            // ls -l affiche les droits
            // si on a pas tous les doits, chmod -R 777 nom_du_dossier donne tous les droits sur un dossier et tous ses éléments
    $upload = move_uploaded_file($_FILES["photo"]["tmp_name"], $fichierCible);
    // Si l'upload a réussi, on return true, sinon on return false
    if ($upload === true) {
        return true;
    } else {
        return false;
    }
}

/* Dans le traitement d'un formulaire */

$upload = upload_file();
if ($upload === true) {
    // L'upload a fonctionné, on continue le traitement
} else {
    // L'upload a échoué
}

/* Dans le traitement d'un formulaire de modification */

// unlink(fichier à supprimer)
// Uploadez le fichier

?>