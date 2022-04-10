<?php 


 if(isset($_POST['add_result_info']))
 {
    $teacher_id = (int) $_POST['teacher_id'];
    $class_id = (int) $_POST['class_id'];
    $subject_id = (int) $_POST['subject_id'];
    $student_id = (int) $_POST['student_id'];
    $term = (int) $_POST['term'];
    $year = (int) $_POST['year'];
    $marks = (int) $_POST['marks'];

	 //validation
	 if($teacher_id == "" || $class_id == "" || $subject_id == "" || $student_id == "" || $term == "" || $year == "" || $marks == "")
	 {
		 echo "<script>alert('Some Field are missing....');</script>";
	 }
	 else
	 {
        //add result
	 
        $add_done = $ravi->add_result_info($teacher_id, $class_id, $subject_id, $student_id, $term, $year, $marks);
        
        if($add_done==true) //feedback
        {
            echo "<script>alert('Results Added successfully');</script>";
            echo "<script>window.location='home.php?add-result';</script>";
        }
        else
        {
            echo "<script>alert('Could not add result information');</script>";
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
                <form class="form-horizontal" method="post">
                    <div class="form-group"> <label for="inputEmail3" class="col-sm-2 control-label">Teacher</label>
                        <div class="col-sm-9"> 
                            <!-- select teachers -->
                            <select id="selector1" class="form-control1" name="teacher_id">
                                <option>Select Teacher</option>
                                <?php
                                    $t_query = $ravi->teacher_info_display_admin();
                                    if($t_query->num_rows>0){
                                        while($t =$t_query->fetch_assoc()){		
                                ?>
                            
                                <option value="<?php echo $t['t_id'] ?>"><?php echo $t['t_fullname'] ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"> <label for="inputEmail3" class="col-sm-2 control-label">Class</label>
                        <div class="col-sm-9"> 
                        <!-- select teachers -->
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
                        </div>
                    </div>
                    <div class="form-group"> <label for="address" class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-9"> 
                            <!-- select teachers -->
                            <select id="selector1" class="form-control1" name="subject_id">
                                <option>Select Subject</option>
                                <?php
                                    $s_query = $ravi->subject_info();
                                    if($s_query->num_rows>0){
                                        while($s =$s_query->fetch_assoc()){		
                                ?>
                            
                                <option value="<?php echo $s['id'] ?>"><?php echo $s['subject_name'] ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                <div class="form-group"> 
                    <label for="address" class="col-sm-2 control-label">Student</label>
                        <div class="col-sm-9"> 
                        <!-- select students -->
                        <input list="students" type="text" class="form-control" name="student_id" >
                        <datalist id="students" class="form-control1" >
                                <option>Select Student</option>
                                <?php
                                    $st_query = $ravi->student_info();
                                    if($st_query->num_rows>0){
                                        while($st =$st_query->fetch_assoc()){		
                                ?>
                            
                                <option value="<?php echo $st['st_id'] ?>"><?php echo $st['st_fullname'] ?></option>
                                <?php } } ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group"> <label for="address" class="col-sm-2 control-label">Term</label>
                        <div class="col-sm-9"> 
                            <select id="selector1" class="form-control1" name="term">
                                <option>Select Term</option>
                                <option value="1">Term One</option>
                                <option value="2">Term Two</option>
                                <option value="3">Term Three</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group"> <label for="year" class="col-sm-2 control-label">Year</label>
                        <div class="col-sm-9"> <input type="text" class="form-control" name="year" placeholder="Year" pattern="[0-9]{4}"> </div>

                    </div>
                    <div class="form-group"> <label for="address" class="col-sm-2 control-label">Marks</label>
                        <div class="col-sm-9"> <input type="text" class="form-control" name="marks" placeholder="Mark " pattern="[0-9]+"> </div>

                    </div>

                    <div class="col-sm-offset-2"> 
                        <input type="submit" class="btn btn-default" name="add_result_info" value ="Add Result Info">
                        </div>
                </form>
            </div>

		</div>


	</div>