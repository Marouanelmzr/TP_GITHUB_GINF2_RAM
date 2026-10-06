<?php

// Test 1: Création et état initial
$livre = new Livre('9782100545261', 'Algo', 'Cormen');
verifier($livre->estDisponible(), 'Un nouveau livre est disponible');
verifier($livre->getIsbn() === '9782100545261', 'Le getter getIsbn() retourne la bonne valeur');
verifier($livre->getTitre() === 'Algo', 'Le getter getTitre() retourne la bonne valeur');

// Test 2: Emprunt classique
$livre->emprunter();
verifier(!$livre->estDisponible(), 'Après emprunt, le livre est indisponible');

// Test 3: Exception si déjà emprunté
try {
    $livre->emprunter();
    $exceptionEmprunt = false;
} catch (Exception $e) {
    $exceptionEmprunt = true;
}
verifier($exceptionEmprunt, 'Emprunter un livre déjà emprunté lève une Exception');

// Test 4: Retour classique
$livre->rendre();
verifier($livre->estDisponible(), 'Après retour, le livre est de nouveau disponible');

// Test 5: Exception si déjà disponible
try {
    $livre->rendre();
    $exceptionRetour = false;
} catch (Exception $e) {
    $exceptionRetour = true;
}
verifier($exceptionRetour, 'Rendre un livre déjà disponible lève une Exception');

// Test 6: Exception sur un ISBN invalide
try {
    $livreInvalide = new Livre('123', 'Titre Invalide', 'Auteur');
    $exceptionIsbn = false;
} catch (InvalidArgumentException $e) {
    $exceptionIsbn = true;
}
verifier($exceptionIsbn, 'Un ISBN de mauvaise longueur lève une InvalidArgumentException');

// Test 7: Méthode __toString
$attendu = "Algo par Cormen (ISBN: 9782100545261) - Disponible";
verifier((string)$livre === $attendu, 'La méthode __toString formate correctement la chaîne');