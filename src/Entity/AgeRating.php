<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AgeRatingRepository")
 */
class AgeRating
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $rating_factor;


    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

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
