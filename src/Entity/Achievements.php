<?php

namespace App\Entity;

use App\Repository\AchievementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AchievementsRepository::class)
 */
class Achievements
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gitLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $httpLink;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $updateDate;

    /**
     * @ORM\OneToMany(targetEntity=PictureAchievements::class, mappedBy="achievements", orphanRemoval=true, cascade={"persist"})
     */
    private $pictures;

    /**
     * @ORM\ManyToMany(targetEntity=WebTechnologies::class, inversedBy="achievements")
     */
    private $technology;

    /**
     * @ORM\ManyToOne(targetEntity=Establishments::class, inversedBy="achievements")
     */
    private $applicant;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->technology = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getGitLink(): ?string
    {
        return $this->gitLink;
    }

    public function setGitLink(string $gitLink): self
    {
        $this->gitLink = $gitLink;

        return $this;
    }

    public function getHttpLink(): ?string
    {
        return $this->httpLink;
    }

    public function setHttpLink(?string $httpLink): self
    {
        $this->httpLink = $httpLink;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(?\DateTimeInterface $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * @return Collection|PictureAchievements[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(PictureAchievements $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setAchievements($this);
        }

        return $this;
    }

    public function removePicture(PictureAchievements $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getAchievements() === $this) {
                $picture->setAchievements(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|WebTechnologies[]
     */
    public function getTechnology(): Collection
    {
        return $this->technology;
    }

    public function addTechnology(WebTechnologies $technology): self
    {
        if (!$this->technology->contains($technology)) {
            $this->technology[] = $technology;
        }

        return $this;
    }

    public function removeTechnology(WebTechnologies $technology): self
    {
        $this->technology->removeElement($technology);

        return $this;
    }

    public function getApplicant(): ?Establishments
    {
        return $this->applicant;
    }

    public function setApplicant(?Establishments $applicant): self
    {
        $this->applicant = $applicant;

        return $this;
    }
}
