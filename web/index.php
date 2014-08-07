<?php

define('CLASS_DIR', '../src/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register();

require_once('../src/FT/Cliente/Util/dados.php');
$clientes = getClientes();
usort($clientes, 'verificador');

function setOrdem($ord)
{
    //monte a url com as variáveis ord e id, conforme a necessidade
    if(is_null($ord)) {
        $url = "/";
    } else {
        $url = "/?ord=".$ord;
    }
    //verifica se há cliente selecionado
    if(isset($_REQUEST['id'])) {
        if($url == "/") {
            $url .= "?id=".$_REQUEST['id'];
        } else {
            $url .= "&id=".$_REQUEST['id'];
        }
    }

    return $url;
}

function setCliente($id)
{
    //monte a url com as variáveis ord e id, conforme a necessidade
    if(is_null($id)) {
        $url = "/";
    } else {
        $url = "/?id=".$id;
    }
    //verifica se há ordem selecionada
    if(isset($_REQUEST['ord'])) {
        if($url == "/") {
            $url .= "?ord=".$_REQUEST['ord'];
        } else {
            $url .= "&ord=".$_REQUEST['ord'];
        }
    }

    return $url;
}

//se a ordem passada como parâmetro for a ordem corrente
//deve-se retornar um ícone de checado
function isOrdemSelecionada($ord)
{
    if(isset($_REQUEST['ord']) && ($_REQUEST['ord'] == $ord)) {
        echo "class='alert-success'";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"/>
    <title>POO - Code.Education</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.7.1.min.js"><\/script>')</script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</head>

<div class="container">
    <body>
    <div class="hero-unit">
        <h2>PHP: Programação Orientada a Objetos</h2>
        <h2><small>Projeto Fase 3 - Fábio Tavares</small></h2>
    </div>

    <div class="page-header" style="margin-bottom: 10px">
        <h4>Tabela de Clientes</h4>
    </div>

    <div class="btn-group pull-right" style="margin-bottom: 20px">
        <button class="btn dropdown-toggle btn-info" data-toggle="dropdown">Ordenar Por
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="<?php echo setOrdem('idc'); ?>" <?php echo isOrdemSelecionada('idc'); ?>>Id (crescente)</a></li>
            <li><a href="<?php echo setOrdem('idd'); ?>" <?php echo isOrdemSelecionada('idd'); ?>>Id (decrescente)</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo setOrdem('nomec'); ?>" <?php echo isOrdemSelecionada('nomec'); ?>>Nome (crescente)</a></li>
            <li><a href="<?php echo setOrdem('nomed'); ?>" <?php echo isOrdemSelecionada('nomed'); ?>>Nome (decrescente)</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo setOrdem('tipoc'); ?>" <?php echo isOrdemSelecionada('tipoc'); ?>>Tipo (crescente)</a></li>
            <li><a href="<?php echo setOrdem('tipod'); ?>" <?php echo isOrdemSelecionada('tipod'); ?>>Tipo (decrescente)</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo setOrdem('classec'); ?>" <?php echo isOrdemSelecionada('classec'); ?>>Classe (crescente)</a></li>
            <li><a href="<?php echo setOrdem('classed'); ?>" <?php echo isOrdemSelecionada('classed'); ?>>Classe (decrescente)</a></li>
        </ul>
    </div>

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
            if(isset($_REQUEST['id']) && ($_REQUEST['id'] == $cliente->getId())) {
                //imprime a linha com uma cor de destaque
                echo "<tr class='success'>\n<td>".$cliente->getId()."</td>\n";
                //imprime nome do cliente
                echo "<td><b><a href='".setCliente(null)."'>".$cliente->getNome()."</a></b><br/>";
                //imprime cadastro completo do cliente
                $cliente->imprimeCliente();
                echo "</td>\n";
            } else {
                echo "<tr>\n<td>".$cliente->getId()."</td>\n";
                //imprime nome do cliente com link para seu id
                $link = setCliente($cliente->getId());
                echo "<td><a href='{$link}'>{$cliente->getNome()}</a></td>\n";
            }

            echo "<td>".$cliente->getTipoCliente()."</td>\n";
            echo "<td>".$cliente->getClasseStars()."</td>\n</tr>\n";
        }
        ?>
        </tbody>
    </table

    <script type="text/javascript" src="js/bootstrap.js"></script>
    </body>
</div>


</html>