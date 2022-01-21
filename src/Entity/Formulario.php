<?php

namespace App\Entity;

use App\Repository\FormularioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormularioRepository::class)
 */
class Formulario
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categoria;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plantilla;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @ORM\OneToMany(targetEntity=Documento::class, mappedBy="formulario")
     */
    private $documentos;

    /**
     * @ORM\OneToMany(targetEntity=Documento::class, mappedBy="formulario")
     */
    private $documentosCreados;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    

    public function __construct()
    {
        $this->documentos = new ArrayCollection();
        $this->documentosCreados = new ArrayCollection();
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

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }


    public function getPlantilla(): ?string
    {
        return $this->plantilla;
    }

    public function setPlantilla(?string $plantilla): self
    {
        $this->plantilla = $plantilla;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection|Documento[]
     */
    public function getDocumentosCreados(): Collection
    {
        return $this->documentosCreados;
    }

    public function addDocumentosCreado(Documento $documentosCreado): self
    {
        if (!$this->documentosCreados->contains($documentosCreado)) {
            $this->documentosCreados[] = $documentosCreado;
            $documentosCreado->setFormulario($this);
        }

        return $this;
    }

    public function removeDocumentosCreado(Documento $documentosCreado): self
    {
        if ($this->documentosCreados->removeElement($documentosCreado)) {
            // set the owning side to null (unless already changed)
            if ($documentosCreado->getFormulario() === $this) {
                $documentosCreado->setFormulario(null);
            }
        }

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    
}
