<?php

class Utilisateur {
    public string $nom;
    public int $age;
    private string $motDePasse;

    public function __construct(string $nom, int $age, string $motDePasse) {
        $this->nom        = $nom;
        $this->age        = $age;
        $this->motDePasse = $motDePasse;
    }

    public function __serialize(): array {
        return [
            'nom' => $this->nom,
            'age' => $this->age,
        ];
    }

    public function __unserialize(array $data): void {
        $this->nom        = $data['nom'];
        $this->age        = $data['age'];
        $this->motDePasse = "";
    }
}


$u = new Utilisateur("Alice", 25, "secret123");
$serialise = serialize($u);
echo "Sérialisé : $serialise" . PHP_EOL;
echo "<br>";

$restaure = unserialize($serialise);
echo "Objet restauré (var_dump) : <pre>";
var_dump($restaure);                    
echo "</pre><hr>";


class UtilisateurNaif {
    public function __construct(
        public string $nom,
        private string $motDePasse
    ) {}
}

$brut = serialize(new UtilisateurNaif("Alice", "secret123"));

echo "Sans __serialize : " . str_replace("\0", "*", $brut) . PHP_EOL;
echo "<br>";
echo "<hr>";
echo "--- Alternatives sûres ---" . PHP_EOL;
echo "<br>";

$json = json_encode(['nom' => $u->nom, 'age' => $u->age]);
echo "JSON : $json" . PHP_EOL;
echo "<br>";

$data = json_decode($json, true);
var_dump($data);
echo "<hr>";

$sur = unserialize($serialise, ['allowed_classes' => false]);
echo "Avec allowed_classes=false : " . get_class($sur) . PHP_EOL; 


