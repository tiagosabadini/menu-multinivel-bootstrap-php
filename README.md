Menu-Multinivel
===============
Menu com vários subníveis adaptado para trabalhar com o Bootstrap 2.2.1


Exemplo
-------

    require('Menu.php'); 

    Menu simples sem submenu
    $menu = new Menu();
    $menu->novoItem("Principal", "home.php")
         ->novoItem("Fornecedor", "fornecedor.php")
         ->novoItem("Clientes", "cliente.php")->appendMenu();



    Menu com submenu
    $menu = new Menu();
    $menu->novoItem("Principal", "home.php")
         ->novoItem("Fornecedor", "fornecedor.php")
         ->novoItem("Clientes")->appendMenu();

     $menu->novoItem("Ativos", "clientes-ativos.php")->appendSubmenu();
