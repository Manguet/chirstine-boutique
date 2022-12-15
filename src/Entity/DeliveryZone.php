<?php

namespace App\Entity;

use App\Repository\DeliveryZoneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveryZoneRepository::class)]
class DeliveryZone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'deliveryZone', targetEntity: Address::class, orphanRemoval: true)]
    private Collection $addresses;

    #[ORM\OneToMany(mappedBy: 'deliveryZone', targetEntity: Cart::class)]
    private Collection $carts;

    #[ORM\ManyToOne(inversedBy: 'deliveryZones')]
    private ?Deliverer $deliverer = null;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->carts     = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses->add($address);
            $address->setDeliveryZone($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->removeElement($address)
            && $address->getDeliveryZone() === $this)
        {
            $address->setDeliveryZone(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, Cart>
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts->add($cart);
            $cart->setDeliveryZone($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)
            && $cart->getDeliveryZone() === $this)
        {
            $cart->setDeliveryZone(null);
        }

        return $this;
    }

    public function getDeliverer(): ?Deliverer
    {
        return $this->deliverer;
    }

    public function setDeliverer(?Deliverer $deliverer): self
    {
        $this->deliverer = $deliverer;

        return $this;
    }
}
