
<?php
class Exercicio13
{
    public function calcular(array $d): array
    {
        $consumo = (float)$d['consumo'];
        $precoKwh = (float)$d['precoKwh'];
        $taxa = (float)$d['taxa'];
        $multa = (float)$d['multa'];

        $atraso = ($d['atraso'] ?? 'nao') === 'sim';

        $custoEnergia = $consumo * $precoKwh;
        $multaAplicada = $atraso ? $multa : 0;

        $total = $custoEnergia + $taxa + $multaAplicada;

        $consumoReduzido = $consumo * 0.85;
        $energiaReduzida = $consumoReduzido * $precoKwh;

        $totalReduzido = $energiaReduzida + $taxa + $multaAplicada;
        $economia = $total - $totalReduzido;

        return [
            'Custo de energia' => $custoEnergia,
            'Taxas adicionais' => $taxa,
            'Multa por atraso' => $multaAplicada,
            'Valor total' => $total,
            'Total com redução de consumo de 15%' => $totalReduzido,
            'Economia estimada' => $economia,
            'Alerta' => $atraso
                ? 'Multa incluída por atraso.'
                : 'Sem multa por atraso.'
        ];
    }
}
