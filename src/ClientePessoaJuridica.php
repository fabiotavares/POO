<?php

require_once("Cliente.php");
require_once("iCliente.php");
require_once("iEndereco.php");

class ClientePessoaJuridica extends Cliente implements iCliente, iEndereco
{
    protected $razaoSocial;
    protected $cnpj;

    //implementação das interfaces

    //interface iCliente

    public function getNome()
    {
        return $this->getRazaoSocial();
    }

    public function imprimeCliente()
    {
        //imprime todos os atributos do cliente (pessoa jurídica) em uma tabela
        echo "<table class='table table-condensed'>";
        echo "<tr><td style='text-align: right'>ID: </td><td>".$this->getId()."</td></tr>";
        echo "<tr><td style='text-align: right'>Razão Social: </td><td>".$this->getRazaoSocial()."</td></tr>";
        echo "<tr><td style='text-align: right'>CNPJ: </td><td>".$this->getCnpj()."</td></tr>";
        echo "<tr><td style='text-align: right'>Email: </td><td>".$this->getEmail()."</td></tr>";
        echo "<tr><td style='text-align: right'>Telefone: </td><td>".$this->getTelefone()."</td></tr>";
        echo "<tr><td style='text-align: right'>Classe: </td><td>".$this->getClasse()." estrelas</td></tr>";
        echo "<tr><td style='text-align: right; vertical-align: top'>Endereço Principal: </td><td>";
        $this->imprimeEnderecoPrincipal();
        echo "</td></tr>";
        echo "<tr><td style='text-align: right; vertical-align: top'>Endereço de Cobrança: </td>";
        if($this->getEnderecosIguais())
        {
            echo "<td>igual ao endereço principal</td></tr></table>";
        } else
        {
            echo "<td>";
            $this->imprimeEnderecoCobranca();
            echo "</td></tr></table>";
        }
    }

    public function getTipoCliente()
    {
        return "Pessoa Jurídica";
    }

    public function promoveCliente()
    {
        $classe = parent::getClasse() + 1;
        return parent::setClasse($classe);
    }

    public function rebaixaCliente()
    {
        $classe = parent::getClasse() - 1;
        return parent::setClasse($classe);
    }

    //interface iEndereco

    public function imprimeEnderecoPrincipal()
    {
        parent::getEnderecoPrincipal()->imprimeEndereco();
    }

    public function imprimeEnderecoCobranca()
    {
        parent::getEnderecoCobranca()->imprimeEndereco();
    }

    public function getTipoEnderecoPrincipal()
    {
        return parent::getEnderecoPrincipal()->getTipo();
    }

    public function getTipoEnderecoCobranca()
    {
        return parent::getEnderecoCobranca()->getTipo();
    }

    //getters e setters

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
        return $this;
    }

    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }
} 