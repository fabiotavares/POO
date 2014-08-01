<?php
session_start();

require_once("src/dados.php");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>POO - Code.Education</title>
    <meta charset="UTF-8"/>
    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
</head>

<div class="container">

    <div class="hero-unit">
        <h3>PHP: Programação Orientada a Objetos</h3>
        <h4>Projeto Fase 2 - Fábio Tavares</h4>
    </div>

    <body>

        <form method="get" action="src/page/ordena_lista.php">
            <fieldset>
                <legend>Tabela de Clientes</legend>
                <label>Ordenar por:
                <select name="ordem" onchange="form.submit();">
                    <option value="id_c" <?php getSelected('id_c'); ?>>Id (crescente)</option>
                    <option value="id_d" <?php getSelected('id_d'); ?>>Id (decrescente)</option>
                    <option value="nome_c" <?php getSelected('nome_c'); ?>>Nome (crescente)</option>
                    <option value="nome_d" <?php getSelected('nome_d'); ?>>Nome (decrescente)</option>
                    <option value="tipo_c" <?php getSelected('tipo_c'); ?>>Tipo (crescente)</option>
                    <option value="tipo_d" <?php getSelected('tipo_d'); ?>>Tipo (decrescente)</option>
                    <option value="classe_c" <?php getSelected('classe_c'); ?>>Classe (crescente)</option>
                    <option value="classe_d" <?php getSelected('classe_d'); ?>>Classe (decrescente)</option>
                </select></label>
            </fieldset>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Classe</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    //exibe cada cliente do array, exibindo todos os dados para o cliente selecionado
                    foreach ($clientes as $cliente) {
                        //verifica se deve exibir cadastro completo
                        if(isset($_SESSION['id']) && ($_SESSION['id'] == $cliente->getId())) {
                            //imprime a linha com uma cor de destaque
                            echo "<tr class='success'><td>".$cliente->getId()."</td>";
                            //imprime nome do cliente
                            echo "<td><b><a href='src/page/seleciona_cliente.php'>".$cliente->getNome()."</a></b><br/>";
                            //imprime cadastro completo do cliente
                            $cliente->imprimeCliente();
                            echo "</td>";
                        } else {
                            echo "<tr><td>".$cliente->getId()."</td>";
                            //imprime nome do cliente com link para seu id
                            echo "<td><a href='src/page/seleciona_cliente.php?id=".$cliente->getId()."'>".$cliente->getNome()."</a></td>";
                        }

                        echo "<td>".$cliente->getTipoCliente()."</td>";
                        echo "<td>".getEstrelas($cliente->getClasse())."</td></tr>";
                    }
                ?>
            </tbody>
        </table
    </body>
</div>

</html>