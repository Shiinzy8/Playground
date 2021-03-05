<?php


namespace MVP_Office\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="MVP_Office\Repository\ColorRepository")
 * @ORM\Table(name="andrii_mvp_office_color")
 * @ApiResource(
 *     normalizationContext={"groups"={"color:read"}}
 * )
 */
class Color
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("color:read")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=6)
     * @Groups("color:read")
     */
    private $hexColor;

    public function __construct(string $name, string $hexColor)
    {
        $this->name = $name;
        $this->hexColor = $hexColor;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getHexColor(): ?string
    {
        return $this->hexColor;
    }

    public function setHexColor(string $hexColor): self
    {
        $this->hexColor = $hexColor;

        return $this;
    }
}
