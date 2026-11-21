<?php

echo "=== 6.1 DÉCOUVERTE DE L'HÉRITAGE ===" . PHP_EOL;

class Animal {
    public function manger(): void {
        echo "Je mange." . PHP_EOL;
    }
}

class Chien extends Animal {
    public function aboyer(): void {
        echo "Wouf !" . PHP_EOL;
    }
}


class Chat extends Animal {
    public function miauler(): void {
        echo "Miaou !" . PHP_EOL;
    }
}

$c = new Chien();
echo "<br>";
$c->manger();    
echo "<br>";
$c->aboyer();    
$chat = new Chat();
$chat->miauler();

echo "<br><hr>" . PHP_EOL;

echo "=== 6.2 parent:: ET REDÉFINITION ===" . PHP_EOL;

class PersonneSimple {
    public function __construct(protected string $nom) {}

    public function presentation(): string {
        return "Je suis {$this->nom}";
    }
}

class EtudiantSimple extends PersonneSimple {
    public function __construct(string $nom, private string $filiere) {
        parent::__construct($nom);
    }

    public function presentation(): string {
        return parent::presentation() . ", étudiant en {$this->filiere}";
    }
}

$eSimple = new EtudiantSimple("Ahmed", "Informatique");
echo "<br>";
echo $eSimple->presentation() . PHP_EOL;
echo "<br>";
class EtudiantComplet extends PersonneSimple {
    public function __construct(string $nom, private string $filiere) {
        parent::__construct($nom);
    }

    public function presentation(): string {
        return parent::presentation() . ", étudiant en {$this->filiere}";
    }
}

$eComplet = new EtudiantComplet("Ahmed", "Informatique");
echo $eComplet->presentation() . PHP_EOL;

echo "<br><hr>" . PHP_EOL;

echo "=== 6.3 final ET readonly ===" . PHP_EOL;

class Base {
    final public function afficher(): void {
        echo "Méthode finale (ne peut pas être redéfinie)" . PHP_EOL;
    }
}

final class Outil {
    public const VERSION = "1.0";
}

class Produit {
    public function __construct(public string $reference) {}
}
echo "<br>";
$base = new Base();
$base->afficher();
echo "<br>";
echo "Outil version : " . Outil::VERSION . PHP_EOL;
echo "<br>";
$prod = new Produit("REF-001");
echo "Référence du produit : " . $prod->reference . PHP_EOL;


echo "<br><hr>" . PHP_EOL;



echo "=== 6.4 EXERCICE PRINCIPAL (Etudiant extends Personne) ===" . PHP_EOL;
echo "<br>";
class Personne {
    public function __construct(
        public string $nom,
        public string $prenom,
        private string $dateNaissance,
        private string $villeNaissance,
        private string $cin
    ) {}

    protected function getAge(): int {
        $naissance = new DateTime($this->dateNaissance);
        $aujourdhui = new DateTime();
        return $naissance->diff($aujourdhui)->y;
    }

    public function getVilleNaissance(): string {
        return $this->villeNaissance;
    }

    public function getCin(): string {
        return $this->cin;
    }

    public function __toString(): string {
        return "{$this->prenom} {$this->nom} ({$this->getAge()} ans)";
    }
}

class Etudiant extends Personne {
    public function __construct(
        string $nom,
        string $prenom,
        string $dateNaissance,
        string $villeNaissance,
        string $cin,
        private string $cne
    ) {
        parent::__construct($nom, $prenom, $dateNaissance, $villeNaissance, $cin);
    }

    public function getCne(): string {
        return $this->cne;
    }

    public function __toString(): string {
        return parent::__toString() . " - CNE : {$this->cne}";
    }

    public function ageDansDeuxAns(): int {
        return $this->getAge() + 2; 
    }
}


$etudiants = [
    new Etudiant("EL FAHLI", "Adam", "2004-05-14", "Marrakech", "EE123456", "R130000001"),
    new Etudiant("Benali", "Youssef", "2003-11-02", "Casablanca", "BK654321", "R130000002"),
    new Etudiant("Idrissi", "Omar", "2004-01-27", "Fès", "CD112233", "R130000003"),
    new Etudiant("Tazi", "Salma", "2003-08-19", "Rabat", "A998877", "R130000004"),
    new Etudiant("Chraibi", "Hamza", "2004-03-30", "Béni Mellal", "T445566", "R130000005")
];

foreach ($etudiants as $e) {
    echo $e . PHP_EOL;
    echo "<br>";
}

echo "<br>";
echo "Test méthode personnalisée : Dans deux ans, " . $etudiants[0]->prenom . " aura " . $etudiants[0]->ageDansDeuxAns() . " ans." . PHP_EOL;