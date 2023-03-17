<?php


namespace App\Entity\Animales;

use Doctrine\ORM\Mapping as ORM;
/**
 * Animales
 *
 * @ORM\Table(name="animales")
 * @ORM\Entity
*/
class Animales
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
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="raza", type="string", length=255, nullable=false)
     */
    private $raza;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=false)
     */
    private $color;


}
