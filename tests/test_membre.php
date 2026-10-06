<?php

$membre = new Membre(1, 'Sara');
verifier($membre->getId() === 1 && $membre->getNom() === 'Sara', 'Membre : id et nom corrects');
verifier(count($membre->getEmprunts()) === 0, 'Membre : aucun emprunt au départ');

$livreM1 = new Livre('9782100545261', 'Algo', 'Cormen');
$membre->emprunter($livreM1);
verifier(count($membre->getEmprunts()) === 1, 'Membre : un emprunt enregistré');
verifier(!$livreM1->estDisponible(), 'Membre : le livre emprunté est indisponible');

$membre->rendre($livreM1);
verifier(count($membre->getEmprunts()) === 0, 'Membre : emprunt supprimé après retour');
verifier($livreM1->estDisponible(), 'Membre : le livre rendu est disponible');

// Limite de 3 livres
$membre2 = new Membre(2, 'Omar');
foreach (['1111111111', '2222222222', '3333333333'] as $isbn) {
    $membre2->emprunter(new Livre($isbn, "Livre $isbn", 'Auteur'));
}
$leve = false;
try {
    $membre2->emprunter(new Livre('4444444444', 'Quatrième', 'Auteur'));
} catch (Exception $e) {
    $leve = true;
}
verifier($leve, 'Membre : exception au 4e emprunt');

// Rendre un livre non emprunté
$leve = false;
try {
    $membre->rendre(new Livre('5555555555', 'Jamais emprunté', 'Auteur'));
} catch (Exception $e) {
    $leve = true;
}
verifier($leve, 'Membre : exception si on rend un livre non emprunté');