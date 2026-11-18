<?php
// Partie 0 – la première classe
class Voiture {
    public $marque;
    public $couleur;

    public function setMarque($m) {
        $this->marque = $m;      // $this = l'objet qui appelle la méthode
    }

    public function setCouleur($c) {
        $this->couleur = $c;
    }

    public function afficher() {
        echo "Marque : " . $this->marque . " | Couleur : " . $this->couleur . PHP_EOL;
    }
}

$v1 = new Voiture();
$v1->setMarque("Toyota");
$v1->setCouleur("Noire");
$v1->afficher();

// 0.1
$v2 = new Voiture();
$v2->setMarque("Renault");
$v2->setCouleur("Rouge");
$v2->afficher();

// 0.3 : non, $v1 et $v2 ne partagent pas $marque : chaque objet a ses propres propriétés.
