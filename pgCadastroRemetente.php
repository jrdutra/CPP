<?php
include '_mysql/conexao.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css"/>
        <title>Cadastro de Remetentes</title>
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
                    <h1>Cadastro de Órgão de Origem do Paciente</h1>
                    <form id="cCadastroRemetente" name="nCadastroRemetente" method="get" action="cadastrandoRemetente.php">
                            <div id="caixa-generica">
                                <table>
                                    <tr>
                                        <td>
                                            <img src="_imagens/icone-remetente.png">
                                        </td>
                                        <td>
                                            <label for="cSubstancia">Nome do Órgão</label><br/>
                                            <input class="cCampo" type="text" id="cNome" name="tNome" autofocus required><br/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <input class="Botao" id="cBotaoEntrar" type="submit" value="Cadastrar Novo Remetente">
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
