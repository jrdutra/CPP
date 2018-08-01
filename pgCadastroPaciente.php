<?php
include '_mysql/conexao.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css"/>
        <title>Cadastro de Pacientes Psiquiátricos</title>
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
            <div id="corpo">
                <div id="corpo-interno">
                    <h1>Cadastro de Paciente:</h1>
                    <form id="cCadastroPaciente" name="nCadastroPaciente" method="get" action="cadastrandoPaciente.php">
                        <div id="caixa-generica">
                            <h3>Dados pessoais:</h3>
                            <label for="cNome" >Nome (Obrigatório)</label><br/>
                            <input class="cCampo" type="text" id="cNome" name="tNome" autofocus required><br/>
                            <?php
                                if((empty($_GET['tCpf'])))
                                {
                                    echo "<label for=\"cCpf\">CPF (Obrigatório)</label><br/>
                                            <input class=\"cCampo\" type=\"text\" id=\"cCpf\" name=\"tCpf\" pattern=\"\d{3}\.\d{3}\.\d{3}-\d{2}\" title=\"Digite um CPF no formato: xxx.xxx.xxx-xx\" placeholder=\"000.000.000-00\" required maxlength=\"14\" OnKeyPress=\"formatar('###.###.###-##', this)\"><br/>";
                                }
                                else
                                {
                                    $vCpf = $_GET['tCpf'];
                                    echo "<label for=\"cCpf\">CPF (Obrigatório)</label><br/>
                                          <input class=\"cCampo\" type=\"text\" id=\"cCpf\" name=\"tCpf\" value=\"$vCpf\" pattern=\"\d{3}\.\d{3}\.\d{3}-\d{2}\" title=\"Digite um CPF no formato: xxx.xxx.xxx-xx\" placeholder=\"000.000.000-00\" required maxlength=\"14\" OnKeyPress=\"formatar('###.###.###-##', this)\"><br/>";
                                }

                            ?>

                            <label for="cProntuario">Prontuário do PSA</label><br/>
                            <input class="cCampo" type="text" id="cProntuario" name="tProntuario"><br/>

                            <label for="cSus">Número do Cartão do SUS</label><br/>
                            <input class="cCampo" type="text" id="cSus" name="tSus"><br/>

                            <label for="cRg">RG</label><br/>
                            <input class="cCampo" type="text" id="cRg" name="tRg"><br/>

                            <label for="cCnh">Carteira Nacional de Habilitação</label><br/>
                            <input class="cCampo" type="text" id="cCnh" name="tCnh"><br/>

                            <label>Data de Nascimento</label><br/>
                            <label for="cDia">Dia:</label><input class="cCampoPequeno" type="number" id="cDia" name="tDia" min="1" max="31">
                            <label for="cMes">Mês:</label><input class="cCampoPequeno" type="number" id="cMes" name="tMes" min="1" max="12">
                            <label for="cAno">Ano:</label><input class="cCampoPequeno" type="number" id="cAno" name="tAno" min="1900" max="2100"><br/>
                            <label for="cGenero">Gênero</label><br/>
                            <select id="cGenero" name="tGenero">
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                            <br/>
                            <h3>Contatos:</h3>
                            <label for="cTel">Telefone de contato</label><br/>
                            <input class="cCampo" type="text" id="cTel" name="tTel"><br/>
                            <label for="cTel">E-mail</label><br/>
                            <input class="cCampo" type="email" id="cEmail" name="tEmail"><br/>

                            <h3>Endereço:</h3>
                            <label for="cLogradouro">Logradouro:</label><br/>
                            <input class="cCampo" type="text" id="cLogradouro" name="tLogradouro">
                            <label for="cNumero">Número:</label>
                            <input class="cCampoPequeno" type="text" id="cNumero" name="tNumero"><br/>
                            <label for="cBairro">Bairro</label><br/>
                            <input class="cCampo" type="text" id="cBairro" name="tBairro"><br/>
                            <label for="cCidade">Cidade:</label><br/>
                            <input class="cCampo" type="text" id="cCidade" name="tCidade">
                            <label for="cUf">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UF:</label>
                            <input class="cCampoPequeno" type="text" id="cUf" name="tUf"><br/>


                        </div>
                        <input class="Botao" id="cBotaoEntrar" type="submit" value="Cadastrar Novo Paciente">
                    </form>
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
