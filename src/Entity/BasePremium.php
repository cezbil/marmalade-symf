<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BasePremiumRepository")
 */
class BasePremium
{


    /**
     * @ORM\Id()
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $base_premium;


    public function getBasePremium(): ?string
    {
        return $this->base_premium;
    }

    public function setBasePremium(?string $base_premium): self
    {
        $this->base_premium = $base_premium;

        return $this;
    }
}
