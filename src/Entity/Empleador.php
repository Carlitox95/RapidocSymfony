<?php

namespace App\Entity;

use App\Repository\EmpleadorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpleadorRepository::class)
 */
class Empleador
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $apellido;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cuitcuil;

    /**
     * @ORM\OneToMany(targetEntity=persona::class, mappedBy="empleador")
     */
    private $persona;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

    public function __construct()
    {
        $this->persona = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getCuitcuil(): ?string
    {
        return $this->cuitcuil;
    }

    public function setCuitcuil(string $cuitcuil): self
    {
        $this->cuitcuil = $cuitcuil;

        return $this;
    }

    /**
     * @return Collection|persona[]
     */
    public function getPersona(): Collection
    {
        return $this->persona;
    }

    public function addPersona(persona $persona): self
    {
        if (!$this->persona->contains($persona)) {
            $this->persona[] = $persona;
            $persona->setEmpleador($this);
        }

        return $this;
    }

    public function removePersona(persona $persona): self
    {
        if ($this->persona->removeElement($persona)) {
            // set the owning side to null (unless already changed)
            if ($persona->getEmpleador() === $this) {
                $persona->setEmpleador(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return strtoupper("$this->apellido,$this->nombre");
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }
}
