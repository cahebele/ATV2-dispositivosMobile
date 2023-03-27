<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Ursos Sem Curso</title>
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
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <div class="cadastro-container container">
	<h1 class="w-100 text-center">Cadastro de Bio</h1>
	<form method="post" action="home.php" enctype="multipart/form-data" class="bg-white p-3 rounded mt-3">
		<label for="foto">Foto:</label>
		<input type="file" name="foto" onchange="previewImagem(event)"/><br>
		<img id="preview" class="preview" src="" alt="">

		<label for="nome">Nome:</label>
		<input type="text" name="nome" required/><br>

		<label for="idade">Idade:</label>
		<input type="number" name="idade" required/><br>

		<label for="profissao">Profissão:</label>
		<input type="text" name="profissao" required/><br>

		<label for="resumo">Resumo:</label>
		<textarea name="resumo" required></textarea><br>

    <div class="form-actions">
      <a href="home.php">
        <button class="voltar" formnovalidate>Voltar</button>
      </a>
      <input class="botao" type="submit" value="Enviar Cadastro">
    </div>
	</form>
	<img src="img/ursos-sem-curso.png" alt="Imagem ursos sem curso" id="img-ursos">
</div>


	<script>
		function previewImagem(event) {
			var imagem = document.getElementById('preview');
			imagem.src = URL.createObjectURL(event.target.files[0]);
		}
	</script>
</body>
</html>
