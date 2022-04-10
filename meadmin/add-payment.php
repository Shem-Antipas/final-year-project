<?php 


 if(isset($_POST['add_feepayment_info']))
 {
    $student_id = $_POST['student_id'];
    $fee_id = $_POST['fee_id'];
    $amount = $_POST['amount'];

	 //validation
	 if($student_id == "" || $fee_id == "" || $amount == "")
	 {
		 echo "<script>alert('Some Field are missing....');</script>";
	 }
	 else
	 {
        //add result
	 
        $add_done = $ravi->add_feepayment_info( (int)$student_id, (int)$fee_id, (int)$amount);
        
        if($add_done==true) //feedback
        {
            echo "<script>alert('Fee Payment Added successfully');</script>";
            echo "<script>window.location='home.php?ravi=view-payments';</script>";
        }
        else
        {
            echo "<script>alert('Could not add fee payment information');</script>";
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
                    <div class="form-group"> <label for="fee_id" class="col-sm-2 control-label">Fee Info</label>
                        <div class="col-sm-9"> 
                            <!-- select teachers -->
                            <select id="selector1" class="form-control1" name="fee_id">
                                <option>Fee Info</option>
                                <?php
                                    $s_query = $ravi->fee_info_display();
                                    if($s_query->num_rows>0){
                                        while($s =$s_query->fetch_assoc()){
                                ?>
                            
                                <option value="<?php echo $s['id'] ?>"><?php echo 'Class :'. $s['class_id'] . ' Term:' . $s['term'] . ' Year:' .$s['year']?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                   
                    <div class="form-group"> <label for="amount" class="col-sm-2 control-label">Amount</label>
                        <div class="col-sm-9"> <input type="text" class="form-control" name="amount" placeholder="Amount " pattern="[0-9]+"> </div>

                    </div>

                    <div class="col-sm-offset-2"> 
                        <input type="submit" class="btn btn-default" name="add_feepayment_info" value ="Add Payment Info">
                        </div>
                </form>
            </div>

		</div>


	</div>