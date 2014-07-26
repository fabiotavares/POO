<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 25/07/14
 * Time: 10:40
 */
session_start();

require_once("src/dados.php");

if (isset($_REQUEST['ordem'])) {
    if ($_REQUEST['ordem'] == 'decrescente') {
        krsort($clientes);
    } else {
        ksort($clientes);
    }
} else {
    ksort($clientes);
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
        <h2>Orientação a Objetos</h2>
        <p>Manipulação de objetos em um array com PHP</p>
    </div>

    <body>
    <form class="navbar-form" role="searchForm" name="form1" method="get">
        <fieldset>
            <legend>Tabela de Clientes</legend>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ação</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach($clientes as $indice => $cliente) {
                    if (isset($_REQUEST['clt']) && ($_REQUEST['clt'] == $indice)) {
                        echo "<tr class='info'>";
                        echo "<td>{$indice}</td>";
                        echo "<td>";
                        $cliente->imprimir();
                        echo "</td>";
                        echo "<td>{$cliente->email}</td>";
                        echo "<td><a href='/'>Ocultar</a></td>";
                        echo "</tr>";
                    } else {
                        echo "<tr>";
                        echo "<td>".$indice."</td>";
                        echo "<td>{$cliente->nome}</td>";
                        echo "<td>{$cliente->email}</td>";
                        echo "<td><a href='?clt=".$indice."'>Exibir</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
                </tbody>
            </table>

            <input type="submit" name="ordem" value="crescente" class="btn btn-primary">
            <input type="submit" name="ordem" value="decrescente" class="btn btn-primary">
        </fieldset>
    </form>

    </body>

</div>

</html>