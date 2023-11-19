<?php
if (isset($_POST["cadastrar"])) {
    require_once "conexao.php";

    // Recupere os dados do formulário
    $titulo = $_POST["tituloAdmin"];
    $conteudo = $_POST["conteudoAdmin"];
    $link = $_POST["linkAdmin"];

    // Verifique se um arquivo foi enviado
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
        $imagem_temp = $_FILES["imagem"]["tmp_name"];

        // Abra o arquivo em modo binário
        $imagem_binario = file_get_contents($imagem_temp);

        // Valide os dados (você pode adicionar mais validações aqui)
        if (empty($titulo) || empty($conteudo)) {
            echo "Por favor, preencha todos os campos.";
        } else {
            $conn = new Conexao();
            $sql = "INSERT INTO noticias (titulo, conteudo, imagem, link) VALUES (?, ?, ?,?)";
            $stmt = $conn->conexao->prepare($sql);
            $stmt->bindParam(1, $titulo);
            $stmt->bindParam(2, $conteudo);
            $stmt->bindParam(3, $imagem_binario, PDO::PARAM_LOB); // Use PDO::PARAM_LOB para dados binários grandes
            $stmt->bindParam(4, $link);
            if ($stmt->execute()) {
                echo "Notícia cadastrada com sucesso!";
            } else {
                echo "Erro ao cadastrar a notícia.";
            }
        }
    } else {
        echo "Por favor, escolha uma imagem.";
    }
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <title>Perfil</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel=stylesheet href="css/style.css">
    <script type="text/javascript" src="javascript/script.js"></script>
    <link rel="shortcut icon" type="image/png" href="imagem/favicon.png" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>


<body>

    <body id="bodyPerfil">
        <div class="box">
            <header id="headerPerfil">
                <div class="row" id="existeno">
                    <div id="divHeader" class="col-7" style="margin: auto;"><a href="index2.php"><img
                                src="imagem/aquasemfundo.png" alt="" id="imgAqua"></a></div>
                    <div id="divHeader" class="col-1" style="margin: auto;"><a href="index2.php" id="text"
                            href="#"><span id="spanInicio">Início</span></a>
                    </div>
                    <div id="divHeader" class="col-1" style="margin: auto;"><a href="sobre2.html" id="text"
                            href="#"><span id="spanSobre">Sobre</span></a>
                    </div>
                    <div id="divHeader" class="col-1" style="margin: auto;"><a href="contato2.html" id="text"
                            href="#"><span id="Contato">Contato</span></a></div>
                    <div id="divHeader" class="col-2" style="margin: auto;"><a href="perfil.html" id="text"
                            href="#"><span>
                                <div class="login">Perfil</div>
                            </span></a></div>

                </div>
            </header>
        </div>

        <div id="perfil">
            <p id="textoPerfil"> <span class="blue">|</span> ADMIN
            </p>
        </div>

        <div id="divpraia">
            <img src="imagem/imagempraia.svg" id="imgpraiaperfil">
        </div>

        <hr id="linha">
        <br>

        <main id="mainPerfil">
        <form action="" method="POST" enctype="multipart/form-data">
            <div id="cardsPerfil">
                <div class="card2Perfil">
                    <div class="infoPerfil">
                    <label id ="criarNoticia" style="color: white;"> Criar notícia</label>
                        <div id="fotoPerfil">
                        
                        <input type="text" id="inputAdmin" name="tituloAdmin" placeholder="titulo">
                        
                    </div>
                    <input type="text" id="inputAdmin" name="conteudoAdmin" placeholder="conteudo">
                </div>
                <input type="text" id="inputAdmin" name="linkAdmin" placeholder="link">
                <div class="mb-3" id="escolherFoto">
    <button type="button" id="trocarFotoBtn" class="btn btn-primary" onclick="document.getElementById('imagem').click();">Adicionar Foto</button>
    <input type="file" name="imagem" id="imagem" style="display: none;">
</div>
                <input type="submit" name="cadastrar">
            </div>
</form>
        </main>

        <footer id="footerAdmin"style="opacity: 0;>
            <div class="text-center" id="divfooter" style="opacity: 0;">
                Aqua Technology Ltda. © 2023 - All Rights Reserved. ©
            </div>
        </footer>
    </body>

</html>