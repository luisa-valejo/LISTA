
<?php
class Exercicio15
{
    public function calcular(array $d): array
    {
        $horas = (float)$d['horas'];
        $valorHora = (float)$d['valorHora'];
        $paginas = (int)$d['paginas'];
        $valorPagina = (float)$d['valorPagina'];
        $entradaPct = (float)$d['entradaPct'];

        $custoHoras = $horas * $valorHora;
        $custoPaginas = $paginas * $valorPagina;

        $total = $custoHoras + $custoPaginas;

        $entrada = $total * $entradaPct / 100;
        $saldo = $total - $entrada;

        $resultados = [
            'Custo de desenvolvimento' => $custoHoras,
            'Custo adicional das páginas' => $custoPaginas,
            'Valor total' => $total,
            'Valor da entrada' => $entrada,
            'Saldo restante' => $saldo
        ];

        if ($total > 3000) {
            $parcelas = $saldo / 3;

            $resultados['Cada uma das 3 parcelas após a entrada'] = $parcelas;
            $resultados['Alerta'] = 'Projeto acima de R$ 3.000,00: saldo dividido em três parcelas iguais.';
        } else {
            $resultados['Alerta'] = 'Projeto de até R$ 3.000,00: não se aplica a condição de três parcelas.';
        }

        return $resultados;
    }
}
