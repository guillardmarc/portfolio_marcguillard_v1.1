<?php

namespace App\TwigServices;

use App\Entity\Presentations;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PresentationsExtension extends AbstractExtension
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunction(): array
    {
        return [
            new TwigFunction('presentation', [$this,'getPresentation'])
        ];
    }

    public function getPresentation()
    {
        return $this->em->getRepository(Presentations::class)->findOneBy([], ['id'=>'ASC'], [1]);
    }
}