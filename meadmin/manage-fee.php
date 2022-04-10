<?php 

    $query = "SELECT * FROM tblfee ";

    if(isset($_GET['filter']))
    {
        $year =  $_GET['year'];
        $class_id =  $_GET['class_id'];
        $term =  $_GET['term'];

        $whereSQL = array();

        
        if($class_id != 0){
            array_push( $whereSQL, "class_id=". (int)$class_id);
        }

        if(!empty($year) && $year != 0){
            array_push( $whereSQL, "year=". (int)$year);
        }

        if($term != 0){
            array_push( $whereSQL, "term=". (int)$term);
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
            $query .= !empty($where_sql) ? ' WHERE '. $where_sql : '';
        }

    
    }
    
    $fee_info = $ravi->result_info($query);

 if(isset($_POST['add_fee_info']))
 {
    $class_id = (int) $_POST['class_id'];
    $term = (int) $_POST['term'];
    $year = (int) $_POST['year'];
    $amount = (int) $_POST['amount'];

	 //validation
	 if($class_id == "" || $term == "" || $year == "" || $amount == "")
	 {
		 echo "<script>alert('Some Field are missing....');</script>";
	 }
	 else
	 {
        //add result
	 
        $add_done = $ravi->add_fee_info($class_id, $term, $year, $amount);
        
        if($add_done==true) //feedback
        {
            echo "<script>alert('Fee Added successfully');</script>";
            echo "<script>window.location='home.php?ravi=manage-fee';</script>";
        }
        else
        {
            echo "<script>alert('Could not add fee information');</script>";
        }
    }
 }

?>
<div class="outter-wp">
	<!--sub-heard-part-->
	<div class="sub-heard-part">
		<ol class="breadcrumb m-b-0">
			<li><a href="index.html">Home</a></li>
			<li class="active">
				<?php if(isset($_GET['ravi'])){ echo strtoupper($page=$_GET['ravi']); } ?>
			</li>
		</ol>
	</div>
	<!--//sub-heard-part-->
	<div class="graph-visual tables-main">
		<h2 class="inner-tittle">
			<?php echo strtoupper($_GET['ravi']); ?>
		</h2>

		<div class="grid-1">
            
            <div class="form-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <input type="hidden" name="ravi" value="manage-fee">
                    <div class="form-row">
                        <div class="col-sm-2">
                            <div class="form-group"> <label for="inputEmail3" class="col-sm-2 control-label">Class</label>
                                <div class="col-sm-9"> 
                                <!-- select teachers -->
                                <select id="selector1" class="form-control1" name="class_id">
                                        <option value="0" selected>Select Class/Grade</option>
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
                            <div class="col-sm-4">
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
                            <div class="col-sm-4">
                                <div class="form-group"> <label for="year" class="col-sm-2 control-label">Year</label>
                                    <div class="col-sm-9"> <input type="text" class="form-control" name="year" placeholder="Year" pattern="[0-9]{4}"> </div>

                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="col-sm-2 control-label"></label>
                                    <div class="col-sm-9">
                                        <input type="submit" class="btn btn-primary form-control" name="filter" value ="Filter">
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>

                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class</th>
                                <th>Term</th>
                                <th>Year</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Class</th>
                                <th>Term</th>
                                <th>Year</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <tr>
                                <form action="" method="post">
                                <th>Add</th>
                                <th>
                                     <select id="selector1" class="form-control1" name="class_id">
                                        <option>Select Class/Grade</option>
                                        <?php
                                            $g_query = $ravi->grade_info();
                                            if($g_query->num_rows>0){
                                                while($g =$g_query->fetch_assoc()){		
                                        ?>
                                    
                                        <option value="<?php echo $g['id'] ?>"><?php echo $g['id'] ?></option>
                                        <?php } } ?>
                                    </select>
                                </th>
                                <th>
                                    <select id="selector1" class="form-control1" name="term">
                                        <option>Select Term</option>
                                        <option value="1">Term One</option>
                                        <option value="2">Term Two</option>
                                        <option value="3">Term Three</option>
                                    </select>
                                </th>
                                <th>
                                    <input type="text" class="form-control" name="year" placeholder="Year" pattern="[0-9]{4}">
                                </th>
                                <th>
                                    <input type="text" class="form-control" name="amount" placeholder="Amount" pattern="[0-9]+">
                                </th>
                                <th>
                                    <input type="submit" class="form-control btn btn-default" name="add_fee_info" value ="Add Fee Info">
                                </th>
                                </form>
                            </tr> 
                            <?php 
                                if($fee_info->num_rows > 0) {
                                    $sno = 1;
                                    while($row = $fee_info->fetch_assoc()) {
                            ?>
                            <tr>
                                <th><?php echo $sno ; ?></th>
                                <th><?php echo $row['class_id'] ; ?></th>
                                <th><?php echo $row['term'] ; ?></th>
                                <th><?php echo $row['year'] ; ?></th>
                                <th><?php echo $row['amount'] ; ?></th>
                                <th>Action</th>
                            </tr>
                            <?php $sno ++; }    ?>
                            <?php } ?>
                           
                        </tbody>
                    </table>
            </div>

		</div>


	</div>