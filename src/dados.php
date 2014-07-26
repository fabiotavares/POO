<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 25/07/14
 * Time: 12:49
 */

require_once("Cliente.php");

//Criando array com 10 objetos de Cliente
$clientes = [
    1 => new Cliente("Fabio Tavares", "fabio@gmail.com", "111.111.111-11", "25/10/1972",
            "Rua Jose Grillo", 52, "centro", "Espera Feliz", "MG", "(32) 1111-1111"),

    2 => new Cliente("Raquel Garcia Tavares", "raquel@gmail.com", "222.222.222-22", "03/12/1973",
            "Rua Gregorio", 135, "centro", "Carangola", "MG", "(47) 2222-2222"),

    3 => new Cliente("Gabriela Garcia", "gabi@hotmail.com", "444.123.432-11", "30/07/2003",
            "Rua dos Estudantes", 25, "centro", "Caiana", "MG", "(56) 1111-3333"),

    4 => new Cliente("Rafael Pinheiro", "rafa@uol.com.br", "123.123.345-22", "22/02/2006",
            "Av dos Andradas", 13, "Serra", "Belo Horizonte", "MG", "(11) 2222-4444"),

    5 => new Cliente("Sandro Pereira", "sanira@gmail.com", "678.543.211-23", "25/04/1980",
            "Pça da Bandeira", 78, "Sete", "Rio de Janeiro", "RJ", "(33) 2323-5555"),

    6 => new Cliente("Gustavo Deboçan", "tavinho@gmail.com", "678.876.890-34", "12/10/1987",
            "Faz dos Lopes, ZR", 0, "Estrela", "Cachoeiro do Itapemirim", "ES", "(23) 1234-4321"),

    7 => new Cliente("Dayane Pinheiro", "dayoinheiro@gmail.com", "333.444.555-66", "23/09/2000",
            "Rua dos Perdidos", 567, "Campestre", "Muriaé", "MG", "(11) 3456-6543"),

    8 => new Cliente("Marília Tavares", "mtavares@gmail.com", "231.456.222-35", "04/11/1969",
            "Rua Sem Saída", 111, "centro", "Itaperuna", "RJ", "(21) 5678-9876"),

    9 => new Cliente("Rosalina Breder", "rosalina@gmail.com", "567.333.222-22", "09/12/1977",
            "Rua Brilhante", 234, "centro", "Sorocaba", "SP", "(14) 6547-7334"),

    10 => new Cliente("Maria Lucia", "mlucia@gmail.com", "234.123.765.-59", "23/04/1934",
            "Rua Paulo Afonso", 1234, "Patronato", "Leopoldina", "MG", "(34) 3445-3333")
];