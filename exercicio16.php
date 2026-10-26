
<?php
class Exercicio16
{
    public function calcular(array $d): array
    {
        $nome = $d['nome'];
        $valor = (float)$d['valor'];
        $percentual = (float)$d['desvalorizacao'];
        $anos = (int)$d['anos'];

        $desvalorizacaoAnual = $valor * $percentual / 100;

        $perdaAcumulada = min(
            $valor,
            $desvalorizacaoAnual * $anos
        );

        $valorResidual = max(0, $valor - $perdaAcumulada);

        $percentualPerdido = $valor > 0
            ? ($perdaAcumulada / $valor) * 100
            : 0;

        return [
            'Equipamento' => $nome,
            'Valor de compra' => $valor,
            'Desvalorização por ano' => $desvalorizacaoAnual,
            'Perda acumulada' => $perdaAcumulada,
            'Valor residual estimado' => $valorResidual,
            'Situação do equipamento' => $percentualPerdido > 50
                ? 'Perdeu mais de 50% do valor original.'
                : 'Perdeu até 50% do valor original.'
        ];
    }
}
