<div class="container-fluid" style="margin-top:98px">
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-4">
                <form action="components/_restaurantEdit.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header" style="background-color: rgb(111 202 203);">
                            Register New Restaurant
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">Restaurant Name: </label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Restaurant Description: </label>
                                <input type="text" class="form-control" name="desc" required>
                            </div> 
                            <div class="form-group">
								<label for="image" class="control-label">Image</label>
								<input type="file" name="image" id="image" accept=".jpg" class="form-control" required style="border:none;">
								<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
							</div>  
                        </div>  
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="regRestaurant" class="btn btn-sm btn-primary col-sm-3 offset-md-4"> Register </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->
    
            <!-- Table Panel -->
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-body">
                    <table class="table table-bordered table-hover mb-0">
                        <thead style="background-color: rgb(111 202 203);">
                        <tr>
                            <th class="text-center" style="width:7%;">Id</th>
                            <th class="text-center">Img</th>
                            <th class="text-center" style="width:58%;">Restaurant Detail</th>
                            <th class="text-center" style="width:18%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php error_reporting(0); 
                            $sql = "SELECT * FROM `restaurants`"; 
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $resId = $row['res_id'];
                                $resName = $row['res_Name'];
                                $resDesc = $row['res_Description'];

                                echo '<tr>
                                        <td class="text-center"><b>' .$resId. '</b></td>
                                        <td><img src="/pizza-delivery/img/card-'.$resId. '.jpg" alt="image for this Restaurant" width="150px" height="150px"></td>
                                        <td>
                                            <p>Name : <b>' .$resName. '</b></p>
                                            <p>Description : <b class="truncate">' .$resDesc. '</b></p>
                                        </td>
                                        <td class="text-center">
                                            <div class="row mx-auto" style="width:112px">
                                            <button class="btn btn-sm btn-primary edit_cat" type="button" data-toggle="modal" data-target="#updateRes' .$resId. '">Edit</button>
                                            <form action="components/_restaurantEdit.php" method="POST">
                                                <button name="removeRestaurant" class="btn btn-sm btn-danger" style="margin-left:9px;">Delete</button>
                                                <input type="hidden" name="resId" value="' .$resId. '">
                                            </form></div>
                                        </td>
                                    </tr>';
                            }
                        ?> 
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>	    
</div>


<?php error_reporting(0); 
    $ressql = "SELECT * FROM `restaurants`";
    $resResult = mysqli_query($conn, $ressql);
    while($resRow = mysqli_fetch_assoc($resResult)){
        $resId = $resRow['res_id'];
        $resName = $resRow['res_Name'];
        $resDesc = $resRow['res_Description'];
?>

<!-- Modal -->
<div class="modal fade" id="updateRes<?php error_reporting(0); echo $resId; ?>" tabindex="-1" role="dialog" aria-labelledby="updateRes<?php error_reporting(0); echo $resId; ?>" aria-hidden="true" style="width: -webkit-fill-available;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="updateRes<?php error_reporting(0); echo $resId; ?>">Restaurant Id: <b><?php error_reporting(0); echo $resId; ?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="components/_restaurantEdit.php" method="post" enctype="multipart/form-data">
		    <div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
		   		<div class="form-group col-md-8">
					<b><label for="image">Image</label></b>
					<input type="file" name="resimage" id="resimage" accept=".jpg" class="form-control" required style="border:none;" onchange="document.getElementById('itemPhoto').src = window.URL.createObjectURL(this.files[0])">
					<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
					<input type="hidden" id="resId" name="resId" value="<?php error_reporting(0); echo $resId; ?>">
					<button type="submit" class="btn btn-success my-1" name="updateResPhoto">Update Img</button>
				</div>
				<div class="form-group col-md-4">
					<img src="/pizza-delivery/img/card-<?php error_reporting(0); echo $resId; ?>.jpg" id="itemPhoto" name="itemPhoto" alt="Restaurant image" width="100" height="100">
				</div>
			</div>
		</form>
        <form action="components/_restaurantEdit.php" method="post">
            <div class="text-left my-2">
                <b><label for="name">Name</label></b>
                <input class="form-control" id="name" name="name" value="<?php error_reporting(0); echo $resName; ?>" type="text" required>
            </div>
            <div class="text-left my-2">
                <b><label for="desc">Description</label></b>
                <textarea class="form-control" id="desc" name="desc" rows="2" required minlength="6"><?php error_reporting(0); echo $resDesc; ?></textarea>
            </div>
            <input type="hidden" id="resId" name="resId" value="<?php error_reporting(0); echo $resId; ?>">
            <button type="submit" class="btn btn-success" name="updateRestaurant">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php error_reporting(0);
    }
?>