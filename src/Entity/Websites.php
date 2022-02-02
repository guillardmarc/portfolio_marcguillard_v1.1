<?php

namespace App\Entity;

use App\Repository\WebsitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WebsitesRepository::class)
 */
class Websites
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="text")
     */
    private $regulation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $copyright;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $version;

    /**
     * @ORM\OneToMany(targetEntity=UpdateWebsites::class, mappedBy="websites")
     */
    private $upldate;

    public function __construct()
    {
        $this->upldate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function getRegulation(): ?string
    {
        return $this->regulation;
    }

    public function setRegulation(string $regulation): self
    {
        $this->regulation = $regulation;

        return $this;
    }

    public function getCopyright(): ?string
    {
        return $this->copyright;
    }

    public function setCopyright(string $copyright): self
    {
        $this->copyright = $copyright;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return Collection|UpdateWebsites[]
     */
    public function getUpldate(): Collection
    {
        return $this->upldate;
    }

    public function addUpldate(UpdateWebsites $upldate): self
    {
        if (!$this->upldate->contains($upldate)) {
            $this->upldate[] = $upldate;
            $upldate->setWebsites($this);
        }

        return $this;
    }

    public function removeUpldate(UpdateWebsites $upldate): self
    {
        if ($this->upldate->removeElement($upldate)) {
            // set the owning side to null (unless already changed)
            if ($upldate->getWebsites() === $this) {
                $upldate->setWebsites(null);
            }
        }

        return $this;
    }
}
