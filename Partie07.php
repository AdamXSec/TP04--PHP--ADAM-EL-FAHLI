<?php

class Compte {
    protected float $montant;
    private float $interet;

    public function __construct(float $montantInitial, float $interet) {
        $this->montant = $montantInitial;
        $this->interet = $interet;
    }

    public function un_an(): void {
        $this->montant = $this->montant * (1 + $this->interet / 100);
    }

    public function get_montant(): float {
        return $this->montant;
    }
    public function deposer(float $montant): void {
        if ($this->estValide($montant)) {
            $this->montant += $montant;
        } else {
            throw new InvalidArgumentException("Le montant du dépôt doit être strictement positif.");
        }
    }

    private function estValide(float $montant): bool {
        return $montant > 0;
    }

    public function retirer(float $montant): void {
        if (!$this->estValide($montant)) {
            throw new InvalidArgumentException("Le montant du retrait doit être strictement positif.");
        }
        if ($montant > $this->montant) {
            throw new RuntimeException("Solde insuffisant pour effectuer ce retrait.");
        }
        $this->montant -= $montant;
    }
}

class CompteEpargne extends Compte {
    public function afficherSolde(): void {
        echo "<li><strong>Compte Épargne :</strong> " . number_format($this->montant, 2, ',', ' ') . " dirhams</li>" . PHP_EOL;
    }
}

$c1 = new Compte(400, 10);
$c2 = new Compte(2500, 5);

for ($i = 1; $i <= 10; $i++) {
    $c1->un_an();
    $c2->un_an();
}

echo "<h2> Résultats de la simulation bancaire (après 10 ans)</h2>";
echo "<ul>";
echo "<li><strong>Compte 1 (400 DH à 10 %) :</strong> " . number_format($c1->get_montant(), 2, ',', ' ') . PHP_EOL;
echo "<li><strong>Compte 2 (2 500 DH à 5 %) :</strong> " . number_format($c2->get_montant(), 2, ',', ' ') . PHP_EOL;
echo "</ul>";

echo "<hr>";

echo "<h2> Tests des opérations et de la sécurité</h2>";
echo "<ul>";

$c3 = new Compte(montantInitial: 1000, interet: 3);
$c3->deposer(500);
$c3->retirer(200);
echo "<li>Compte 3 après dépôt (500 DH) et retrait (200 DH) : <strong>" . number_format($c3->get_montant(), 2, ',', ' ') . " dirhams</strong></li>" . PHP_EOL;

try {
    $c3->deposer(-50);
} catch (InvalidArgumentException $e) {
    echo "<li><span style='color:red;'>Exception capturée :</span> " . $e->getMessage() . "</li>" . PHP_EOL;
}

try {
    $c3->retirer(99999);
} catch (RuntimeException $e) {
    echo "<li><span style='color:red;'>Exception capturée :</span> " . $e->getMessage() . "</li>" . PHP_EOL;
}

echo "</ul>";

echo "<h3> Test de l'héritage (CompteÉpargne) :</h3>";
echo "<ul>";
$epargne = new CompteEpargne(5000, 2);
$epargne->afficherSolde();
echo "</ul>";