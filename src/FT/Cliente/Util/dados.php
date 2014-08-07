<?php

use FT\Cliente\Types\ClientePessoaFisica;
use FT\Cliente\Types\ClientePessoaJuridica;
use FT\Cliente\Endereco;

//Criando 10 objetos clientes (pessoa física e jurídica) e inserindo em um array para manipulação
//..............................................................................................
function getClientes()
{
    //..............................................................................................CLIENTE 01 (FÍSICA)
    $cliente = new ClientePessoaFisica();
    $endereco1 = new Endereco();
    $endereco2 = new Endereco();

    $endereco1
        ->setTipo(2) //apartamento
        ->setLogradouro("Rua Jose Grillo")
        ->setNumero(52)
        ->setBairro("Centro")
        ->setCidade("Espera Feliz")
        ->setEstado("MG")
        ->setCep("36830-000");

    $endereco2
        ->setTipo(1) //casa
        ->setLogradouro("Rua Gregorio Duarte")
        ->setNumero(135)
        ->setBairro("Centro")
        ->setCidade("Espera Feliz")
        ->setEstado("MG")
        ->setCep("36830-000");

    $cliente
        ->setId(1)
        ->setNome("Fabio Tavares")
        ->setEmail("fabio@gmail.com")
        ->setCpf("111.111.111-11")
        ->setNascimento("25/10/1972")
        ->setSexo("Masculino")
        ->setTelefone("(32) 1111-1111")
        ->setEnderecoPrincipal($endereco1)
        ->setEnderecoCobranca($endereco2)
        ->setEnderecosIguais(false) //endereco de cobranca é diferente
        ->setClasse(5);

    //inserindo cliente no array
    $clientes = [$cliente]; //primeiro elemento

    //..............................................................................................CLIENTE 02 (FÍSICA)
    $cliente = new ClientePessoaFisica();
    $endereco1 = new Endereco(); //apenas um endereço cadastrado = cobrança

    $endereco1
        ->setTipo(1) //casa
        ->setLogradouro("Rua Gregorio Antônio")
        ->setNumero(135)
        ->setBairro("Centro")
        ->setCidade("Carangola")
        ->setEstado("MG")
        ->setCep("36880-000");

    $cliente
        ->setId(2)
        ->setNome("Raquel Garcia Tavares")
        ->setEmail("raquel@gmail.com")
        ->setCpf("222.222.222-22")
        ->setNascimento("03/12/1973")
        ->setSexo("Feminino")
        ->setTelefone("(47) 2222-2222")
        ->setEnderecoPrincipal($endereco1)
        ->setClasse(4);

    //inserindo cliente no array
    array_push($clientes, $cliente);

    //..............................................................................................CLIENTE 03 (FÍSICA)
    $cliente = new ClientePessoaFisica();
    $endereco1 = new Endereco();

    $endereco1
        ->setTipo(4) //outros
        ->setLogradouro("Rua dos Estudantes")
        ->setNumero(25)
        ->setBairro("Centro")
        ->setCidade("Caiana")
        ->setEstado("MG")
        ->setCep("37845-970");

    $cliente
        ->setId(3)
        ->setNome("Gabriela Garcia")
        ->setEmail("gabi@hotmail.com")
        ->setCpf("444.123.432-11")
        ->setNascimento("30/07/2003")
        ->setSexo("Feminino")
        ->setTelefone("(56) 1111-3333")
        ->setEnderecoPrincipal($endereco1)
        ->setClasse(4);

    //inserindo cliente no array
    array_push($clientes, $cliente);

    //..............................................................................................CLIENTE 04 (FÍSICA)
    $cliente = new ClientePessoaFisica();
    $endereco1 = new Endereco();
    $endereco2 = new Endereco();

    $endereco1
        ->setTipo(2) //apartamento
        ->setLogradouro("Av dos Andradas")
        ->setNumero(13)
        ->setBairro("Serra")
        ->setCidade("Belo Horizonte")
        ->setEstado("MG")
        ->setCep("34876-345");

    $endereco2
        ->setTipo(3) //comercial
        ->setLogradouro("Rua das Travessas")
        ->setNumero(1234)
        ->setBairro("Claudio Afonso")
        ->setCidade("Guaçuí")
        ->setEstado("ES")
        ->setCep("23456-765");

    $cliente
        ->setId(4)
        ->setNome("Rafael Garcia Tavares")
        ->setEmail("rafa@uol.com.br")
        ->setCpf("123.123.345-22")
        ->setNascimento("22/02/2006")
        ->setSexo("Masculino")
        ->setTelefone("(11) 2222-4444")
        ->setEnderecoPrincipal($endereco1)
        ->setEnderecoCobranca($endereco2)
        ->setEnderecosIguais(false) //endereco de cobranca é diferente
        ->setClasse(5);

    //inserindo cliente no array
    array_push($clientes, $cliente);

    //..............................................................................................CLIENTE 05 (FÍSICA)
    $cliente = new ClientePessoaFisica();
    $endereco1 = new Endereco();
    $endereco2 = new Endereco();

    $endereco1
        ->setTipo(4) //outros
        ->setLogradouro("Pça da Bandeira")
        ->setNumero(78)
        ->setBairro("Sete de Setembro")
        ->setCidade("Rio de Janeiro")
        ->setEstado("RJ")
        ->setCep("09865-890");

    $endereco2
        ->setTipo(1) //casa
        ->setLogradouro("Pça dos Songamongas")
        ->setNumero(76)
        ->setBairro("Perdido")
        ->setCidade("Viçosa")
        ->setEstado("MG")
        ->setCep("39098-789");

    $cliente
        ->setId(5)
        ->setNome("Sandro Pereira")
        ->setEmail("sanira@gmail.com")
        ->setCpf("678.543.211-23")
        ->setNascimento("25/04/1980")
        ->setSexo("M")
        ->setTelefone("(33) 2323-5555")
        ->setEnderecoPrincipal($endereco1)
        ->setEnderecoCobranca($endereco2)
        ->setEnderecosIguais(false) //endereco de cobranca diferente do endereco principal
        ->setClasse(1);

    //inserindo cliente no array
    array_push($clientes, $cliente);

    //..............................................................................................CLIENTE 06 (JURÍDICA)
    $cliente = new ClientePessoaJuridica();
    $endereco1 = new Endereco();
    $endereco2 = new Endereco();

    $endereco1
        ->setTipo(3) //comercial
        ->setLogradouro("Rua das Congregações")
        ->setNumero(1234)
        ->setBairro("Jardim Florido")
        ->setCidade("São Paulo")
        ->setEstado("SP")
        ->setCep("11234-098");

    $endereco2
        ->setTipo(3) //comercial
        ->setLogradouro("Av das Marias")
        ->setNumero(234)
        ->setBairro("Centro")
        ->setCidade("Marília")
        ->setEstado("SP")
        ->setCep("45098-476");

    $cliente
        ->setId(10)
        ->setRazaoSocial("Comércio de Café Ltda")
        ->setEmail("ccafe@gmail.com")
        ->setCnpj("11.234.567/001-23")
        ->setTelefone("(65) 7654-9876")
        ->setEnderecoPrincipal($endereco1)
        ->setEnderecoCobranca($endereco2)
        ->setEnderecosIguais(false) //endereco de cobranca é diferente
        ->setClasse(2);

    //inserindo cliente no array
    array_push($clientes, $cliente);

    //..............................................................................................CLIENTE 07 (JURÍDICA)
    $cliente = new ClientePessoaJuridica();
    $endereco1 = new Endereco();

    $endereco1
        ->setTipo(3) //comercial
        ->setLogradouro("Av dos Coqueiros")
        ->setNumero(34)
        ->setBairro("Prado")
        ->setCidade("Belo Horizonte")
        ->setEstado("MG")
        ->setCep("45623-000");

    $cliente
        ->setId(9)
        ->setRazaoSocial("Papelaria Traço Fino SA")
        ->setEmail("tracofino@yahoo.com.br")
        ->setCnpj("34.444.222/001-24")
        ->setTelefone("(31) 2222-1111")
        ->setEnderecoPrincipal($endereco1)
        ->setClasse(5);

    //inserindo cliente no array
    array_push($clientes, $cliente);

    //..............................................................................................CLIENTE 08 (JURÍDICA)
    $cliente = new ClientePessoaJuridica();
    $endereco1 = new Endereco();

    $endereco1
        ->setTipo(4) //outros
        ->setLogradouro("Rua dos Periquitos Voadores")
        ->setNumero(234)
        ->setBairro("Centro")
        ->setCidade("Carangola")
        ->setEstado("MG")
        ->setCep("36880-000");

    $cliente
        ->setId(8)
        ->setRazaoSocial("Padaria 100 Pão")
        ->setEmail("paochique@gmail.com")
        ->setCnpj("33.222.111/001-76")
        ->setTelefone("(32) 3741-1111")
        ->setEnderecoPrincipal($endereco1)
        ->setClasse(3);

    //inserindo cliente no array
    array_push($clientes, $cliente);

    //..............................................................................................CLIENTE 09 (JURÍDICA)
    $cliente = new ClientePessoaJuridica();
    $endereco1 = new Endereco();

    $endereco1
        ->setTipo(3) //comercial
        ->setLogradouro("Rua das Indústrias")
        ->setNumero(98)
        ->setBairro("Centro")
        ->setCidade("Manhumirim")
        ->setEstado("MG")
        ->setCep("36330-040");

    $cliente
        ->setId(7)
        ->setRazaoSocial("Açougue Dois Irmãos")
        ->setEmail("carnedura@gmail.com")
        ->setCnpj("44.234.678/001-22")
        ->setTelefone("(21) 92222-1111")
        ->setEnderecoPrincipal($endereco1)
        ->setClasse(1);

    //inserindo cliente no array
    array_push($clientes, $cliente);

    //..............................................................................................CLIENTE 10 (JURÍDICA)
    $cliente = new ClientePessoaJuridica();
    $endereco1 = new Endereco();

    $endereco1
        ->setTipo(3) //comercial
        ->setLogradouro("Av das Bruxas")
        ->setNumero(234)
        ->setBairro("Centro")
        ->setCidade("Caracas")
        ->setEstado("PR")
        ->setCep("33445-000");

    $cliente
        ->setId(6)
        ->setRazaoSocial("Informática Fácil")
        ->setEmail("infofacil@gmail.com")
        ->setCnpj("87.345.098/004-09")
        ->setTelefone("(45) 1234-4321")
        ->setEnderecoPrincipal($endereco1)
        ->setClasse(3);

    //inserindo cliente no array
    array_push($clientes, $cliente);

    //..............................................................................................FIM DADOS
    return $clientes;
}

//função que verifica a precedência de dois clientes,
//com base no atributo passado na $_SESSION['ordem']
function verificador($cliente1, $cliente2)
{
    //valores padrão: ordenação crescente pelo nome
    $valor1 = $cliente1->getNome();
    $valor2 = $cliente2->getNome();
    $crescente = 1;

    //verifica se existe uma solicitação de classificação
    if (isset($_REQUEST['ord'])) {
        //descobre a ordem solicitada
        switch($_REQUEST['ord'])
        {
            case 'idc':
                $valor1 = $cliente1->getId();
                $valor2 = $cliente2->getId();
                break;
            case 'idd':
                $valor1 = $cliente1->getId();
                $valor2 = $cliente2->getId();
                $crescente = -1;
                break;
            case 'nomed':
                $crescente = -1;
                break;
            case 'tipoc':
                $valor1 = $cliente1->getTipoCliente();
                $valor2 = $cliente2->getTipoCliente();
                break;
            case 'tipod':
                $valor1 = $cliente1->getTipoCliente();
                $valor2 = $cliente2->getTipoCliente();
                $crescente = -1;
                break;
            case 'classec':
                $valor1 = $cliente1->getClasse();
                $valor2 = $cliente2->getClasse();
                break;
            case 'classed':
                $valor1 = $cliente1->getClasse();
                $valor2 = $cliente2->getClasse();
                $crescente = -1;
        }
    }

    //calcula a relação de precedência
    if ($valor1 < $valor2) {
        return -1 * $crescente;
    } elseif ($valor1 > $valor2) {
        return 1 * $crescente;
    }
    return 0;
}




