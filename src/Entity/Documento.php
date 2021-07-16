<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DocumentoRepository;
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
     * @ORM\ManyToOne(targetEntity=Persona::class, inversedBy="documentos")
     */
    private $persona;

  
    /**
     * @ORM\Column(type="object")
     */
    private $archivo;

    /**
     * @ORM\ManyToOne(targetEntity=Formulario::class, inversedBy="documentosCreados")
     */
    private $formulario;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ubicacion;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaCreacion;

   
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
    
    
    public function getPersona(): ?persona
    {
        return $this->persona;
    }

    public function setPersona(?persona $persona): self
    {
        $this->persona = $persona;

        return $this;
    }


    public function getArchivo()
    {
     return $this->archivo;
    }

    public function setArchivo($archivo): self
    {
     $this->archivo = $archivo;
     return $this;
    }
    
    public function __toString() {
        return strtoupper("$this->nombre");
    }

    public function getFormulario(): ?Formulario
    {
        return $this->formulario;
    }

    public function setFormulario(?Formulario $formulario): self
    {
        $this->formulario = $formulario;

        return $this;
    }

    public function getUbicacion(): ?string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(?string $ubicacion): self
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }


    /**
     * Me devuelve la ubicacion relativa al archivo
     */
    function getRuta() {        
     return "archivos/".$this->getNombre().".pdf";
    }

    /**
     * Me retorna el nombre del Archivo sin el Cuit
     */
    function getNombreCorto(){
      return substr($this->getNombre(),12);
    }



    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(?\DateTimeInterface $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }
   


}
