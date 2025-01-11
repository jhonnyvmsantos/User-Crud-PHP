<!DOCTYPE html>
<html lang="pt-br">

<?php
  include_once("../database/config.php");

  if (isset($_REQUEST["action"])) {
    switch ($_REQUEST["action"]) {
      case 'create':
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
  
        $sql = "INSERT INTO tbl_user (user_name, user_email, user_password) VALUES ('$name', '$email', '$pass')";
        $result = mysqli_query($conn, $sql);
  
        if ($result == true) {
          echo "<script>alert('Cadastro efetuado com SUCESSO.');</script>";
        } else {
          echo "<script>alert('ERRO ao cadastrar o usuário...');</script>";
        }
        break;
  
      case 'edit':
        echo "<script>alert('EDIT');</script>";
        break;
  
      case 'delete':
        $id = $_REQUEST["id"];

        $res = mysqli_query($conn, "DELETE FROM tbl_user WHERE user_id = $id");
  
        if ($res == true) {
          echo "<script>
          alert('Usuário DELETADO com sucesso.');
          window.locate.href = './list.php';
        </script>";
        } else {
          echo "
            <script> 
              alert('ERRO ao deletar usuário.');
              window.locate.href = './list.php';
            </script>
          ";
        }
        break;
    }
  }
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../style.css">
  <script defer src="../script.js"></script>
</head>

<body>
  <div class="navbar">
    <div>
      <h2 id="home-page">USER</h2>
    </div>

    <div class="navbar-menu" id="menu-button">
      <img src="../imgs/menu.png" alt="navbar-menu" />
    </div>

    <nav>
      <ul>
        <li id="list-page">LISTAGEM</li>
        <li id="reg-page">CADASTRO</li>
      </ul>
    </nav>
  </div>

  <main id="list-main">
    <div class="list-container">
      <h2>LISTAGEM DE USUÁRIOS</h2>

      

      <div id="list-content">
        <?php
          $sql = "SELECT * FROM tbl_user";

          $res = mysqli_query($conn, $sql);

          if ($res->num_rows > 0) {
            echo "
              <script> 
                let edit, del;
              </script>
            ";

            foreach ($res->fetch_all(MYSQLI_ASSOC) as $index => $row) {
              $id = $row['user_id'];
              $name = $row['user_name'];
              $email = $row['user_email'];
              
              echo "
                <div class='list-item'>
                  <div class='list-id'>
                      <h3>$id</h3>
                  </div>
                  <div class='list-info'>
                      <h5>$name</h5>
                      <p>$email</p>
                  </div>
                  <div class='list-buttons'>
                      <img id='edit-btn$index' src='../imgs/edit.png' alt='edit-button'>
                      <img id='del-btn$index' src='../imgs/trash.png' alt='delete-button'>
                  </div>
                </div>

                <script> 
                  edit = document.getElementById('edit-btn$index');
                  del = document.getElementById('del-btn$index');

                  edit.addEventListener('click', () => {
                    alert('$name');
                  });

                  del.addEventListener('click', () => {
                    window.location.href = './list.php?action=delete&id=$id';
                  });
                </script>
              ";
            }
          }
        ?>
      </div>

    </div>
  </main>

</body>
</html>