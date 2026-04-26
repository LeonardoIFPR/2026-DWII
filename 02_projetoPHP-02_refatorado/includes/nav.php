<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 04 — PHP para Web: Formulários, GET e POST
  Autor      : Leonardo Garbuio
  Data       : 15/03/2026
  Caminho    : /workspaces/2026-DWII/includes/nav.php
-->
<?php
if (!isset($pagina_atual)) $pagina_atual = "";
if (!isset($caminho_raiz)) $caminho_raiz = "./";

function menu_class($item, $atual){
    return ($item === $atual) ? 'class="ativo"' : "";
}

$logado = isset($_SESSION["usuario"]);
?>

<nav>
    <div class="nav-esquerda">
        <a href="<?php echo $caminho_raiz?>index.php" <?php echo menu_class("inicio", $pagina_atual); ?>>
            Inicio
        </a>
        <a href="<?php echo $caminho_raiz?>sobre.php" <?php echo menu_class("sobre", $pagina_atual); ?>>
            Sobre
        </a>
        <a href="<?php echo $caminho_raiz?>projetos.php" <?php echo menu_class("projetos", $pagina_atual); ?>>
            Projetos
        </a>
        <a href="<?php echo $caminho_raiz?>contato.php" <?php echo menu_class("contato", $pagina_atual); ?>>
            Contato
        </a>    
        <a href="<?php echo $caminho_raiz?>index.php" <?php echo menu_class("Catalogo", $pagina_atual); ?>>
            Catalogo
        </a>
        <a href="<?php echo $caminho_raiz?>publico.php" <?php echo menu_class("Pagina Publica", $pagina_atual); ?>>
            Publico
        </a>
        <a href="<?php echo $caminho_raiz?>index.php" <?php echo menu_class("index", $pagina_atual); ?>>
            HUB
        </a>
    </div>

    <?php if ($logado): ?>
    
    <a href="<?php echo $caminho_raiz ?>"painel.php><?php echo menu_class("painel", $pagina_atual); ?>
    Painel
    </a>

    <a href="<?php echo $caminho_raiz; ?>"logout.php>Sair</a>

    <?php else: ?>

        <a href="<?php echo $caminho_raiz; ?>"login.php <?php echo menu_class("Login", $pagina_atual); ?>>Login</a>

    <?php endif; ?>
</nav>

