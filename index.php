<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "dbinotes";
$insert = false;

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
  die("Sorry we failed to connect ! " . mysqli_connect_error());
}


// delete wala btn 
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  // echo $sno;
  $sql = "DELETE FROM `info_table` WHERE `sno` = $sno";
  $result = mysqli_query($conn,$sql);
}
// now sending data to db using PHP
// echo $_SERVER["REQUEST_METHOD"];

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['snoEdit'])){
    // exit();
    $title = $_POST['title'];
    $description = $_POST['desc'];
    $sno = $_POST['snoEdit'];

    $sql = "UPDATE `info_table` SET `title` = '$title' , `description` = '$description' WHERE `info_table`.`sno` = $sno";
    $result = mysqli_query($conn,$sql);
  }
  else{
  $title = $_POST['title'];
  $description = $_POST['desc'];

  if(empty($title) || empty($description)){
    echo "Fill the form dude";
  }
  else{
  $sql = "INSERT INTO `info_table` (`title`, `description`) VALUES ('$title', '$description')";

    $result = mysqli_query($conn,$sql);

    if($result){
      // echo "Ho gya bro";
      $insert = true;
    }
    else{
      echo "nahi hua bro";
    }
  }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="//cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="//cdn.datatables.net/2.1.5/js/dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
 
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous" />

  <title>iNotes</title>
  <style>
    .design{
      display: flex;
      justify-content: center;
      align-items: center;
      gap:12px;
    }
  </style>
</head>

<body>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit this record </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        


      <form action="/lectures/project/index.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
      <div class="form-group">
        <label for="titleEdit">Notes</label>
        <input type="text" class="form-control" id="titleEdit" name="title" />
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1" >Notes Description</label>
        <textarea
        id="descEdit"
        name="desc"
          class="form-control"
          id="exampleFormControlTextarea1"
          rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">iNotes</a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input
          class="form-control mr-sm-2"
          type="search"
          placeholder="Search"
          aria-label="Search" />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
          Search
        </button>
      </form>
    </div>
  </nav>
<?php
if($insert){
  echo "    <div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>SUCCESS</strong> Your notes has been added successfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}

?>

  <div class="container my-3">
    <form action="/lectures/project/index.php" method="post">
      <div class="form-group">
        <label for="exampleInput">Notes</label>
        <input type="text" class="form-control" id="exampleInput" name="title" />
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1" >Notes Description</label>
        <textarea
          name="desc"
          class="form-control"
          id="exampleFormControlTextarea1"
          rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <div class="container">

  <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">SNO.</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <tr>
     
    <?php
    $sql = "SELECT * FROM `info_table`";
    $result = mysqli_query($conn, $sql);
    $sno=0;
    while ($row = mysqli_fetch_assoc($result)) {
      if (isset($row['sno'])) {
        $sno=$sno+1;
        echo "
         <tr>
      <td scope='row'>".$sno."</td>".
      "<td>".$row['title']."</td>"
      ."<td>".$row['description']."</td>".
      "<td class='design'> <button class='btn delete  btn-sm btn-primary' id=d".$row['sno'].">DELETE</button>    <button class='btn edit  btn-sm btn-primary' id=".$row['sno'].">EDIT</button>
</td>"
      //  ."<td>""</td>".
    ."</tr>
        ";
      } 
    }
    ?>
  </tbody>
</table>









 
  </div>
  <script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
    <script defer>
  let table = new DataTable('#myTable');
  </script>
  <script>
    document.addEventListener('DOMContentLoaded',()=>{
      let edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((el)=>{
      el.addEventListener('click',(evt)=>{
        let tr = evt.target.parentNode.parentNode;
        console.log(tr);
        title = tr.getElementsByTagName('td')[1].innerText;
        desc = tr.getElementsByTagName('td')[2].innerText;
        console.log(desc,title);
        titleEdit.value = title;
        descEdit.value = desc;
        snoEdit.value = evt.target.id;
        console.log(evt.target.id);
        $('#editModal').modal('toggle');

      }
      ,false);
    });

    let del = document.getElementsByClassName('delete');
    Array.from(del).forEach((el)=>{
      el.addEventListener('click',(evt)=>{
        let tr = evt.target.parentNode.parentNode;
        console.log(tr);
        title = tr.getElementsByTagName('td')[1].innerText;
        desc = tr.getElementsByTagName('td')[2].innerText;
     
        sno = evt.target.id.substr(1,);
        if(confirm("Are you sure you want to delete your notes?")){
          console.log("yes");
          window.location = `/lectures/project/index.php?delete=${sno}`;
        }
 


      }
      ,false);
    });


    },false);
    

   

  </script>
</body>

</html>