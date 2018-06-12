<?php 
include 'connect_dp.php';		
session_start();
$pagetitle=$_SESSION['username'].' Home ';
//header("refresh:3");
if(isset( $_SESSION['username'] )){
	include 'temp/thehead.php';
	include 'temp/navbar.php';
	
	//<!-- <div>the begaining of check edit| delete| add </div> -->
	$action = (isset($_GET['do'])) ? $_GET['do'] : 'manage' ;

	if($action=='manage'){##################################################################/////////MANAGE//////////#########################
	if(isset($_GET['showdelmes'])){
		echo '
					    <div class="container">
						    <div class="alert alert-success alert-dismissible fade in" role="alert"> 
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span></button> 
									<strong>Successfully</strong>
									delete 
									<strong>'.$_GET['showdelmes'].'</strong>
							</div>
						</div>';
	}
	?>
		<div class="container-fluid">
			<div class="table-responsive ">
				<h1 class="text-center">Manage Members</h1>
				<div class="kero">
				<table class="manage-table table table-bordered">
					<thead class="text-center">
						<td>#ID</td>
						<td>Username</td>
						<td>Full Name</td>
						<td>Password</td>
						<td>Email</td>
						<td>Registered Date</td>
						<td>Control</td>
					</thead>
					
					<tbody>

						<?php 
						$query='';
						if (isset($_GET['showunreg'])) {
							$query="WHERE regstatus=0";
						}
						$sql='SELECT * FROM users '.$query;
						
						$res=$con->query($sql);
						echo $con->error;
						foreach ($res as $key) {?>
							<tr>
								<td><?php echo $key['id']; ?></td>
								<td><?php echo $key['username']; ?></td>
								<td><?php echo $key['fallname']; ?></td>
								<td><?php echo $key['password']; ?></td>
								<td><?php echo $key['email']; ?></td>
								<td><?php echo $key['date']; ?></td>
								<td>
									<a class="btn btn-success" href="?do=edit&id=<?php echo($key['id'])?>"><i class="fa fa-edit"></i> Edit</a>
									<a class="btn btn-danger confirm" href="?do=delete&id=<?php echo($key['id'])?>"><i class="fa fa-close"></i> delete</a>
									<?php if ($key['regstatus']==0) {
										echo '<a class="btn btn-info" href="?do=activate&id='.$key["id"].'"><i class="fa fa-edit"></i> acitvate</a>';
									} ?>
								</td>
							</tr>
<?php 
						}

?>
					</tbody>
				</table>
			</div>
			</div>
			<a class="btn btn-info" href="home.php?do=add"><i class="fa fa-plus"></i> Add new Member</a>
		</div>

	<?php }
	elseif ($action=='edit') {
		$myid = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false ;
		//echo $myid;
			if($myid){
				//$name=$_SESSION['username'];
				$sql="SELECT * from users WHERE id='$myid' LIMIT 1" ;
				$res=$con->query($sql);
				echo $con->error;
				if($res->num_rows){
					//foreach ($res as $key) {$result=$key; break;}
					$result=$res->fetch_array();
					//print_r($result);

?>
	<div class="container">	
		<form class="row editform" action="?do=update" method="POST">
			<h1 class="text-center">EDIT MEMBER</h1>
			<label class="col-sm-2">UserName</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control" id="myname" value="<?php echo($result['username']) ?>" name="username">
					    <div class="alert alert-danger alert-dismissible fade in" role="alert"> 
							<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span></button>  -->
							<p id="alertname">d</p> 
						</div>
			</div>
			<label class="col-sm-2">password</label>
			<div class="col-sm-10 form-group">
				<input type="password" class="form-control" id="mypass" name="password">
				 		<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
							<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span></button>  -->
							<p id="alerpassword">d</p> 
						</div>
			</div>

			<label class="col-sm-2">Email</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control" id="myemail"  value="<?php echo($result['email']) ?>" name="email">
						<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
							<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span></button>  -->
							<p id="alertemail">d</p> 
						</div>
			</div>

			<label class="col-sm-2">Full Name</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control"id="myfall"  value="<?php echo($result['fallname']) ?>" name="fallname">
				<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
							<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span></button>  -->
							<p  id="alertfallname">d</p> 
				</div>
			</div>
			<div class=" col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-info form-group update_btn" id="updatebtn" value="Update" name="update">

			</div>
		</form>
	</div>
<?php }
}
}
elseif ($action=='update') {
if($_SERVER['REQUEST_METHOD']=='POST'){
		$username= $_POST['username'];
		$password= $_POST['password'];
		$fallname= $_POST['fallname'];
		$email   = $_POST['email'];
		$id=$_SESSION['id'];
		$errormessage;
		if(empty($username)){$errormessage[]='Username cant be empty';}
		if(empty($password)){$errormessage[]='Password cant be empty';}
		if(empty($fallname)){$errormessage[]='Fallname cant be empty';}
		if(empty($email)){$errormessage[]='Email cant be empty';}
		if(strlen($username)<=4){$errormessage[]='UserName is too short';}
		if(strlen($password)<3){$errormessage[]='password is too short';}
		//continue with re
		if(!empty($errormessage)){
			foreach ($errormessage as $key) {
				echo '
					    <div class="container">
						    <div class="alert alert-danger alert-dismissible fade in" role="alert"> 
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span></button> 
									<strong>ERROR </strong> 
									' .$key. '
							</div>
						</div>';
			}

		}
		else{
		//echo $username;

		$newpass=sha1($password);
				$sql="UPDATE users SET  username='$username',password='$newpass',email='$email',fallname='$fallname' WHERE id='$id' AND username='$username'";
				$res = $con->query($sql);
				//echo "$res";
				echo $con->error;
					showmessage("home.php"," Is Updated Succesfully",4,$username,"success");

		}
	}

	else{
		showmessage("home.php","Access This Page Direct","3","You Can't",'danger');
	}
}
elseif($action=='add') {######################################################--ADD--#########################################################
	?>
	<div class="container">	
		<form class="row editform" action="?do=insert" method="POST">
			<h1 class="text-center">ADD NEW MEMBER</h1>
			<label class="col-sm-2">UserName</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control" id="myname"  name="username" required placeholder="user name with no spaces">
					    <div class="alert alert-danger alert-dismissible fade in" role="alert"> 
							<p id="alertname">d</p> 
						</div>
			</div>
			<label class="col-sm-2">password</label>
			<div class="col-sm-10 form-group">
				<i class="fa show-pass fa-eye-slash fa-2x"></i>
				<input type="password" class="form-control" id="mypass" name="password" required placeholder="all least 3 chars ,2 Capital chars">
					
				 		<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
							<p id="alerpassword"></p> 
						</div>

			</div>

			<label class="col-sm-2">Email</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control" id="myemail"  name="email" required placeholder="test@domain.range">
						<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
							<p id="alertemail">d</p> 
						</div>
			</div>

			<label class="col-sm-2">Full Name</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control" id="myfall" name="fallname" required placeholder="name1 name2">
				<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
							<p  id="alertfallname">d</p> 
				</div>
			</div>
			<div class=" col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-info form-group update_btn" id="" value="ADD MEMBER" name="update">

			</div>
		</form>
	</div>	

<?php  
}
elseif ($action=='insert') {###################################################--insert new members--##################################
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$username= $_POST['username'];
		$password= $_POST['password'];
		$fallname= $_POST['fallname'];
		$email   = $_POST['email'];
		$errormessage;
		if(empty($username)){$errormessage[]='Username cant be empty';}
		if(empty($password)){$errormessage[]='Password cant be empty';}
		if(empty($fallname)){$errormessage[]='Fallname cant be empty';}
		if(empty($email)){$errormessage[]='Email cant be empty';}
		if(strlen($username)<4){$errormessage[]='UserName is too short';}
		if(strlen($password)<3){$errormessage[]='password is too short';}
		//continue with re
		if(!empty($errormessage)){
			foreach ($errormessage as $key) {
				echo '
					    <div class="container">
						    <div class="alert alert-danger alert-dismissible fade in" role="alert"> 
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span></button> 
									<strong>ERROR </strong> 
									' .$key. '
							</div>
						</div>';
			}
		}
		else{
			if(!checkitem("users","username",$username)){
				$newpass=sha1($password);
				$sql="INSERT INTO users(username,password,fallname,email,`date`,`regstatus`) VALUES ('$username','$newpass','$fallname','$email',now(),1)";
				$res = $con->query($sql);
				//echo "$res";
				echo $con->error;
				if(!$con->error)
					showmessage("home.php"," Is Added Succesfully",4,$username,"success");
				else showmessage("home.php","Is Is Not Added , There Is An Error",4,$username,"success");
		}
		else{
			showmessage("home.php"," is already exist",2,$username,"danger");
		}
		}
	}
	else{
		echo "you can't access this page direct";
	}
}##############################################################--end insert--###################################
elseif ($action=='delete') {
		$myid = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false ;
		if($myid){
					//function checkitem($tablename,$columnname,$value)
			if(checkitem("users","id",$myid)>0){
					$sql="DELETE from users WHERE id='$myid' LIMIT 1" ;
					$res=$con->query($sql);
					echo $con->error;
					header('location:home.php?showdelmes='.$myid);
				}
				// showmessage($wantedpage,$message,$time,$strong,$class)
				else showmessage("home.php"," Is Not Found",5,$myid,"danger");

			}
				else showmessage("home.php","Don't Try To access this page Direct",3,$myid,"danger");
}

elseif ($action=='activate') {
		$myid = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false ;
		if($myid){
					//function checkitem($tablename,$columnname,$value)
			if(checkitem("users","id",$myid)>0){
					$sql="UPDATE users SET regstatus=1 WHERE id='$myid'";
					$res=$con->query($sql);
					echo $con->error;
					//header('location:home.php?showdelmes='.$myid);
					showmessage("home.php"," Is Succesfully Become Registered",5,$myid,"success");
				}
				// showmessage($wantedpage,$message,$time,$strong,$class)
				else showmessage("home.php"," Is Not Found",5,$myid,"danger");

			}
				else showmessage("home.php","Don't Try To access this page Direct",3,$myid,"danger");
}
?>
<?php 
	include 'temp/thetail.php';
}
else{
	header('location:index.php');
	die();
}

?>