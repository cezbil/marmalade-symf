<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostcodeRatingRepository")
 */
class PostcodeRating
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=4)
     */
    private $postcode_area;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $rating_factor;



    public function getPostcodeArea(): ?string
    {
        return $this->postcode_area;
    }

    public function setPostcodeArea(string $postcode_area): self
    {
        $this->postcode_area = $postcode_area;

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
