<?php

namespace App\Entity;

use App\Repository\PromoCodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromoCodeRepository::class)]
class PromoCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(nullable: true)]
    private ?float $priceHt = null;

    #[ORM\Column(nullable: true)]
    private ?float $priceTTC = null;

    #[ORM\Column(nullable: true)]
    private ?float $pourcent = null;

    #[ORM\OneToMany(mappedBy: 'promoCode', targetEntity: Cart::class)]
    private Collection $cart;

    public function __construct()
    {
        $this->cart = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPriceHt(): ?float
    {
        return $this->priceHt;
    }

    public function setPriceHt(?float $priceHt): self
    {
        $this->priceHt = $priceHt;

        return $this;
    }

    public function getPriceTTC(): ?float
    {
        return $this->priceTTC;
    }

    public function setPriceTTC(?float $priceTTC): self
    {
        $this->priceTTC = $priceTTC;

        return $this;
    }

    public function getPourcent(): ?float
    {
        return $this->pourcent;
    }

    public function setPourcent(?float $pourcent): self
    {
        $this->pourcent = $pourcent;

        return $this;
    }

    /**
     * @return Collection<int, Cart>
     */
    public function getCart(): Collection
    {
        return $this->cart;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->cart->contains($cart)) {
            $this->cart->add($cart);
            $cart->setPromoCode($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->cart->removeElement($cart)
            && $cart->getPromoCode() === $this)
        {
            $cart->setPromoCode(null);
        }

        return $this;
    }
}
