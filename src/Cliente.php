<?php

class Cliente
{
    protected $id;
    protected $email;
    protected $telefone;
    protected $enderecoPrincipal;
    protected $enderecoCobranca = null; //endereço de cobrança pode ser nulo
    protected $enderecosIguais = true; //diz se endereco e enderecoCobranca são iguais
    protected $classe = 1; //1, 2, 3, 4 ou 5 estrelas (valor inicial padrão = 1)

    //getters e setters:

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


} 