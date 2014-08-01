<?php
session_start();

//arquivo auxiliar
//seta valor para variável de sessão responsável por persistir a ordem
if(isset($_REQUEST['ordem'])) {
    $_SESSION['ordem'] = $_REQUEST['ordem'];
} else {
    unset($_SESSION['ordem']);
}

header("Location: /");