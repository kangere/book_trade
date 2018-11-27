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
      $cond  = $_POST['condition'];

      if($book->insert_book($email,$title,$author,$year,$isbn,$cond)){
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

?>

<!DOCTYPE html>
<html>
<head>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>

  var i = 0;

  function increment(){
    i+= 1;
  }

  function removeElement(parentDiv,childDiv){
    var child = document.getElementById(childDiv);
    var parent = document.getElementById(parentDiv);
    parent.removeChild(child);
    i -= 1;
  }


  function addAuthor(){
    
    var div = document.createElement('div');

    div.setAttribute("class","entry input-group col-xs-3");

    var y = document.createElement('INPUT');

    y.setAttribute("type","text");
    y.setAttribute("class","input form-control");
    y.setAttribute("placeholder","Enter Another Author");
    increment();
    y.setAttribute("name","author[" + i + "]");
    div.setAttribute("id","author_div_" + i);

    var button = document.createElement("Button");
    button.setAttribute("class","btn btn-danger btn-add");
    button.setAttribute("type","button");
    button.setAttribute("onclick","removeElement('author','author_div_" + i +"')");
    button.appendChild(document.createTextNode("-"));

    div.appendChild(y);
    div.appendChild(button);

    document.getElementById("author").appendChild(div);
  }
</script>

<?php getNavBar($fname,$lname,$email) ?>
</head>
<body>
    
    <div class="mt-5">
      <h4 class="text-center">My Library</h4>
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
            <div class ="form-group" id="author">
              <label for="author"><b>Author</b></label>
              <div class="entry input-group col-xs-3">
                <input type="text" class ="input form-control" placeholder="Enter Author Name" name="author[0]"  /><span class="input-group-btn">
                            <button class="btn btn-success btn-add" type="button" onclick="addAuthor()">
                                +
                            </button>
                        </span>
              </div>
              
            </div>

            <div class ="form-group">
              <label for="year"><b>Year Published</b></label>
              <input type="text" class ="form-control" placeholder="Enter Year Published" name="year" required>
            </div>

            <div class ="form-group">
              <label for="isbn"><b>ISBN</b></label>
              <input type="text" class ="form-control" placeholder="Enter Book ISBN" name="isbn" required>
            </div>

            <div class ="form-group">
              <label for="isbn"><b>Book Condition</b></label>
              <div class="radio">
                <label><input type="radio" name="condition" checked>Like-New</label>
              </div>
              <div class="radio">
                <label><input type="radio" name="condition">Used</label>
              </div>
              <div class="radio">
                <label><input type="radio" name="condition">Damaged</label>
              </div>
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