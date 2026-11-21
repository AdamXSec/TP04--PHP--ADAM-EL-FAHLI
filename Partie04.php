<?php


class Personne {
    public function __construct(
        public string $nom,
        public string $prenom,
        private string $dateNaissance,
        private string $villeNaissance,
        private string $cin
    ) {}

    private function getAge(): int {
        $dateNaissance = new DateTime($this->dateNaissance);
        $maintenant = new DateTime();
        return $dateNaissance->diff($maintenant)->y;
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


$p = new Personne("EL FAHLI", "Adam", "2000-05-14", "Marrakech", "EE123456");

echo "<h3>1. Affichage direct de l'objet :</h3>";
echo $p . PHP_EOL; 
echo '<br /><hr />';

echo "<h3>2. Situations pratiques (__toString vs getName) :</h3>";


echo "Bonjour " . $p . PHP_EOL; 
echo '<br />';

echo "En majuscules : " . strtoupper($p) . PHP_EOL; 
echo '<br />';

$ageActuel = (new DateTime("2000-05-14"))->diff(new DateTime())->y;
$attendu = "Adam EL FAHLI (" . $ageActuel . " ans)";

echo (string) $p === $attendu
    ? "Cast explicite (string)\$p : OK" . PHP_EOL
    : " Différent" . PHP_EOL;
echo '<br />';

var_dump($p instanceof Stringable); 
echo '<br /><hr />';


echo "<h3>3. Exemples de retours valides pour __toString() :</h3>";

class RetourEntier {
    public function __toString(): string {
        return "42";
    }
}
echo "Retour d'un nombre converti en chaîne : ";
echo new RetourEntier() . PHP_EOL;
echo '<br />';


class RetourTableau {
    public function __toString(): string {
        return "[]";
    }
}

echo "Représentation textuelle d'un tableau vide : ";
echo new RetourTableau() . PHP_EOL;