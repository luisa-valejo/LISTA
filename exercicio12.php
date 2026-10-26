
<?php
class Exercicio12
{
    public function calcular(array $d): array
    {
        $pecas = (int)$d['pecas'];
        $horas = (float)$d['horas'];
        $meta = (float)$d['meta'];
        $valorPeca = (float)$d['valorPeca'];

        $produtividade = $pecas / $horas;
        $esperada = $meta * $horas;

        $percentual = ($pecas / $esperada) * 100;

        $pagamento = $pecas * $valorPeca;

        $bonus = $percentual >= 120
            ? $pagamento * 0.10
            : 0;

        return [
            'Produtividade por hora' => number_format($produtividade, 2, ',', '.') . ' peças/hora',
            'Produção esperada' => number_format($esperada, 2, ',', '.') . ' peças',
            'Percentual da meta atingida' => number_format($percentual, 2, ',', '.') . '%',
            'Pagamento variável' => $pagamento,
            'Bônus' => $bonus,
            'Total a receber' => $pagamento + $bonus,
            'Alerta' => $percentual >= 120
                ? 'Meta superada em pelo menos 20%: bônus concedido.'
                : ($pecas >= $esperada
                    ? 'Meta atingida.'
                    : 'Meta não atingida.')
        ];
    }
}
