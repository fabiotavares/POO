<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 25/07/14
 * Time: 10:31
 */

class Cliente {
    public $nome;
    public $email;
    public $cpf;
    public $nascimento;
    public $endereco;
    public $numero;
    public $bairro;
    public $cidade;
    public $estado;
    public $telefone;

    //construtor
    public function __construct($nome, $email, $cpf, $nascimento, $endereco, $numero, $bairro, $cidade, $estado, $telefone)
    {
        //inicialização dos atributos
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->nascimento = $nascimento;
        $this->endereco = $endereco;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->telefone = $telefone;
    }

    //método que imprime atributos do cliente
    public function imprimir()
    {
        echo "<strong>".$this->nome."</strong>";
        echo "<table class='table table-condensed'>";

        echo "<tr><td>Email: </td>";
        echo "<td>{$this->email}</td></tr>";

        echo "<tr><td>CPF: </td>";
        echo "<td>{$this->cpf}</td></tr>";

        echo "<tr><td>Nascimento: </td>";
        echo "<td>{$this->nascimento}</td></tr>";

        echo "<tr><td>Endereço: </td>";
        echo "<td>{$this->endereco}, n° {$this->numero}</td></tr>";

        echo "<tr><td>Bairro: </td>";
        echo "<td>{$this->bairro}</td></tr>";

        echo "<tr><td>Cidade/UF: </td>";
        echo "<td>{$this->cidade}/{$this->estado}</td></tr>";

        echo "<tr><td>Telefone: </td>";
        echo "<td>{$this->telefone}</td></tr>";

        echo "</table>";
    }
} 