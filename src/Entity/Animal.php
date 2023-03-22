<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Animales
 *
 * @ORM\Entity(repositoryClass="App\Repository\AnimalRepository")
 * @ORM\Table(name="animales")
*/
class Animal
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex(
     *  pattern = "/[a-zA-Z]+/",
     *  message="El tipo debe ser letras sin numeros"
     *  )
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="raza", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex(
     *  pattern = "/[a-zA-Z]+/",
     *  message="La raza debe ser letras sin numeros"
     *  )
     */
    private $raza;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex(
     *  pattern = "/[a-zA-Z]+/",
     *  message="el color debe ser letras sin numeros ni ningún otro formato"
     *  )
     */
    private $color;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getRaza(): ?string
    {
        return $this->raza;
    }

    public function setRaza(string $raza): self
    {
        $this->raza = $raza;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }


}
