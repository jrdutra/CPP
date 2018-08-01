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
        <script type="text/javascript">
            function cadastrado(id) {
                window.location='detalhandoPaciente.php?id='+id
            }
            function naocadastrado() {
                setTimeout("window.location='pgCadastroPaciente.php'", 1000);
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
                $vData_nasc=$vDia+"-".$vMes."-".$vAno;
                $vData_nasc2=$vAno."-".$vMes."-".$vDia;
                //calculando idade
                date_default_timezone_set('America/Sao_Paulo');
                $data_atual = date('Y-m-d');
                $data1 = new DateTime($data_atual);
                $data2 = new DateTime($vData_nasc2);
                $idade= $data1->diff($data2);
            ?>
            <div id="corpo">
                <div id="corpo-interno">
                    <!-- Mostrando se o Paciente foi cadastrado com sucesso -->
                    <?php
                    //grava a amostra na base de dados
                    $sql = mysqli_query($conexao,"INSERT INTO `$banco`.`pacientes` (`id`,`nome`,`cpf`,`prontuario`,`sus`,`RG`,`cnh`,`data_nascimento`,`genero`,`telefone`,`email`,`logradouro`,`numero`,`bairro`,`cidade`,`uf`) VALUES (NULL ,'$vNome','$vCpf','$vProntuario','$vSus','$vRg','$vCnh','$vData_nasc2','$vGenero','$vTel','$vEmail','$vLogradouro','$vNumero','$vBairro','$vCidade','$vUf');");

                    //pegando a id do paciente recem cadastrado
                    $sql2 = mysqli_query($conexao, "Select * From pacientes where cpf='$vCpf';")or die(mysqli_error($conexao));
                    $row = mysqli_num_rows($sql2);
                    if($row>0) {
                        while ($exibe = mysqli_fetch_assoc($sql2)) {
                            $id_paciente = $exibe['id'];
                        }
                    }

                    if($sql==1){
                        echo "<div id=\"caixa-generica\">
                                    <h3>Paciente Cadastrado com Sucesso!</h3>
                                </div>";
                        echo"<script>cadastrado($id_paciente)</script>";
                    } else {

                        echo "<h2>Falhou ao tentar cadastrar o paciente!</h2>";
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
