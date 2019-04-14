<?php

$resultado = array();

if (isset($_POST['codigo']) && !empty($_POST['codigo'])) {
    require_once 'search.php';
    $search = new Search('produtos.csv');

    $resultado = $search->item($_POST['codigo']);
}
?>
<!doctype html>
<html>
<head>
    <title>Mario Loucas - Consulta de Preco</title>
</head>
<body>
<img src="consulta.png">
<font face=Arial>
<form method="post" action="index.php">
    <fieldset>
        <legend>Consulta de Preços - <b>Mário Louças</b></legend>
        <label>
            Código (em <font color=red><b>vermelho</font></b> no Catálogo):
            <input type="text" name="codigo" value=""/>
        </label>
        <input type="submit" value="Consultar...">
    </fieldset>
</form>

<?php if (isset($_POST['codigo'])): ?>
    <h1>Resultado de Busca</h1>
    <?php if (!empty($resultado)): ?>
        <table border="1">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Fabricante</th>
                <th>Medida</th>
                <th>Preço</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($resultado as $item): ?>
                <tr>
                    <td><?= $item->codigo ?></td>
                    <td><?= $item->nome ?></td>
                    <td><?= $item->fabricante ?></td>
                    <td><?= $item->medida ?></td>
                    <td>R$ <?= $item->preco ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p><h3><b><font color=red>Código não encontrado - verifique se foi digitado corretamente</font></b></h3></p>
    <?php endif; ?>
<?php endif; ?>
</font>
</body>
</html>