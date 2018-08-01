<?php
include '_mysql/conexao.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css"/>
        <title>Cadastrando Medicamentos</title>
        <link rel="shortcut icon" href="_imagens/favicon.png" type="image/png"/>
        <script type="text/javascript">
            function cadastrado() {
                setTimeout("window.location='pgMenuPrincipal.php'", 5000);
            }
            function naocadastrado() {
                setTimeout("window.location='pgMenuPrincipal.php'", 1000);
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
                $vNome = $_GET['tNome'];
                $vDosagem = $_GET['tDosagem'];

            ?>
            <div id="corpo">
                <div id="corpo-interno">
                    <!-- Mostrando se o Paciente foi cadastrado com sucesso -->
                    <?php
                    //grava a amostra na base de dados
                    $sql = mysqli_query($conexao,"INSERT INTO `$banco`.`medicamentos` (`id`,`nome`,`dosagem`) VALUES (NULL ,'$vNome','$vDosagem');");
                    if($sql==1){
                        echo "<h3>Medicamento Cadastrado com Sucesso!</h3>
                                    <div id=\"caixa-generica\">
                                    <table>
                                        <tr>
                                            <td>
                                                <img src=\"_imagens/icone-remedio.png\">
                                            </td>
                                            <td>
                                                <label id=\"cCampo\">Nome: </label><label id=\"cVariavel\">$vNome</label><br/>
                                                <label id=\"cCampo\">Dosagem: </label><label id=\"cVariavel\">$vDosagem</label><br/>
                                            </td>
                                        
                                        </tr>
                                    </table>
                                </div>";
                        echo"<script>cadastrado()</script>";
                    } else {

                        echo "<h2>Falhou ao tentar cadastrar o medicamento!</h2>";
                        echo"<script>naocadastrado()</script>";
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
