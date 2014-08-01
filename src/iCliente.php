<?php

interface iCliente
{
    public function getNome(); //retorna o nome do cliente ou a razão social, conforme o caso
    public function getTipoCliente(); //retrona possoa física ou jurídica
    public function promoveCliente(); //incrementa uma estrela
    public function rebaixaCliente(); //decrementa uma estrela
    public function imprimeCliente(); //imprime todos os atributos do cliente
} 