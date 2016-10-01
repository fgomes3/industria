<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of memorial
 *
 * @author fabio.gomes
 */
class memorial {
    public function memorialDescritivo() {

        ob_start();

        $params = $_POST;
        $params['conexao'] = 'producao';
        $params['retornar'] = true;
        $params['debug'] = true;
        $params['idsql'] = 'memorialdescritivo';
        $dados = $this->exec2object($params);
        $date = date_create($dados->datamovimento);

        $paramsItem = $_POST;
        $paramsItem['conexao'] = 'producao';
        $paramsItem['retornar'] = true;
        $paramsItem['debug'] = true;
        $paramsItem['idsql'] = 'ficha_tecnica_semelhante';
        $dadosSemelhantes = $this->exec2array($paramsItem);

        foreach ($dados as $v => $item) {
            $dados->$v = utf8_decode($dados->$v);
        }

        echo'<html>
                <head>
                    <title>Industria</title>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <style>
                        *{
                            font-size: 11px;
                        }
                        body{
                            min-width: 530px;
                            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                        }
                        .container{
                            width: 45%;
                            float: left;
                        }

                        .section{
                            float: left;
                            width: 100%;
                        }
                        .titulo{
                            text-align: center;
                            text-transform: uppercase;
                            background-color: #d2d2d2;
                            -webkit-print-color-adjust: exact; 
                        }
                        table{
                            width: 100%;
                        }
                        table, th, td {
                            border: 1px solid black;
                            border-collapse: collapse;
                            text-align: center;
                        }
                        th, td {
                            padding: 2px;
                        }
                        .subtitulo{
                            width: 50%;
                            text-align: center;
                            background-color: #eaeaea;
                            text-transform: uppercase;
                            font-weight: bold;
                            -webkit-print-color-adjust: exact; 
                        }
                        .tabledesc{
                            float: left;
                            width: 50%;
                        }
                        .descpro{
                            text-align: center;
                            text-transform: uppercase;
                        }

                        #tabletitulo{
                            font-weight: bold;
                        }
                        .tituloazul{
                            background-color: #077dda !important;
                            color: #fff !important;
                        }
                        .negrito{
                            font-weight: bold;
                        }
                        .infotec td{
                            width: 20%;
                        }
                        .infodesc td{
                            font-size: 10px;
                        }

                    </style>
                </head>
                <body>
                    <div class="section">
                        <table class="principal">
                            <tr>
                                <th width="20%" rowspan="2"><img src="http://www.colchoesgazin.com.br/site/assets/img/logo.png" width="100"><br>SAC 0800 643 0303</th>
                                <th class="titulo">FICHA T&Eacute;CNICA</th>
                                <th width="10%">' . date_format($date, 'd/m/Y') . '</th>
                                <th width="10%">SETOR</th>
                            </tr>
                            <tr>
                                <td>' . $_POST['idproduto'] . '-' . $_POST['idgradex'] . '-' . $_POST['idgradey'] . '   ' . utf8_decode($_POST['descricao']) . '</td>
                                <td>REVIS&Atilde;O. ' . $_POST['versao'] . '</td>
                                <th>Desenv. Produto</th>
                            </tr>
                        </table>
                        <table>
                            <tr><td colspan="5" class="subtitulo tituloazul">FOTO ILUSTRATIVA</td></tr>
                            <tr>
                                <td colspan="5" style="padding: 5px;">
                                    <img src="' . $_POST['urlimagem'] . '" width="300">
                                </td>
                            </tr>
                            <tr><td colspan="5" class="subtitulo tituloazul">COMPOSI&Ccedil;&Atilde;O DO PRODUTO</td></tr>
                            <tr>
                                <td colspan="5" style="padding: 5px;">
                                    <img src="' . $dados->urlimagem . '" width="300">
                                </td>
                            </tr>
                            
                            <tr><td colspan="5" class="subtitulo tituloazul">PRODUTOS SEMELHANTES</td></tr>
                    ';
        
        
        foreach ($dadosSemelhantes as $i) {
            echo'<tr>
                    <td colspan="5" class="codigo"><b>Produto: </b>' . $_POST['idproduto'] . '-' . $_POST['idgradex'] . '-' . $_POST['idgradey'] . ' <b>Descri&ccedil;&atilde;o:</b> '.utf8_decode($i['descricao']).'</td>
                </tr>';
        }


        echo'
                            <tr class="infotec"><td colspan="5" class="subtitulo tituloazul">Informa&ccedil;&otilde;es T&eacute;cnicas do Produto</td></tr>
                                
                            <tr class="infotec">
                                <td colspan="1" class="negrito">Suporte de peso</td>
                                <td colspan="1">' . $dados->suportedepeso . ' kg</td>
                                <td colspan="1" rowspan="2" class="negrito">Estrutura Base</td>
                                <td colspan="2" rowspan="2">' . $dados->estruturabase . '</td>
                            </tr>
                            <tr class="infotec">
                                <td colspan="1" class="negrito">Pillow/Euro</td>
                                <td colspan="1">' . $dados->pilloweuro . '</td>
                            </tr>
                            <tr class="infotec">
                                <td colspan="1" class="negrito">Revest. Superior</td>
                                <td colspan="1">' . $dados->revestimentosuperior . '</td>
                                <td colspan="1" class="negrito">Revest. Superior Base</td>
                                <td colspan="2">' . $dados->revestivemntosuperiorbase . '</td>
                            </tr>
                            
                            <tr class="infotec">
                                <td colspan="1" class="negrito">Revest. Lateral</td>
                                <td colspan="1">' . $dados->revestimentolateral . '</td>
                                <td colspan="1" class="negrito">Revest. Lateral Base</td>
                                <td colspan="2">' . $dados->revestivemntolateralbase . '</td>
                            </tr>
                            <tr class="infotec">
                                <td colspan="1" class="negrito">Revest. Inferior</td>
                                <td colspan="1">' . $dados->revestimentoinferior . '</td>
                                <td colspan="1" class="negrito">P&eacute;s</td>
                                <td colspan="2">' . $dados->pes . '</td>
                            </tr>
                            <tr class="infotec">
                                <td colspan="1" class="negrito">Molejo</td>
                                <td colspan="1">' . $dados->molejo . '</td>
                                <td colspan="1" class="negrito">Altura do Colch&atilde;o</td>
                                <td colspan="2">' . $dados->alturadocolchao . ' m</td>
                            </tr>
                            <tr class="infotec">
                                <td colspan="1" class="negrito">N&iacute;vel de Conforto</td>
                                <td colspan="1">' . $dados->niveldeconforto . '</td>
                                <td colspan="1" class="negrito">Altura da Base</td>
                                <td colspan="2">' . $dados->alturadabase . ' m</td>
                            </tr>
                            <tr class="infotec">
                                <td colspan="1" class="negrito">Garantia do Colch&atilde;o</td>
                                <td colspan="1">' . $dados->garantiacolchao . ' Anos</td>
                                <td colspan="1" class="negrito">Altura dos P&eacute;s</td>
                                <td colspan="2">' . $dados->alturadospes . ' m</td>
                            </tr>
                            <tr class="infotec">
                                <td colspan="1" class="negrito">Garantia Base</td>
                                <td colspan="1">' . $dados->garantiabase . ' Meses</td>
                                <td colspan="1" class="negrito">Altura Total Conjunto</td>
                                <td colspan="2">' . $dados->alturatotalconjunto . ' m</td>
                            </tr>
                            <tr class="infotec">
                                <td colspan="1" class="negrito">Peso</td>
                                <td colspan="1">' . $dados->peso . ' kg</td>
                                <td colspan="1" class="negrito">Classisfica&ccedil;&atilde;o Fiscal</td>
                                <td colspan="2">' . $dados->classificacaofiscal . '</td>
                            </tr>
                            
                            
                            <tr><td colspan="5" class="subtitulo tituloazul">DIFERENCIAL DO PRODUTO</td></tr>
                            <tr class="infodesc">
                                <td colspan="5">' . $dados->obs . '</td>
                            </tr>
                            <tr><td colspan="5" class="subtitulo tituloazul">Respons&aacute;vel</td></tr>
                            <tr class="infodesc">
                                <td colspan="1" class="negrito">Elaborado</td>
                                <td colspan="1">' . $dados->nome . '</td>
                                <td colspan="1" class="negrito">Data da Elabora&ccedil;&atilde;o</td>
                                <td colspan="2">' . date_format($date, 'd/m/Y') . '</td>
                            </tr>
                        </table>
                    </div>

                </body>
            </html>';

        $html = ob_get_contents();
        ob_end_clean();
        echo $html;
    }
}
