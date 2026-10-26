
<?php
class Exercicio11
{
    public function calcular(array $d): array
    {
        $pratos = (int)$d['qPratos'] * (float)$d['pPratos'];
        $bebidas = (int)$d['qBebidas'] * (float)$d['pBebidas'];
        $sobremesas = (int)$d['qSobremesas'] * (float)$d['pSobremesas'];

        $subtotal = $pratos + $bebidas + $sobremesas;

        $taxa = $subtotal * (float)$d['taxa'] / 100;
        $desconto = $subtotal * (float)$d['desconto'] / 100;

        $total = $subtotal + $taxa - $desconto;
        $pago = (float)$d['pago'];

        return [
            'Subtotal dos pratos' => $pratos,
            'Subtotal das bebidas' => $bebidas,
            'Subtotal das sobremesas' => $sobremesas,
            'Subtotal dos produtos' => $subtotal,
            'Taxa de serviço' => $taxa,
            'Desconto' => $desconto,
            'Valor total' => $total,
            'Valor pago' => $pago,
            'Troco' => max(0, $pago - $total),
            'Valor restante' => max(0, $total - $pago),
            'Alerta' => $pago >= $total
                ? 'Pagamento suficiente.'
                : 'Pagamento insuficiente.'
        ];
    }
}
