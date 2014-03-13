Menu-Multinivel
===============
Menu com vários subníveis adaptado para trabalhar com o Bootstrap 2.2.1


### Exemplo de Menu simples sem submenu
```
require('Menu.php'); 
$menu = new Menu();
$menu->novoItem("Principal", "home.php")
     ->novoItem("Fornecedor", "fornecedor.php")
     ->novoItem("Clientes", "cliente.php")->appendMenu();
```

### Menu com submenu
```
require('Menu.php');
$menu = new Menu();
$menu->novoItem("Principal", "home.php")
     ->novoItem("Fornecedor", "fornecedor.php")
     ->novoItem("Clientes")->appendMenu();

 $menu->novoItem("Ativos", "clientes-ativos.php")->appendSubmenu();
```

### Menu com submenu e vários níveis
```
require('Menu.php');
$menu = new Menu();
$menu->novoItem("Principal", "home.php")
     ->novoItem("Fornecedor", "fornecedor.php")
     ->novoItem("Clientes")->appendMenu();

$menu->novoItem("Ativos", "clientes-ativos.php")->appendSubmenu();

$menu->novoItem("Outros Anos")->appendSubmenu();
$menu->novoItem("2013", "clientes-2013.php")
     ->novoItem("2012", "clientes-2012.php")->appendSubmenu();
```