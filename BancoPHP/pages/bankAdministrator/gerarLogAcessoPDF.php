<?php

include('../../mPDF/mpdf.php'); //Carregando a biblioteca mPDF
include '../../include/control/BancoSession.php';
include '../../include/dao/Factory.php';
include '../../include/dao/IbLogDAO.php';

$BancoSession = new BancoSession();
$filtrosLogsAcesso = $BancoSession->obterFiltrosLogsAcessoSession();

$IbLogDAO = new IbLogDAO();
$listaArray = $IbLogDAO->listar($filtrosLogsAcesso[0], $filtrosLogsAcesso[1], $filtrosLogsAcesso[2]);

//Inicia o buffer, qualquer HTML que for sair agora sera capturado para o buffer
ob_start();

$stylesheet = file_get_contents('../../css/style.css');

$html = '<table class="tabela">';
$html.= '<thead>';
$html.= '<tr>';
$html.= '<th>Cliente</th>';
$html.= '<th>Agência</th>';
$html.= '<th>Conta</th>';
$html.= '<th>Último acesso</th>';
$html.= '</tr>';
$html.= '</thead>';
$html.= '<tbody>';
foreach ($listaArray as $log) {
    $html.= '<tr>';
    $html.= '<td>' . $log['nome'] . '</td>';
    $html.= '<td>' . $log['agencia'] . '</td>';
    $html.= '<td>' . $log['nr_conta'] . '</td>';
    $html.= '<td>' . $log['data'] . '</td>';
    $html.= '</tr>';
}
$html.= '</tbody>';
$html.= '</table>';

//Limpa o buffer jogando todo o HTML em uma variavel.
$mpdf = new mPDF();
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);
$mpdf->Output();
exit;
