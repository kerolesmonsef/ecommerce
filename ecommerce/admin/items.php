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
 }
elseif ($action=='edit') {###############################################################--edit
	
}

elseif ($action=='update') {##############################################u --pdate
}
elseif($action=='add') {######################################################--ADD--#########################################################
	?>
<div class="container">	
		<form class="row editform" action="?do=insert" method="POST">
			<h1 class="text-center">ADD NEW ITEM</h1>
			<label class="col-sm-2">Name</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control" name="name" required  placeholder="Enter Category Name" autocomplete="off">
			</div>

			<label class="col-sm-2">Describe</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control" name="description"   placeholder="Describe the item" autocomplete="off">
			</div>
			<label class="col-sm-2">Price</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control"  name="price"   placeholder="Enter Item Price"  autocomplete="off">
			</div>
			<label class="col-sm-2">Country</label>
			<div class="col-sm-10 form-group">
				<input type="text" class="form-control" name="name" required  placeholder="Made In ..." autocomplete="off">
			</div>

			<label class="col-sm-2">Status</label>
			<div class="col-sm-10 form-group">
				<select class="form-control" name="status">
					<option value="0">New</option>
					<option value="1">Like New</option>
					<option value="2">Used</option>
					<option value="3">Old</option>
					<option value="0">Very Old</option>
				</select>
			</div>
			<label class="col-sm-2">Rate</label>
			<div class="col-sm-9 form-group">
				<input value="0" oninput="out.value=this.value" type="range" class="form-control" min="0" max="5" name="rate">
			</div>
			<output class="col-sm-1" name="out">0</output>
			<div class=" col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-info form-group update_btn"><i class="fa fa-plus"></i> Add The Item</button>
			</div>
		</form>
	</div>	
<?php 
}
elseif ($action=='insert') {###################################################--insert new members--##################################
	
}
elseif ($action=='delete') {###################################################--DELETE--##################################
		
}
elseif ($action=='activate') {
		
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