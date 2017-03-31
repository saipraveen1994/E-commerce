<?php 
include '../includes/db.php';
$c_id = $_SESSION['c_id'];
$sql="SELECT * FROM customer_details WHERE cus_id = '$c_id'";
if(isset($_GET['delete']) && !empty($_GET['delete'])){
  $delete_id=(int)$_GET['delete'];
  $sql="DELETE FROM customer_details WHERE cus_detail_id='$delete_id'";
  $con->query($sql);

  header("location: ../checkout.php");
}

$results=$con->query($sql);

if(isset($_GET['add']) ||isset($_GET['edit'])){

  $cus_fullname=((isset($_POST['cus_fullname']) && $_POST['cus_fullname']!='')?$_POST['cus_fullname']:'');
  $cus_address=((isset($_POST['cus_address']) && $_POST['cus_address']!='')?$_POST['cus_address']:'');
  $cus_city=((isset($_POST['cus_city']) && $_POST['cus_city']!='')?$_POST['cus_city']:'');
  $cus_state=((isset($_POST['cus_state']) && $_POST['cus_state']!='')?$_POST['cus_state']:'');
  $cus_zipcode=((isset($_POST['cus_zipcode']) && $_POST['cus_zipcode']!='')?$_POST['cus_zipcode']:'');
  $cus_mobile=((isset($_POST['cus_mobile']) && $_POST['cus_mobile']!='')?$_POST['cus_mobile']:'');



  if(isset($_GET['edit'])){

    $edit_id=(int)$_GET['edit'];
    $detailresults=$con->query("SELECT * FROM customer_details WHERE cus_detail_id='$edit_id'");
    $details=mysqli_fetch_assoc($detailresults);
    $cus_fullname=((isset($_POST['cus_fullname']) && $_POST['cus_fullname']!='')?$_POST['cus_fullname']:$details['cus_fullname']);
    $cus_address=((isset($_POST['cus_address']) && $_POST['cus_address']!='')?$_POST['cus_address']:$details['cus_address']);
    $cus_city=((isset($_POST['cus_city']) && $_POST['cus_city']!='')?$_POST['cus_city']:$details['cus_city']);
    $cus_state=((isset($_POST['cus_state']) && $_POST['cus_state']!='')?$_POST['cus_state']:$details['cus_state']);
    $cus_zipcode=((isset($_POST['cus_zipcode']) && $_POST['cus_zipcode']!='')?$_POST['cus_zipcode']:$details['cus_zipcode']);
    $cus_mobile=((isset($_POST['cus_mobile']) && $_POST['cus_mobile']!='')?$_POST['cus_mobile']:$details['cus_mobile']);

   
    }

  if($_POST){

    $cus_fullname=$_POST['cus_fullname'];
    $cus_address=$_POST['cus_address'];
    $cus_city=$_POST['cus_city'];
    $cus_state=$_POST['cus_state'];
    $cus_zipcode=$_POST['cus_zipcode'];
    $cus_mobile=$_POST['cus_mobile'];

    // $tax_sql = $con->query("SELECT * FROM tax WHERE state_id = '$cus_state'");
    // $tax_rate = mysqli_fetch_assoc($tax_sql);
    // $state_tax = $tax_rate['state_tax'];

    $sql="INSERT INTO customer_details (cus_id, cus_fullname, cus_address, cus_city, cus_state, cus_zipcode, cus_mobile) VALUES ('$c_id', '$cus_fullname', '$cus_address', '$cus_city', '$cus_state', '$cus_zipcode', '$cus_mobile')";
    if(isset($_GET['edit'])){
      $sql="UPDATE customer_details SET cus_fullname='$cus_fullname', cus_address='$cus_address', cus_city='$cus_city', cus_state='$cus_state', cus_zipcode='$cus_zipcode', cus_mobile='$cus_mobile' WHERE cus_detail_id='$edit_id'";
    }
    $con->query($sql);

    header("location: ../checkout.php");
  }

?>


<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ' :'Add New');?> Shipping Address</h2><hr>

<div class="container">
  <div class="row">
    <div class="col-sm-6 col-xs-12 personal-info">

      <form class="form-horizontal" action="parsers/ship_details.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" role="form" method="POST">
        <div class="form-group">
          <label class="col-lg-3 control-label">Full name:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cus_fullname" name="cus_fullname" value="<?php echo "$cus_fullname"; ?>" >
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Road No./Apt No.:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cus_address" name="cus_address" value="<?php echo "$cus_address"; ?>">
          </div>
        </div>
         <div class="form-group">
          <label class="col-lg-3 control-label">City:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cus_city" name="cus_city" value="<?php echo "$cus_city"; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">State:</label>
          <div class="col-lg-8">
            <div class="ui-select">
              <select id="cus_state" name="cus_state" class="form-control"> 
                <option ><?php echo $cus_state; ?></option>
                <option value="TX">TX</option>
                <option value="CA">CA</option>
                <option value="IL">IL</option>
                <option value="FL">FL</option>
                <option value="IN">IN</option>
                <option value="MI">MI</option>
                <option value="MA">MA</option>
                <option value="CO">CO</option>
                <option value="NY">NY</option>
                <option value="OH">OH</option>
              </select>
            </div>
          </div>
        </div>
         <div class="form-group">
          <label class="col-lg-3 control-label">Zip Code:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cus_zipcode" name="cus_zipcode" value="<?php echo "$cus_zipcode"; ?>">
          </div>
        </div> 
         <div class="form-group">
          <label class="col-lg-3 control-label">Mobile Number:</label>
          <div class="col-lg-8">
            <input class="form-control" type="text" id="cus_mobile" name="cus_mobile" value="<?php echo "$cus_mobile"; ?>">
          </div>
        </div>
       
        <div class="form-group pull-right">
         <a href="delivery_address.php" class="btn btn-default">Cancel</a>
         <input type="submit" value=<?=(isset($_GET['edit']))?'Edit':'Add ';?> Shipping Address" class=" btn btn-success">
      </div><div class="clearfix"></div> 
      </form>
    </div>
  </div>
</div>


<?php }
else{
  ?>
    
      <hr>
      <div class="container">
       <div class="col-xs-6 col-md-offset-3">
        <div class="row">
       <a href="parsers/ship_details.php?add=1" class="btn btn-success pull-right" id="add-product-btn "> Add Shipping Address</a><div class="clearfix">
      <table class="table table-bordered table-condensed table-striped">
        <thead><th>SHIPPING ADDRESS</th></thead>
        <tbody>
          <?php while($cusdetails=mysqli_fetch_assoc($results)): ?>
            <tr>
            <td>
                <span><form action="cart_review.php" method="POST" enctype="multipart/form-data">
                <input type="radio" class="form-check-input" name="tax_id" id="tax_id" <?php if (isset($_POST['tax_id']) && $_POST['tax_id'] == $cusdetails['cus_detail_id']) echo ' checked="checked"'; ?> value="<?=$cusdetails['cus_detail_id'];?>" onclick="this.form.submit()" >
                <!-- <input type="radio" class="form-check-input" name="tax_id" id="tax_id"> -->
                
              
                
                  </span><span class="pull-right"> <a href="parsers/ship_details.php?edit=<?=$cusdetails['cus_detail_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>   <a href="parsers/ship_details.php?delete=<?=$cusdetails['cus_detail_id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></span>
            <?=$cusdetails['cus_fullname']?><br><?=$cusdetails['cus_address']?><br><?=$cusdetails['cus_city']?><br><?=$cusdetails['cus_state']?><br><?=$cusdetails['cus_zipcode']?><br><?=$cusdetails['cus_mobile']?></td>
           </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
   
   </form>
   <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
      <?php }
?>
