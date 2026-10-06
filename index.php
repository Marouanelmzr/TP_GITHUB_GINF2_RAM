<?php
require __DIR__ . '/autoload.php';

$biblio = new Bibliotheque();
$membres = []; // nom => Membre

function saisir(string $invite): string
{
    echo $invite;
    $ligne = fgets(STDIN);
    return $ligne === false ? '' : trim($ligne);
}

function obtenirMembre(array &$membres, string $nom): Membre
{
    if (!isset($membres[$nom])) {
        $membres[$nom] = new Membre(count($membres) + 1, $nom);
    }
    return $membres[$nom];
}

function afficher(array $livres): void
{
    if (count($livres) === 0) {
        echo "Aucun livre.\n";
        return;
    }
    foreach ($livres as $l) {
        echo " - $l\n";
    }
}

while (true) {
    echo "\n=== BIBLIO ===\n";
    echo "1 Ajouter  2 Lister  3 Rechercher  4 Emprunter  5 Rendre  0 Quitter\n";
    $choix = saisir("Votre choix : ");

    try {
        switch ($choix) {
            case '1':
                $isbn = saisir("ISBN (10 ou 13 chiffres) : ");
                $titre = saisir("Titre : ");
                $auteur = saisir("Auteur : ");
                $biblio->ajouter(new Livre($isbn, $titre, $auteur));
                echo "Livre ajouté.\n";
                break;
            case '2':
                echo $biblio->compter() . " livre(s) :\n";
                afficher($biblio->tous());
                break;
            case '3':
                afficher($biblio->rechercher(saisir("Mot-clé : ")));
                break;
            case '4':
            case '5':
                $membre = obtenirMembre($membres, saisir("Nom du membre : "));
                $livre = $biblio->trouver(saisir("ISBN du livre : "));
                if ($livre === null) {
                    echo "Livre introuvable.\n";
                    break;
                }
                if ($choix === '4') {
                    $membre->emprunter($livre);
                    echo "Emprunt enregistré.\n";
                } else {
                    $membre->rendre($livre);
                    echo "Retour enregistré.\n";
                }
                break;
            case '0':
                echo "Au revoir.\n";
                exit(0);
            default:
                echo "Choix invalide.\n";
        }
    } catch (Exception $e) { // couvre aussi InvalidArgumentException
        echo "Erreur : " . $e->getMessage() . "\n";
    }
}