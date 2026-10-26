
<?php
class Exercicio9
{
    public function calcular(array $d): array
    {
        $custo = (float)$d['custoCompra'] + (float)$d['custoAdicional'];

        $preco = $custo * (1 + (float)$d['percentualLucro'] / 100);

        $quantidade = (int)$d['quantidade'];

        $faturamento = $preco * $quantidade;

        $lucro = ($preco - $custo) * $quantidade;

        return [
            'Nome do produto' => $d['nome'],
            'Custo unitário' => $custo,
            'Preço de venda recomendado' => $preco,
            'Faturamento estimado' => $faturamento,
            'Lucro estimado' => $lucro,
            'Alerta' => $lucro > 0
                ? 'Venda com lucro estimado positivo.'
                : 'Atenção: não haverá lucro com essa margem.'
        ];
    }
}
