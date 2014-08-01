<?php
session_start();

//arquivo auxiliar
//seta valor para variável de sessão responsável por persistir a cliente selecionado
if(isset($_REQUEST['id'])) {
    $_SESSION['id'] = $_REQUEST['id'];
} else {
    unset($_SESSION['id']);
}

header("Location: /");