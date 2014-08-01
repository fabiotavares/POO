<?php

interface iEndereco 
{
    public function imprimeEnderecoPrincipal(); //imprime endereço principal completo
    public function imprimeEnderecoCobranca(); //imprime endereço cobrança completo
    public function getTipoEnderecoPrincipal(); //1=casa, 2=apartamento, 3=comercial, 4=outros
    public function getTipoEnderecoCobranca(); //1=casa, 2=apartamento, 3=comercial, 4=outros
}