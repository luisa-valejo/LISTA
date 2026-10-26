
<?php
$exercicios = [
    9 => 'Formação de Preço - Venda de Produtos',
    10 => 'Plano de Internet - Comparação de Planos',
    11 => 'Gestão de Pedidos - Restaurante',
    12 => 'Produtividade - Funcionário de uma Fábrica',
    13 => 'Consumo de Energia - Empresa',
    14 => 'Viagem a Trabalho - Reembolso de Despesas',
    15 => 'Contratação de Freelancer - Desenvolvimento de Site',
    16 => 'Inventário - Avaliação de Patrimônio',
    17 => 'Investimento Empresarial - Reserva Financeira'
];

$campos = [
    9 => [
        ['nome', 'Nome do produto', 'text'],
        ['custoCompra', 'Custo de compra por unidade (R$)', 'number'],
        ['custoAdicional', 'Custo adicional por unidade (R$)', 'number'],
        ['percentualLucro', 'Percentual de lucro desejado (%)', 'number'],
        ['quantidade', 'Quantidade de unidades vendidas', 'number']
    ],
    10 => [
        ['consumo', 'Consumo mensal estimado (GB)', 'number'],
        ['franquia', 'Franquia do plano (GB)', 'number'],
        ['mensalidade', 'Mensalidade (R$)', 'number'],
        ['valorGb', 'Valor por GB excedente (R$)', 'number']
    ],
    11 => [
        ['qPratos', 'Quantidade de pratos', 'number'],
        ['pPratos', 'Preço unitário dos pratos (R$)', 'number'],
        ['qBebidas', 'Quantidade de bebidas', 'number'],
        ['pBebidas', 'Preço unitário das bebidas (R$)', 'number'],
        ['qSobremesas', 'Quantidade de sobremesas', 'number'],
        ['pSobremesas', 'Preço unitário das sobremesas (R$)', 'number'],
        ['taxa', 'Taxa de serviço (%)', 'number'],
        ['desconto', 'Percentual de desconto (%)', 'number'],
        ['pago', 'Valor pago pelo cliente (R$)', 'number']
    ],
    12 => [
        ['pecas', 'Quantidade de peças produzidas', 'number'],
        ['horas', 'Horas trabalhadas', 'number'],
        ['meta', 'Meta de produção por hora', 'number'],
        ['valorPeca', 'Valor pago por peça (R$)', 'number']
    ],
    13 => [
        ['consumo', 'Consumo mensal (kWh)', 'number'],
        ['precoKwh', 'Preço por kWh (R$)', 'number'],
        ['taxa', 'Taxas adicionais (R$)', 'number'],
        ['multa', 'Multa por atraso (R$)', 'number'],
        ['atraso', 'Houve atraso no pagamento?', 'select']
    ],
    14 => [
        ['km', 'Distância percorrida (km)', 'number'],
        ['porKm', 'Valor de reembolso por quilômetro (R$)', 'number'],
        ['alimentacao', 'Gastos com alimentação (R$)', 'number'],
        ['hospedagem', 'Gastos com hospedagem (R$)', 'number'],
        ['outros', 'Outros gastos autorizados (R$)', 'number'],
        ['limite', 'Limite máximo de reembolso (R$)', 'number']
    ],
    15 => [
        ['horas', 'Quantidade de horas de desenvolvimento', 'number'],
        ['valorHora', 'Valor cobrado por hora (R$)', 'number'],
        ['paginas', 'Quantidade de páginas', 'number'],
        ['valorPagina', 'Valor adicional por página (R$)', 'number'],
        ['entradaPct', 'Percentual de entrada (%)', 'number']
    ],
    16 => [
        ['nome', 'Nome do equipamento', 'text'],
        ['valor', 'Valor de compra (R$)', 'number'],
        ['desvalorizacao', 'Desvalorização anual (%)', 'number'],
        ['anos', 'Quantidade de anos de uso', 'number']
    ],
    17 => [
        ['inicial', 'Valor inicial investido (R$)', 'number'],
        ['aporte', 'Aporte mensal (R$)', 'number'],
        ['taxa', 'Taxa de rendimento mensal (%)', 'number'],
        ['meses', 'Quantidade de meses', 'number'],
        ['objetivo', 'Objetivo financeiro (R$)', 'number']
    ]
];

function h($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}

$numero = isset($_GET['exercicio']) ? (int)$_GET['exercicio'] : 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matemática e Lógica no Mundo do Trabalho</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main class="container">

    <h1>Matemática e Lógica no Mundo do Trabalho</h1>
    <p>Escolha um exercício para preencher os dados e calcular os resultados.</p>

    <section class="menu">
        <h2>Lista de exercícios</h2>

        <div class="links">
            <?php foreach ($exercicios as $n => $titulo) { ?>
                <a class="link" href="index.php?exercicio=<?= $n ?>">
                    Exercício <?= $n ?> - <?= h($titulo) ?>
                </a>
            <?php } ?>
        </div>
    </section>

    <?php if (isset($exercicios[$numero])) { ?>

        <section class="card">
            <h2>Exercício <?= $numero ?> - <?= h($exercicios[$numero]) ?></h2>

            <form action="resultado.php" method="POST">
                <input type="hidden" name="exercicio" value="<?= $numero ?>">

                <?php foreach ($campos[$numero] as $campo) { ?>

                    <label for="<?= h($campo[0]) ?>">
                        <?= h($campo[1]) ?>
                    </label>

                    <?php if ($campo[2] == 'select') { ?>

                        <select id="<?= h($campo[0]) ?>" name="<?= h($campo[0]) ?>">
                            <option value="nao">Não</option>
                            <option value="sim">Sim</option>
                        </select>

                    <?php } else { ?>

                        <input
                            type="<?= h($campo[2]) ?>"
                            id="<?= h($campo[0]) ?>"
                            name="<?= h($campo[0]) ?>"
                            <?= $campo[2] == 'number' ? 'step="any" min="0"' : '' ?>
                            required
                        >

                    <?php } ?>

                <?php } ?>

                <button type="submit">Calcular resultado</button>
            </form>
        </section>

    <?php } ?>

</main>

</body>
</html>
