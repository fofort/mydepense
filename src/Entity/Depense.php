<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Depense
 *
 * @ORM\Table(name="depense")
 * @ORM\Entity(repositoryClass="App\Repository\DepenseRepository")
 */
class Depense
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_shop", type="integer", nullable=false)
     */
    private $idShop;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_buy", type="date", nullable=false)
     */
    private $dateBuy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdShop(): ?int
    {
        return $this->idShop;
    }

    public function setIdShop(int $idShop): self
    {
        $this->idShop = $idShop;

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDateBuy(): ?\DateTimeInterface
    {
        return $this->dateBuy;
    }

    public function setDateBuy(\DateTimeInterface $dateBuy): self
    {
        $this->dateBuy = $dateBuy;

        return $this;
    }


}

