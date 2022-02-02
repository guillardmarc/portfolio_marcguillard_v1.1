<?php

namespace App\TwigServices;

use App\Entity\Websites;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WebsitesExtension extends AbstractExtension
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('website', [$this, 'getWebsite'])
        ];
    }
    
    public function getWebsite()
    {
        return $this->em->getRepository(Websites::class)-> findOneBy([], ['id'=>'ASC'], [1]);
    }
}