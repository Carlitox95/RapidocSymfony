<?php

namespace App\Entity;

use App\Repository\F575RTRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=F575RTRepository::class)
 */
class F575RT
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
    private $apellido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $anio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cuitcuil;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cuitcuilEmpleador;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diferenciaContribuciones;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $interesesResarcitorios;

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

    public function getMes(): ?string
    {
        return $this->mes;
    }

    public function setMes(string $mes): self
    {
        $this->mes = $mes;

        return $this;
    }

    public function getAnio(): ?string
    {
        return $this->anio;
    }

    public function setAnio(string $anio): self
    {
        $this->anio = $anio;

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

    public function getCuitcuilEmpleador(): ?string
    {
        return $this->cuitcuilEmpleador;
    }

    public function setCuitcuilEmpleador(string $cuitcuilEmpleador): self
    {
        $this->cuitcuilEmpleador = $cuitcuilEmpleador;

        return $this;
    }

    public function getDiferenciaContribuciones(): ?string
    {
        return $this->diferenciaContribuciones;
    }

    public function setDiferenciaContribuciones(?string $diferenciaContribuciones): self
    {
        $this->diferenciaContribuciones = $diferenciaContribuciones;

        return $this;
    }

    public function getInteresesResarcitorios(): ?string
    {
        return $this->interesesResarcitorios;
    }

    public function setInteresesResarcitorios(?string $interesesResarcitorios): self
    {
        $this->interesesResarcitorios = $interesesResarcitorios;

        return $this;
    }
}
