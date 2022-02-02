<?php

namespace App\Entity;

use App\Repository\PictureAchievementsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PictureAchievementsRepository::class)
 */
class PictureAchievements
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
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="boolean")
     */
    private $top;

    /**
     * @ORM\ManyToOne(targetEntity=Achievements::class, inversedBy="pictures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $achievements;

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getTop(): ?bool
    {
        return $this->top;
    }

    public function setTop(bool $top): self
    {
        $this->top = $top;

        return $this;
    }

    public function getAchievements(): ?Achievements
    {
        return $this->achievements;
    }

    public function setAchievements(?Achievements $achievements): self
    {
        $this->achievements = $achievements;

        return $this;
    }
}
