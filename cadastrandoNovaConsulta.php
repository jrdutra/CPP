<?php
include '_mysql/conexao.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css"/>
        <title>Cadastrnado Consulta</title>
        <link rel="shortcut icon" href="_imagens/favicon.png" type="image/png"/>
        <script type="text/javascript">
            function retornar(id) {
                window.location='detalhandoPaciente.php?id='+id
            }
            function retornar_falha(id) {
                alert("Falhou ao tentar cadastrar uma nova consulta!");
                window.location='detalhandoPaciente.php?id='+id
            }
        </script>
    </head>
    <body>
        <header>
            <div id="barra-cabecalho">
                <label id="texto-cabecalho"></label><br/>
                <label id="sub-texto-cabecalho"></label>
            </div>
            <br/>
            <div id="barra-menu">
                <a href="pgMenuPrincipal.php"><div id="texto-menuPrincipal"><img src="_imagens/icone-menu2.png"></div></a><br/>
            </div>
            <div id="barra-menu-2">
                <a href="pgPesquisa.php"><div id="texto-menuPrincipal">Buscar Paciente</div></a><br/>
            </div>
            <div id="barra-menu-3">
                <a href="pgSimplificada.php"><div id="texto-menuPrincipal">Página Simplificada</div></a><br/>
            </div>
        </header>
        <article>
            <?php
            //Capiturando Os dados do paciente oriundos do formulário
            $vIdPaciente=$_GET['tIdPaciente'];
            $vSituacao=$_GET['tSituacao'];
            $vRemetente=$_GET['tRemetente'];
            $vMedicamento=$_GET['tMedicamento'];
            $vPosologiaManha=$_GET['tPossologiaManha'];
            $vPosologiaTarde=$_GET['tPossologiaTarde'];
            $vPosologiaNoite=$_GET['tPossologiaNoite'];
            $vQuantidadedeDias=$_GET['tQuantidadedeDias'];
            $vMedico=$_GET['tMedico'];
            $vInformacoesAdicionais=$_GET['tInformacoesAdicionais'];

            date_default_timezone_set('America/Sao_Paulo');
            $dataAtendimento = date('Y-m-d');
            $dataRetorno = date('Y-m-d', strtotime($dataAtendimento. ' + '.$vQuantidadedeDias.' days'));
            $data=date('d/m/Y', strtotime($dataAtendimento));
            $data2=date('d/m/Y', strtotime($dataRetorno));
            ?>
            <div id="corpo">
                <div id="corpo-interno">
                    <!-- Mostrando se o Paciente foi cadastrado com sucesso -->
                    <?php
                    //grava a amostra na base de dados
                    $sql = mysqli_query($conexao,"INSERT INTO `$banco`.`consultas` (`id`,`fkpaciente`,`data`,`situacao`,`fkremetente`,`fkmedicamento`,`manha`,`tarde`,`noite`,`quantidadedeDias`,`fkmedico`,`informacoesAdicionais`) VALUES (NULL ,'$vIdPaciente','$dataAtendimento','$vSituacao','$vRemetente','$vMedicamento','$vPosologiaManha','$vPosologiaTarde','$vPosologiaNoite','$vQuantidadedeDias','$vMedico','$vInformacoesAdicionais');");
                    //$sql = mysqli_query($conexao,"INSERT INTO `$banco`.`consultas` (`id`,`fk_paciente`,`data`,`situacao`,`fk_remetente`,`fk_medicamento`,`manha`,`tarde`,`noite`) VALUES (NULL ,'$vIdPaciente','$dataAtendimento','$vSituacao','$vRemetente','$vMedicamento','$vPosologiaManha','$vPosologiaTarde','$vPosologiaNoite');");

                    if($sql==1){
                        echo "<div id=\"caixa-generica\">
                                    <h3>Consulta Cadastrada com Sucesso!</h3>
                                    <div id=\"caixa-generica\">
                                    <table>
                                        <tr>
                                                <td>
                                                    <img src='_imagens/icone-calendario.png'>
                                                </td>
                                                <td>
                                                    <label id=\"cCampo\">Data do Atendimento: </label><label id=\"cVariavel\">$data</label><br/>
                                                    <label id=\"cCampo\">Data do Retorno: </label><label id=\"cVariavel\">$data2</label><br/>
                                                </td>
                                        </tr>
                                    </table>
                                        
                                    </div>
                                </div>";
                        echo"<script>retornar($vIdPaciente)</script>";
                    } else {

                        echo "<h2>Falhou ao tentar cadastrar a Consulta!</h2>";
                        echo"<script>retornar_falha($vIdPaciente)</script>";
                    }
                    ?>
                </div>
            </div>
        </article>
        <footer>
            <div id="rodape">
                <img id="logo-prefeitura" src="_imagens/pmm.png">
            </div>
        </footer>
    </body>
</html>
