# TP04--PHP--ADAM-EL-FAHLI
TP 04 PHP — Programmation Web 2 &amp;  php — 2026/2027
# Réponses – TP 4 POO en PHP

## Partie 0
- **0.3** Non : chaque objet a ses propres propriétés ; `$this` désigne l'objet qui appelle la méthode.

## Partie 1
- **1.1** `$p->cin` et `$p->dateNaissance` : `Cannot access private property`. `$p->getAge()` : `Call to private method Personne::getAge() from global scope`.
- **1.2** N'importe quel code extérieur pourrait lire ou modifier le CIN sans contrôle.
- **1.3** Elle sert d'outil interne : elle peut être appelée par d'autres méthodes de la classe (ex. `__toString()`).
- **1.4** Non, `protected` reste inaccessible depuis l'extérieur.

## Partie 2
- **2.1.a** `new Voiture("Noire")` : vitesse = 0. `new Voiture(120)` : accepté en mode non strict (converti en `"120"`), `TypeError` avec `strict_types=1`.
- **2.1.b** Moins de code : déclaration et initialisation en une seule fois.
- **2.2.a** `Cannot redeclare Personne::__construct()` : PHP n'a pas de surcharge de méthodes.
- **2.2.b** Un seul constructeur avec des valeurs par défaut.
- **2.3.a** créée → détruite → Fin du script.
- **2.3.b** créée → Fin du script → détruite.
- **2.3.c** En fin de script, en pratique dans l'ordre de création.

## Partie 3
- **3.2** Sans `__set` : erreur d'accès à une propriété privée. Avec `__set` : la méthode est appelée automatiquement.
- **3.3** Oui, si elle écrit sans contrôle. Il faut valider les valeurs (voir 3.4).

## Partie 4
- **4.1** L'appel est fait depuis l'intérieur de la classe.
- **4.2** Converti en chaîne en mode non strict ; `TypeError` en mode strict.
- **4.3** `echo` direct, interpolation de chaîne, logs, `implode()`.

## Partie 5
- **5.1** Non, le mot de passe n'apparaît pas.
- **5.2** Il apparaît en clair : risque de fuite de donnée sensible.
- **5.3** `""` ; en vrai : ré-authentification, et ne jamais stocker un mot de passe en clair (`password_hash`).
- **5.4** *PHP Object Injection* : `unserialize()` instancie des objets et exécute leurs méthodes magiques. Alternative : `json_encode` / `json_decode`.

## Partie 6
- **6.1.b** Non : `miauler()` appartient à `Chat`.
- **6.2.a** `$nom` n'est pas initialisé : le constructeur du parent n'est pas appelé automatiquement.
- **6.2.b** `protected` permet à la classe fille d'y accéder.
- **6.3.a** (1) `Cannot override final method` (2) `cannot extend final class` (3) `Cannot modify readonly property`.
- **6.3.b** `readonly` : identifiant, date de création. `final` : classe utilitaire ou de sécurité à ne pas modifier.
- **6.4.a** Erreur : méthode privée. Il faut la passer en `protected`.
- **6.4.b** `dateNaissance` est `private` : elle appartient à `Personne` seule.
- **6.4.c** Pas de duplication, et `Etudiant` suit les évolutions de `Personne`.

## Partie 7
- **7.1** Opérateur manquant dans `$this->montant 1 * ...`.
- **7.2** `montant * (1 + t/100)`.
- **7.3** L'ordre est incohérent avec l'énoncé ; une inversion à l'appel ne produit aucune erreur.
- **Résultats :** 1 037,50 DH et 4 072,24 DH.

## Questions de synthèse
1. La classe est le modèle ; l'objet est une instance créée avec `new`.
2. Réutilisation (héritage), encapsulation, modularité/maintenance.
3. Pour masquer les détails internes et contrôler les modifications.
4. `private` : la classe seule ; `protected` : la classe et ses filles.
5. Oui, `public` ; exceptions tolérées : `__construct` / `__destruct` peuvent être `private`/`protected` (ex. singleton).