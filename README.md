# RAM

## 👥 Membres du groupe

* Reda Elghazouani
* Ahmed Amine Elouardi
* Marouane El Mozariahi

## 📚 Description

**RAM** est une équipe de développement travaillant sur le mini-projet **Biblio**, une application PHP en ligne de commande permettant de gérer une bibliothèque, notamment les livres, les membres et les emprunts.

Le projet est réalisé en équipe sur un seul dépôt GitHub, avec tous les membres travaillant sur la branche `main`.

## 🔌 Contrat d'interface

Chaque membre est responsable d'une classe et de ses tests :

| Membre                | Fichiers                                               | Interface                             |
| --------------------- | ------------------------------------------------------ | ------------------------------------- |
| Marouane El Mozariahi      | `src/Livre.php`, `tests/test_livre.php`                | Gestion des livres                    |
| Ahmed Amine Elouardi  | `src/Bibliotheque.php`, `tests/test_bibliotheque.php`  | Gestion de la bibliothèque            |
| Reda Elghazouani | `src/Membre.php`, `tests/test_membre.php`, `index.php` | Gestion des membres et menu principal |

### Livre

```text
Livre
- __construct(string $isbn, string $titre, string $auteur)
- getIsbn()
- getTitre()
- getAuteur()
- estDisponible(): bool
- emprunter()
- rendre()
- __toString(): string
```

### Bibliotheque

```text
Bibliotheque
- ajouter(Livre $l): void
- trouver(string $isbn): ?Livre
- tous(): array
- compter(): int
- rechercher(string $mot): array
```

### Membre

```text
Membre
- __construct(int $id, string $nom)
- getId()
- getNom()
- emprunter(Livre $l)
- rendre(Livre $l)
- getEmprunts(): array
```

Les interfaces doivent être respectées afin de permettre l'intégration des trois parties sans modification imprévue des classes des autres membres.
