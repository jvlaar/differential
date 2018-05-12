<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReleaseRepository")
 */
class Release
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="blob")
     */
    private $art;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function getId() {
    	return $this->id;
    }

    public function setName($name) {
    	return $this->name = name;
    }

    public function getName() {
    	return $this->name;
    }
}
