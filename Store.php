<?php
session_start();
  include_once 'include/class.user.php';
  include_once 'include/class.books.php';
  include_once 'include/class.owned.php';
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

  if(isset($_GET['h'])){
    header("location:home.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<style type="text/css">
table.greenTable {
  font-family: "Arial Black", Gadget, sans-serif;
  border: 6px solid #FFFFFF;
  background-color: #2A1303;
  width: 100%;
  height: 300px;
  text-align: center;
  color: #E6F7E1;
}
table.greenTable td, table.greenTable th {
  border: 1px solid #AFAFAF;
  padding: 3px 2px;
}
table.greenTable tbody td {
  font-size: 13px;
}

table.greenTable td:nth-child(1) {
   font-size: 13px;
}



//
* {
    box-sizing: border-box;
}

body {
  margin: 0;
}

/* Style the header */
.header { 
    background-image: url("headerpic.jpg");
    padding: 20px;
    text-align: center;
    font-family: 'Lobster', Georgia, Times, serif;
 font-size: 60px;
 line-height: 90px;
 color: #f2f2f2;
}


/* Style the top navigation bar */
.topnav {
    overflow: hidden;
    background-color: #2A1303;

}

/* Style the topnav links */
.topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
    background-color: #2A1303;
    color: #2A1303;
}

</style>








<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


<div class="header"">
  <h1>Book Store</h1>
</div>
<div class="topnav">
  <a href="Store.php">Book Store</a>
  <a href="home.php">My Library</a>
  <a href="home.php?q=logout">Logout</a>
</div>


<<table class="greenTable">
<tbody>
<?php $owned->get_ownedbooks();?>
</tbody>
</tr>
</table>

</body>
</html>