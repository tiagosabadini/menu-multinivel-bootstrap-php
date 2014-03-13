<?php

/**
 * @author Tiago Sabadini <sabadini.tiago@gmail.com>
 * @copyright (c) 2014, Tiago Sabadini
 * @version 1.5
 * 
 * Suporta Bootstrap v2.2.1
 * para montagem de menu horizontal com níveis infinitos
 * 
 */
class Menu {

    /**
     * Array com os itens do menu
     * @var array 
     */
    private $arrayMenu = array();

    /**
     * String com o menu montado
     * @var string 
     */
    private $menuMontado = "";

    /**
     * Armazena temporariamente os itens do menu
     * @var array 
     */
    private $menuTmp = array();

    /**
     * Versão do Bootstrap
     * @var int [2|3]
     */
    private $versaoBootstrap = 2;

    
    /**
     * Confirgura a versão do bootstrap que será usada
     * @param int $versao
     */
    public function setBootstrap($versao = 2) {
        if ($versao > 2) {
            $this->versaoBootstrap = 3;
        } else {
            $this->versaoBootstrap = 2;
        }
    }

    /**
     * Inclui um item de menu ao menu temporário.
     * O menu temporário é incrementado até que appendMenu seja utilizado
     * 
     * @param string $nome Nome do item, título  tag <a>
     * @param string $link Destino do item tag <a>
     * @param string $class classe do item tag <li>
     * @param string $id Identificador único do item tag <li>
     * @param string $title Título tag <a> atributo title
     * @param string $target Destino, atributo target (_parent, _blank) tag <a>
     * @param string $rel atributo rel tag <a>
     */
    public function novoItem($nome, $link = "#", $class = "", $id = "", $title = "", $target = "", $rel = "") {
        $this->menuTmp[] = array(
            'nome' => $nome,
            'link' => $link,
            'class' => ($class != "") ? "class='{$class}'" : "",
            'id' => ($id != "") ? "id='{$id}'" : "",
            'title' => ($title != "") ? "title='{$title}'" : "",
            'target' => ($target != "") ? "target='{$target}'" : "",
            'rel' => ($rel != "") ? "rel='{$rel}'" : ""
        );
        return $this;
    }

    /**
     * Recupera o conteúdo do menu temporário e
     * adiciona ao menu principal
     */
    public function addMenu() {
        foreach ($this->menuTmp as $mT) {
            $this->arrayMenu[] = $mT;
        }
        $this->menuTmp = array();
    }

    /**
     * 
     * @param array $menu
     * @param array $submenu
     */
    private function addItemSubmenu(&$menu, $submenu) {
        end($menu);
        $chave = key($menu);
        if (!isset($menu[$chave]['submenu'])) {
            $menu[$chave]['submenu'] = $submenu;
        } else {
            $this->addItemSubmenu($menu[$chave]['submenu'], $submenu);
        }
    }

    /**
     * Adiciona um item ao submenu do indice ativo do menu
     * @return \Menu
     */
    public function addSubmenu() {
        $this->addItemSubmenu($this->arrayMenu, $this->menuTmp);
        $this->menuTmp = array();
        return $this;
    }

    /**
     * Monta o menu em forma de string
     * @param array $menu
     * @param int $nivel
     * @param int $itens
     */
    public function montarMenu($menu = null, $nivel = 0, $itens = 0) {
        foreach ($menu as $mn) {
            if (isset($mn['submenu']) && !is_null($mn['submenu'])) {
                $itens = count($mn['submenu']);
                $submenu = ($nivel > 0) ? "sub-menu" : "";
                $caret = ($nivel > 0) ? " &raquo; " : "<b class='caret'></b>";
                $this->menuMontado .= "<li {$mn['id']} class='dropdown {$mn['class']}'><a href='{$mn['link']}' {$mn['rel']} {$mn['target']} {$mn['title']} class='dropdown-toggle' data-toggle='dropdown'>{$mn['nome']} {$caret}</a>\n";
                $this->menuMontado .= "   <ul class='dropdown-menu $submenu'>\n";
                $this->montarMenu($mn['submenu'], 1, $itens);
                $this->menuMontado .= "   </ul>\n";
                $this->menuMontado .= "</li>\n";
                $itens--;
                continue;
            }
            if (strcasecmp($mn['class'], 'divider') == 0) {
                $this->menuMontado .= "<li class='{$mn['class']}'> </li>\n";
            } else if (array_key_exists('link', $mn)) {
                $this->menuMontado .= "<li {$mn['id']} {$mn['class']}><a {$mn['rel']} {$mn['target']} {$mn['title']} href='{$mn['link']}'>{$mn['nome']}</a></li>\n";
            }
        }
    }

    public function getArrayMenu() {
        return $this->arrayMenu;
    }

    public function getTplItem() {
        return "<li {ID} {CLASS}><a {TITLE} {TARGET} {REL} href='{LINK}'>{NOME}</a> {SUBMENU}</li>";
    }

    public function getMenu() {
        $this->montarMenu($this->getArrayMenu());
        $tplMenu = file_get_contents("menu{$this->versaoBootstrap}.phtml");
        $menu = $this->menuMontado;
        return str_replace("{MENU}", $menu, $tplMenu);
    }

}
?>

