<?php 
include "../setting/config.php";
 session_start();
if(!$_SESSION['st_user'])
{
	header("location:index.php");
}
else
{
	$st_username = $_SESSION['st_user'];
	$std_info = $ravi->student_info_select($st_username);
	
	$student = $std_info->fetch_assoc();

	$where_sql = '';

	$query = "SELECT tblfeepayment.*, st_fullname, st_id, class_id, term, year FROM tblfeepayment ";
	$query .= " LEFT JOIN st_info ON tblfeepayment.student_id = st_info.st_id ";
	$query .= " LEFT JOIN tblfee ON tblfeepayment.fee_id = tblfee.id ";

   if(isset($_GET['filter']))
   {
	   $year =  $_GET['year'];
	   $class_id =  $_GET['class_id'];
	   $term =  $_GET['term'];

	   $student_id = $_GET['student_id'];

	   $whereSQL = array();

	   
	   if($class_id != 0){
		   array_push( $whereSQL, "tblfee.class_id=". (int)$class_id);
	   }

	   if(!empty($year) && $year != 0){
		   array_push( $whereSQL, "tblfee.year=". (int)$year);
	   }

	   if($term != 0){
		   array_push( $whereSQL, "tblfee.term=". (int)$term);
	   }
	   
	   if( count($whereSQL) != 0){
		   $where_sql = ' ';
		   if( count($whereSQL) > 0) {
			   for ($i=0; $i < count($whereSQL); $i++) { 
				   if( $i == count($whereSQL) - 1){
					   $where_sql .= $whereSQL[$i];
				   }
				   else
				   {
					   $where_sql .=  $whereSQL[$i] . " AND ";
				   }
			   }
		   }
		   
	   }

   
   }

   if(!empty($where_sql)){
	   $query .= " WHERE $where_sql AND student_id = " . (int)$student['st_id'] ;
   }
   else{
	   $query .= " WHERE student_id = "  . (int) $student['st_id'] ;
   }

    $results = $ravi->result_info($query);
	
}


?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>

<head>
	<title>Orero School| Home :: Welcome</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Augment Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<!-- Graph CSS -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- jQuery -->
	<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
	<!-- lined-icons -->
	<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
	<!-- //lined-icons -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/amcharts.js"></script>
	<script src="js/serial.js"></script>
	<script src="js/light.js"></script>
	<script src="js/radar.js"></script>
	<link href="css/barChart.css" rel='stylesheet' type='text/css' />
	<link href="css/fabochart.css" rel='stylesheet' type='text/css' />
	<!--clock init-->
	<script src="js/css3clock.js"></script>
	<!--Easy Pie Chart-->
	<!--skycons-icons-->
	<script src="js/skycons.js"></script>

	<script src="js/jquery.easydropdown.js"></script>

	<!--//skycons-icons-->
</head>

<body>
	<div class="page-container">
		<!--/content-inner-->
		<div class="left-content">
			<div class="inner-content">
				<!-- header-starts -->
				<div class="header-section">

					<div class="clearfix"></div>
				</div>
				<!-- //header-ends -->
				<div class="outter-wp">
				<div class="sub-heard-part">
		<ol class="breadcrumb m-b-0">
			<li><a href="index.html">Home</a></li>
			<li class="active">
				<?php if(isset($_GET['ravi'])){ echo strtoupper($page=$_GET['ravi']); } ?>
			</li>
		</ol>
	</div>
	<!--//sub-heard-part-->
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                        <input type="hidden" name="ravi" value="view-result">
                        <div class="form-row">
                            <div class="col-sm-3">
                                <div class="form-group"> 
									<label for="class_id" class="col-sm-2 control-label">Class</label>
                                    <div class="col-sm-9"> 
                                    <!-- select teachers -->
                                    <select id="selector1" class="form-control1" name="class_id">
                                            <option value="0" selected>Class/Grade</option>
                                            <?php
                                                $g_query = $ravi->grade_info();
                                                if($g_query->num_rows>0){
                                                    while($g =$g_query->fetch_assoc()){		
                                            ?>
                                        
                                            <option value="<?php echo $g['id'] ?>"><?php echo $g['id'] ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"> <label for="address" class="col-sm-2 control-label">Term</label>
                                    <div class="col-sm-9"> 
                                        <select id="selector1" class="form-control1" name="term">
                                            <option value="0" selected>Select Term</option>
                                            <option value="1">Term One</option>
                                            <option value="2">Term Two</option>
                                            <option value="3">Term Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group"> <label for="year" class="col-sm-2 control-label">Year</label>
                                    <div class="col-sm-9"> <input type="text" class="form-control" name="year" placeholder="Year" pattern="[0-9]{4}"> </div>

                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="col-sm-2 control-label"></label>
                                    <div class="col-sm-9">
                                        <input type="submit" class="btn btn-primary form-control" name="filter" value ="Filter">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
	<div class="graph-visual tables-main">
		<div class="grid-1" id="printable">
            <div class="card bg-transparent mt-2">
                <div class="card-body" >
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Id</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Term</th>
                                <th>Year</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Student Id</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Term</th>
                                <th>Year</th>
                                <th>Amount</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php 
                                if($results->num_rows > 0) {
                                    $sno = 1;
                                    while($row = $results->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $sno ; ?></td>
                                <td><?php echo $row['student_id'] ; ?></td>
                                <td><?php echo $row['st_fullname'] ; ?></td>
                                <td><?php echo $row['class_id'] ; ?></td>
                                <td><?php echo $row['term'] ; ?></td>
                                <td><?php echo $row['year'] ; ?></td>
                                <td><?php echo $row['amount'] ; ?></td>
                            </tr>
                            <?php }  $sno += 1;  ?>
                            <?php } ?> 
                        </tbody>
                    </table>
					<div class="card-text">
						
					</div>
                </div>
            </div>
			
		</div>
		<div class="row">
							<div class="col-md-6 text-center mx-auto">
								<button id="print" data-target="#example">Print</button>
							</div>
						</div>

					<!--//outer-wp-->
				</div>
				<!--footer section start-->
				<footer>
					<p>2022 Orero School. All rights reserved | Design by ShemArts.</a> Developed By ShemAntipas</p>
				</footer>
				<!--footer section end-->
			</div>
		</div>
		
		<!--//content-inner-->
		<!--/sidebar-menu-->
		<div class="sidebar-menu">
			<header class="logo">
				<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="index.html"> <span id="logo"> <h1>Augment</h1></span> 
					<!--<img id="logo" src="" alt="Logo"/>--> 
				  </a>
			</header>
			<div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
			<!--/down-->
			<div class="down">
				<a href="index.html"><img src="images/admin.jpg"></a>
				<a href="index.html"><span class=" name-caret"><?php echo $student['st_fullname']; ?></span></a>
				<p>Student</p>
				<ul>
					<li><a class="tooltips" href="index.html"><span>Profile</span><i class="lnr lnr-user"></i></a></li>
					<li><a class="tooltips" href="index.html"><span>Settings</span><i class="lnr lnr-cog"></i></a></li>
					<li><a class="tooltips" href="logouts.php"><span>Log out</span><i class="lnr lnr-power-switch"></i></a></li>
				</ul>
			</div>
			<!--//down-->
			<div class="menu">
				<ul id="menu">
					<li>
						<a href="home.php">
							<i class="fa fa-tachometer"></i> 
							<span>Dashboard</span>
						</a>
					</li>
					<li>
						<a href="results.php?ravi=results">
							<i class="fa fa-file"></i> 
							<span>Results</span>
						</a>

						<a href="view-payments.php?ravi=view-payments">
							<i class="fa fa-money"></i> 
							<span>View Payments</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<script>
		var toggle = true;

		$(".sidebar-icon").click(function() {
			if (toggle) {
				$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
				$("#menu span").css({
					"position": "absolute"
				});
			} else {
				$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
				setTimeout(function() {
					$("#menu span").css({
						"position": "relative"
					});
				}, 400);
			}

			toggle = !toggle;
		});

		var printButton = $('#print');
		printButton.click( () => {
			var printContent = document.getElementById('printable');

			let winPrint = window.open('', '', 'left=0, top=0, width=1024, height=900, toolbar=0, scrollbars=0, status=0');
			winPrint.document.write(printContent.innerHTML);
			winPrint.document.close();
			winPrint.focus();
			winPrint.print();
			winPrint.close();
		})
	</script>
	<!--js -->
	<link rel="stylesheet" href="css/vroom.css">
	<script type="text/javascript" src="js/vroom.js"></script>
	<script type="text/javascript" src="js/TweenLite.min.js"></script>
	<script type="text/javascript" src="js/CSSPlugin.min.js"></script>
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
</body>

</html>