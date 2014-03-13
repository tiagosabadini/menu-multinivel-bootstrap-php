<!DOCTYPE html>
<html>
    <head>
        <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
        <link href="menuMultinivel.css" rel="stylesheet">
        <link type="text/css" href="jquery-ui/css/smoothness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />



        <meta charset=utf-8 />
        <title>Menu Multinível com Bootstrap 2 e PHP</title>
        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-6212749-13', 'tiagosabadini.com.br');
            ga('send', 'pageview');

        </script>
    </head>
    <body>
        <?php require('Menu.php'); ?>
        <div class="container">
            <h2>Menu Multinível com Bootstrap 2 e PHP</h2>
            <div class="row">
                <div class="span12">
                    <?php
                        $menu = new Menu();
                        $menu->novoItem("Principal", "home.php")
                             ->novoItem("Fornecedor", "fornecedor.php")
                             ->novoItem("Clientes")
                                ->appendMenu();
                        
                        $menu->novoItem("Novo", "novoCliente.php")
                             ->novoItem("Listar")
                                ->appendSubmenu();
                                
                                $menu->novoItem("Ativos", "listarClienteAtivo.php")
                                     ->novoItem("Bloqueados")
                                        ->appendSubmenu();
                                
                                $menu->novoItem("2013", "bloqueados2013.php")
                                     ->novoItem("2014", "bloqueados2014.php")
                                        ->appendSubmenu();
										
										
				$menu->novoItem("Ativos 2")->appendMenu();
                                $menu->novoItem("Bloqueados")->appendSubmenu();
                        
                        echo $menu->getMenu();
                    ?>
                </div>
            </div>
        </div>


        <script src="js/jquery-1.10.1.min.js" type="text/javascript"></script>
        <script src="jquery-ui/js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>