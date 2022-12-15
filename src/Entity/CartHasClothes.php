<?php

namespace App\Entity;

use App\Repository\CartHasClothesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartHasClothesRepository::class)]
class CartHasClothes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'cartHasClothes')]
    private ?Cart $cart = null;

    #[ORM\OneToMany(mappedBy: 'cartHasClothes', targetEntity: Clothe::class)]
    private Collection $clothes;

    public function __construct()
    {
        $this->clothes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * @return Collection<int, Clothe>
     */
    public function getClothes(): Collection
    {
        return $this->clothes;
    }

    public function addClothes(Clothe $clothes): self
    {
        if (!$this->clothes->contains($clothes)) {
            $this->clothes->add($clothes);
            $clothes->setCartHasClothes($this);
        }

        return $this;
    }

    public function removeClothes(Clothe $clothes): self
    {
        if ($this->clothes->removeElement($clothes)
            && $clothes->getCartHasClothes() === $this)
        {
            $clothes->setCartHasClothes(null);
        }

        return $this;
    }
}
