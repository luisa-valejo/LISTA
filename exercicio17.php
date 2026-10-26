
<?php
class Exercicio17
{
    public function calcular(array $d): array
    {
        $inicial = (float)$d['inicial'];
        $aporte = (float)$d['aporte'];
        $taxa = (float)$d['taxa'] / 100;
        $meses = (int)$d['meses'];
        $objetivo = (float)$d['objetivo'];

        $saldo = $inicial;

        for ($i = 1; $i <= $meses; $i++) {
            $saldo = $saldo * (1 + $taxa);
            $saldo = $saldo + $aporte;
        }

        $totalAportes = $aporte * $meses;
        $totalInvestido = $inicial + $totalAportes;

        $rendimentos = $saldo - $totalInvestido;
        $diferenca = $saldo - $objetivo;

        return [
            'Total investido inicialmente' => $inicial,
            'Total de aportes realizados' => $totalAportes,
            'Saldo final com rendimentos' => $saldo,
            'Total estimado de rendimentos' => $rendimentos,
            'Objetivo financeiro' => $objetivo,
            'Diferença em relação à meta' => abs($diferenca),
            'Situação da meta' => $diferenca >= 0
                ? 'Meta atingida ou superada.'
                : 'Ainda falta para atingir a meta.'
        ];
    }
}
