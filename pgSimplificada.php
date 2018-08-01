<?php
include '_mysql/conexao.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css"/>
        <title>Pesquisa</title>
        <link rel="shortcut icon" href="_imagens/favicon.png" type="image/png"/>
        <script>
            function formatar(mascara, documento){
                var i = documento.value.length;
                var saida = mascara.substring(0,1);
                var texto = mascara.substring(i);
                if (texto.substring(0,1) != saida){
                    documento.value += texto.substring(0,1);
                }
            }
            function pesquisar_cpf(cpf){
                window.location='pgSimplificada.php?tGravando=falso&tCpf='+cpf;
            }
        </script>
    </head>
    <body>
        <header>
            <div id="barra-cabecalho-2">
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
                <a href="pgSimplificada.php"><div id="texto-menuPrincipal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Limpar Tudo</div></a><br/>
            </div>
        </header>
        <article>
            <div id="corpo-2">
                <?php
                if(!empty($_GET['tGravando'])){
                    if($_GET['tGravando']=="verdadeiro"){
                        ///////////////////////
                        //Referente a GRAVAÇÃO
                        ///////////////////////
                        //Capiturando Os dados do paciente oriundos do formulário
                        $vNome = $_GET['tNome'];
                        $vCpf = $_GET['tCpf'];
                        $vProntuario = $_GET['tProntuario'];
                        $vSus = $_GET['tSus'];
                        $vRg = $_GET['tRg'];
                        $vCnh = $_GET['tCnh'];
                        $vDia = $_GET['tDia'];
                        $vMes = $_GET['tMes'];
                        $vAno = $_GET['tAno'];
                        $vGenero = $_GET['tGenero'];
                        $vTel = $_GET['tTel'];
                        $vEmail = $_GET['tEmail'];
                        $vLogradouro = $_GET['tLogradouro'];
                        $vNumero = $_GET['tNumero'];
                        $vBairro = $_GET['tBairro'];
                        $vCidade = $_GET['tCidade'];
                        $vUf = $_GET['tUf'];
                        //construindo data para inserir no banco
                        $vData_nasc=$vDia."-".$vMes."-".$vAno;
                        $vData_nasc2=$vAno."-".$vMes."-".$vDia;
                        //calculando idade
                        date_default_timezone_set('America/Sao_Paulo');
                        $data_atual = date('Y-m-d');
                        $data1 = new DateTime($data_atual);
                        $data2 = new DateTime($vData_nasc2);
                        $idade= $data1->diff($data2);
                        //capiturando dados do formulario da nova consulta

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
                        if($_GET['tFlag']=="pacienteNaoExistente"){
                            $sql = mysqli_query($conexao,"INSERT INTO `$banco`.`pacientes` (`id`,`nome`,`cpf`,`prontuario`,`sus`,`RG`,`cnh`,`data_nascimento`,`genero`,`telefone`,`email`,`logradouro`,`numero`,`bairro`,`cidade`,`uf`) VALUES (NULL ,'$vNome','$vCpf','$vProntuario','$vSus','$vRg','$vCnh','$vData_nasc2','$vGenero','$vTel','$vEmail','$vLogradouro','$vNumero','$vBairro','$vCidade','$vUf');");
                            //pegando a id do paciente recem cadastrado
                            $sql2 = mysqli_query($conexao, "Select * From pacientes where cpf='$vCpf';")or die(mysqli_error($conexao));
                            $row = mysqli_num_rows($sql2);
                            if($row>0) {
                                while ($exibe = mysqli_fetch_assoc($sql2)) {
                                    $id_paciente = $exibe['id'];
                                }
                            }
                            $vIdPaciente=$id_paciente;//pegando o id do paciente recem gravado para colocar na consulta
                            //grava a consulta na base de dados
                            $sql_consulta = mysqli_query($conexao,"INSERT INTO `$banco`.`consultas` (`id`,`fkpaciente`,`data`,`situacao`,`fkremetente`,`fkmedicamento`,`manha`,`tarde`,`noite`,`quantidadedeDias`,`fkmedico`,`informacoesAdicionais`) VALUES (NULL ,'$vIdPaciente','$dataAtendimento','$vSituacao','$vRemetente','$vMedicamento','$vPosologiaManha','$vPosologiaTarde','$vPosologiaNoite','$vQuantidadedeDias','$vMedico','$vInformacoesAdicionais');");
                            if($sql==1||$sql_consulta==1){
                                echo "<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style=\"box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.2); padding: 9px; border-radius: 3px 2px 3px 3px; background-color: rgba(255,145,145,.5);font-size: 19px; color: rgba(0,0,0,1);\">Paciente e Antendimento Gravados com Sucesso!</label>";
                            }
                        }
                        if($_GET['tFlag']=="pacienteExistente"){
                            $sql = mysqli_query($conexao,"UPDATE `pacientes` SET nome='$vNome',prontuario='$vProntuario',sus='$vSus',RG='$vRg',cnh='$vCnh',data_nascimento='$vData_nasc2',genero='$vGenero',telefone='$vTel',email='$vEmail',logradouro='$vLogradouro',numero='$vNumero',bairro='$vBairro',cidade='$vCidade',uf='$vUf' where cpf='$vCpf';");
                            $sql2 = mysqli_query($conexao, "Select * From pacientes where cpf='$vCpf';")or die(mysqli_error($conexao));
                            $row = mysqli_num_rows($sql2);
                            if($row>0) {
                                while ($exibe = mysqli_fetch_assoc($sql2)) {
                                    $id_paciente = $exibe['id'];
                                }
                            }
                            $vIdPaciente=$id_paciente;
                            //grava a consulta na base de dados
                            $sql_consulta = mysqli_query($conexao,"INSERT INTO `$banco`.`consultas` (`id`,`fkpaciente`,`data`,`situacao`,`fkremetente`,`fkmedicamento`,`manha`,`tarde`,`noite`,`quantidadedeDias`,`fkmedico`,`informacoesAdicionais`) VALUES (NULL ,'$vIdPaciente','$dataAtendimento','$vSituacao','$vRemetente','$vMedicamento','$vPosologiaManha','$vPosologiaTarde','$vPosologiaNoite','$vQuantidadedeDias','$vMedico','$vInformacoesAdicionais');");
                            echo "<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style=\"box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.2); padding: 9px; border-radius: 3px 2px 3px 3px; background-color: rgba(255,145,145,.5);font-size: 19px; color: rgba(0,0,0,1);\">Antendimento para $vNome Gravado com Sucesso!</label>";

                        }
                    }
                }


                    //Se for a Primeira Tela, Entra Aqui
                    if((empty($_GET['tGravando']))){
                        echo"<div id=\"corpo-interno\">
                                <h3>Dados Pessoais</h3>
                                <form id=\"cNoaConsulta\" name=\"nNovaConsulta\" method=\"get\" action=\"pgSimplificada.php\">
                                <div id=\"caixa-simples\">
                                <table id=\"formulario\">
                                    <tr>
                                        <td>
                                            <label for=\"cCpf\">CPF (Obrigatório)</label><br/>
                                            <input type=\"text\" id=\"cCpf\" name=\"tCpf\" style=\"width: 130px; background-color: rgba(255,145,145,.5);\" pattern=\"\d{3}\.\d{3}\.\d{3}-\d{2}\" title=\"Digite um CPF no formato: xxx.xxx.xxx-xx\" placeholder=\"000.000.000-00\" required maxlength=\"14\" onKeyUp=\"if(event.keyCode==13 || this.value.length == 14){pesquisar_cpf(this.value)} else {formatar('###.###.###-##', this);}\">
                                        </td>
                                        <td>
                                            <label for=\"cNome\">Nome (Obrigatório)</label><br/>
                                            <input type=\"text\" id=\"cNome\" name=\"tNome\" style=\"width: 330px; background-color: rgba(255,145,145,.5);\" title=\"Digite o nome do paciente\" placeholder=\"Nome do paciente\" required>
                                        </td>
                                        <td>
                                            <label for=\"cProntuario\">Prontuário (PSA)</label><br/>
                                            <input type=\"text\" id=\"cProntuario\" name=\"tProntuario\" style=\"width: 130px\" title=\"Informe o prontuário do paciente no PSA\">
            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for=\"cSus\">Nº Cartão do SUS</label><br/>
                                            <input type=\"text\" id=\"cSus\" name=\"tSus\" style=\"width: 160px\" title=\"Informe o prontuário do paciente no PSA\">
            
                                        </td>
                                        <td>
                                            <label for=\"cRg\">Nº do RG</label><br/>
                                            <input type=\"text\" id=\"cRg\" name=\"tRg\" style=\"width: 160px\" title=\"Informe o prontuário do paciente no PSA\">
            
                                        </td>
                                        <td>
                                            <label for=\"cRg\">Nº da CNH</label><br/>
                                            <input type=\"text\" id=\"cCnh\" name=\"tCnh\" style=\"width: 160px\" title=\"Informe o prontuário do paciente no PSA\">
                                        </td>
                                    <tr>
                                        <td>
                                            <label>Data de Nascimento</label><br/>
                                            <label for=\"cDia\">Dia:</label><input type=\"number\" id=\"cDia\" name=\"tDia\" style=\"width: 40px\" min=\"1\" max=\"31\" required>
                                            <label for=\"cMes\">Mês:</label><input type=\"number\" id=\"cMes\" name=\"tMes\" style=\"width: 40px\" min=\"1\" max=\"12\" required>
                                            <label for=\"cAno\">Ano:</label><input type=\"number\" id=\"cAno\" name=\"tAno\" style=\"width: 50px\" min=\"1900\" max=\"2100\" required><br/>
            
                                        </td>
                                        <td>
                                            <label for=\"cGenero\">Gênero</label><br/>
                                            <select id=\"cGenero\" name=\"tGenero\" style=\"width: 80px\">
                                                <option value=\"M\">M</option>
                                                <option value=\"F\">F</option>
                                            </select>
                                        </td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                </table>
                                </div>
                                <h3>Contatos</h3>
                                <div id=\"caixa-simples\">
                                    <table>
                                    <tr>
                                        <td>
                                            <label for=\"cTel\">Telefone de contato</label><br/>
                                            <input type=\"text\" id=\"cTel\" name=\"tTel\" style=\"width: 180px\">
                                        </td>
                                        <td>
                                            <label for=\"cTel\">E-mail</label><br/>
                                            <input type=\"email\" id=\"cEmail\" name=\"tEmail\" style=\"width: 610px\"><br/>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                                <h3>Endereço</h3>
                                <div id=\"caixa-simples\"><table>
                                    <tr>
                                        <td>
                                            <label for=\"cLogradouro\">Logradouro:</label><br/>
                                            <input style=\"width: 550px\" type=\"text\" id=\"cLogradouro\" name=\"tLogradouro\">
                                        </td>
                                        <td>
                                            <label for=\"cNumero\">Número:</label><br/>
                                            <input style=\"width: 240px\" type=\"text\" id=\"cNumero\" name=\"tNumero\"><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for=\"cBairro\">Bairro</label><br/>
                                            <input style=\"width: 410px\" type=\"text\" id=\"cBairro\" name=\"tBairro\"><br/>
                                        </td>
                                        <td>
                                            <label for=\"cCidade\">Cidade:</label><br/>
                                            <input style=\"width: 240px\" type=\"text\" id=\"cCidade\" name=\"tCidade\"><br/>
                                            <label for=\"cUf\">&nbsp;UF:</label><br/>
                                            <input style=\"width: 50px\" type=\"text\" id=\"cUf\" name=\"tUf\"><br/>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                                <h3>Dados do Atendimento</h3>
                                <div id=\"caixa-simples\" style=\"background-color: rgba(255,145,145,.4)\">
                                    <table>
                                        <tr>
                                            <td>
                                                <label for=\"cSituacao\">Situacao:</label>
                                                <select style=\"width: 240px\" id=\"cSituacao\" name=\"tSituacao\" required>
                                                    <option value=\"nenhum\">Nenhum</option>
                                                    <option value=\"Acolhido e Encaminhado\">Acolhido e Encaminhado</option>
                                                    <option value=\"Acolhido\">Acolhido</option>
                                                    <option value=\"Demanda Espontânea\">Demanda Espontânea</option>
                                                </select> &nbsp Por:
                                                <select style=\"width: 140px\" id=\"cRemetente\" name=\"tRemetente\" required>";
                                                    $sql2 = mysqli_query($conexao, "Select * From remetentes ORDER by nome;")or die(mysqli_error($conexao));
                                                    $row2 = mysqli_num_rows($sql2);
                                                    if($row2>0) {
                                                        while ($exibe2 = mysqli_fetch_assoc($sql2)) {
                                                            echo '<option value="'.$exibe2['id'].'">'.$exibe2['nome'].'</option>';
                                                        }
                                                    }
                                    echo "</select><label><a href=\"pgCadastroRemetente.php\">&nbsp; CADASTRAR NOVO ÓRGÃO</a></label>
                                            </td>
            
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for=\"cMedicamento\">Medicamento:</label>
                                                <select style=\"width: 260px\" id=\"cMedicamento\" name=\"tMedicamento\" required>";

                                                $sql3 = mysqli_query($conexao, "Select * From medicamentos order by nome;")or die(mysqli_error($conexao));
                                                $row3 = mysqli_num_rows($sql3);
                                                if($row3>0) {
                                                    while ($exibe3 = mysqli_fetch_assoc($sql3)) {
                                                        echo '<option value=\"'.$exibe3['id'].'\">'.$exibe3['nome'].'-'.$exibe3['dosagem'].'</option>';
                                                    }
                                                }
                                        echo "</select><label><a href=\"pgCadastroMedicamento.php\">&nbsp;&nbsp;CADASTRAR NOVO MEDICAMENTO</a></label><br/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for=\"cPossologia\">Posologia:</label>
                                                <label for=\"cPossologiaManha\" >Manhã-</label>
                                                <input style=\"width: 60px\" type=\"number\" id=\"cPossologiaManha\" name=\"tPossologiaManha\" required>
                                                <label for=\"cPossologiaTarde\"> Tarde-</label>
                                                <input style=\"width: 60px\" type=\"number\" id=\"cPossologiaTarde\" name=\"tPossologiaTarde\" required>
                                                <label for=\"cPossologiaNoite\"> Noite-</label>
                                                <input style=\"width: 60px\" type=\"number\" id=\"cPossologiaNoite\" name=\"tPossologiaNoite\" required>
                                                <label for=\"cQuantidadeDias\">Quantidade de Dias:</label>
                                                <input style=\"width: 60px\" type=\"number\" id=\"cQuantidadeDias\" name=\"tQuantidadedeDias\" required>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <label>Médico: </label>
                                                <select style=\"width: 220px\" id=\"cMedico\" name=\"tMedico\" required>";
                                                $sql4 = mysqli_query($conexao, "Select * From medicos order by nome;")or die(mysqli_error($conexao));
                                                $row4 = mysqli_num_rows($sql4);
                                                if($row4>0) {
                                                    while ($exibe4 = mysqli_fetch_assoc($sql4)) {
                                                        echo '<option value="'.$exibe4['id'].'">'.$exibe4['nome'].'  |  CRM:'.$exibe4['crm'].'</option>';
                                                    }
                                                }
                                    echo "</select><label><a href=\"pgCadastroMedico.php\">&nbsp; CADASTRAR NOVO MÉDICO</a></label>
                                            </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Informações Adiionais:</label><br/>
                                                        <textarea type=\"text\" style=\"width: 780px\" name=\"tInformacoesAdicionais\" placeholder=\"Informações adicionais\" maxlength=\"1000\" rows=\"10\" cols=\"81\"></textarea><br/><br/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                            <input type=\"hidden\" id=\"cGravando\" name=\"tGravando\" value=\"verdadeiro\">
                                            <input class=\"Botao\" id=\"cBotaoGravar\" type=\"submit\" name=\"gravar\" value=\"Gravar Informações\"><br>
                                        </form>";
                    }
                    //Se tGravando for diferente vazio, cai aqui
                    else
                    {
                        if((!empty($_GET['tCpf']))){
                            $vCpf = $_GET['tCpf'];
                            $sql = mysqli_query($conexao, "Select * From pacientes where cpf='$vCpf';")or die(mysqli_error($conexao));
                            $row = mysqli_num_rows($sql);
                            //Se o paciente for cadastrado, cai aqui
                            if($row>0){
                                $exibe = mysqli_fetch_assoc($sql);
                                echo"<div id=\"corpo-interno\">
                                <h3>Dados Pessoais</h3>
                                <form id=\"cNoaConsulta\" name=\"nNovaConsulta\" method=\"get\" action=\"pgSimplificada.php\">
                                <div id=\"caixa-simples\">
                                <table id=\"formulario\">
                                    <tr>
                                        <td>
                                            <label for=\"cCpf\">CPF (Obrigatório)</label><br/>
                                            <input type=\"text\" id=\"cCpf\" name=\"tCpf\" style=\"width: 130px; background-color: rgba(255,145,145,.5);\" value=\"$vCpf\" pattern=\"\d{3}\.\d{3}\.\d{3}-\d{2}\" title=\"Digite um CPF no formato: xxx.xxx.xxx-xx\" placeholder=\"000.000.000-00\" required maxlength=\"14\" onKeyUp=\"if(event.keyCode==13 || this.value.length == 14){pesquisar_cpf(this.value)} else {formatar('###.###.###-##', this);}\">
                                            <label style=\"color: rgba(9,134,0,1);\">Encontrado!</label>
                                        </td>
                                        <td>
                                            <label for=\"cNome\">Nome (Obrigatório)</label><br/>
                                            <input type=\"text\" id=\"cNome\" name=\"tNome\" style=\"width: 330px; background-color: rgba(255,145,145,.5);\" value=\"".$exibe['nome']."\" title=\"Digite o nome do paciente\" placeholder=\"Nome do paciente\" required>
                                        </td>
                                        <td>
                                            <label for=\"cProntuario\">Prontuário (PSA)</label><br/>
                                            <input type=\"text\" id=\"cProntuario\" name=\"tProntuario\" style=\"width: 130px\" value=\"".$exibe['prontuario']."\" title=\"Informe o prontuário do paciente no PSA\">
            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for=\"cSus\">Nº Cartão do SUS</label><br/>
                                            <input type=\"text\" id=\"cSus\" name=\"tSus\" style=\"width: 160px\" value=\"".$exibe['sus']."\" title=\"Informe o prontuário do paciente no PSA\">
            
                                        </td>
                                        <td>
                                            <label for=\"cRg\">Nº do RG</label><br/>
                                            <input type=\"text\" id=\"cRg\" name=\"tRg\" style=\"width: 160px\" value=\"".$exibe['RG']."\" title=\"Informe o prontuário do paciente no PSA\">
            
                                        </td>
                                        <td>
                                            <label for=\"cRg\">Nº da CNH</label><br/>
                                            <input type=\"text\" id=\"cCnh\" name=\"tCnh\" style=\"width: 160px\" value=\"".$exibe['cnh']."\" title=\"Informe o prontuário do paciente no PSA\">
                                        </td>
                                    <tr>
                                        <td>";
                                       //Configurando data de nascimento
                                    $data = $exibe['data_nascimento'];
                                    $partes = explode("-", $data);
                                    $ano = $partes[0];
                                    $mes = $partes[1];
                                    $dia = $partes[2];

                                      echo "<label>Data de Nascimento</label><br/>
                                            <label for=\"cDia\">Dia:</label><input type=\"number\" id=\"cDia\" name=\"tDia\" style=\"width: 40px\" value=\"$dia\" min=\"1\" max=\"31\" required>
                                            <label for=\"cMes\">Mês:</label><input type=\"number\" id=\"cMes\" name=\"tMes\" style=\"width: 40px\" value=\"$mes\" min=\"1\" max=\"12\" required>
                                            <label for=\"cAno\">Ano:</label><input type=\"number\" id=\"cAno\" name=\"tAno\" style=\"width: 50px\" value=\"$ano\" min=\"1900\" max=\"2100\" required><br/>
            
                                        </td>
                                        <td>
                                            <label for=\"cGenero\">Gênero</label><br/>
                                            <select id=\"cGenero2\" name=\"tGenero\" style=\"width: 80px\">";

                                            if($exibe['genero']=="M"){
                                                echo "<option value=\"M\">M</option>
                                                      <option value=\"F\">F</option>";
                                            }else{
                                                echo "<option value=\"F\">F</option>
                                                      <option value=\"M\">M</option>";
                                            }


                                            echo "</select>
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                    </table>
                                    </div>
                                    <h3>Contatos</h3>
                                    <div id=\"caixa-simples\">
                                    <table>
                                    <tr>
                                        <td>
                                            <label for=\"cTel\">Telefone de contato</label><br/>
                                            <input type=\"text\" id=\"cTel\" name=\"tTel\" style=\"width: 180px\" value=\"".$exibe['telefone']."\">
                                        </td>
                                        <td>
                                            <label for=\"cTel\">E-mail</label><br/>
                                            <input type=\"email\" id=\"cEmail\" name=\"tEmail\" style=\"width: 610px\" value=\"".$exibe['email']."\"><br/>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                                <h3>Endereço</h3>
                                <div id=\"caixa-simples\"><table>
                                    <tr>
                                        <td>
                                            <label for=\"cLogradouro\">Logradouro:</label><br/>
                                            <input style=\"width: 550px\" type=\"text\" id=\"cLogradouro\" name=\"tLogradouro\" value=\"".$exibe['logradouro']."\">
                                        </td>
                                        <td>
                                            <label for=\"cNumero\">Número:</label><br/>
                                            <input style=\"width: 240px\" type=\"text\" id=\"cNumero\" name=\"tNumero\" value=\"".$exibe['numero']."\"><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for=\"cBairro\">Bairro</label><br/>
                                            <input style=\"width: 410px\" type=\"text\" id=\"cBairro\" name=\"tBairro\" value=\"".$exibe['bairro']."\"><br/>
                                        </td>
                                        <td>
                                            <label for=\"cCidade\">Cidade:</label><br/>
                                            <input style=\"width: 240px\" type=\"text\" id=\"cCidade\" name=\"tCidade\" value=\"".$exibe['cidade']."\"><br/>
                                            <label for=\"cUf\">&nbsp;UF:</label><br/>
                                            <input style=\"width: 50px\" type=\"text\" id=\"cUf\" name=\"tUf\" value=\"".$exibe['uf']."\"><br/>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                                <h3>Dados do Atendimento</h3>
                                <div id=\"caixa-simples\" style=\"background-color: rgba(255,145,145,.4)\">
                                    <table>
                                        <tr>
                                            <td>
                                                <label for=\"cSituacao\">Situacao:</label>
                                                <select style=\"width: 240px\" id=\"cSituacao\" name=\"tSituacao\" required>
                                                    <option value=\"nenhum\">Nenhum</option>
                                                    <option value=\"Acolhido e Encaminhado\">Acolhido e Encaminhado</option>
                                                    <option value=\"Acolhido\">Acolhido</option>
                                                    <option value=\"Demanda Espontânea\">Demanda Espontânea</option>
                                                </select> &nbsp Por:
                                                <select style=\"width: 140px\" id=\"cRemetente\" name=\"tRemetente\" required>";
                                $sql2 = mysqli_query($conexao, "Select * From remetentes order by nome;")or die(mysqli_error($conexao));
                                $row2 = mysqli_num_rows($sql2);
                                if($row2>0) {
                                    while ($exibe2 = mysqli_fetch_assoc($sql2)) {
                                        echo '<option value="'.$exibe2['id'].'">'.$exibe2['nome'].'</option>';
                                    }
                                }
                                echo "</select><label><a href=\"pgCadastroRemetente.php\">&nbsp; CADASTRAR NOVO ÓRGÃO</a></label>
                                            </td>
            
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for=\"cMedicamento\">Medicamento:</label>
                                                <select style=\"width: 260px\" id=\"cMedicamento\" name=\"tMedicamento\" required>";

                                                $sql3 = mysqli_query($conexao, "Select * From medicamentos order by nome;")or die(mysqli_error($conexao));
                                                $row3 = mysqli_num_rows($sql3);
                                                if($row3>0) {
                                                    while ($exibe3 = mysqli_fetch_assoc($sql3)) {
                                                        echo '<option value="'.$exibe3['id'].'">'.$exibe3['nome'].'-'.$exibe3['dosagem'].'</option>';
                                                    }
                                                }
                                        echo "</select><label><a href=\"pgCadastroMedicamento.php\">&nbsp;&nbsp;CADASTRAR NOVO MEDICAMENTO</a></label><br/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for=\"cPossologia\">Posologia:</label>
                                                <label for=\"cPossologiaManha\">Manhã-</label>
                                                <input style=\"width: 60px\" type=\"number\" id=\"cPossologiaManha\" name=\"tPossologiaManha\" required>
                                                <label for=\"cPossologiaTarde\"> Tarde-</label>
                                                <input style=\"width: 60px\" type=\"number\" id=\"cPossologiaTarde\" name=\"tPossologiaTarde\" required>
                                                <label for=\"cPossologiaNoite\"> Noite-</label>
                                                <input style=\"width: 60px\" type=\"number\" id=\"cPossologiaNoite\" name=\"tPossologiaNoite\" required>
                                                <label for=\"cQuantidadeDias\">Quantidade de Dias:</label>
                                                <input style=\"width: 60px\" type=\"number\" id=\"cQuantidadeDias\" name=\"tQuantidadedeDias\" required>
                                            </td>
                                        </tr>";
                                        echo "<tr>
                                            <td>
                                                <label>Médico: </label>
                                                <select style=\"width: 220px\" id=\"cMedico\" name=\"tMedico\" required>";
                                $sql4 = mysqli_query($conexao, "Select * From medicos order by nome;")or die(mysqli_error($conexao));
                                $row4 = mysqli_num_rows($sql4);
                                if($row4>0) {
                                    while ($exibe4 = mysqli_fetch_assoc($sql4)) {
                                        echo '<option value="'.$exibe4['id'].'">'.$exibe4['nome'].'  |  CRM:'.$exibe4['crm'].'</option>';
                                    }
                                }
                                echo "</select><label><a href=\"pgCadastroMedico.php\">&nbsp; CADASTRAR NOVO MÉDICO</a></label>
                                            </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Informações Adiionais:</label><br/>
                                                        <textarea type=\"text\" style=\"width: 780px\" name=\"tInformacoesAdicionais\" placeholder=\"Informações adicionais\" maxlength=\"1000\" rows=\"10\" cols=\"81\"></textarea><br/><br/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                            <input type=\"hidden\" id=\"cGravando\" name=\"tGravando\" value=\"verdadeiro\">
                                            <input type=\"hidden\" id=\"cFlag\" name=\"tFlag\" value=\"pacienteExistente\">
                                            <input class=\"Botao\" id=\"cBotaoGravar\" type=\"submit\" name=\"gravar\" value=\"Gravar Informações\"><br>
                                        </form>
                                        <br/>
                                        <br/>
                                        <label>==================================</label>
                                        <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Últimos 5 Atendimentos</h3>
                                        <label>==================================</label>
                                        <table>
                                            <tr>
                                                <td>";
                                //===================================
                                //COMECA LER AS CONSULTAS
                                //===================================
                                $id_paciente=$exibe['id'];
                                $sql_consultas = mysqli_query($conexao, "Select * From consultas where `fkpaciente` ='$id_paciente' ORDER BY data DESC;")or die(mysqli_error($conexao));
                                $row_consultas = mysqli_num_rows($sql_consultas);

                                if($row_consultas>0){
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


                                        echo '<div id="caixa-simples"><label style="background-color: rgba(255,145,145,.4); padding: 8px; border-radius: 3px 3px 3px 3px; font-size: 24px;">Receita '.$exibe_consultas['id'].'</label><br/><br/>';

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
                                        echo "</div><br/>";

                                    }



                                }
                                else{
                                    echo '<div id="caixa-simples">
                                        
                                        Esse Paciente ainda não fez nenhuma consulta!<br/>
                                        Preencha a primeira consulta na caixa rosa acima.<br/>
                                    </div>';
                                }

                                echo " </td>
                                  </tr>
                                    </table>";
                                echo"</div>";
                            }
                            //SE O paciente nao for cadastrado cai aqui
                            else{
                                echo"<div id=\"corpo-interno\">
                                <h3>Dados Pessoais</h3>
                                <form id=\"cNoaConsulta\" name=\"nNovaConsulta\" method=\"get\" action=\"pgSimplificada.php\">
                                <div id=\"caixa-simples\">
                                <table id=\"formulario\">
                                    <tr>
                                        <td>
                                            <label for=\"cCpf\">CPF (Obrigatório)</label><br/>
                                            <input type=\"text\" id=\"cCpf\" name=\"tCpf\" style=\"width: 130px; background-color: rgba(255,145,145,.5);\" value=\"$vCpf\" pattern=\"\d{3}\.\d{3}\.\d{3}-\d{2}\" title=\"Digite um CPF no formato: xxx.xxx.xxx-xx\" placeholder=\"000.000.000-00\" required maxlength=\"14\" onKeyUp=\"if(event.keyCode==13 || this.value.length == 14){pesquisar_cpf(this.value)} else {formatar('###.###.###-##', this);}\">
                                            <label style=\"color: rgba(255,24,0,1);\">Não Cadastrado</label>
                                        </td>
                                        <td>
                                            <label for=\"cNome\">Nome (Obrigatório)</label><br/>
                                            <input type=\"text\" id=\"cNome\" name=\"tNome\" style=\"width: 330px; background-color: rgba(255,145,145,.5);\" title=\"Digite o nome do paciente\" placeholder=\"Nome do paciente\" required>
                                        </td>
                                        <td>
                                            <label for=\"cProntuario\">Prontuário (PSA)</label><br/>
                                            <input type=\"text\" id=\"cProntuario\" name=\"tProntuario\" style=\"width: 130px\" title=\"Informe o prontuário do paciente no PSA\">
            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for=\"cSus\">Nº Cartão do SUS</label><br/>
                                            <input type=\"text\" id=\"cSus\" name=\"tSus\" style=\"width: 160px\" title=\"Informe o prontuário do paciente no PSA\">
            
                                        </td>
                                        <td>
                                            <label for=\"cRg\">Nº do RG</label><br/>
                                            <input type=\"text\" id=\"cRg\" name=\"tRg\" style=\"width: 160px\" title=\"Informe o prontuário do paciente no PSA\">
            
                                        </td>
                                        <td>
                                            <label for=\"cRg\">Nº da CNH</label><br/>
                                            <input type=\"text\" id=\"cCnh\" name=\"tCnh\" style=\"width: 160px\" title=\"Informe o prontuário do paciente no PSA\">
                                        </td>
                                    <tr>
                                        <td>
                                            <label>Data de Nascimento</label><br/>
                                            <label for=\"cDia\">Dia:</label><input type=\"number\" id=\"cDia\" name=\"tDia\" style=\"width: 40px\" min=\"1\" max=\"31\" required>
                                            <label for=\"cMes\">Mês:</label><input type=\"number\" id=\"cMes\" name=\"tMes\" style=\"width: 40px\" min=\"1\" max=\"12\" required>
                                            <label for=\"cAno\">Ano:</label><input type=\"number\" id=\"cAno\" name=\"tAno\" style=\"width: 50px\" min=\"1900\" max=\"2100\" required><br/>
            
                                        </td>
                                        <td>
                                            <label for=\"cGenero\">Gênero</label><br/>
                                            <select id=\"cGenero\" name=\"tGenero\" style=\"width: 80px\">
                                                <option value=\"M\">M</option>
                                                <option value=\"F\">F</option>
                                            </select>
                                        </td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                </table>
                                </div>
                                <h3>Contatos</h3>
                                <div id=\"caixa-simples\">
                                    <table>
                                    <tr>
                                        <td>
                                            <label for=\"cTel\">Telefone de contato</label><br/>
                                            <input type=\"text\" id=\"cTel\" name=\"tTel\" style=\"width: 180px\">
                                        </td>
                                        <td>
                                            <label for=\"cTel\">E-mail</label><br/>
                                            <input type=\"email\" id=\"cEmail\" name=\"tEmail\" style=\"width: 610px\"><br/>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                                <h3>Endereço</h3>
                                <div id=\"caixa-simples\"><table>
                                    <tr>
                                        <td>
                                            <label for=\"cLogradouro\">Logradouro:</label><br/>
                                            <input style=\"width: 550px\" type=\"text\" id=\"cLogradouro\" name=\"tLogradouro\">
                                        </td>
                                        <td>
                                            <label for=\"cNumero\">Número:</label><br/>
                                            <input style=\"width: 240px\" type=\"text\" id=\"cNumero\" name=\"tNumero\"><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for=\"cBairro\">Bairro</label><br/>
                                            <input style=\"width: 410px\" type=\"text\" id=\"cBairro\" name=\"tBairro\"><br/>
                                        </td>
                                        <td>
                                            <label for=\"cCidade\">Cidade:</label><br/>
                                            <input style=\"width: 240px\" type=\"text\" id=\"cCidade\" name=\"tCidade\"><br/>
                                            <label for=\"cUf\">&nbsp;UF:</label><br/>
                                            <input style=\"width: 50px\" type=\"text\" id=\"cUf\" name=\"tUf\"><br/>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                                <h3>Dados do Atendimento</h3>
                                <div id=\"caixa-simples\" style=\"background-color: rgba(255,145,145,.4)\">
                                    <table>
                                        <tr>
                                            <td>
                                                <label for=\"cSituacao\">Situacao:</label>
                                                <select style=\"width: 240px\" id=\"cSituacao\" name=\"tSituacao\" required>
                                                    <option value=\"nenhum\">Nenhum</option>
                                                    <option value=\"Acolhido e Encaminhado\">Acolhido e Encaminhado</option>
                                                    <option value=\"Acolhido\">Acolhido</option>
                                                    <option value=\"Demanda Espontânea\">Demanda Espontânea</option>
                                                </select> &nbsp Por:
                                                <select style=\"width: 140px\" id=\"cRemetente\" name=\"tRemetente\" required>";
                                $sql2 = mysqli_query($conexao, "Select * From remetentes ORDER by nome;")or die(mysqli_error($conexao));
                                $row2 = mysqli_num_rows($sql2);
                                if($row2>0) {
                                    while ($exibe2 = mysqli_fetch_assoc($sql2)) {
                                        echo '<option value="'.$exibe2['id'].'">'.$exibe2['nome'].'</option>';
                                    }
                                }
                                echo "</select><label><a href=\"pgCadastroRemetente.php\">&nbsp; CADASTRAR NOVO ÓRGÃO</a></label>
                                            </td>
            
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <label for=\"cMedicamento\">Medicamento:</label>
                                                <select style=\"width: 260px\" id=\"cMedicamento\" name=\"tMedicamento\" required>";

                                                $sql3 = mysqli_query($conexao, "Select * From medicamentos ORDER by nome;")or die(mysqli_error($conexao));
                                                $row3 = mysqli_num_rows($sql3);
                                                if($row3>0) {
                                                    while ($exibe3 = mysqli_fetch_assoc($sql3)) {
                                                        echo '<option value=\"'.$exibe3['id'].'\">'.$exibe3['nome'].'-'.$exibe3['dosagem'].'</option>';
                                                    }
                                                }
                                        echo "</select><label><a href=\"pgCadastroMedicamento.php\">&nbsp;&nbsp;CADASTRAR NOVO MEDICAMENTO</a></label><br/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for=\"cPossologia\">Posologia:</label>
                                                <label for=\"cPossologiaManha\">Manhã-</label>
                                                <input style=\"width: 60px\" type=\"number\" id=\"cPossologiaManha\" name=\"tPossologiaManha\" required>
                                                <label for=\"cPossologiaTarde\"> Tarde-</label>
                                                <input style=\"width: 60px\" type=\"number\" id=\"cPossologiaTarde\" name=\"tPossologiaTarde\" required>
                                                <label for=\"cPossologiaNoite\"> Noite-</label>
                                                <input style=\"width: 60px\" type=\"number\" id=\"cPossologiaNoite\" name=\"tPossologiaNoite\" required>
                                                <label for=\"cQuantidadeDias\">Quantidade de Dias:</label>
                                                <input style=\"width: 60px\" type=\"number\" id=\"cQuantidadeDias\" name=\"tQuantidadedeDias\" required>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <label>Médico: </label>
                                                <select style=\"width: 220px\" id=\"cMedico\" name=\"tMedico\" required>";
                                $sql4 = mysqli_query($conexao, "Select * From medicos ORDER by nome;")or die(mysqli_error($conexao));
                                $row4 = mysqli_num_rows($sql4);
                                if($row4>0) {
                                    while ($exibe4 = mysqli_fetch_assoc($sql4)) {
                                        echo '<option value="'.$exibe4['id'].'">'.$exibe4['nome'].'  |  CRM:'.$exibe4['crm'].'</option>';
                                    }
                                }
                                echo "</select><label><a href=\"pgCadastroMedico.php\">&nbsp; CADASTRAR NOVO MÉDICO</a></label>
                                            </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Informações Adiionais:</label><br/>
                                                        <textarea type=\"text\" style=\"width: 780px\" name=\"tInformacoesAdicionais\" placeholder=\"Informações adicionais\" maxlength=\"1000\" rows=\"10\" cols=\"81\"></textarea><br/><br/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                            <input type=\"hidden\" id=\"cGravando\" name=\"tGravando\" value=\"verdadeiro\">
                                            <input type=\"hidden\" id=\"cFlag\" name=\"tFlag\" value=\"pacienteNaoExistente\">
                                            <input class=\"Botao\" id=\"cBotaoGravar\" type=\"submit\" name=\"gravar\" value=\"Gravar Informações\"><br>
                                        </form>";
                            }
                        }
                    }
                ?>
            </div>
        </article>
        <footer>
            <div id="rodape">

            </div>
        </footer>
    
    </body>
</html>
