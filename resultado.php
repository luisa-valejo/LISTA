
<?php
function h($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}

function dinheiro($valor) {
    return 'R$ ' . number_format((float)$valor, 2, ',', '.');
}

$numero = isset($_POST['exercicio']) ? (int)$_POST['exercicio'] : 0;

$classes = [
    9 => 'Exercicio9',
    10 => 'Exercicio10',
    11 => 'Exercicio11',
    12 => 'Exercicio12',
    13 => 'Exercicio13',
    14 => 'Exercicio14',
    15 => 'Exercicio15',
    16 => 'Exercicio16',
    17 => 'Exercicio17'
];

$titulos = [
    9 => 'Formação de Preço',
    10 => 'Plano de Internet',
    11 => 'Gestão de Pedidos',
    12 => 'Produtividade',
    13 => 'Consumo de Energia',
    14 => 'Reembolso de Despesas',
    15 => 'Desenvolvimento de Site',
    16 => 'Avaliação de Patrimônio',
    17 => 'Reserva Financeira'
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($classes[$numero])) {
    die('Exercício inválido. <a href="index.php">Voltar</a>');
}

$dados = $_POST;

foreach ($dados as $chave => $valor) {
    if (in_array($chave, ['nome', 'exercicio', 'atraso'], true)) {
        continue;
    }

    if (!is_numeric($valor) || (float)$valor < 0) {
        die('Informe valores numéricos válidos e não negativos. <a href="index.php?exercicio=' . $numero . '">Voltar</a>');
    }
}

if (in_array($numero, [9, 16], true) && trim($dados['nome'] ?? '') === '') {
    die('Informe o nome. <a href="index.php?exercicio=' . $numero . '">Voltar</a>');
}

if ($numero == 9 && (float)$dados['quantidade'] < 1) {
    die('A quantidade deve ser maior que zero.');
}

if ($numero == 11 && ((float)$dados['taxa'] > 100 || (float)$dados['desconto'] > 100)) {
    die('A taxa e o desconto devem estar entre 0% e 100%.');
}

if ($numero == 12 && ((float)$dados['horas'] <= 0 || (float)$dados['meta'] <= 0)) {
    die('As horas trabalhadas e a meta devem ser maiores que zero.');
}

if ($numero == 15 && (float)$dados['entradaPct'] > 100) {
    die('A entrada deve estar entre 0% e 100%.');
}

if ($numero == 16 && (float)$dados['desvalorizacao'] > 100) {
    die('A desvalorização não pode ultrapassar 100%.');
}

if ($numero == 17 && (float)$dados['meses'] < 1) {
    die('A quantidade de meses deve ser pelo menos 1.');
}

if ($numero == 13 && !in_array($dados['atraso'] ?? '', ['sim', 'nao'], true)) {
    die('Selecione se houve atraso.');
}

require_once __DIR__ . '/classes/' . $classes[$numero] . '.php';

$classe = $classes[$numero];
$objeto = new $classe();
$resultados = $objeto->calcular($dados);

function formatarResultado($rotulo, $valor) {
    $itensMonetarios = [
        'Custo unitário',
        'Preço de venda recomendado',
        'Faturamento estimado',
        'Lucro estimado',
        'Valor adicional',
        'Total mensal',
        'Total com aumento de consumo',
        'Subtotal dos pratos',
        'Subtotal das bebidas',
        'Subtotal das sobremesas',
        'Subtotal dos produtos',
        'Taxa de serviço',
        'Desconto',
        'Valor total',
        'Valor pago',
        'Troco',
        'Valor restante',
        'Pagamento variável',
        'Bônus',
        'Total a receber',
        'Custo de energia',
        'Taxas adicionais',
        'Multa por atraso',
        'Total com redução de consumo de 15%',
        'Economia estimada',
        'Reembolso por quilometragem',
        'Total das despesas',
        'Valor permitido para reembolso',
        'Valor excedente não reembolsável',
        'Custo de desenvolvimento',
        'Custo adicional das páginas',
        'Valor da entrada',
        'Saldo restante',
        'Cada uma das 3 parcelas após a entrada',
        'Valor de compra',
        'Desvalorização por ano',
        'Perda acumulada',
        'Valor residual estimado',
        'Total investido inicialmente',
        'Total de aportes realizados',
        'Saldo final com rendimentos',
        'Total estimado de rendimentos',
        'Objetivo financeiro',
        'Diferença em relação à meta'
    ];

    if (in_array($rotulo, $itensMonetarios, true) && is_numeric($valor)) {
        return dinheiro($valor);
    }

    return is_scalar($valor) ? (string)$valor : '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - <?= h($titulos[$numero]) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main class="container">
    <section class="card">
        <h1>Resultado do Exercício <?= $numero ?></h1>
        <h2><?= h($titulos[$numero]) ?></h2>

        <dl>
            <?php foreach ($resultados as $rotulo => $valor) { ?>
                <div class="resultado">
                    <dt><?= h($rotulo) ?></dt>
                    <dd><?= h(formatarResultado($rotulo, $valor)) ?></dd>
                </div>
            <?php } ?>
        </dl>

        <a class="botao-secundario" href="index.php?exercicio=<?= $numero ?>">
            Voltar ao exercício
        </a>

        <a class="botao-secundario" href="index.php">
            Menu principal
        </a>
    </section>
</main>

</body>
</html>
