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
                    <div id="caixa-generica">
                        <table>
                            <tr>
                                <td><img src="_imagens/pointe-down.png"></td>
                                <td><h1>Escolha uma das opções abaixo</h1></td>
                            </tr>
                        </table>
                        <div id="caixa-botaoMenu"><a id="botao_menu" href="pgPesquisa.php"><div id="botao_menu">Pesquisar Paciente</div></a><label id="descricao_botao_menu">Fazer pesquisa por CPF ou por NOME do paciente.</label></div>
                        <div id="caixa-botaoMenu"><a id="botao_menu" href="pgCadastroPaciente.php"><div id="botao_menu">Cadastrar Paciente</div></a><label id="descricao_botao_menu">Cadastrar um novo paciente no sistema.</label></div>
                        <div id="caixa-botaoMenu"><a id="botao_menu" href="pgCadastroMedicamento.php"> <div id="botao_menu">Cadastrar Medicamento</div></a><label id="descricao_botao_menu">Cadastrar um novo remédio no sistema.</label></div>
                        <div id="caixa-botaoMenu"><a id="botao_menu" href="pgCadastroMedico.php"> <div id="botao_menu">Cadastrar Médico</div></a><label id="descricao_botao_menu">Cadastrar um médico no sistema.</label></div>
                        <div id="caixa-botaoMenu"><a id="botao_menu" href="pgCadastroRemetente.php">  <div id="botao_menu">Cadastrar Órgão de Origem</div></a><label id="descricao_botao_menu">Cadastrar um órgão ou entidade de origem do paciente.</label></div>
                        <div id="caixa-botaoMenu"><a id="botao_menu" href="pgDados.php"><div id="botao_menu">Dados</div></a><label id="descricao_botao_menu">Visualizar diversos relatórios sobre as informações contidas no sistema.</label></div>
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
