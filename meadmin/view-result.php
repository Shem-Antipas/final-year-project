<?php 
    $query = "SELECT tblresult.*, st_fullname, subject_name FROM tblresult ";
    $query .= " LEFT JOIN st_info ON tblresult.StudentId = st_info.st_id ";
    $query .= "LEFT JOIN subjects_info ON tblresult.SubjectId = subjects_info.id ";

    if(isset($_GET['filter']))
    {
        $year =  $_GET['year'];
        $class_id =  $_GET['class_id'];
        $term =  $_GET['term'];

        $whereSQL = array();

        
        if($class_id != 0){
            array_push( $whereSQL, "ClassId=". (int)$class_id);
        }

        if(!empty($year) && $year != 0){
            array_push( $whereSQL, "Year=". (int)$year);
        }

        if($term != 0){
            array_push( $whereSQL, "Term=". (int)$term);
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
    
    $results = $ravi->result_info($query);
    
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
            <div class="card bg-transparent mt-2">
                <div class="card-header">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                        <input type="hidden" name="ravi" value="view-result">
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
                </div>
                <div class="card-body">
                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Id</th>
                                <th>Student Name</th>
                                <th>Subject</th>
                                <th>Marks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Student Id</th>
                                <th>Student Name</th>
                                <th>Subject</th>
                                <th>Marks</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php 
                                if($results->num_rows > 0) {
                                    $sno = 1;
                                    while($row = $results->fetch_assoc()) {
                            ?>
                            <tr>
                                <th><?php echo $sno ; ?></th>
                                <th><?php echo $row['st_fullname'] ; ?></th>
                                <th><?php echo $row['StudentId'] ; ?></th>
                                <th><?php echo $row['subject_name'] ; ?></th>
                                <th><?php echo $row['marks'] ; ?></th>
                                <th>Action</th>
                            </tr>
                            <?php }  $sno += 1;  ?>
                            <?php } ?> 
                        </tbody>
                    </table>
                </div>
            </div>

		</div>


	</div>