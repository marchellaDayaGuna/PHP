<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login/login.php");
    exit;
}
require 'database.php';
require 'create-to-do.php';
require 'display-to-do.php';
require 'delete-to-do.php';
require 'done-to-do.php';
//cek button submit sudah ditekan atau belum
$idUser = $_SESSION["id"];
if (isset($_POST["submit"])) {
    if (createTask($_POST, $idUser) > 0) {
        echo "";
    } else {
        echo "";
    }
}
if(isset($_GET["delete"])){
    $id = $_GET["delete"];
    if(delete($id)>0){
        echo "";
    }else{
        echo "";
    }
}
if(isset($_GET["done"])){
    $id = $_GET["done"];
    if(done($id)>0){
        echo "Tugas Telah Selesai";
    }else{
        echo "Tugas gagal diganti";
    }
}
$query = "SELECT * FROM todo where idUser = $idUser";
$todo = display($query);

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card rounded-3">
          <div class="card-body p-4">

            <h4 class="text-center my-3 pb-3">To Do App</h4>

            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" action="" method="post">
              <div class="col-12">
                <div class="form-outline">
                <label class="form-label" for="task">MasukkanTo-Do List</label>
                  <input type="text" id="task" class="form-control" name="task" required/>
                  
                </div>
              </div>

              <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
              </div>
            </form>

            <table class="table mb-4">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Task</th>
                  <th scope="col">Status</th>
                  <th scope="col">Edit</th>
                </tr>
              </thead>
              <tbody>
              <?php $i = 1; ?>
                <?php foreach ($todo as $item) : ?>
                <tr>
                <td><?= $i ?></td>
                <td><?= $item["Task"] ?></td>
                <td><?= $item["Status"] ?></td>
                  <td>
                    <button type="submit" class="btn btn-outline-primary"><a href="?delete=<?= $item["ID"] ?>"style = "Text-decoration: none; color: black;" >Hapus</a></button>
                    <button type="submit" class="btn btn-outline-primary"><a href="?done=<?= $item["ID"] ?>"style = "Text-decoration: none; color: black;">Selesai</a></button>
                  </td>
                </tr>
                <tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
            <button class="btn btn-outline-primary" ><a href="login/logout.php"style="Text-decoration: none; color: black;">Logout!</a></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>

</html>