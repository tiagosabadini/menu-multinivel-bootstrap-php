Menu-Multinivel
===============
Menu com vários subníveis adaptado para trabalhar com o Bootstrap 2.2.1

Utilize qualquer customização do Bootstrap e jQuery UI

## Estrutura
A estrutura básica para que o menu funcione.

Lembrando que você pode usar qualquer customização do bootstrap ou tema do jquery-ui e pode adaptar a estrutura conforme
as necessidades do seu projeto também.

```
|-- bootstrap/
|   |-- bootstrap.min.css
|   |-- bootstrap.min.js
|-- img/
|   |-- glyphicons-halflings-white.png
|   |-- glyphicons-halflings.png
|-- jquery-ui/
|   |-- css/
|   |-- js/
|-- js/
|   |-- jquery-1.10.1.min.js
|-- Menu.php
|-- menu.phtml
`-- menuMultinivel.css
```

### Exemplo de Menu simples sem submenu
```
require('Menu.php'); 
$menu = new Menu();
$menu->novoItem("Principal", "home.php")
     ->novoItem("Fornecedor", "fornecedor.php")
     ->novoItem("Clientes", "cliente.php")->addMenu();
```

### Menu com submenu
```
require('Menu.php');
$menu = new Menu();
$menu->novoItem("Principal", "home.php")
     ->novoItem("Fornecedor", "fornecedor.php")
     ->novoItem("Clientes")->addMenu();

 $menu->novoItem("Ativos", "clientes-ativos.php")->addSubmenu();
```

### Menu com submenu e vários níveis
```
require('Menu.php');
$menu = new Menu();
$menu->novoItem("Principal", "home.php")
     ->novoItem("Fornecedor", "fornecedor.php")
     ->novoItem("Clientes")->addMenu();

$menu->novoItem("Ativos", "clientes-ativos.php")->addSubmenu();

$menu->novoItem("Outros Anos")->addSubmenu();
$menu->novoItem("2013", "clientes-2013.php")
     ->novoItem("2012", "clientes-2012.php")->addSubmenu();
```

