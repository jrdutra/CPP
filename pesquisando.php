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
        <script type="text/javascript">
            function cadastra_paciente_cpf(cpf) {
                window.location='pgCadastroPaciente.php?tCpf='+cpf;
            }
            function cadastra_paciente() {
                window.location='pgCadastroPaciente.php';
            }
            function exibe_paciente(id) {
                window.location='detalhandoPaciente.php?id='+id;
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
                    <h1>Paciente(s) Encontrados:</h1>
                    <?php
                    $vFlag=$_GET['tFlag'];

                    if($vFlag=="cpf"){
                        $vCpf=$_GET['tCpf'];
                        $sql = mysqli_query($conexao, "Select * From pacientes where cpf='$vCpf';")or die(mysqli_error($conexao));
                        $row = mysqli_num_rows($sql);
                        if($row>0)
                        {
                            while($exibe = mysqli_fetch_assoc($sql)) {
                                $id_paciente=$exibe['id'];
                                echo "<script>exibe_paciente(".$exibe['id'].")</script>";
                            }
                        }
                        else{
                               echo "<script>cadastra_paciente_cpf(\"$vCpf\")</script>";
                        }
                    }
                    if($vFlag=="nome"){
                        $vNome=$_GET['tNome'];
                        $sql = mysqli_query($conexao, "Select * From pacientes where UPPER(nome) like '%$vNome%';")or die(mysqli_error($conexao));
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
                                    echo '<a href="detalhandoPaciente.php?id=' . $id_paciente . '">
                                                 <div id="caixa-paciente">
                                                    <table>
                                                        <tr>
                                                            <td>';
                                    if ($exibe['genero'] == 'M') {
                                        echo '<img src="_imagens/icone-paciente-homem.png">';
                                    } else {
                                        echo '<img src="_imagens/icone-paciente-mulher.png">';
                                    }
                                    echo '</td>
                                                            <td>
                                                                <label id="cCampo"style="font-size: 28px;">Nome: </label><label id="cVariavel" style="color: #700000; font-size: 28px;">' . $exibe['nome'] . '</label><br/>
                                                                <label id="cCampo">CPF: </label><label id="cVariavel">' . $exibe['cpf'] . '</label>&nbsp;&nbsp;&nbsp;
                                                                <label id="cCampo">Prontuário: </label><label id="cVariavel" style="color: #700000;">' . $exibe['prontuario'] . '</label><br/>
                                                                <label id="cCampo">Data de Nascimento: </label><label id="cVariavel">' . date('d/m/Y', strtotime($exibe['data_nascimento'])) . '</label><br/>
                                                                <label id="cCampo">Idade: </label><label id="cVariavel">' . $idade->y . '</label><br/>                     
                                                                <label id="cCampo">Útimo Atendimento: </label><label id="cVariavel" style="color: #700000;">dd/mm/aaaa</label><br/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                </a>';
                                }
                        }
                        else{
                            echo"<script>cadastra_paciente()</script>";
                        }
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
