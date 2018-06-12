<?php 
include 'connect_dp.php';		
session_start();
$pagetitle="DashBoard";

if(isset($_SESSION['username'])){
	include 'temp/thehead.php';
	include 'temp/navbar.php';

?>
<div class="container">
	<h1 class="text-center">Dashboard</h1>
	<div class="row">
		<div class="col-md-3 col-sm-6 text-center ">
			<div class="box" style="background-color:#2991DC;">
				<h5>Total Members</h5>
				<h1><?php echo countitem("users","username"); ?></h1>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 text-center">
			<div class="box" style="background-color:#CA4429;">
				<h5>Un Activate Memvers</h5>
				<h1><a href="home.php?showunreg=true"><?php 
				//function countitemwhere($table,$attr,$condtion,$wanted)
				echo countitemwhere("users","username","regstatus","0");
				 ?></a></h1>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 text-center">
			<div class="box" style="background-color:#DF5B00;">
				<h5>Total Members</h5>
				<h1>200</h1>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 text-center">
			<div class="box" style="background-color:#9151AE;">
				<h5>Total Members</h5>
				<h1>200</h1>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading" style="overflow:hidden"><i class="fa fa-users"></i> Panel heading without title
				<form class="" >
				        <div class="form-group col-md-8">
				          <input  type="number" name="kero" class="form-control " placeholder="Search">
				        </div>
				        <button type="submit" formaction="?limit=kero.value" class="btn btn-success col-md-4">LIMIT</button>
			      </form>
			  </div>
			  <div class="panel-body">
			    <!-- getlatest($table,$wanted,$limit=3) -->
			    <ul class="list-unstyled member-list">
				    <?php 
					$limit = (isset($_GET['kero']) && is_numeric($_GET['kero'])) ? $_GET['kero'] : 3 ;
					//echo $limit;
				    $res=getlatest("users","username,id,regstatus",$limit);
				    foreach ($res as $key ) {
				    	echo "<li>".$key['username'].
				    	"<a class='btn btn-success fa fa-edit' href='home.php?do=edit&id=".$key['id']."'> edit</a>";
				    	if ($key['regstatus']==0) 
							echo '<a class="btn btn-info fa fa-check" href="home.php?do=activate&id='.$key["id"].'"> acitvate</a>';
				    	echo "</li>";
				    	
				    }
				     ?>
				 </ul>
			  </div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">Panel heading without title</div>
			  <div class="panel-body">
			    Panel content
			  </div>
			</div>
		</div>
	</div>
</div>
	<?php 
	include 'temp/thetail.php';
 }
 else{
 	header("location:index.php");
 }