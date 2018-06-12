<?php
session_start();
$pagetitle='LogIn';
if(isset($_SESSION['username'])){
	header("location:home.php");
}
include 'connect_dp.php' ;
include 'temp/thehead.php';
//echo "string"; 
//echo $_SESSION['username'];
if ($_SERVER['REQUEST_METHOD']=='POST') {
	$name=$_POST['name'];
	$pass=$_POST['pass'];
	$pass=sha1($pass);
	$sql="SELECT id,username,password from users WHERE password='$pass' and username='$name' and groupid='1' LIMIT 1" ;
	$res=$con->query($sql);
	if($res->num_rows>0)
	{
		foreach ($res as $key ) {
			$result=$key;
			break;
		}
		$_SESSION['username']=$name;
		$_SESSION['id']=$result['id'];
		//echo $_SESSION['id'];
		header('location: home.php');
		exit();
	}
}
?>

<form class="login text-center"  action=" <?php echo($_SERVER['PHP_SELF']) ?>" method="POST">
	<h1 class="text-primary">LogIn Admin</h1>
	<input type="text"     class="form-group form-control" name="name"  placeholder="enter name">
	<input type="password" class="form-group form-control" name="pass"  placeholder="enter password">
	<input type="submit"   class="form-group form-control btn btn-primary" name="submit" >
</form>

<?php include 'temp/thetail.php'; ?>