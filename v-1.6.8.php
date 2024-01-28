<!-- Connection -->
<?php
    $con = mysqli_connect('localhost', 'root');
    mysqli_select_db($con,'databesh');
?>
<!--// Connection -->

<!-- SQL Datebesh To PHP File order by DESC -->
<?php
  $query     = "SELECT * FROM `mydb` ORDER BY `addedOn` DESC";
  $queryfire = mysqli_query($con, $query);
  $num       = mysqli_num_rows($queryfire);
  if($num > 0) {
      while($date = mysqli_fetch_array($queryfire)){
?>

<?php echo "?id=".$date["id"]?>
<?php echo $date["addedOn"]?>
<?php echo date('F jS, Y',strtotime($date["addedOn"]))?>
<?php echo date('D jS, Y',strtotime($date["addedOn"]))?>
<?php echo date('M j, Y',strtotime($date["addedOn"]))?>
<?php echo strtoupper(date('M jS, Y',strtotime($date["addedOn"])))?>
<?php
	$date = new DateTime($date["addedOn"]);
	$current = new DateTime();
	$diff = $current->diff($date);

	if ($diff->y) echo $diff->y . ' Year ago';
	elseif ($diff->m) echo $diff->m . ' Month ago';
	elseif ($diff->d) echo $diff->d . ' Day ago';
	elseif ($diff->h) echo $diff->h . ' Hour ago';
	elseif ($diff->i) echo $diff->i . ' Minute ago';
	else echo 'Just now';
?>
<?= ($diff = (new DateTime($date["addedOn"]))->diff(new DateTime()))->y ? $diff->y . ' Year ago' : ($diff->m ? $diff->m . ' Month ago' : ($diff->d ? $diff->d . ' Day ago' : ($diff->h ? $diff->h . ' Hour ago' : ($diff->i ? $diff->i . ' Minute ago' : 'Just now')))); ?>
<?php echo strip_tags(substr($date["details"], 0,55))."..."?>
<?php
    if(empty($date["description"])) {
        echo strip_tags(substr($date["content"], 0,255))."...";
    } else {
        echo strip_tags(substr($date["description"], 0,255))."...";
    }
?>
<?php }}?>
<!--// SQL Datebesh To PHP File order by DESC -->

<!-- SQL Datebesh To PHP File order by DESC Mini -->
<?php
	$query       = "SELECT * FROM `mydb` ORDER BY `addedOn` DESC";
	$queryfire   = mysqli_query($con, $query);
	while ($date = mysqli_fetch_array($queryfire)) {
		echo $date["category_slug"];
	}
?>

<?php
  $query       = "SELECT * FROM `mydb` ORDER BY `addedOn` DESC";
  $queryfire   = mysqli_query($con, $query);
  while ($date = mysqli_fetch_array($queryfire)) {
?>
<?php echo $date["addedOn"]?>
<?php }?>
<!--// SQL Datebesh To PHP File order by DESC Mini -->

<!-- SQL Datebesh To PHP File order by ASC -->
<?php
    $id = $_REQUEST['id'];
	if(empty($id)) {
        header("location:index.php");
    }
    $query     = " SELECT `id`, `addedOn` FROM `mydb` WHERE id=$id ORDER BY id ASC ";
    $queryfire = mysqli_query($con, $query);
    $num       = mysqli_num_rows($queryfire);
    if($num > 0) {
        while($date = mysqli_fetch_array($queryfire)){
?>

<?php echo $date["addedOn"]?>

<?php }}?>
<!--// SQL Datebesh To PHP File order by ASC -->

<!-- Total Number of Data (Row Count) in Database in php -->
<?php
	$query     = "SELECT id FROM mydb ORDER BY id";
	$query_run = mysqli_query($con, $query);
	$row       = mysqli_num_rows($query_run);
		echo ''.$row.'';
?>
<!--// Total Number of Data (Row Count) in Database in php -->

<!-- HTML Form To SQL Databesh -->
<?php
if ($con->connect_error) {
    die("Connection Failed." . $con->connect_error);
}

if (isset($_POST['fast_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone'])) {
    $fast_name       = $_POST['fast_name'];
    $last_name       = $_POST['last_name'];
    $email           = $_POST['email'];
    $phone           = $_POST['phone'];
    $sql             = "INSERT INTO mytable(fast_name, last_name, email, phone) VALUES('$fast_name','$lastName','$email','$phone')";
    if (mysqli_query($con, $sql)) {
        // echo '<h3>Data instat</h3>';
        header("Location: index.php");
    };
}
?>
<!--// HTML Form To SQL Databesh -->

<!-- Img Upload In Database -->
<?php
if ($con->connect_error) {
    die("Connection Failed." . $con->connect_error);
}
if (isset($_POST['title'])) {
    $title        = $_POST['title'];

    $imgname      = $_FILES['img'] ['name'];
    $tmpname      = $_FILES['img'] ['tmp_name'];
    $uploc        = 'images/'.$imgname;
    $sql          = "INSERT INTO bloglist(title, img) VALUES('$title','$imgname')";
    if (mysqli_query($con, $sql)) {
		move_uploaded_file($tmpname,$uploc);
        // echo '<h3>Data instat</h3>';
		header("Location: index.php");
    };
}
?>

<form action="" method="POST" enctype="multipart/form-data"></form>
<!--// Img Upload In Database -->

<!--// PHP function -->
<?php
    function getBlogID($con,$slug){
        $query = "SELECT ID FROM `blog` WHERE slug='$slug'";
        $run   = mysqli_query($con,$query);
        $num   = mysqli_num_rows($run);
        if($num > 0) {
        $data  = mysqli_fetch_assoc($run);
        return $data['ID'];
        }else{
            return 0;
        }
    }
?>

<?= getBlogID($con,$slug)?>
<!--// PHP function -->

<!--// Simple menu without dropdown -->
<?php
	$query = "SELECT `ID`, `name`, `link`, `order` FROM menu ORDER BY `order` ASC";
	$result = mysqli_query($con, $query);
	while ($row = mysqli_fetch_assoc($result)) {
		echo '<li class="nav-item"><a class="nav-link" href="' . $row['link'] . '">' . $row['name'] . '</a></li>';
	}
?>
<!--// Simple menu without dropdown -->

<!--// JOIN Database -->
<?php
	$query = "SELECT *, blog.ID AS blog_ID, category.ID AS category_ID FROM blog JOIN category ON blog.cat_ID = category.ID ORDER BY `addedOn` DESC";
?>
<!--// JOIN Database -->