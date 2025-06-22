<?php
include_once '../backend/conexaoCliente.php';
// Buscar todas as bandas distintas
$bandas = [];
$resBandas = $conn->query("SELECT DISTINCT banda FROM produtos WHERE banda IS NOT NULL AND banda <> '' ORDER BY banda ASC");
if ($resBandas && $resBandas->num_rows > 0) {
    while ($b = $resBandas->fetch_assoc()) {
        $bandas[] = $b['banda'];
    }
}
?>
<link rel="stylesheet" href="../assets/css/filtro.css">
<form method="GET" class="filtro_form">
    <h2>Filtro</h2>
    <span>Pesquisa</span>

    <input type="text" name="busca" placeholder="Buscar por nome..." value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>">
    <div class="filtro_ordem">
        <span>Ordenar por:</span>
        <label>
            <input type="checkbox" name="ordem[]" value="preco_asc" <?php if (isset($_GET['ordem']) && in_array('preco_asc', (array)$_GET['ordem'])) echo 'checked'; ?>>
            <span>Preço crescente</span>
        </label>
        <label>
            <input type="checkbox" name="ordem[]" value="preco_desc" <?php if (isset($_GET['ordem']) && in_array('preco_desc', (array)$_GET['ordem'])) echo 'checked'; ?>>
            <span>Preço decrescente</span>
        </label>
        <label>
            <input type="checkbox" name="ordem[]" value="nome_asc" <?php if (isset($_GET['ordem']) && in_array('nome_asc', (array)$_GET['ordem'])) echo 'checked'; ?>>
            <span>Nome A-Z</span>
        </label>
        <label>
            <input type="checkbox" name="ordem[]" value="nome_desc" <?php if (isset($_GET['ordem']) && in_array('nome_desc', (array)$_GET['ordem'])) echo 'checked'; ?>>
            <span>Nome Z-A</span>
        </label>
    </div>
    <label>
        Banda:
        <select name="banda">
            <option value="">Todas</option>
            <?php foreach ($bandas as $banda): ?>
                <option value="<?php echo htmlspecialchars($banda); ?>" <?php if (isset($_GET['banda']) && $_GET['banda'] === $banda) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($banda); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit">Filtrar</button>
</form>