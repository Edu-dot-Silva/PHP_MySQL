<link rel="stylesheet" href="../assets/css/topoAdm.css">
<div class="topo_adm">
    <div></div> <!-- Div vazia para ocupar o espaço à esquerda -->
    
    <div>
        <img src="../assets/img/logo.png" alt="Logo Heavy Words" class="logo_cabecalho">
    </div>
    
    <div class="topo_direita">
        <button class="adm_icon"></button>
        <?php
        session_start();
        $nome = isset($_SESSION['admin_nome']) ? $_SESSION['admin_nome'] : 'Administrador';
        echo "Bem-vindo, $nome";
        ?>
        <a href="../backend/sairAdmin.php"><button class="adm_sair"></button></a>
    </div>
</div>
