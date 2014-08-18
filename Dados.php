<?php

use \FT\Cliente\ClienteAbstract;
use \FT\Cliente\Types\ClientePessoaFisica;
use \FT\Cliente\Types\ClientePessoaJuridica;
use \FT\Cliente\Endereco;

class Dados
{
    private $conn;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    //persiste um objeto de cliente no banco de dados
    public function persistCliente(ClienteAbstract $cliente)
    {
        try {
            //verifica o tipo de cliente passado e monta a sql de acordo
            if($cliente instanceof ClientePessoaFisica) {
                $sql = "INSERT INTO clientes (nome, email, cpf, nascimento, sexo, end_principal, end_cobranca, end_iguais, telefone, classe)
                       VALUES (:nome, :email, :cpf, :nascimento, :sexo, :end_principal, :end_cobranca, :end_iguais, :telefone, :classe);";
                $stmt = $this->conn->prepare($sql);
                $nome = $cliente->getNome();
                $stmt->bindParam('nome', $nome);
                $cpf = $cliente->getCpf();
                $stmt->bindParam('cpf', $cpf);
                $nascimento = $cliente->getNascimento();
                $stmt->bindParam('nascimento', $nascimento);
                $sexo = $cliente->getSexo();
                $stmt->bindParam('sexo', $sexo);
            } else {
                $sql = "INSERT INTO clientes (razao_social, email, cnpj, end_principal, end_cobranca, end_iguais, telefone, classe)
                       VALUES (:razao_social, :email, :cnpj, :end_principal, :end_cobranca, :end_iguais, :telefone, :classe);";
                $stmt = $this->conn->prepare($sql);
                $rsocial = $cliente->getRazaoSocial();
                $stmt->bindParam('razao_social', $rsocial);
                $cnpj = $cliente->getCnpj();
                $stmt->bindParam('cnpj', $cnpj);
            }
            //seta valores em comum de pf e pj
            $email = $cliente->getEmail();
            $stmt->bindParam('email', $email);
            $endi = $cliente->getEnderecosIguais();
            $stmt->bindParam('end_iguais', $endi);
            $tel = $cliente->getTelefone();
            $stmt->bindParam('telefone', $tel);
            $classe = $cliente->getClasse();
            $stmt->bindParam('classe', $classe);
            //cadastra os endereços existentes para o cliente
            $endp = $cliente->getEnderecoPrincipal();
            if(isset($endp)) {
                //cadastro o endereço, obtendo o id gerado automaticamente
                $id1 = $this->persistEndereco($cliente->getEnderecoPrincipal());
            } else {
                $id1 = null;
            }
            $stmt->bindParam('end_principal', $id1);

            $endc = $cliente->getEnderecoCobranca();
            if(isset($endc)) {
                //cadastro o endereço, obtendo o id gerado automaticamente
                $id2 = $this->persistEndereco($cliente->getEnderecoCobranca());
            } else {
                $id2 = null;
            }
            $stmt->bindParam('end_cobranca', $id2);

            //insere o cliente
            $stmt->execute();

        } catch (\Exception $ex) {
            die("Erro de persistência de cliente<br />Código: ".$ex->getCode()."<br />Mensagem: ".$ex->getMessage());
        }
    }

    //persiste um objeto de endereco no banco de dados
    public function persistEndereco(Endereco $endereco)
    {
        try {
            //prepara a sql
            $sql = "INSERT INTO enderecos (tipo, logradouro, numero, bairro, cep, cidade, estado)
                   VALUES (:tipo, :logradouro, :numero, :bairro, :cep, :cidade, :estado);";
            $stmt = $this->conn->prepare($sql);

            $tipo = $endereco->getTipoInt();
            $stmt->bindParam('tipo', $tipo);

            $log = $endereco->getLogradouro();
            $stmt->bindParam('logradouro', $log);

            $num = $endereco->getNumero();
            $stmt->bindParam('numero', $num);

            $bairro = $endereco->getBairro();
            $stmt->bindParam('bairro', $bairro);

            $cep = $endereco->getCep();
            $stmt->bindParam('cep', $cep);

            $cidade = $endereco->getCidade();
            $stmt->bindParam('cidade', $cidade);

            $uf = $endereco->getEstado();
            $stmt->bindParam('estado', $uf);

            //cadastra o endereço
            $stmt->execute();
            //retorna o id gerado automaticamente
            return $this->conn->lastInsertId();

        } catch (\Exception $ex) {
            die("Erro de persistência de endereço<br />Código: ".$ex->getCode()."<br />Mensagem: ".$ex->getMessage());
        }
    }

    //cadastra dez clientes no banco de dados para testes
    public function flush()
    {
        try {

            //...................................................CLIENTE 01 (FÍSICA)
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
                ->setNome("Fabio Tavares")
                ->setEmail("fabio@gmail.com")
                ->setCpf("111.111.111-11")
                ->setNascimento("25/10/1972")
                ->setSexo("Masculino")
                ->setTelefone("(32) 1111-1111")
                ->setEnderecoPrincipal($endereco1)
                ->setEnderecoCobranca($endereco2)
                ->setEnderecosIguais(0) //endereco de cobranca é diferente
                ->setClasse(5);

            //persistindo cliente no banco de dados
            $this->persistCliente($cliente);

            //...................................................CLIENTE 02 (FÍSICA)
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
                ->setNome("Raquel Garcia Tavares")
                ->setEmail("raquel@gmail.com")
                ->setCpf("222.222.222-22")
                ->setNascimento("03/12/1973")
                ->setSexo("Feminino")
                ->setTelefone("(47) 2222-2222")
                ->setEnderecoPrincipal($endereco1)
                ->setClasse(4);

            //persistindo cliente no banco de dados
            $this->persistCliente($cliente);

            //...................................................CLIENTE 03 (FÍSICA)
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
                ->setNome("Gabriela Garcia")
                ->setEmail("gabi@hotmail.com")
                ->setCpf("444.123.432-11")
                ->setNascimento("30/07/2003")
                ->setSexo("Feminino")
                ->setTelefone("(56) 1111-3333")
                ->setEnderecoPrincipal($endereco1)
                ->setClasse(4);

            //persistindo cliente no banco de dados
            $this->persistCliente($cliente);

            //...................................................CLIENTE 04 (FÍSICA)
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
                ->setNome("Rafael Garcia Tavares")
                ->setEmail("rafa@uol.com.br")
                ->setCpf("123.123.345-22")
                ->setNascimento("22/02/2006")
                ->setSexo("Masculino")
                ->setTelefone("(11) 2222-4444")
                ->setEnderecoPrincipal($endereco1)
                ->setEnderecoCobranca($endereco2)
                ->setEnderecosIguais(0) //endereco de cobranca é diferente
                ->setClasse(5);

            //persistindo cliente no banco de dados
            $this->persistCliente($cliente);

            //...................................................CLIENTE 05 (FÍSICA)
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
                ->setNome("Sandro Pereira")
                ->setEmail("sanira@gmail.com")
                ->setCpf("678.543.211-23")
                ->setNascimento("25/04/1980")
                ->setSexo("M")
                ->setTelefone("(33) 2323-5555")
                ->setEnderecoPrincipal($endereco1)
                ->setEnderecoCobranca($endereco2)
                ->setEnderecosIguais(0) //endereco de cobranca diferente do endereco principal
                ->setClasse(1);

            //persistindo cliente no banco de dados
            $this->persistCliente($cliente);

            //...................................................CLIENTE 06 (JURÍDICA)
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
                ->setRazaoSocial("Comércio de Café Ltda")
                ->setEmail("ccafe@gmail.com")
                ->setCnpj("11.234.567/001-23")
                ->setTelefone("(65) 7654-9876")
                ->setEnderecoPrincipal($endereco1)
                ->setEnderecoCobranca($endereco2)
                ->setEnderecosIguais(0) //endereco de cobranca é diferente
                ->setClasse(2);

            //persistindo cliente no banco de dados
            $this->persistCliente($cliente);

            //...................................................CLIENTE 07 (JURÍDICA)
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
                ->setRazaoSocial("Papelaria Traço Fino SA")
                ->setEmail("tracofino@yahoo.com.br")
                ->setCnpj("34.444.222/001-24")
                ->setTelefone("(31) 2222-1111")
                ->setEnderecoPrincipal($endereco1)
                ->setClasse(5);

            //persistindo cliente no banco de dados
            $this->persistCliente($cliente);

            //...................................................CLIENTE 08 (JURÍDICA)
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
                ->setRazaoSocial("Padaria 100 Pão")
                ->setEmail("paochique@gmail.com")
                ->setCnpj("33.222.111/001-76")
                ->setTelefone("(32) 3741-1111")
                ->setEnderecoPrincipal($endereco1)
                ->setClasse(3);

            //persistindo cliente no banco de dados
            $this->persistCliente($cliente);

            //...................................................CLIENTE 09 (JURÍDICA)
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
                ->setRazaoSocial("Açougue Dois Irmãos")
                ->setEmail("carnedura@gmail.com")
                ->setCnpj("44.234.678/001-22")
                ->setTelefone("(21) 92222-1111")
                ->setEnderecoPrincipal($endereco1)
                ->setClasse(1);

            //persistindo cliente no banco de dados
            $this->persistCliente($cliente);

            //...................................................CLIENTE 10 (JURÍDICA)
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
                ->setRazaoSocial("Informática Fácil")
                ->setEmail("infofacil@gmail.com")
                ->setCnpj("87.345.098/004-09")
                ->setTelefone("(45) 1234-4321")
                ->setEnderecoPrincipal($endereco1)
                ->setClasse(3);

            //persistindo cliente no banco de dados
            $this->persistCliente($cliente);

        } catch (\Exception $ex) {
            die("Erro de persistência<br />Código: ".$ex->getCode()."<br />Mensagem: ".$ex->getMessage());
        }
    }

}
