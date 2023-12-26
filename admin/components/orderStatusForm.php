<?php error_reporting(0); 
    $itemModalSql = "SELECT * FROM `orders`";
    $itemModalResult = mysqli_query($conn, $itemModalSql);
    while($itemModalRow = mysqli_fetch_assoc($itemModalResult)){
        $orderid = $itemModalRow['order_id'];
        $userid = $itemModalRow['customer_id'];
        $order_Status = $itemModalRow['order_Status'];
    
?>

<!-- Modal -->
<div class="modal fade" id="order_Status<?php error_reporting(0); echo $orderid; ?>" tabindex="-1" role="dialog" aria-labelledby="order_Status<?php error_reporting(0); echo $orderid; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="order_Status<?php error_reporting(0); echo $orderid; ?>">Order Status and Delivery Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="components/_orderEdit.php" method="post" style="border-bottom: 2px solid #dee2e6;">
            <div class="text-left my-2">    
                <b><label for="name">Order Status</label></b>
                <div class="row mx-2">
                <input class="form-control col-md-3" id="status" name="status" value="<?php error_reporting(0); echo $order_Status; ?>" type="number" min="0" max="6" required>    
                <button type="button" class="btn btn-secondary ml-1" data-container="body" data-toggle="popover" title="User Types" data-placement="bottom" data-html="true" data-content="0=Order Placed.<br> 1=Order Confirmed.<br> 2=Preparing your Order.<br> 3=Your order is on the way!<br> 4=Order Delivered.<br> 5=Order Denied.<br> 6=Order Cancelled.">
                    <i class="fas fa-info"></i>
                </button>
                </div>
            </div>
            <input type="hidden" id="order_id" name="order_id" value="<?php error_reporting(0); echo $orderid; ?>">
            <button type="submit" class="btn btn-success mb-2" name="updateStatus">Update</button>
        </form>
        <?php error_reporting(0); 
            $deliveryDetailSql = "SELECT * FROM `delivery_info` WHERE `order_id`= $orderid";
            $deliveryDetailResult = mysqli_query($conn, $deliveryDetailSql);
            $deliveryDetailRow = mysqli_fetch_assoc($deliveryDetailResult);
            $trackId = $deliveryDetailRow['id'];
            $deliveryMan_Name = $deliveryDetailRow['deliveryMan_Name'];
            $deliveryMan_phone_num = $deliveryDetailRow['deliveryMan_phone_num'];
            $time_mins = $deliveryDetailRow['time_mins'];
            if($order_Status>0 && $order_Status<5) { 
        ?>
            <form action="components/_orderEdit.php" method="post">
                <div class="text-left my-2">
                    <b><label for="name">DeliveryMan Name</label></b>
                    <input class="form-control" id="name" name="name" value="<?php error_reporting(0); echo $deliveryMan_Name; ?>" type="text" required>
                </div>
                <div class="text-left my-2 row">
                    <div class="form-group col-md-6">
                        <b><label for="phone">Phone No</label></b>
                        <input class="form-control" id="phone" name="phone" value="<?php error_reporting(0); echo $deliveryMan_phone_num; ?>" type="tel" required pattern="[0-9]{11}">
                    </div>
                    <div class="form-group col-md-6">
                        <b><label for="resId">Estimated Time (minutes)</label></b>
                        <input class="form-control" id="time" name="time" value="<?php error_reporting(0); echo $time_mins; ?>" type="number" min="1" max="120" required>
                    </div>
                </div>
                <input type="hidden" id="trackId" name="trackId" value="<?php error_reporting(0); echo $trackId; ?>">
                <input type="hidden" id="order_id" name="order_id" value="<?php error_reporting(0); echo $orderid; ?>">
                <button type="submit" class="btn btn-success" name="updateDeliveryDetails">Update</button>
            </form>
        <?php error_reporting(0); } ?>
      </div>
    </div>
  </div>
</div>

<?php error_reporting(0);
    }
?>

<style>
    .popover {
        top: -77px !important;
    }
</style>

<script>
    $(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>