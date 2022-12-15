<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\ManyToOne(inversedBy: 'cart')]
    private ?PromoCode $promoCode = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    private ?DeliveryZone $deliveryZone = null;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: CartHasClothes::class)]
    private Collection $cartHasClothes;

    public function __construct()
    {
        $this->cartHasClothes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPromoCode(): ?PromoCode
    {
        return $this->promoCode;
    }

    public function setPromoCode(?PromoCode $promoCode): self
    {
        $this->promoCode = $promoCode;

        return $this;
    }

    public function getDeliveryZone(): ?DeliveryZone
    {
        return $this->deliveryZone;
    }

    public function setDeliveryZone(?DeliveryZone $deliveryZone): self
    {
        $this->deliveryZone = $deliveryZone;

        return $this;
    }

    public function getClothes(): array
    {
        $clothes = [];
        foreach ($this->cartHasClothes as $cartHasClothe) {
            $clothes[] = $cartHasClothe->getClothes();
        }

        return $clothes;
    }

    /**
     * @return Collection<int, CartHasClothes>
     */
    public function getCartHasClothes(): Collection
    {
        return $this->cartHasClothes;
    }

    public function addCartHasClothes(CartHasClothes $cartHasClothes): self
    {
        if (!$this->cartHasClothes->contains($cartHasClothes)) {
            $this->cartHasClothes->add($cartHasClothes);
            $cartHasClothes->setCart($this);
        }

        return $this;
    }

    public function removeCartHasClothes(CartHasClothes $cartHasClothes): self
    {
        if ($this->cartHasClothes->removeElement($cartHasClothes)
            && $cartHasClothes->getCart() === $this)
        {
            $cartHasClothes->setCart(null);
        }

        return $this;
    }
}
