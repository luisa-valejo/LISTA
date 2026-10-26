
<?php
class Exercicio14
{
    public function calcular(array $d): array
    {
        $km = (float)$d['km'];
        $porKm = (float)$d['porKm'];
        $alimentacao = (float)$d['alimentacao'];
        $hospedagem = (float)$d['hospedagem'];
        $outros = (float)$d['outros'];
        $limite = (float)$d['limite'];

        $quilometragem = $km * $porKm;

        $total = $quilometragem
            + $alimentacao
            + $hospedagem
            + $outros;

        $permitido = min($total, $limite);
        $excedente = max(0, $total - $limite);

        return [
            'Reembolso por quilometragem' => $quilometragem,
            'Total das despesas' => $total,
            'Valor permitido para reembolso' => $permitido,
            'Valor excedente não reembolsável' => $excedente,
            'Alerta' => $excedente > 0
                ? 'As despesas ultrapassaram o limite de reembolso.'
                : 'As despesas estão dentro do limite.'
        ];
    }
}
