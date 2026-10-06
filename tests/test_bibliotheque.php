<?php

require_once __DIR__ . '/../src/Livre.php';
require_once __DIR__ . '/../src/Bibliotheque.php';

// Test 1: Ajouter des livres
$bibliotheque = new Bibliotheque();

$livre1 = new Livre('9782100545261', 'Algo', 'Cormen');
$livre2 = new Livre('9782212673420', 'PHP', 'Martin');

$bibliotheque->ajouter($livre1);
$bibliotheque->ajouter($livre2);

verifier($bibliotheque->compter() === 2, 'La bibliothèque contient 2 livres');

// Test 2: Trouver un livre
$livreTrouve = $bibliotheque->trouver('9782100545261');

verifier($livreTrouve === $livre1, 'Trouver un livre par son ISBN fonctionne');

// Test 3: ISBN inexistant
$livreInexistant = $bibliotheque->trouver('1234567890');

verifier($livreInexistant === null, 'Un ISBN inexistant retourne null');

// Test 4: Récupérer tous les livres
$tous = $bibliotheque->tous();

verifier(count($tous) === 2, 'La méthode tous() retourne tous les livres');

// Test 5: Exception si ISBN déjà existant
try {
    $livreDoublon = new Livre('9782100545261', 'Autre livre', 'Auteur');
    $bibliotheque->ajouter($livreDoublon);
    $exceptionDoublon = false;
} catch (Exception $e) {
    $exceptionDoublon = true;
}

verifier($exceptionDoublon, 'Ajouter un livre avec un ISBN existant lève une Exception');

// Test 6: Recherche dans le titre
$resultats = $bibliotheque->rechercher('algo');

verifier(count($resultats) === 1 && $resultats[0] === $livre1, 'La recherche fonctionne dans le titre');

// Test 7: Recherche dans l'auteur
$resultats = $bibliotheque->rechercher('CORMEN');

verifier(count($resultats) === 1 && $resultats[0] === $livre1, 'La recherche fonctionne dans l\'auteur sans tenir compte de la casse');

// Test 8: Recherche sans résultat
$resultats = $bibliotheque->rechercher('Java');

verifier(count($resultats) === 0, 'Une recherche sans résultat retourne un tableau vide');