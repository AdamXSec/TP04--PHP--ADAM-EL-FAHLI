<?php 
class Voiture {
    public string $couleur;
    public int $vitesse; 

    public function __construct(string $couleur, int $vitesse) {
        $this->couleur = $couleur;
        $this->vitesse = $vitesse;
    }

    public function afficher (): void {
        echo "Couleur : " . $this->couleur . "\n";
        echo "Vitesse : " . $this->vitesse . "\n";
    }

}
$v1 = new Voiture();
$v2 = new Voiture("Rouge", 120);
$v1->afficher();
$v2->afficher();

(new Voiture("Bleu"))->afficher();
