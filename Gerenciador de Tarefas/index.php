<?php
session_start();

if(!isset($_SESSION['tarefas']))
{
  $_SESSION['tarefas'] = array();
}

if(isset($_POST['campo-tarefa']))
{
  if($_POST['campo-tarefa'] != "")
  {
    array_push($_SESSION['tarefas'], $_POST['campo-tarefa']);
    unset($_POST['campo-tarefa']);
  }
  else
    $_SESSION['message'] = 'Preencha o campo!';
}

if(isset($_POST['botao-limpar']))
{
  unset($_SESSION['tarefas']);
}

if(isset($_GET['key']))
{
  array_splice($_SESSION['tarefas'], $_GET['key'], 1);
  unset($_GET['key']);
}
?>



<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="./estilo.css">

    <!--Importanto fonte Ubuntu-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="tarefas-container">
      <h1>Gerenciador de Tarefas</h1>
      <form action="index.php" method="post">
        <label for="campo-tarefa">Tarefa: </label>
        <input type="text" id="campo-tarefa" name="campo-tarefa" placeholder="Ex: Ir fazer compras...">
        <input type="submit" name="botao-enviar" value="Inserir">
      </form>
      <?php
      if(isset($_SESSION['message']))
      {
        echo "<p class='mensagem-erro'>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
      }
      ?>
      <div class="separador"></div>

      <div class="lista-de-tarefas">
        <ul>
          <?php
          if(isset($_SESSION['tarefas']))
          {
            foreach($_SESSION['tarefas'] as $key => $tarefa)
            {
              echo "<li>
                <span>$tarefa</span>
                <button class='botao-eliminar' type='button' onclick='eliminar$key()'>Eliminar</button>
                <script>
                  function eliminar$key()
                  {
                    window.confirm('Deseja remover essa tarefa?');
                    if(window.confirm)
                    {
                      window.location = 'http://localhost/phpProjetos/Tarefas/index.php?key=$key';
                    }
                    return false;
                  }
                </script>
                  </li>";
            }
          }
          ?>
        </ul>
      </div>

      <form method="post">
        <button type="submit" name="botao-limpar">Limpar</button>
      </form>

      <footer>
        <p>Feito por Matheus Augusto</p>
      </footer>
    </div>


  </body>
</html>
