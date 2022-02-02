<?php

namespace App\Entity;

use App\Repository\EstablishmentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EstablishmentsRepository::class)
 */
class Establishments
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
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $httpLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=13, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pictureLink;

    /**
     * @ORM\OneToMany(targetEntity=Achievements::class, mappedBy="applicant")
     */
    private $achievements;

    /**
     * @ORM\OneToMany(targetEntity=ProfessionnalCareers::class, mappedBy="employer")
     */
    private $employer;

    /**
     * @ORM\ManyToMany(targetEntity=ProfessionnalCareers::class, mappedBy="workSite")
     */
    private $workSite;

    public function __construct()
    {
        $this->achievements = new ArrayCollection();
        $this->employer = new ArrayCollection();
        $this->workSite = new ArrayCollection();
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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPictureLink(): ?string
    {
        return $this->pictureLink;
    }

    public function setPictureLink(?string $pictureLink): self
    {
        $this->pictureLink = $pictureLink;

        return $this;
    }

    /**
     * @return Collection|Achievements[]
     */
    public function getAchievements(): Collection
    {
        return $this->achievements;
    }

    public function addAchievement(Achievements $achievement): self
    {
        if (!$this->achievements->contains($achievement)) {
            $this->achievements[] = $achievement;
            $achievement->setApplicant($this);
        }

        return $this;
    }

    public function removeAchievement(Achievements $achievement): self
    {
        if ($this->achievements->removeElement($achievement)) {
            // set the owning side to null (unless already changed)
            if ($achievement->getApplicant() === $this) {
                $achievement->setApplicant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProfessionnalCareers[]
     */
    public function getEmployer(): Collection
    {
        return $this->employer;
    }

    public function addEmployer(ProfessionnalCareers $employer): self
    {
        if (!$this->employer->contains($employer)) {
            $this->employer[] = $employer;
            $employer->setEmployer($this);
        }

        return $this;
    }

    public function removeEmployer(ProfessionnalCareers $employer): self
    {
        if ($this->employer->removeElement($employer)) {
            // set the owning side to null (unless already changed)
            if ($employer->getEmployer() === $this) {
                $employer->setEmployer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProfessionnalCareers[]
     */
    public function getWorkSite(): Collection
    {
        return $this->workSite;
    }

    public function addWorkSite(ProfessionnalCareers $workSite): self
    {
        if (!$this->workSite->contains($workSite)) {
            $this->workSite[] = $workSite;
            $workSite->addWorkSite($this);
        }

        return $this;
    }

    public function removeWorkSite(ProfessionnalCareers $workSite): self
    {
        if ($this->workSite->removeElement($workSite)) {
            $workSite->removeWorkSite($this);
        }

        return $this;
    }
}
