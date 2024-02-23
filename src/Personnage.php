<?php

namespace App\Personnage;

class Perso
{
    protected string $name;
    protected int $pv;
    protected float $def;
    protected int $att;

    public function __construct(string $name, int $pv, float $def, int $att)
    {
        $this->name = $name;
        $this->pv = $pv;
        $this->def = $def;
        $this->att = $att;
    }

    public function attaquer(Perso $otherPlayer)
    {
        $otherPlayer->pv -= $this->att;
    }

    public function attaqueSpeciale(Perso $otherPlayer)
    {
        // Méthode à implémenter dans les classes filles
    }

    // Getter pour $name
    public function getName(): string
    {
        return $this->name;
    }

    // Setter pour $name
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    // Getter pour $pv
    public function getPv(): int
    {
        return $this->pv;
    }

    // Setter pour $pv
    public function setPv(int $pv): void
    {
        $this->pv = $pv;
    }

    // Getter pour $def
    public function getDef(): float
    {
        return $this->def;
    }

    // Setter pour $def
    public function setDef(float $def): void
    {
        $this->def = $def;
    }

    // Getter pour $att
    public function getAtt(): int
    {
        return $this->att;
    }

    // Setter pour $att
    public function setAtt(int $att): void
    {
        $this->att = $att;
    }
}

class Guerrier extends Perso
{
    public function __construct()
    {
        parent::__construct("Guerrier", 120, 0.2, 15);
    }

    public function attaqueSpeciale(Perso $otherPlayer)
    {
        $this->def = 0.3;
        $this->att = 25;
        $otherPlayer->pv -= 40;
    }

}

class Archer extends Perso
{
    public function __construct()
    {
        parent::__construct("Archer", 90, 0.15, 18);
    }

    public function attaqueSpeciale(Perso $otherPlayer)
    {
        $random5 = rand(2, 5);
        $otherPlayer->pv -= 12 * $random5;
    }
}

class Pretre extends Perso
{
    public function __construct()
    {
        parent::__construct("Pretre", 80, 0.3, 10);
    }

    public function attaqueSpeciale(Perso $otherPlayer)
    {
        $newPv = $this->pv + 30;
        if ($newPv <= 80) {
            $this->pv = $newPv;
        } else {
            $this->pv = 80;
        }
    }
}

class Mage extends Perso
{
    public function __construct()
    {
        parent::__construct("Mage", 100, 0.1, 20);
    }

    public function attaqueSpeciale(Perso $otherPlayer)
    {
        $otherPlayer->pv -= 40;
    }
}

