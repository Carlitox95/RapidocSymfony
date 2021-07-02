<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=DocumentoRepository::class)
*/
class Documento {

  
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
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;
    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $plantilla;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $codigo;  


    /**
     * @ORM\ManyToOne(targetEntity=Formulario::class, inversedBy="documentos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formulario;

    /**
     * @ORM\ManyToOne(targetEntity=Persona::class, inversedBy="documentos")
     */
    private $persona;

   

   
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPlantilla(): ?string
    {
        return $this->plantilla;
    }

    public function setPlantilla(string $plantilla): self
    {
        $this->plantilla = $plantilla;

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }
    
    

    public function getFormulario(): ?formulario
    {
        return $this->formulario;
    }

    public function setFormulario(?formulario $formulario): self
    {
        $this->formulario = $formulario;

        return $this;
    }

    public function getPersona(): ?persona
    {
        return $this->persona;
    }

    public function setPersona(?persona $persona): self
    {
        $this->persona = $persona;

        return $this;
    }

   


}
