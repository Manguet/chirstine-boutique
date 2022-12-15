<?php

namespace App\Entity;

use App\Repository\DelivererRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DelivererRepository::class)]
class Deliverer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'deliverer', targetEntity: DeliveryZone::class)]
    private Collection $deliveryZones;

    public function __construct()
    {
        $this->deliveryZones = new ArrayCollection();
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
     * @return Collection<int, DeliveryZone>
     */
    public function getDeliveryZones(): Collection
    {
        return $this->deliveryZones;
    }

    public function addDeliveryZone(DeliveryZone $deliveryZone): self
    {
        if (!$this->deliveryZones->contains($deliveryZone)) {
            $this->deliveryZones->add($deliveryZone);
            $deliveryZone->setDeliverer($this);
        }

        return $this;
    }

    public function removeDeliveryZone(DeliveryZone $deliveryZone): self
    {
        if ($this->deliveryZones->removeElement($deliveryZone)
            && $deliveryZone->getDeliverer() === $this)
        {
            $deliveryZone->setDeliverer(null);
        }

        return $this;
    }
}
