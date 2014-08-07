<?php

namespace FT\Cliente;

class Endereco
{
    protected $tipo; //1=casa, 2=apartamento, 3=comercial, 4=outros
    protected $logradouro;
    protected $numero;
    protected $bairro;
    protected $cep;
    protected $cidade;
    protected $estado;

    /*getters e setters:
    ********************************************************************/

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
        return $this;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
        return $this;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
        return $this;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setTipo($tipo)
    {
        //validando...
        if(is_integer($tipo) && ($tipo > 0) && ($tipo <= 5)) {
            $this->tipo = $tipo;
        }
        return $this;
    }

    public function getTipo()
    {
        switch ($this->tipo) {
            case 1:
                return "Casa";
                break;
            case 2:
                return "Apartamento";
                break;
            case 3:
                return "Comercial";
                break;
            default:
                return "Outros";
        }
    }

    public function imprimeEndereco()
    {
        echo $this->getTipo()."<br/>";
        echo $this->getLogradouro().", num. ".$this->getNumero()."<br/>";
        echo $this->getBairro().", ".$this->getCidade()."/".$this->getEstado()."<br/>";
        echo "CEP ".$this->getCep()."<br/>";
    }
} 