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
                var txt_pagina="pesquisando.php?tFlag=cpf&tCpf=";
                var link = txt_pagina.concat(cpf);
                window.location='pesquisando.php?tFlag=cpf&tCpf='+cpf;
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
                    <h1>Pesquisa de Paciente:</h1>
                    <div id="caixa-generica">
                        <h3>Pesquisa por CPF:</h3>
                        <table>
                            <tr>
                                <td>
                                    <img src="_imagens/icone-paciente-homem.png">
                                </td>
                                <td>
                                    <form id="cPesquisaCpf" name="nPesquisaCpf" method="get" action="pesquisando.php">
                                        <input type="hidden" id="cFlag" name="tFlag" value="cpf">
                                        <label for="cCpf">CPF do Paciente</label><br/>
                                        <input class="cCampo" type="text" id="cCpf" name="tCpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF no formato: xxx.xxx.xxx-xx" placeholder="000.000.000-00" required maxlength="14" onKeyUp="if(event.keyCode==13 || this.value.length == 14){pesquisar_cpf(this.value)} else {formatar('###.###.###-##', this);}"><br/><br/>
                                        <input class="Botao" id="cBotaoEntrar" type="submit" value="Pesquisar">
                                    </form>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div id="caixa-generica">
                        <h3>Pesquisa por Nome:</h3>
                        <table>
                            <tr>
                                <td>
                                    <img src="_imagens/icone-paciente-homem.png">
                                </td>
                                <td>
                                    <form id="cPesquisaNome" name="nPesquisaNome" method="get" action="pesquisando.php">
                                        <input type="hidden" id="cFlag" name="tFlag" value="nome">
                                        <label for="cNome">Nome do Paciente</label><br/>
                                        <input class="cCampo" type="text" id="cNome" name="tNome"><br/><br/>
                                        <input class="Botao" id="cBotaoEntrar" type="submit" value="Pesquisar">
                                    </form>
                                </td>
                            </tr>
                        </table>

                    </div>
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
