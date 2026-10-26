
<?php
class Exercicio10
{
    public function calcular(array $d): array
    {
        $consumo = (float)$d['consumo'];
        $franquia = (float)$d['franquia'];
        $mensalidade = (float)$d['mensalidade'];
        $valorGb = (float)$d['valorGb'];

        $dentroFranquia = min($consumo, $franquia);
        $excedente = max(0, $consumo - $franquia);

        $adicional = $excedente * $valorGb;
        $total = $mensalidade + $adicional;

        $consumoMaior = $consumo * 1.20;
        $excedenteMaior = max(0, $consumoMaior - $franquia);
        $totalMaior = $mensalidade + ($excedenteMaior * $valorGb);

        return [
            'Consumo mensal' => number_format($consumo, 2, ',', '.') . ' GB',
            'Consumo dentro da franquia' => number_format($dentroFranquia, 2, ',', '.') . ' GB',
            'Quantidade excedente' => number_format($excedente, 2, ',', '.') . ' GB',
            'Valor adicional' => $adicional,
            'Total mensal' => $total,
            'Consumo com aumento de 20%' => number_format($consumoMaior, 2, ',', '.') . ' GB',
            'Total com aumento de consumo' => $totalMaior,
            'Alerta' => $excedente > 0
                ? 'O consumo ultrapassou a franquia.'
                : 'O consumo está dentro da franquia.'
        ];
    }
}
