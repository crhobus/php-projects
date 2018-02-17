<?php

$modelo = $_POST['modelo'];
$ano = $_POST['ano'];
$valor = $_POST['valor'];
$nrParcelas = $_POST['nrParcelas'];
$juros = $_POST['juros'];

function calcularJurosParcelas($valor_total, $parcelas, $juros) {
    $string = 'Parcela - Valor <br/>';
    if ($juros > 0) {
        for ($i = 1; $i < ($parcelas + 1); $i++) {
            $I = $juros / 100.00;
            $valor_parcela = $valor_total * $I * pow((1 + $I), $parcelas) / (pow((1 + $I), $parcelas) - 1);
            $string .= $i . 'x (Juros de: ' . $juros . '%) - R$ ' . number_format($valor_parcela, 2, ",", ".") . ' <br />';
        }
    } else {
        for ($i = 1; $i < ($parcelas + 1); $i++) {
            $string .= $i . 'x (Juros de: ' . $juros . '%) - R$ ' . number_format($valor_total / $parcelas, 2, ",", ".") . ' <br />';
        }
    }
    return $string;
}

echo 'Financiamento' . '<br/>';
echo 'Modelo: ' . $modelo . '<br/>';
echo 'Ano: ' . $ano . '<br/>';
echo 'Valor: ' . number_format($valor, 2, ',', '.') . '<br/>';
echo calcularJurosParcelas($valor, $nrParcelas, $juros);
