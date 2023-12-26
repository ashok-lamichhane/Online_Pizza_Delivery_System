<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%" id='notempty'>
    <strong>Info!</strong> If problem is not related to the order then order id = 0	
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
</div>
<style>
    .btn-danger-gradiant {
        background: linear-gradient(to right, #ff4d7e 0%, #ff6a5b 100%);
    }

    .btn-danger-gradiant:hover {
        background: linear-gradient(to right, #ff6a5b 0%, #ff4d7e 100%);
    }
</style>
<div style="margin-right: 32px;display: table;margin-left: auto;">
<button type="button" class="btn btn-danger-gradiant text-white border-0 py-2 px-3 mx-2" data-toggle="modal" data-target="#history"><span> HISTORY <i class="ti-arrow-right"></i></span></button>
</div>
<div class="container-fluid" id='empty'>	
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12 text-center">
                    <thead style="background-color: rgb(111 202 203);">
                        <tr>
                            <th>Id</th>
                            <th>UserId</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Order Id</th>
                            <th>Message</th>
                            <th>datetime</th>
                            <th>Reply</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php error_reporting(0);
                            $sql = "SELECT * FROM customer_message"; 
                            $result = mysqli_query($conn, $sql);
                            $count = 0;
                            while($row=mysqli_fetch_assoc($result)) {
                                $contact_id = $row['contact_id'];
                                $customer_id = $row['customer_id'];
                                $email = $row['email'];
                                $phone_num = $row['phone_num'];
                                $order_id = $row['order_id'];
                                $message = $row['message'];
                                $time = $row['time'];
                                $count++;

                                echo '<tr>
                                        <td>' .$contact_id. '</td>
                                        <td>' .$customer_id. '</td>
                                        <td>' .$email. '</td>
                                        <td>' .$phone_num. '</td>
                                        <td>' .$order_id. '</td>
                                        <td>' .$message. '</td>
                                        <td>' .$time. '</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#reply' .$contact_id. '">Reply</button>
                                        </td>
                                    </tr>';
                            }
                            if($count==0) {
                              ?><script> document.getElementById("notempty").innerHTML = '<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%"> You have not received any messages!	</div>';
                              document.getElementById("empty").innerHTML = '';
                              </script> <?php error_reporting(0);
                            }
                        ?>
                        
                    </tbody>
		        </table>
			</div>
		</div>
	</div>
</div>

    <?php error_reporting(0); 
        $contactsql = "SELECT * FROM `customer_message`";
        $contactResult = mysqli_query($conn, $contactsql);
        while($contactRow = mysqli_fetch_assoc($contactResult)){
            $contact_id = $contactRow['contact_id'];
            $Id = $contactRow['customer_id'];
    ?>

    <!-- Reply Modal -->
    <div class="modal fade" id="reply<?php error_reporting(0); echo $contact_id; ?>" tabindex="-1" role="dialog" aria-labelledby="reply<?php error_reporting(0); echo $contact_id; ?>" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: rgb(111 202 203);">
            <h5 class="modal-title" id="reply<?php error_reporting(0); echo $contact_id; ?>">Reply (Contact Id: <?php error_reporting(0); echo $contact_id; ?>)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="components/_contactEdit.php" method="post">
                <div class="text-left my-2">
                    <b><label for="message">Message: </label></b>
                    <textarea class="form-control" id="message" name="message" rows="2" required minlength="5"></textarea>
                </div>
                <input type="hidden" id="contact_id" name="contact_id" value="<?php error_reporting(0); echo $contact_id; ?>">
                <input type="hidden" id="customer_id" name="customer_id" value="<?php error_reporting(0); echo $Id; ?>">
                <button type="submit" class="btn btn-success" name="admin_reply">Reply</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php error_reporting(0);
        }
    ?>

    <!-- history Modal -->
    <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="history" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(187 188 189);">
              <h5 class="modal-title" id="history">Your Sent Messages</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="notReply">
            <table class="table-striped table-bordered col-md-12 text-center">
                <thead style="background-color: rgb(111 202 203);">
                    <tr>
                        <th>Contact Id</th>
                        <th>Reply Message</th>
                        <th>datetime</th>
                    </tr>
                </thead>
                <tbody>
                <?php error_reporting(0); 
                    $sql = "SELECT * FROM `admin_reply`"; 
                    $result = mysqli_query($conn, $sql);
                    $totalReply = 0;
                    while($row=mysqli_fetch_assoc($result)) {
                        $contact_id = $row['contact_id'];
                        $message = $row['message'];
                        $date_time = $row['date_time'];
                        $totalReply++;

                        echo '<tr>
                                <td>' .$contact_id. '</td>
                                <td>' .$message. '</td>
                                <td>' .$date_time. '</td>
                              </tr>';
                    }    

                    if($totalReply==0) {
                      ?><script> document.getElementById("notReply").innerHTML = '<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%"> You have not replied to any messages yet!	</div>';</script> <?php error_reporting(0);
                    }   

                ?>
                </tbody>
		    </table>
            </div>
          </div>
        </div>
    </div>