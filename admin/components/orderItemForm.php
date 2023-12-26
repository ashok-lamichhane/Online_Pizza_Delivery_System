<?php error_reporting(0); 
    $itemModalSql = "SELECT * FROM `orders`";
    $itemModalResult = mysqli_query($conn, $itemModalSql);
    while($itemModalRow = mysqli_fetch_assoc($itemModalResult)){
        $orderid = $itemModalRow['order_id'];
        $userid = $itemModalRow['customer_id'];
    
?>

<!-- Modal -->
<div class="modal fade" id="orderItem<?php error_reporting(0); echo $orderid; ?>" tabindex="-1" role="dialog" aria-labelledby="orderItem<?php error_reporting(0); echo $orderid; ?>" aria-hidden="true" style="width: -webkit-fill-available;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(111 202 203);">
                <h5 class="modal-title" id="orderItem<?php error_reporting(0); echo $orderid; ?>">Order Items (<b>Order Id: <?php error_reporting(0); echo $orderid; ?></b>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
                <div class="container">
                    <div class="row">
                        <!-- Shopping cart table -->
                        <div class="table-responsive">
                            <table class="table text">
                            <thead>
                                <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="px-3">Item</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="text-center">Quantity</div>
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php error_reporting(0);
                                    $mysql = "SELECT * FROM `ordered_items` WHERE order_id = $orderid";
                                    $myresult = mysqli_query($conn, $mysql);
                                    while($myrow = mysqli_fetch_assoc($myresult)){
                                        $pizza_id = $myrow['pizza_id'];
                                        $quantity = $myrow['quantity'];
                                        
                                        $itemsql = "SELECT * FROM `pizza_items` WHERE pizza_id = $pizza_id";
                                        $itemresult = mysqli_query($conn, $itemsql);
                                        $itemrow = mysqli_fetch_assoc($itemresult);
                                        $pizza_Name = $itemrow['pizza_Name'];
                                        $pizza_Price = $itemrow['pizza_Price'];
                                        $pizza_Description = $itemrow['pizza_Description'];
                                        $pizza_res_id = $itemrow['pizza_res_id'];

                                        echo '<tr>
                                                <th scope="row">
                                                    <div class="p-2">
                                                    <img src="/pizza-delivery/img/pizza-'.$pizza_id. '.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <h5 class="mb-0"> '.$pizza_Name. '</h5><span class="text-muted font-weight-normal font-italic d-block">Tk. ' .$pizza_Price. '/-</span>
                                                    </div>
                                                    </div>
                                                </th>
                                                <td class="align-middle text-center"><strong>' .$quantity. '</strong></td>
                                            </tr>';
                                    }
                                ?>
                            </tbody>
                            </table>
                        </div>
                        <!-- End -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php error_reporting(0);
    }
?>