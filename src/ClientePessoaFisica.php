<?php

require_once("Cliente.php");
require_once("iCliente.php");
require_once("iEndereco.php");

class ClientePessoaFisica extends Cliente implements iCliente, iEndereco
{
    protected $nome;
    protected $sexo;
    protected $cpf;
    protected $nascimento;

    //implementação das interfaces

    //interface iCliente

    public function imprimeCliente()
    {
        //imprime todos os atributos do cliente (pessoa física) em uma tabela
        echo "<table class='table table-condensed'>";
        echo "<tr><td style='text-align: right'>ID: </td><td>".$this->getId()."</td></tr>";
        echo "<tr><td style='text-align: right'>Nome: </td><td>".$this->getNome()."</td></tr>";
        echo "<tr><td style='text-align: right'>Sexo: </td><td>".$this->getSexo()."</td></tr>";
        echo "<tr><td style='text-align: right'>CPF: </td><td>".$this->getCpf()."</td></tr>";
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
        return "Pessoa Física";
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

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setNascimento($nascimento)
    {
        $this->nascimento = $nascimento;
        return $this;
    }

    public function getNascimento()
    {
        return $this->nascimento;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
        return $this;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

}
