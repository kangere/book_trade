<?php
	session_start();
	include_once 'include/class.user.php';
  include_once 'include/class.books.php';
  include_once 'include/utils.php';


  $user = new User();
  $book = new Book();
  $owned = new OwnedBooks();


  if(!$user->get_session()){
    header("location:login.php");
  }


	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];
  $email = $_SESSION['email'];


	if(isset($_GET['q'])){
		$user->user_logout();
		header("location:login.php");
	}

  if(isset($_POST['addBook'])){

    if(isset($_POST['title']) and isset($_POST['author']) and isset($_POST['year']) and isset($_POST['isbn'])){


      //get book details
      $title = $_POST['title'];
      $author = $_POST['author'];
      $year = $_POST['year'];
      $isbn = $_POST['isbn'];


      if($book->insert_book($email,$title,$author,$year,$isbn)){
         printSuccess("Book Inserted");
      }
         



    }
    
  }

  if(isset($_POST['deleteBook'])){

    if(isset($_POST['isbn_delete'])){

      $isbn_del = $_POST['isbn_delete'];

      if($owned->deleteBookOwned($email,$isbn_del))
          printSuccess("Book Deleted");
      else
          printError("Couldn't delete book");

    } else {
      printWarning("Isbn needed to delete book");
    }
  }

  if(isset($_POST['updateBook'])){

  }

?>

<!DOCTYPE html>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

.search-control > input,
.search-control > button {
    background-color: #e4f0f5;
    color: #29627e;
    font-size: 1.2rem;
}




</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>


<h1>My Library</h1>
<h2>Welcome <?php echo $fname . " " . $lname; ?></h2>
        
          <div class="search-control">
              <input type="search" id="site-search" name="find"
                     placeholder="Search Books"
                     >
              <button>Search</button>
          </div>
    
    <table class="table">
      <thead>
        <tr>
          <td>Title</td>
          <td>Author</td>
          <td>Year</td>
          <td>ISBN</td>  
        </tr>
      </thead>
      <tbody> 
        <?php $book->get_user_library($email);?>
      </tbody>
    </table>

    
      <div class="card" style="width: 18rem;">
        <div class="card-head"><h3> Add New Book</h3></div>
        <div class="card-body">

          <form method="post" action="home.php">
            <div class ="form-group">
              <label for="title"><b>Title</b></label>
              <input type="text" class ="form-control" placeholder="Enter Book Title" name="title" required>
            </div>
            <div class ="form-group">
              <label for="author"><b>Author</b></label>
              <input type="text" class ="form-control" placeholder="Enter Author Name" name="author" required>
            </div>

            <div class ="form-group">
              <label for="year"><b>Year Published</b></label>
              <input type="text" class ="form-control" placeholder="Enter Year Published" name="year" required>
            </div>

            <div class ="form-group">
              <label for="isbn"><b>ISBN</b></label>
              <input type="text" class ="form-control" placeholder="Enter Book ISBN" name="isbn" required>
            </div>

              <input type="submit" class ="btn btn-primary"name="addBook" value="Add Book"/>
          </form>
        </div>
      </div>

      <div class="card" style="width: 18rem;">
        <div class="card-head"><h3> Delete Book</h3></div>
        <div class="card-body">
          <form method="post" action="home.php">
            <div class ="form-group">
              <label for="isbn"><b>ISBN</b></label>
              <input type="text" class ="form-control" placeholder="Enter Book ISBN" name="isbn_delete" required>
            </div>
             <input class="btn btn-danger" type = "submit"  name = "deleteBook"  value = "Delete Book" />
          </form>
        </div>
      </div>
      
<br><br>
<a href="home.php?q=logout">LOGOUT</a>
</body>
</html>