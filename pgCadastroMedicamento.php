<?php
include '_mysql/conexao.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css"/>
        <title>Cadastro de Medicamentos</title>
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
                    <h1>Cadastro de Medicamento</h1>
                    <form id="cCadastroMedicamento" name="nCadastroMedicamento" method="get" action="cadastrandoMedicamento.php">
                            <div id="caixa-generica">
                                <table>
                                    <tr>
                                        
                                        <td>
                                            <img src="_imagens/icone-remedio.png">
                                        </td>
                                        <td>
                                            <label for="cSubstancia">Nome da Substância</label><br/>
                                            <input class="cCampo" type="text" id="cNome" name="tNome" autofocus required><br/>
                                            <label for="cSubstancia">Dosagem da Substância</label><br/>
                                            <input class="cCampo" type="text" id="cDosagem" name="tDosagem" autofocus required><br/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <input class="Botao" id="cBotaoEntrar" type="submit" value="Cadastrar Novo Medicamento">
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
