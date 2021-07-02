<?php

namespace App\Entity;

use App\Repository\PersonaRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=PersonaRepository::class)
*/
class Persona {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellido;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $dniNroTramite;


    /**
     * @ORM\Column(type="string", length=255)
    */
    private $cuitcuil;  

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $direccion;

    /**
     * @ORM\OneToMany(targetEntity=Documento::class, mappedBy="persona")
     */
    private $documentos;

    public function __construct()
    {
        $this->documentos = new ArrayCollection();
    }

    
    
        
   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

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

    public function getDniNroTramite(): ?string
    {
        return $this->dniNroTramite;
    }

    public function setDniNroTramite(string $dniNroTramite): self
    {
        $this->dniNroTramite = $dniNroTramite;

        return $this;
    }

    public function getCuitCuil(): ?string
    {
        return $this->cuitcuil;
    }

    public function setCuitCuil(string $cuitcuil): self
    {
        $this->cuitcuil = $cuitcuil;

        return $this;
    }


    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }


    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }
    
    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }
    
   

    public function __toString() {
        return strtoupper("$this->nombre $this->apellido");
    }

    /**
     * @return Collection|Documento[]
     */
    public function getDocumentos(): Collection
    {
        return $this->documentos;
    }

    public function addDocumento(Documento $documento): self
    {
        if (!$this->documentos->contains($documento)) {
            $this->documentos[] = $documento;
            $documento->setPersona($this);
        }

        return $this;
    }

    public function removeDocumento(Documento $documento): self
    {
        if ($this->documentos->removeElement($documento)) {
            // set the owning side to null (unless already changed)
            if ($documento->getPersona() === $this) {
                $documento->setPersona(null);
            }
        }

        return $this;
    }


}
