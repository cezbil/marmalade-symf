<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AbiCodeRatingRepository")
 */
class AbiCodeRating
{


    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=10)
     */
    private $abi_code;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $rating_factor;


    public function getAbiCode(): ?string
    {
        return $this->abi_code;
    }

    public function setAbiCode(string $abi_code): self
    {
        $this->abi_code = $abi_code;

        return $this;
    }

    public function getRatingFactor(): ?string
    {
        return $this->rating_factor;
    }

    public function setRatingFactor(?string $rating_factor): self
    {
        $this->rating_factor = $rating_factor;

        return $this;
    }
}
