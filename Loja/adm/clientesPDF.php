<?php

include('../mpdf/mpdf.php');
include('../include/global.php');

$LojaSession = new LojaSession();
$id = $LojaSession->obterAdministradorSession();

if ($id) {
    $ClienteDAO = new ClienteDAO();
    $lista = $ClienteDAO->listar();
} else {
    header("Location: index.php");
}

ob_start();

$html = "";
$html.='<h1>Lista de Clientes</h1>';
$html.='<table>';
$html.='<tr>';
$html.='<th>Id</th>';
$html.='<th>Nome</th>';
$html.='<th>Sobrenome</th>';
$html.='<th>E-mail</th>';
$html.='<th>Cidade</th>';
$html.='<th>Estado</th>';
$html.='</tr>';

if ($lista) {
    foreach ($lista as $Cliente) {
        $html.='<tr>';
        $html.='<td style="text-align: center; width:100px">' . $Cliente->getId() . '</td>';
        $html.='<td style="text-align: center; width:100px">' . $Cliente->getNome() . '</td>';
        $html.='<td style="text-align: center; width:100px">' . $Cliente->getSobrenome() . '</td>';
        $html.='<td style="text-align: center; width:100px">' . $Cliente->getEmail() . '</td>';
        $html.='<td style="text-align: center; width:100px">' . $Cliente->getCidade() . '</td>';
        $html.='<td style="text-align: center; width:100px">' . $Cliente->getEstado() . '</td>';
        $html.='</tr>';
    }
}
$html.='</table>';

$mpdf = new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
