<?php 
	function gettitle(){
		global $pagetitle;
		if(isset($pagetitle))
			echo $pagetitle;
		else echo "Default";
	} 
	function countitem($table,$attr){
		global $con;
		$sql="SELECT `$attr` from $table";
		$res=$con->query($sql);
		return $res->num_rows;
	}
	function countitemwhere($table,$attr,$condtion,$wanted){
		global $con;
		$sql="SELECT `$attr` from $table WHERE $condtion='$wanted'";
		$res=$con->query($sql);
		return $res->num_rows;
	}
	function getlatest($table,$wanted,$limit=3){
		global $con;
		$sql="SELECT $wanted  FROM $table ORDER BY $wanted ASC limit $limit";
		$res=$con->query($sql);
		echo $con->error;
		return $res;
	}

	function checkitem($tablename,$columnname,$value){
		global $con;
		$sql="SELECT $columnname from $tablename WHERE $columnname='$value' LIMIT 1";
		$res =$con->query($sql);
		echo $con->error;
		return $res->num_rows;
	}
	function showmessage($wantedpage,$message,$time,$strong,$class){
		echo '
		    <div class="container">
			    <div class="alert alert-'.$class.' alert-dismissible fade in" role="alert"> 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span></button> 
						<strong>'.$strong.'</strong> 
						'.$message.'
				</div>
			</div>';
			echo '
		    <div class="container">
			    <div class="alert alert-info alert-dismissible fade in" role="alert"> 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span></button> 
						you will redirected to after '.$time.' seconds
				</div>
			</div>';
			header("refresh:".$time.";url=".$wantedpage);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo gettitle(); ?>
	</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
