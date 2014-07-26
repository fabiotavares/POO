<?php

require_once("src/dados.php");

//obtém a url sem cliente selecionado, mantendo ordenação anterior
$urlSemCliente = function () //retorna a url sem cliente, mantendo a ordem se houver
{
    if (isset($_REQUEST['ordem']) && !is_null(isset($_REQUEST['ordem']))) {
        return '/?ordem=' . $_REQUEST['ordem'];
    } else {
        return '/';
    }
};

//obtém a url com o cliente selecionado, mantendo ordenação anterior
$urlComCliente = function ($cliente) //retorna a url sem cliente, mantendo a ordem se houver
{
    if (isset($_REQUEST['ordem']) && !is_null(isset($_REQUEST['ordem']))) {
        return "/?ordem={$_REQUEST['ordem']}&clt={$cliente}";
    } else {
        return "/?clt={$cliente}";
    }
};

//obtém url com a ordenação desejada, mantendo o cliente selecionado se houver
function urlOrdenada($ordem)
{
    if (isset($_REQUEST['clt']) && !is_null(isset($_REQUEST['clt']))) {
        echo "/?ordem={$ordem}&clt={$_REQUEST['clt']}";
    } else {
        echo "/?ordem={$ordem}";
    }
}

//ordena o array conforme parâmetros passados via GET
if (isset($_REQUEST['ordem'])) {
    if ($_REQUEST['ordem'] == 'decrescente') {
        krsort($clientes);
    } else {
        ksort($clientes);
    }
} else {
    ksort($clientes);//ordem padrão: crescente
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Orientação a Objetos 1 - Fábio Tavares</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>

<div class="container">

    <div class="hero-unit">
        <h1>Orientação a Objetos</h1>
        <h3>Manipulação de objetos em um array com PHP</h3>
    </div>

    <body>
        <h2>Tabela de Clientes</h2>

        <a href="<?php urlOrdenada('crescente') ?>" class="btn btn-small btn-primary disabled">Crescente</a>
        <a href="<?php urlOrdenada('decrescente') ?>" class="btn btn-small btn-primary disabled">Decrescente</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
                <?php
                //exibe cada cliente do array, exibindo todos os dados para o cliente selecionado
                foreach ($clientes as $indice => $cliente) {
                    if (isset($_REQUEST['clt']) && ($_REQUEST['clt'] == $indice)) {
                        echo "<tr class='info'>";
                        echo "<td>{$indice}</td>";
                        echo "<td>";
                        //imprime dados do cliente
                        $cliente->imprimir();
                        echo "</td>";
                        echo "<td><a href='{$urlSemCliente()}'>Ocultar</a></td>";
                        echo "</tr>";
                    } else {
                        echo "<tr>";
                        echo "<td>" . $indice . "</td>";
                        echo "<td>{$cliente->nome}</td>";
                        echo "<td><a href='{$urlComCliente($indice)}'>Exibir</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table
    </body>
</div>

</html>