<?php

namespace FT\Cliente;

abstract class ClienteAbstract implements iEndereco
{
    protected $id;
    protected $email;
    protected $telefone;
    protected $enderecoPrincipal;
    protected $enderecoCobranca = null; //endereço de cobrança pode ser nulo
    protected $enderecosIguais = true; //diz se endereco e enderecoCobranca são iguais
    protected $classe = 1; //1, 2, 3, 4 ou 5 estrelas (valor inicial padrão = 1)

    /*getters e setters:
    ********************************************************************/

    public function setClasse($classe)
    {
        //validação
        if(is_integer($classe) && ($classe > 0) && ( $classe <= 5)) {
            $this->classe = $classe;
        }
        return $this;
    }

    public function getClasse()
    {
        return $this->classe;
    }

    //retorna a classe do cliente representada por 5 ícones de estrelas (cheias e vazias)
    public function getClasseStars()
    {
        //imprime as estrelas cheias passadas no parâmetro
        $estrelas = $this->getClasse();
        $nota = "";
        for($i=1; $i<= $estrelas; $i++) {
            $nota .= "<i class='icon-star'></i>";
        }
        //imprime as estrelas vazias, se houver
        for($i=$estrelas+1; $i<=5; $i++) {
            $nota .= "<i class='icon-star-empty'></i>";
        }

        return $nota;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEnderecoPrincipal($endereco)
    {
        $this->enderecoPrincipal = $endereco;
        return $this;
    }

    public function getEnderecoPrincipal()
    {
        return $this->enderecoPrincipal;
    }

    public function setEnderecoCobranca($endereco)
    {
        $this->enderecoCobranca = $endereco;
        return $this;
    }

    public function getEnderecoCobranca()
    {
        return $this->enderecoCobranca;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setEnderecosIguais($enderecosIguais)
    {
        //validação
        if(is_bool($enderecosIguais)) {
            $this->enderecosIguais = $enderecosIguais;
        }
        return $this;
    }

    public function getEnderecosIguais()
    {
        return $this->enderecosIguais;
    }


    /* métodos abstratos
    ********************************************************************/

    abstract public function getNome(); //retorna o nome do cliente ou a razão social, conforme o caso
    abstract public function getTipoCliente(); //retorna possoa física ou jurídica
    abstract public function imprimeCliente(); //imprime todos os atributos do cliente
    abstract public function promoveCliente(); //incrementa uma estrela
    abstract public function rebaixaCliente(); //decrementa uma estrela


    /*implementação da interface iEndereco
    ********************************************************************/

    public function imprimeEnderecoPrincipal()
    {
        $this->getEnderecoPrincipal()->imprimeEndereco();
    }

    public function imprimeEnderecoCobranca()
    {
        $this->getEnderecoCobranca()->imprimeEndereco();
    }

    public function getTipoEnderecoPrincipal()
    {
        return $this->getEnderecoPrincipal()->getTipo();
    }

    public function getTipoEnderecoCobranca()
    {
        return $this->getEnderecoCobranca()->getTipo();
    }

} 