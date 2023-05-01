<?php
namespace Models;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contato")
 */
class Contato
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $tipo;

    /**
     * @ORM\Column(type="string")
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="Pessoa", inversedBy="contato")
     * @ORM\JoinColumn(name="idPessoa", referencedColumnName="id")
     */
    private $pessoa;

    public function getId()
    {
        return $this->id;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getPessoa()
    {
        return $this->pessoa;
    }

    public function setPessoa($pessoa)
    {
        $this->pessoa = $pessoa;
    }
}
