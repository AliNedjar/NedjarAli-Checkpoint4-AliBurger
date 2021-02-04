<?php

namespace App\Entity;

use App\Repository\SauceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SauceRepository::class)
 */
class Sauce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Origin;

    /**
     * @ORM\Column(type="text")
     */
    private $Ingredient;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sauces")
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="sauce")
     */
    private  $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->Origin;
    }

    public function setOrigin(string $Origin): self
    {
        $this->Origin = $Origin;

        return $this;
    }

    public function getIngredient(): ?string
    {
        return $this->Ingredient;
    }

    public function setIngredient(string $Ingredient): self
    {
        $this->Ingredient = $Ingredient;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setSauce($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getSauce() === $this) {
                $comment->setSauce(null);
            }
        }

        return $this;
    }
}
