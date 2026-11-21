<?php
declare(strict_types=1);

require_once __DIR__ . '/outils.php';


final class Personne
{
    private string $nom = '';
    private string $prenom = '';
    private string $dateNaissance = '';

    public function __set(string $name, mixed $value): void
    {
        if (!property_exists($this, $name)) {
            throw new OutOfBoundsException("Propriété $name inexistante");
        }

        // 3.4 : validation selon la propriété
        $this->$name = match ($name) {
            'nom', 'prenom' => $this->validerTexte($name, $value),
            'dateNaissance' => $this->validerDate($value),
        };
    }

    public function __get(string $name): mixed
    {
        return property_exists($this, $name) ? $this->$name : null;
    }

    public function __isset(string $name): bool
    {
        // une valeur vide est considérée comme "non définie"
        return property_exists($this, $name) && $this->$name !== '';
    }

    public function __unset(string $name): void
    {
        if (property_exists($this, $name)) {
            $this->$name = '';
        }
    }

    private function validerTexte(string $champ, mixed $valeur): string
    {
        if (!is_string($valeur) || mb_strlen(trim($valeur)) < 2) {
            throw new InvalidArgumentException("Le champ $champ doit contenir au moins 2 caractères.");
        }
        return trim($valeur);
    }

    private function validerDate(mixed $valeur): string
    {
        $date = is_string($valeur) ? DateTimeImmutable::createFromFormat('!Y-m-d', $valeur) : false;
        if ($date === false || $date->format('Y-m-d') !== $valeur) {
            throw new InvalidArgumentException('Date invalide (format AAAA-MM-JJ).');
        }
        return $valeur;
    }
}

$p = new Personne();
$p->nom = 'EL FAHLI ';
echo $p->nom . PHP_EOL;          
var_dump(isset($p->nom));          
unset($p->nom); 
var_dump(isset($p->nom));         
$p->dateNaissance = '2000-05-14';
echo $p->dateNaissance . PHP_EOL;


