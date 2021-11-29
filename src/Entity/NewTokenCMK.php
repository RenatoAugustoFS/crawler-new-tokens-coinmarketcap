<?php

namespace App\Entity;

use App\Repository\NewTokenCMKRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NewTokenCMKRepository::class)
 */
class NewTokenCMK
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __toString(): string
    {
        $message = "### Novo TOKEN Adicionado ###" . "\n";
        $message.= "Nome: => " . $this->name . "\n";
        return $message;
    }
}
