<?php

class Livre
{
    private string $isbn;
    private string $titre;
    private string $auteur;
    private bool $disponible;

    public function __construct(string $isbn, string $titre, string $auteur)
    {
        // Nettoyage éventuel des tirets pour compter uniquement les caractères de l'ISBN
        $isbnPropre = str_replace(['-', ' '], '', $isbn);
        
        if (strlen($isbnPropre) !== 10 && strlen($isbnPropre) !== 13) {
            throw new InvalidArgumentException("L'ISBN doit contenir exactement 10 ou 13 chiffres.");
        }

        $this->isbn = $isbn;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->disponible = true; // Un livre est disponible par défaut lors de sa création
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getAuteur(): string
    {
        return $this->auteur;
    }

    public function estDisponible(): bool
    {
        return $this->disponible;
    }

    public function emprunter(): void
    {
        if (!$this->disponible) {
            throw new Exception("Le livre '{$this->titre}' est déjà emprunté.");
        }
        $this->disponible = false;
    }

    public function rendre(): void
    {
        if ($this->disponible) {
            throw new Exception("Le livre '{$this->titre}' est déjà disponible.");
        }
        $this->disponible = true;
    }

    public function __toString(): string
    {
        $etat = $this->disponible ? 'Disponible' : 'Emprunté';
        return "{$this->titre} par {$this->auteur} (ISBN: {$this->isbn}) - {$etat}";
    }
}