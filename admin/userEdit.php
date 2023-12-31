
<div class="container-fluid" style="margin-top:98px">
	
	<div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#newUser"><i class="fa fa-plus"></i> New user</button>
        </div>
	</div>
	    <br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12 text-center">
                    <thead style="background-color: rgb(111 202 203);">
                        <tr>
                            <th>UserId</th>
                            <th style="width:7%">Photo</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php error_reporting(0);
                            $sql = "SELECT * FROM system_users"; 
                            $result = mysqli_query($conn, $sql);
                            
                            while($row=mysqli_fetch_assoc($result)) {
                                $Id = $row['id'];
                                $username = $row['username'];
                                $first_name = $row['first_name'];
                                $last_name = $row['last_name'];
                                $email = $row['email'];
                                $phone = $row['phone'];
                                $user_group = $row['user_group'];
                                if($user_group == 0) 
                                    $user_group = "user";
                                else
                                    $user_group = "Admin";

                                echo '<tr>
                                    <td>' .$Id. '</td>
                                    <td><img src="/pizza-delivery/img/person-' .$Id. '.jpg" alt="image for this user" onError="this.src =\'/pizza-delivery/img/profilePic.jpg\'" width="100px" height="100px"></td>
                                    <td>' .$username. '</td>
                                    <td>
                                        <p>First Name : <b>' .$first_name. '</b></p>
                                        <p>Last Name : <b>' .$last_name. '</b></p>
                                    </td>
                                    <td>' .$email. '</td>
                                    <td>' .$phone. '</td>
                                    <td>' .$user_group. '</td>
                                    <td class="text-center">
                                        <div class="row mx-auto" style="width:112px">
                                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editUser' .$Id. '" type="button">Edit</button>';
                                            if($Id == 1) {
                                                echo '<button class="btn btn-sm btn-danger" disabled style="margin-left:9px;">Delete</button>';
                                            }
                                            else {
                                                echo '<form action="components/_userEdit.php" method="POST">
                                                        <button name="removeUser" class="btn btn-sm btn-danger" style="margin-left:9px;">Delete</button>
                                                        <input type="hidden" name="Id" value="' .$Id. '">
                                                    </form>';
                                            }

                                    echo '</div>
                                    </td>
                                </tr>';
                            }
                        ?>
                    </tbody>
		        </table>
			</div>
		</div>
	</div>
</div>

<!-- newUser Modal -->
<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="newUser" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="newUser">Create New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="components/_userEdit.php" method="post">
              <div class="form-group">
                  <b><label for="username">Username</label></b>
                  <input class="form-control" id="username" name="username" placeholder="Choose a unique Username" type="text" required minlength="3" maxlength="11">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <b><label for="first_name">First Name:</label></b>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                </div>
                <div class="form-group col-md-6">
                  <b><label for="last_name">Last name:</label></b>
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required>
                </div>
              </div>
              <div class="form-group">
                  <b><label for="email">Email:</label></b>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
              </div>
              <div class="form-group row my-0">
                    <div class="form-group col-md-6 my-0">
                        <b><label for="phone">Phone No:</label></b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon">+88</span>
                            </div>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone No" required pattern="[0-9]{11}" maxlength="11">
                        </div>
                    </div>
                    <div class="form-group col-md-6 my-0">
                        <b><label for="user_group">Type:</label></b>
                        <select name="user_group" id="user_group" class="custom-select browser-default" required>
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                        </select>
                    </div>
              </div>
              <div class="form-group">
                  <b><label for="password">Password:</label></b>
                  <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required data-toggle="password" minlength="4" maxlength="21">
              </div>
              <div class="form-group">
                  <b><label for="password1">Confirm Password:</label></b>
                  <input class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" type="password" required data-toggle="password" minlength="4" maxlength="21">
              </div>
              <button type="submit" name="createUser" class="btn btn-success">Submit</button>
            </form>
      </div>
    </div>
  </div>
</div>

<?php error_reporting(0); 
    $usersql = "SELECT * FROM `system_users`";
    $userResult = mysqli_query($conn, $usersql);
    while($userRow = mysqli_fetch_assoc($userResult)){
        $Id = $userRow['id'];
        $name = $userRow['username'];
        $first_name = $userRow['first_name'];
        $last_name = $userRow['last_name'];
        $email = $userRow['email'];
        $phone = $userRow['phone'];
        $user_group = $userRow['user_group'];


?>
<!-- editUser Modal -->
<div class="modal fade" id="editUser<?php error_reporting(0); echo $Id; ?>" tabindex="-1" role="dialog" aria-labelledby="editUser<?php error_reporting(0); echo $Id; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="editUser<?php error_reporting(0); echo $Id; ?>">User Id: <b><?php error_reporting(0); echo $Id; ?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            
            <div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
                <div class="form-group col-md-8">
                    <form action="components/_userEdit.php" method="post" enctype="multipart/form-data">
                        <b><label for="image">Profile Picture</label></b>
                        <input type="file" name="userimage" id="userimage" accept=".jpg" class="form-control" required style="border:none;">
                        <small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
                        <input type="hidden" id="customer_id" name="customer_id" value="<?php error_reporting(0); echo $Id; ?>">
                        <button type="submit" class="btn btn-success mt-3" name="updateProfilePhoto">Update Img</button>
                    </form>         
                </div>
                <div class="form-group col-md-4">
                    <img src="/pizza-delivery/img/person-<?php error_reporting(0); echo $Id; ?>.jpg" alt="Profile Photo" width="100" height="100" onError="this.src ='/pizza-delivery/img/profilePic.jpg'">
                    <form action="components/_userEdit.php" method="post">
                        <input type="hidden" id="customer_id" name="customer_id" value="<?php error_reporting(0); echo $Id; ?>">
                        <button type="submit" class="btn btn-success mt-2" name="removeProfilePhoto">Remove Img</button>
                    </form>
                </div>
            </div>
            
            <form action="components/_userEdit.php" method="post">
                <div class="form-group">
                    <b><label for="username">Username</label></b>
                    <input class="form-control" id="username" name="username" value="<?php error_reporting(0); echo $name; ?>" type="text" disabled>
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                    <b><label for="first_name">First Name:</label></b>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php error_reporting(0); echo $first_name; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <b><label for="last_name">Last name:</label></b>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php error_reporting(0); echo $last_name; ?>" required>
                </div>
                </div>
                <div class="form-group">
                    <b><label for="email">Email:</label></b>
                    <input type="email" class="form-control" id="email" name="email" value="<?php error_reporting(0); echo $email; ?>" required>
                </div>
                <div class="form-group row my-0">
                    <div class="form-group col-md-6 my-0">
                        <b><label for="phone">Phone No:</label></b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon">+88</span>
                            </div>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?php error_reporting(0); echo $phone; ?>" required pattern="[0-9]{11}" maxlength="11">
                        </div>
                    </div>
                    <div class="form-group col-md-6 my-0">
                        <b><label for="user_group">Type:</label></b>
                        <select name="user_group" id="user_group" class="custom-select browser-default" required>
                        <?php error_reporting(0); 
                            if($user_group == 1) {
                        ?>
                            <option value="0">User</option>
                            <option value="1" selected>Admin</option>
                        <?php error_reporting(0);
                            } 
                            else {
                        ?>
                            <option value="0" selected>User</option>
                            <option value="1">Admin</option>
                        <?php error_reporting(0);
                            } 
                        ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" id="customer_id" name="customer_id" value="<?php error_reporting(0); echo $Id; ?>">
                <button type="submit" name="editUser" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
  </div>
</div>

<?php error_reporting(0);
    }
?>