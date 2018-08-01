<?php
include '_mysql/conexao.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css"/>
        <title>Pacientes</title>
        <link rel="shortcut icon" href="_imagens/favicon.png" type="image/png"/>
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
            <div id="corpo">
                <div id="corpo-interno">
                        <?php
                            $id_paciente=$_GET['id'];
                            $sql = mysqli_query($conexao, "Select * From pacientes where id='$id_paciente';")or die(mysqli_error($conexao));
                            $row = mysqli_num_rows($sql);
                            if($row>0) {
                                while ($exibe = mysqli_fetch_assoc($sql)) {
                                    $id_paciente = $exibe['id'];
                                    //calculando idade

                                    date_default_timezone_set('America/Sao_Paulo');
                                    $data_atual = date('Y-m-d');
                                    $data1 = new DateTime($data_atual);
                                    $data2 = new DateTime($exibe['data_nascimento']);
                                    $idade = $data1->diff($data2);
                                    echo '<h3>Detalhando o(a) paciente '.$exibe['nome'].'</h3>';
                                    echo '<div id="caixa-generica">
                                              <table id="detalhe">
                                                    <tr>
                                                        <td>
                                                            <label id="cCampo">Nome: </label><br/><label id="cVariavel">'.$exibe['nome'].'&nbsp;&nbsp;</label><br/>
                                                            <label id="cCampo">CPF: </label><label id="cVariavel">'.$exibe['cpf'].'</label><br/>
                                                            <label id="cCampo">Prontuário: </label><label id="cVariavel">'.$exibe['prontuario'].'</label><br/>
                                                            <label id="cCampo">SUS: </label><label id="cVariavel">'.$exibe['sus'].'</label><br/>
                                                            <label id="cCampo">Telefone: </label><br/><label id="cVariavel">'.$exibe['telefone'].'</label>
                                                        </td>
                                                        <td>
                                                            <label id="cCampo">RG: </label><label id="cVariavel">'.$exibe['RG'].'</label><br/>
                                                            <label id="cCampo">CNH: </label><label id="cVariavel">'.$exibe['cnh'].'</label><br/>
                                                            <label id="cCampo">Gênero: </label><label id="cVariavel">'.$exibe['genero'].'</label><br/>
                                                            <label id="cCampo">Data de Nascimento: </label><label id="cVariavel">'.date('d/m/Y', strtotime($exibe['data_nascimento'])).'&nbsp;&nbsp;</label><br/>
                                                            <label id="cCampo">E-mail: </label><br/><label id="cVariavel">'.$exibe['email'].'</label>
                                                        </td>
                                                        <td>
                                                            <label id="cCampo">Idade: </label><label id="cVariavel">'.$idade->y.'</label><br/>
                                                            <label id="cCampo">Logradouro: </label><br/><label id="cVariavel">'.$exibe['logradouro'].' </label><br/>
                                                            <label id="cCampo">Número: </label><label id="cVariavel">'.$exibe['numero'].' </label><br/>
                                                            <label id="cCampo">Bairro: </label><label id="cVariavel">'.$exibe['bairro'].'</label><br/>
                                                            <label id="cCampo">Cidade: </label><label id="cVariavel">'.$exibe['cidade'].'</label>-<label id="cVariavel">'.$exibe['uf'].'</label>
                                                         </td>
                                                    </tr>
                                            </table>
                                        </div>';
                                }
                            }
                        ?>
                        <!-- Ler as consultas-->
                        <h3>Último Atendimento</h3>
                        <?php
                        $sql_consultas = mysqli_query($conexao, "Select * From consultas where `fkpaciente` ='$id_paciente' ORDER BY data DESC;")or die(mysqli_error($conexao));
                        $row_consultas = mysqli_num_rows($sql_consultas);
                        $exibe_consultas = mysqli_fetch_assoc($sql_consultas);
                        if($row_consultas>0){
                            //Rotina que ficara posteriormente dentro do while
                            //Capiturando chaves estrangeiras
                            $fkremetente=$exibe_consultas['fkremetente'];
                            $fkmedicamento=$exibe_consultas['fkmedicamento'];
                            $fkmedico=$exibe_consultas['fkmedico'];

                            $sql_remetente = mysqli_query($conexao, "Select * From remetentes where id ='$fkremetente';")or die(mysqli_error($conexao));
                            $exibe_remetente = mysqli_fetch_assoc($sql_remetente);

                            $sql_medicamento = mysqli_query($conexao, "Select * From medicamentos where id ='$fkmedicamento';")or die(mysqli_error($conexao));
                            $exibe_medicamento = mysqli_fetch_assoc($sql_medicamento);

                            $sql_medico = mysqli_query($conexao, "Select * From medicos where id ='$fkmedico';")or die(mysqli_error($conexao));
                            $exibe_medico = mysqli_fetch_assoc($sql_medico);

                            //calcula data de retorno
                            $dataAtendimento = $exibe_consultas['data'];
                            $vQuantidadedeDias=$exibe_consultas['quantidadedeDias'];
                            $dataRetorno = date('Y-m-d', strtotime($dataAtendimento. ' + '.$vQuantidadedeDias.' days'));
                            $data=date('d/m/Y', strtotime($dataAtendimento));
                            $data2=date('d/m/Y', strtotime($dataRetorno));

                            date_default_timezone_set('America/Sao_Paulo');
                            $data_atual= date('Y-m-d');
                            $data_atual2= date('d/m/Y', strtotime($data_atual));

                            //calcula quantidade dias
                            $d1 = new DateTime($dataAtendimento);
                            $d2 = new DateTime('now');
                            $diascorridos = ($d2->diff($d1));
                            $diascorridos=$diascorridos->days;

                            $dias_faltando=$vQuantidadedeDias-$diascorridos;

                            if($dias_faltando<0){
                                $dias_faltando=0;//nao existe dias faltando negativo
                            }
                            if($diascorridos>$vQuantidadedeDias){
                                $diascorridos="Já acabou o medicamento!";//nao existe dias faltando negativo
                            }


                            echo '<div id="caixa-generica">';

                            if(strtotime($data_atual) < strtotime($dataRetorno)){
                                echo "<label id=\"cCampo\" style=\"font-size: 20px;\">Situação da Medicação: </label><label id=\"cVariavel\" style=\"font-size: 20px; color: #ff0000; text-shadow: 1px 1px 1px #000000;\"><b>AINDA NÃO TERMINOU!</b></label><br/>";
                            }
                            else{
                                echo "<label id=\"cCampo\" style=\"font-size: 20px;\">Situação da Medicação: </label><label id=\"cVariavel\" style=\"font-size: 20px; color: #79bf2e; text-shadow: 1px 1px 1px #000000;\"><b>JÁ TERMINOU!</b></label><br/>";
                            }

                            echo "<table>
                                    <tr>
                                        <td>
                                            <label id=\"cCampo\">Data do Atendimento: </label><br/>
                                            <label id=\"cCampo\">Data do Retorno: <br/>
                                            <label id=\"cCampo\">Data de Hoje: </label><br/>
                                        </td>
                                        <td>
                                            <label id=\"cVariavel\">$data</label><br/>
                                            </label><label id=\"cVariavel\" style=\"color: #4f6933;\">$data2</label><br/>
                                            <label id=\"cVariavel\"style=\"color: #343369;\">$data_atual2</label><br/>
                                        </td>
                                    </tr>
                                  </table>";
                            echo "<label id=\"cCampo\">*Medicamento: </label>";
                            echo '<label id="cVariavel">'.$exibe_medicamento['nome'].'</label>-<label id="cVariavel">'.$exibe_medicamento['dosagem'].' </label><br/>';
                            echo "<label id=\"cCampo\">Posologia: </label>";
                            echo '<label id="cVariavel">'.$exibe_consultas['manha'].'</label>X<label id="cVariavel">'.$exibe_consultas['tarde'].'</label>X<label id="cVariavel">'.$exibe_consultas['noite'].'</label><br/>';
                            echo "<label id=\"cCampo\">Quantidade de Dias: </label>";
                            echo '<label id="cVariavel">'.$exibe_consultas['quantidadedeDias'].' </label>Dias<br/>';

                            echo "<label id=\"cCampo\">Medico Responsável: </label>";
                            echo '<label id="cVariavel">'.$exibe_medico['nome'].'</label><label id="cVariavel">-CRM: '.$exibe_medico['crm'].'</label><br/>';

                            echo"<label id=\"cCampo\">Quantidade de dias Usando a Medicação: </label><label id=\"cVariavel\">$diascorridos</label><br/>
                                  <label id=\"cCampo\">Quantidade Faltando Para Acabar a Medicação: </label><label id=\"cVariavel\">$dias_faltando</label><br/>
                                  <label id=\"cCampo\" style=\"font-size: 20px;\">**Detalhes do Atendimento: </label><br/>
                                  <label id=\"cCampo\">Origem do Paciente: </label>";
                            echo '<label id="cVariavel">'.$exibe_consultas['situacao'].' </label>Por:<label id="cVariavel">'.$exibe_remetente['nome'].' </label><br/>';
                            echo"<label id=\"cCampo\" style=\"font-size: 20px;\">Informações Adicionais: </label><br/>";
                            echo '<label id="cVariavel">'.$exibe_consultas['informacoesAdicionais'].' </label><br/>';


                            echo "</div>";

                        }
                        else{
                            echo '<div id="caixa-generica">
                                        
                                        Esse Paciente ainda não fez nenhuma consulta!<br/>
                                        Preencha a primeira consulta logo abaixo.<br/>
                                    </div>';
                        }
                        ?>

                    <h3>Incluir Novo Atendimento:</h3>
                    <div id="caixa-generica">
                        <form id="cNoaConsulta" name="nNovaConsulta" method="get" action="cadastrandoNovaConsulta.php">
                            <h3>Origem do Paciente:</h3>
                            <input type="hidden" id="cIdPaciente" name="tIdPaciente" value="<?php echo "$id_paciente";?>">
                            <label for="cSituacao">Situacao:</label>
                            <select class="grande" id="cSituacao" name="tSituacao" required>
                                <option value="nenhum">Nenhum</option>
                                <option value="Acolhido e Encaminhado">Acolhido e Encaminhado</option>
                                <option value="Acolhido">Acolhido</option>
                                <option value="Demanda Espontânea">Demanda Espontânea</option>
                            </select> &nbsp Por:
                            <select class="grande" id="cRemetente" name="tRemetente" required>

                            <?php
                                $sql2 = mysqli_query($conexao, "Select * From remetentes;")or die(mysqli_error($conexao));
                                $row2 = mysqli_num_rows($sql2);
                                if($row2>0) {
                                    while ($exibe2 = mysqli_fetch_assoc($sql2)) {
                                        echo '<option value="'.$exibe2['id'].'">'.$exibe2['nome'].'</option>';
                                    }
                                }

                            ?>
                            </select><label id="cVariavel"><a href="pgCadastroRemetente.php">->(CLIQUE AQUI Para cadastrar um novo órgão.)</a></label><br/>
                            <h3>Dados do Medicamento:</h3>
                            <label for="cMedicamento">Medicamento:</label><br/>
                            <select class="grande" id="cMedicamento" name="tMedicamento" required>
                                <?php
                                $sql3 = mysqli_query($conexao, "Select * From medicamentos;")or die(mysqli_error($conexao));
                                $row3 = mysqli_num_rows($sql3);
                                if($row3>0) {
                                    while ($exibe3 = mysqli_fetch_assoc($sql3)) {
                                        echo '<option value="'.$exibe3['id'].'">'.$exibe3['nome'].'-'.$exibe3['dosagem'].'</option>';
                                    }
                                }
                                ?>
                            </select><label id="cVariavel"><a href="pgCadastroMedicamento.php">->(CLIQUE AQUI Para cadastrar um novo medicamento.)</a></label><br/>
                            <label for="cPossologia">Posologia:</label><br/>
                            <label for="cPossologiaManha">Manhã:</label>
                            <input class="cCampoPequeno" type="number" id="cPossologiaManha" name="tPossologiaManha">
                            <label for="cPossologiaTarde"> Tarde:</label>
                            <input class="cCampoPequeno" type="number" id="cPossologiaTarde" name="tPossologiaTarde">
                            <label for="cPossologiaNoite"> Noite:</label>
                            <input class="cCampoPequeno" type="number" id="cPossologiaNoite" name="tPossologiaNoite"> (Comprimidos)
                            <br/>
                            <label for="cQuantidadeDias">Quantidade de Dias:</label><br/>
                            <input class="cCampoPequeno" type="number" id="cQuantidadeDias" name="tQuantidadedeDias"> (Dias)<br/>
                            <h3>Dados do Médico:</h3>
                            <select class="muito-grande" id="cMedico" name="tMedico" required>
                                <?php
                                $sql4 = mysqli_query($conexao, "Select * From medicos;")or die(mysqli_error($conexao));
                                $row4 = mysqli_num_rows($sql4);
                                if($row4>0) {
                                    while ($exibe4 = mysqli_fetch_assoc($sql4)) {
                                        echo '<option value="'.$exibe4['id'].'">'.$exibe4['nome'].'  |  CRM:'.$exibe4['crm'].'</option>';
                                    }
                                }
                                ?>
                            </select><label id="cVariavel"><a href="pgCadastroMedico.php">->(CLIQUE AQUI Para cadastrar um novo médico.)</a></label><br/><br/>
                            <h3>Informações Adicionais:</h3>
                            <textarea class="cCampoFormulario" type="text" id="cInformacoesAdicionais" name="tInformacoesAdicionais" placeholder="Informações adicionais" maxlength="1000" rows="10" cols="81"></textarea><br/><br/>
                            <input class="Botao" id="cBotaoGravar" type="submit" name="gravar" value="Incluir novo atendimento"><br>
                        </form>
                    </div>
                    <img src="_imagens/seta-anteriores.png">
                    <?php
                    if($row_consultas>0) {
                        //Rotina que ficara posteriormente dentro do while
                        //Capiturando chaves estrangeiras
                        while ($exibe_consultas = mysqli_fetch_assoc($sql_consultas)) {
                            $fkremetente = $exibe_consultas['fkremetente'];
                            $fkmedicamento = $exibe_consultas['fkmedicamento'];
                            $fkmedico = $exibe_consultas['fkmedico'];

                            $sql_remetente = mysqli_query($conexao, "Select * From remetentes where id ='$fkremetente';") or die(mysqli_error($conexao));
                            $exibe_remetente = mysqli_fetch_assoc($sql_remetente);

                            $sql_medicamento = mysqli_query($conexao, "Select * From medicamentos where id ='$fkmedicamento';") or die(mysqli_error($conexao));
                            $exibe_medicamento = mysqli_fetch_assoc($sql_medicamento);

                            $sql_medico = mysqli_query($conexao, "Select * From medicos where id ='$fkmedico';") or die(mysqli_error($conexao));
                            $exibe_medico = mysqli_fetch_assoc($sql_medico);

                            //calcula data de retorno
                            $dataAtendimento = $exibe_consultas['data'];
                            $vQuantidadedeDias = $exibe_consultas['quantidadedeDias'];
                            $dataRetorno = date('Y-m-d', strtotime($dataAtendimento . ' + ' . $vQuantidadedeDias . ' days'));
                            $data = date('d/m/Y', strtotime($dataAtendimento));
                            $data2 = date('d/m/Y', strtotime($dataRetorno));

                            date_default_timezone_set('America/Sao_Paulo');
                            $data_atual = date('Y-m-d');
                            $data_atual2 = date('d/m/Y', strtotime($data_atual));

                            //calcula quantidade dias
                            $d1 = new DateTime($dataAtendimento);
                            $d2 = new DateTime('now');
                            $diascorridos = ($d2->diff($d1));
                            $diascorridos = $diascorridos->days;

                            $dias_faltando = $vQuantidadedeDias - $diascorridos;

                            if ($dias_faltando < 0) {
                                $dias_faltando = 0;//nao existe dias faltando negativo
                            }
                            if ($diascorridos > $vQuantidadedeDias) {
                                $diascorridos = "Já acabou o medicamento!";//nao existe dias faltando negativo
                            }


                            echo '<div id="caixa-generica">';

                            if (strtotime($data_atual) < strtotime($dataRetorno)) {
                                echo "<label id=\"cCampo\" style=\"font-size: 20px;\">Situação da Medicação: </label><label id=\"cVariavel\" style=\"font-size: 20px; color: #ff0000; text-shadow: 1px 1px 1px #000000;\"><b>AINDA NÃO TERMINOU!</b></label><br/>";
                            } else {
                                echo "<label id=\"cCampo\" style=\"font-size: 20px;\">Situação da Medicação: </label><label id=\"cVariavel\" style=\"font-size: 20px; color: #79bf2e; text-shadow: 1px 1px 1px #000000;\"><b>JÁ TERMINOU!</b></label><br/>";
                            }

                            echo "<table>
                                    <tr>
                                        <td>
                                            <label id=\"cCampo\">Data do Atendimento: </label><br/>
                                            <label id=\"cCampo\">Data do Retorno: <br/>
                                            <label id=\"cCampo\">Data de Hoje: </label><br/>
                                        </td>
                                        <td>
                                            <label id=\"cVariavel\">$data</label><br/>
                                            </label><label id=\"cVariavel\" style=\"color: #4f6933;\">$data2</label><br/>
                                            <label id=\"cVariavel\"style=\"color: #343369;\">$data_atual2</label><br/>
                                        </td>
                                    </tr>
                                  </table>";
                            echo "<label id=\"cCampo\">*Medicamento: </label>";
                            echo '<label id="cVariavel">' . $exibe_medicamento['nome'] . '</label>-<label id="cVariavel">' . $exibe_medicamento['dosagem'] . ' </label><br/>';
                            echo "<label id=\"cCampo\">Posologia: </label>";
                            echo "<label id=\"cCampo\">Quantidade de Dias: </label>";
                            echo '<label id="cVariavel">'.$exibe_consultas['quantidadedeDias'].' </label>Dias<br/>';

                            echo '<label id="cVariavel">' . $exibe_consultas['manha'] . '</label>X<label id="cVariavel">' . $exibe_consultas['tarde'] . '</label>X<label id="cVariavel">' . $exibe_consultas['noite'] . '</label><br/>';
                            echo "<label id=\"cCampo\">Medico Responsável: </label>";
                            echo '<label id="cVariavel">' . $exibe_medico['nome'] . '</label><label id="cVariavel">-CRM: ' . $exibe_medico['crm'] . '</label><br/>';

                            echo "<label id=\"cCampo\">Quantidade de dias Usando a Medicação: </label><label id=\"cVariavel\">$diascorridos</label><br/>
                                  <label id=\"cCampo\">Quantidade Faltando Para Acabar a Medicação: </label><label id=\"cVariavel\">$dias_faltando</label><br/>
                                  <label id=\"cCampo\" style=\"font-size: 20px;\">**Detalhes do Atendimento: </label><br/>
                                  <label id=\"cCampo\">Origem do Paciente: </label>";
                            echo '<label id="cVariavel">' . $exibe_consultas['situacao'] . ' </label>Por:<label id="cVariavel">' . $exibe_remetente['nome'] . ' </label><br/>';
                            echo "<label id=\"cCampo\" style=\"font-size: 20px;\">Informações Adicionais: </label><br/>";
                            echo '<label id="cVariavel">' . $exibe_consultas['informacoesAdicionais'] . ' </label><br/>';
                            echo "</div>";

                        }
                    }
                    else{
                        echo '<div id="caixa-generica">
                                        
                                        Esse Paciente ainda não fez nenhuma consulta!<br/>
                                        Preencha a primeira consulta logo abaixo.<br/>
                                    </div>';
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
