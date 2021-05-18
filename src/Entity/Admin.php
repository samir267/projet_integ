<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity=client::class, mappedBy="admin", orphanRemoval=true)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=produit::class, mappedBy="admin", orphanRemoval=true)
     */
    private $produit;

    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection|client[]
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(client $client): self
    {
        if (!$this->client->contains($client)) {
            $this->client[] = $client;
            $client->setAdmin($this);
        }

        return $this;
    }

    public function removeClient(client $client): self
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getAdmin() === $this) {
                $client->setAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|produit[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
            $produit->setAdmin($this);
        }

        return $this;
    }

    public function removeProduit(produit $produit): self
    {
        if ($this->produit->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getAdmin() === $this) {
                $produit->setAdmin(null);
            }
        }

        return $this;
    }
}
