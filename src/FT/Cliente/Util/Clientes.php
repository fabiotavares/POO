<?php

namespace FT\Cliente\Util;

use \FT\Cliente\Types\ClientePessoaFisica;
use \FT\Cliente\Types\ClientePessoaJuridica;
use \FT\Cliente\Endereco;

trait Clientes
{
    public static function getClientes(\PDO $conn, $ordem)
    {
        //prepara a sql correspondente à ordem definida
        switch($ordem) {
            case 'idc':
                $sql = "SELECT * FROM clientes ORDER BY id ASC;";
                break;
            case 'idd':
                $sql = "SELECT * FROM clientes ORDER BY id DESC;";
                break;
            case 'nomec': //select para ordenar por nome e razao_social de forma crescente
                $sql = "SELECT *, nome as ordem from clientes where not isnull(nome) UNION
                SELECT *, razao_social as ordem from clientes where not isnull(razao_social)
                ORDER BY ordem ASC";
                break;
            case 'nomed': //select para ordenar por nome e razao_social de forma decrescente
                $sql = "SELECT *, nome as ordem from clientes where not isnull(nome) UNION
                SELECT *, razao_social as ordem from clientes where not isnull(razao_social)
                ORDER BY ordem DESC";
                break;
            case 'tipoc':
                $sql = "SELECT * FROM clientes ORDER BY cnpj ASC;";
                break;
            case 'tipod':
                $sql = "SELECT * FROM clientes ORDER BY cnpj DESC;";
                break;
            case 'classec':
                $sql = "SELECT * FROM clientes ORDER BY classe ASC;";
                break;
            case 'classed':
                $sql = "SELECT * FROM clientes ORDER BY classe DESC;";
                break;
            default:
                $sql = "SELECT * FROM clientes ORDER BY id ASC;";
        }

        //executa a query
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $registros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        //gerando um array ordenado de objetos com o resultado obtido
        $clientes = [];
        foreach($registros as $registro) {
            //cria o endereço principal (se existir)
            if(isset($registro['end_principal'])) {
                $endPrincipal = self::getEndereco($conn, $registro['end_principal']);
            } else {
                $endPrincipal = null;
            }
            //cria o endereço de cobrança (se existir)
            if(isset($registro['end_cobranca'])) {
                $endCobranca = self::getEndereco($conn, $registro['end_cobranca']);
            } else {
                $endCobranca = null;
            }

            //cria o objeto cliente pf ou pj
            if(isset($registro['nome'])) { //pessoa física
                $cliente = new ClientePessoaFisica();
                $cliente
                    ->setNome($registro['nome'])
                    ->setCpf($registro['cpf'])
                    ->setNascimento($registro['nascimento'])
                    ->setSexo($registro['sexo']);
            } else { //pessoa jurídica
                $cliente = new ClientePessoaJuridica();
                $cliente
                    ->setRazaoSocial($registro['razao_social'])
                    ->setCnpj($registro['cnpj']);
            }
            //seta atributos em comum
            $cliente
                ->setId($registro['id'])
                ->setEmail($registro['email'])
                ->setEnderecoPrincipal($endPrincipal)
                ->setEnderecoCobranca($endCobranca)
                ->setEnderecosIguais($registro['end_iguais'])
                ->setTelefone($registro['telefone'])
                ->setClasse($registro['classe']);

            //insere o objeto cliente no array
            $clientes[] = $cliente;
        }
        //retorna o array de cliente devidamente ordenado
        return $clientes;
    }

    public static function getEndereco(\PDO $conn, $id)
    {
        //retorna um objeto do tipo Endereco com os dados do id passado
        $sql = "SELECT * FROM enderecos WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $end = $stmt->fetch(\PDO::FETCH_ASSOC);
        $endereco = new Endereco();
        $endereco
            ->setTipo($end['tipo'])
            ->setLogradouro($end['logradouro'])
            ->setNumero($end['numero'])
            ->setBairro($end['bairro'])
            ->setCep($end['cep'])
            ->setCidade($end['cidade'])
            ->setEstado($end['estado']);

        return $endereco;
    }
} 