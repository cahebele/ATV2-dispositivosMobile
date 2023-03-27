<?php
// Realiza a conexão com o banco de dados MySQL
$host = "localhost"; // Endereço do servidor
$user = "root"; // Nome do usuário
$password = ""; // Senha do usuário
$dbname = "atv2-mobile"; // Nome do banco de dados

$conn = mysqli_connect($host, $user, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
  die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Recebe os dados do formulário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$idade = isset($_POST['idade']) ? $_POST['idade'] : null;
$profissao = isset($_POST['profissao']) ? $_POST['profissao'] : null;
$resumo = isset($_POST['resumo']) ? $_POST['resumo'] : null;
$foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : null;

$alertaCadastro = '';

if ($nome && $idade && $profissao && $resumo && $foto) {
  // Salva a imagem no servidor
  $tmpName = $_FILES['foto']['tmp_name'];
  $destino = 'uploads/' . $foto;
  move_uploaded_file($_FILES["foto"]["tmp_name"], $destino);

  // Insere os dados no banco de dados
  $sqlInsert = "INSERT INTO cadastro (nome, idade, profissao, resumo, foto) VALUES ('$nome', '$idade', '$profissao', '$resumo', '$destino')";

  if (mysqli_query($conn, $sqlInsert)) {
    $alertaCadastro = "Cadastro realizado com sucesso!";
  } else {
    $alertaCadastro = "Erro ao realizar o cadastro: " . mysqli_error($conn);
  }

  header("location: home.php");
}

$integrantes = array();
$mensagem = '';

// Insere os dados no banco de dados
$sqlSelect = "SELECT * FROM cadastro";
$result = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($result) > 0) {
  $integrantes = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
  $mensagem = "Nenhum resultado encontrado";
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Ursos sem Curso</title>
    <meta charset="utf-8" />
    <meta
      http-equiv="Content-Security-Policy"
      content="default-src * 'self' 'unsafe-inline' 'unsafe-eval' data: gap: content:" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp"
      crossorigin="anonymous" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css" />
    <script src="js/index.js"></script>
  </head>
  <body>
    <div class="container overflow-x-hidden">
      <div
        class="container d-flex flex-column align-items-center bg-white rounded my-4 py-4 px-5 lista-container">
        <h6 class="text-dark text-center">Sobre o grupo</h6>
        <h5 class="text-black text-center">"Ursos Sem Curso"</h5>
        <?php if ($integrantes): ?>
    <div class="lista-integrantes overflow-y-scroll">
      <ul>
        <?php foreach ($integrantes as $integrante): ?>
          <li>
            <img src="<?php echo $integrante['foto']; ?>" alt="Foto do integrante" class="foto-integrante mb-3" />
            <h3><?=$integrante['nome']; ?></h3>
            <p><?=$integrante['idade']; ?> anos</p>
            <p><?=$integrante['profissao']; ?></p>
            <p><?=$integrante['resumo']; ?></p>
          </li>
        <?php endforeach;?>
      </ul>
    </div>
  <?php else: ?>
  <p class="mensagem"><?=$mensagem?></p>
  <?php endif; ?>
        <a href="cadastro.php">
          <button class="botao">Adicionar Integrante</button>
        </a>
      </div>
      <img src="img/ursos-sem-curso.png" alt="Imagem ursos sem curso" id="img-ursos" />
    </div>
  </body>
</html>
