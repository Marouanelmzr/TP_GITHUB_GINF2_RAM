<?php

class Membre
{
    private const MAX_EMPRUNTS = 3;

    private int $id;
    private string $nom;
    /** @var Livre[] indexés par ISBN */
    private array $emprunts = [];

    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function emprunter(Livre $l): void
    {
        if (count($this->emprunts) >= self::MAX_EMPRUNTS) {
            throw new Exception("Limite de " . self::MAX_EMPRUNTS . " livres atteinte pour {$this->nom}.");
        }
        $l->emprunter(); // lève une Exception si le livre est déjà emprunté
        $this->emprunts[$l->getIsbn()] = $l;
    }

    public function rendre(Livre $l): void
    {
        if (!isset($this->emprunts[$l->getIsbn()])) {
            throw new Exception("{$this->nom} n'a pas emprunté ce livre.");
        }
        $l->rendre();
        unset($this->emprunts[$l->getIsbn()]);
    }

    public function getEmprunts(): array
    {
        return array_values($this->emprunts);
    }
}