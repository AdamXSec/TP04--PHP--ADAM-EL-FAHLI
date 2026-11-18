<?php 

class Voiture {
    public string $couleur;
    public int $vitesse;

    public function __construct(string $couleur = "Blanche", int $vitesse = 0) {
        $this->couleur = $couleur;
        $this->vitesse = $vitesse;
    }

    public function afficher(): void {
        echo "Couleur : {$this->couleur} | Vitesse : {$this->vitesse} km/h" . PHP_EOL;
    }
}

$v1 = new Voiture();
$v2 = new Voiture("Rouge", 50);
$v1->afficher();
$v2->afficher();


(new Voiture("Noire"))->afficher();

class VoiturePromo {
    public function __construct(
        public string $couleur = "Blanche",
        public int $vitesse = 0
    ) {}
}
$v3 = new VoiturePromo("Bleue", 80);
echo $v3->couleur . " - " . $v3->vitesse . PHP_EOL;

class Personne {
    public function __construct(
        public string $nom = "",
        public string $prenom = ""
    ) {
        echo "Création " . __CLASS__ . PHP_EOL;
    }

    public static function depuisTableau(array $data): self {
        return new self($data['nom'] ?? "", $data['prenom'] ?? "");
    }

  
    public function __destruct() {
        echo "Détruire " . __CLASS__ . PHP_EOL;
    }
}

$vide = new Personne();
$plein = new Personne("EL FAHLI ", "Adam");
$fab = Personne::depuisTableau(['nom' => 'Alaoui', 'prenom' => 'Omar']);
unset($vide, $plein, $fab);


class VoitureD {
    public function __construct(public string $couleur) {
        echo "Voiture {$this->couleur} créée." . PHP_EOL;
    }

    public function __destruct() {
        echo "Voiture {$this->couleur} détruite." . PHP_EOL;
    }
}

$maVoiture = new VoitureD("Blanche");
unset($maVoiture);
echo "Fin du script." . PHP_EOL;

$a = new VoitureD("A");
$b = new VoitureD("B");
