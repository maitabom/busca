<?php
require_once 'search.php';

$resultado = array();
$json = json_decode(file_get_contents('filtro.json'));
$search = new Search('produtos.csv');
$resultado = $search->items($json->codigo);

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
        
    </fieldset>
</form>

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
</font>
</body>
</html>