<?php 
include 'connect_dp.php';		
session_start();
$pagetitle=$_SESSION['username'].' Categories ';
//header("refresh:3");
if(isset( $_SESSION['username'] )){
	include 'temp/thehead.php';
	include 'temp/navbar.php';
	
	$action = (isset($_GET['do'])) ? $_GET['do'] : 'manage' ;

	if($action=='manage'){##################################################################/////////MANAGE//////////#########################
		?>
		<div class="container">
			<div class="panel panel-default">
				  <div class="panel-heading">Panel heading without title
				  	<span class="full-showing btn btn-info">Full Showing</span>
				  	<span class="classic-showing btn btn-success">Classic Shoing</span>
				  </div>
				  <div class="panel-body">
				    <?php 
				    	$sql="SELECT `id`, `name`, `description`, `ordiring`, `visiblity`, `allow_comment`, `allow_adds` FROM `categories` ORDER BY ordiring";
				    	$res=$con->query($sql);
				    	// $arr=$res->fetch_array();
				    	foreach ($res as $key) {
				    		echo "<div class=\"cat\">";

					    		echo '<div class="edit-del-div">
					    				<a class="btn btn-primary  "       href="?do=edit&id='.$key['id'].'">Edit</a>
					     			  	<a class="btn btn-danger confirm " href="?do=delete&id='.$key['id'].'">Delete</a>

						     			  </div>';
						     			  echo "<h2 class='header2'>".$key['name']."</h2>";
						     	echo "<div class='under-btn-del-up'>";
						    		
						    		if(empty($key['description']))echo "<span class='des'>   <i class='fa fa-eye'></i> the description is empty</span>"; else echo $key['description']."<br>";
						    		if(empty($key['visiblity']))echo "<span class='vis'>     <i class='fa fa-eye'></i> visiblity is disabled </span>"; 
						    		if(empty($key['allow_comment']))echo "<span class='com'> <i class='fa fa-eye'></i> comment is disabled </span>"; 
						    		if(empty($key['allow_adds']))echo "<span class='add'>    <i class='fa fa-eye'></i> adds is disabled </span>"; 
						    		
					    		echo "</div>";
				    			// echo "<hr>";
				    		echo "</div>";
				    	}
				     ?>
				     
				  </div>
				</div>
				<a href="?do=add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Categories</a>
		</div>
		<?php 
			 }
elseif ($action=='edit') {##########################################################################---Edit
	$myid = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false ;
		//echo $myid;
			if($myid){
				//$name=$_SESSION['username'];
				$sql="SELECT * from categories WHERE id='$myid' LIMIT 1" ;
				$res=$con->query($sql);
				echo $con->error;
				if($res->num_rows){
					//foreach ($res as $key) {$result=$key; break;}
					$result=$res->fetch_array();
					//print_r($result);

?>
	<div class="container">	
		<form class="row editform" action="?do=update" method="POST">
			<input type="hidden" name="theid" value="<?php echo($result['id']); ?>">
			<h1 class="text-center">EDIT CATEGORY</h1>
			<label class="col-sm-2">Name</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control" name="name" required  placeholder="Enter Category Name" value="<?php echo($result['name']);?>">
			</div>
			<label class="col-sm-2">Describe</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control" name="description"   placeholder="all least 3 chars ,2 Capital chars" value="<?php echo($result['description']);?>">
			</div>

			<label class="col-sm-2">Ordering</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control"  name="order"   placeholder="number arrange the category" value="<?php echo($result['ordiring']);?>">
			</div>

			<label class="col-sm-2">Allow Visibility</label>
			<div class="col-sm-10 form-group">
				<div>
					<input type="radio" id="vis-yes" value="1"  name="Visibility" <?php if($result['visiblity']==1){echo "checked";} ?>>
					<label for="vis-yes">yes</label>
				</div>

				<div>
				<input type="radio" id="vis-no" value="0" name="Visibility" <?php if($result['visiblity']==0){echo "checked";} ?>>
					<label for="vis-no">No</label>
				</div>
			</div>

			<label class="col-sm-2">Allow Comment</label>
			<div class="col-sm-10 form-group">
				<div>
					<input type="radio" id="com-yes" value="1" name="comment" checked <?php if($result['allow_comment']==1){echo "checked";} ?>>
					<label for="com-yes">yes</label>
				</div>

				<div>
				<input type="radio" id="com-no" value="0" name="comment" <?php if($result['allow_comment']==0){echo "checked";} ?>>
					<label for="com-no">No</label>
				</div>
			</div>

			<label class="col-sm-2">Allow Adds</label>
			<div class="col-sm-10 form-group">
				<div>
					<input type="radio" id="add-yes" value="1" name="adds" checked <?php if($result['allow_adds']==1){echo "checked";} ?>>
					<label for="add-yes">yes</label>
				</div>

				<div>
				<input type="radio" id="add-no" value="0" name="adds" <?php if($result['allow_adds']==0){echo "checked";} ?>>
					<label for="add-no">No</label>
				</div>
			</div>

			<div class=" col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-info form-group update_btn" id="" value="ADD CATEGORY" name="update"><i class="fa fa-plus"></i> UPDATE</button>
			</div>
		</form>
	</div>
<?php 

}
else{
		showmessage("Categoires.php","This id is Not Exist",4,"Error :","danger");
}

}
}
elseif ($action=='update') {##############################################--update
	if($_SERVER['REQUEST_METHOD']=='POST'){
	echo '<h1 class="text-center">ADD NEW CATEGORY</h1>';
		$name 		 = $_POST['name'];
		$id 		 = $_POST['theid'];
		$describtion = $_POST['description'];
		$Visibility  = $_POST['Visibility'];
		$comment     = $_POST['comment'];
		$order     	 = $_POST['order'];
		$adds        = $_POST['adds'];
		$errormessage;
		if(empty($name)){
			$errormessage="The Name Of the Category Can't Be Empty";
		}
		//continue with re
		if(!empty($errormessage)){
				showmessage("?do=add",$errormessage,4,"Error","danger");
		}
		else{
				$sql="UPDATE `categories` SET `name`='$name',`description`='$describtion',`ordiring`='$order',`visiblity`='$Visibility',`allow_comment`='$comment',`allow_adds`='$adds' WHERE `id`='$id'";
				$res = $con->query($sql);
				//echo "$res";
				echo $con->error;
				if(!$con->error)
					showmessage("?"," Is Added Succesfully",4,$name,"success");
				else showmessage("?do=add"," Is Is Not Added , There Is An Error:".$con->error,4,$name,"success");
		}
	}
	else{
		//function showmessage($wantedpage,$message,$time,$strong,$class){
		 showmessage("?do=add","you can't access this page direct",3,"ERROR ","danger");
		//echo "you can't access this page direct";
	}

}######################################################--ADD--#########################################################
elseif($action=='add') {
?>
<div class="container">	
		<form class="row editform" action="?do=insert" method="POST">
			<h1 class="text-center">ADD NEW CATEGORY</h1>
			<label class="col-sm-2">Name</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control" name="name" required  placeholder="Enter Category Name" autocomplete="off">
			</div>
			<label class="col-sm-2">Describe</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control" name="description"   placeholder="all least 3 chars ,2 Capital chars" autocomplete="off">
			</div>

			<label class="col-sm-2">Ordering</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control"  name="order"   placeholder="number arrange the category"  autocomplete="off">
			</div>

			<label class="col-sm-2">Allow Visibility</label>
			<div class="col-sm-10 form-group">
				<div>
					<input type="radio" id="vis-yes" value="1"    name="Visibility" checked   placeholder="name1 name2">
					<label for="vis-yes">yes</label>
				</div>

				<div>
				<input type="radio" id="vis-no" value="0"    name="Visibility"   placeholder="name1 name2">
					<label for="vis-no">No</label>
				</div>
			</div>

			<label class="col-sm-2">Allow Comment</label>
			<div class="col-sm-10 form-group">
				<div>
					<input type="radio" id="com-yes" value="1"    name="comment" checked   placeholder="name1 name2">
					<label for="com-yes">yes</label>
				</div>

				<div>
				<input type="radio" id="com-no" value="0"    name="comment"  placeholder="name1 name2">
					<label for="com-no">No</label>
				</div>
			</div>

			<label class="col-sm-2">Allow Adds</label>
			<div class="col-sm-10 form-group">
				<div>
					<input type="radio" id="add-yes" value="1"    name="adds" checked   placeholder="name1 name2">
					<label for="add-yes">yes</label>
				</div>

				<div>
				<input type="radio" id="add-no" value="0"    name="adds"   placeholder="name1 name2">
					<label for="add-no">No</label>
				</div>
			</div>

			<div class=" col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-info form-group update_btn" id="" value="ADD CATEGORY" name="update"><i class="fa fa-plus"></i> ADD CATEGORY</button>

			</div>
		</form>
	</div>	
<?php 
}#########################################################--insert new members--##################################
elseif ($action=='insert') {
if($_SERVER['REQUEST_METHOD']=='POST'){
	echo '<h1 class="text-center">ADD NEW CATEGORY</h1>';
		$name 		 = $_POST['name'];
		$describtion = $_POST['description'];
		$Visibility  = $_POST['Visibility'];
		$comment     = $_POST['comment'];
		$order     	 = $_POST['order'];
		$adds        = $_POST['adds'];
		$errormessage;
		if(empty($name)){
			$errormessage="The Name Of the Category Can't Be Empty";
		}
		//continue with re
		if(!empty($errormessage)){
				showmessage("?do=add",$errormessage,4,"Error","danger");
		}
		else{
			if(!checkitem("categories","name",$name)){
				$sql="INSERT INTO categories(name,description,ordiring,visiblity,allow_comment,allow_adds) VALUES ('$name','$describtion','$order','$Visibility','$comment','$adds')";
				$res = $con->query($sql);
				//echo "$res";
				echo $con->error;
				if(!$con->error)
					showmessage("?do=manage"," Is Added Succesfully",4,$name,"success");
				else showmessage("?do=add"," Is Is Not Added , There Is An Error",4,$name,"danger");
		}
		else{
			showmessage("?do=add"," is already exist",2,$name,"danger");
		}
		}
	}
	else{
		//function showmessage($wantedpage,$message,$time,$strong,$class){
		 showmessage("?do=add","you can't access this page direct",3,"ERROR ","danger");
		//echo "you can't access this page direct";
	}
}##############################################################--end insert--###################################
elseif ($action=='delete') {###############################-delete
$myid = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false ;
		if($myid){
					//function checkitem($tablename,$columnname,$value)
			if(checkitem("categories","id",$myid)>0){
					$sql="DELETE from categories WHERE id='$myid' LIMIT 1" ;
					$res=$con->query($sql);
					echo $con->error;
					showmessage(""," Is Deleted Succesfully",3,$myid,"success");
				}
				// showmessage($wantedpage,$message,$time,$strong,$class)
				else showmessage("?do=manage"," Is Not Found",5,$myid,"danger");

			}
				else showmessage("?do=manage","Don't Try To access this page Direct",3,$myid,"danger");
}
include 'temp/thetail.php';
}
else{
	header('location:index.php');
	die();
}

?>



