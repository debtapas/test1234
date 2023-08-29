<?php

/*

	Template Name: Create receipt

*/

  if (!is_user_logged_in()) {

    wp_redirect( home_url('login') );

  }



  global $wpdb;  

  $receipt_table = $wpdb->prefix . 'receipt';

  $action   = isset($_GET['action'])  ? trim($_GET['action'])   : ""; // exists action
  $editId   = isset($_GET['editId'])  ? intval($_GET['editId']) : ""; // For update
  $delid    = isset($_GET['delid'])   ? intval($_GET['delid'])  : ""; // For delete 

  $last_number = $wpdb->get_var("SELECT receipt_no  FROM $receipt_table ORDER BY receipt_no DESC LIMIT 1");
  $new_recpt_number = $last_number ? $last_number + 1 : 1000;
  //dd($new_recpt_number);

  //Insert data from Database ~~~~~~~
  if ( isset( $_POST['submit-receipt']) && empty($action) ) {

    $receipt_data = array(
      'user_id'          => $_POST['current_user_id'],
      'receipt_no'       => $_POST['receipt_no'],
      'client_name'      => $_POST['client_name'],
      'receipt_address'  => $_POST['client_address'],
      'receipt_phone'    => $_POST['client_phone'],
      'receipt_date'     => $_POST['receipt_date'],
      'amount'           => $_POST['amount'],
      'payment_mode'     => $_POST['payment_mode'],
      'transaction_date' => $_POST['transaction_date'],
      'cheque_no'        => $_POST['cheque_no'],
      'cheque_issued_br' => $_POST['issued_br_name'],
      'neft_trans_id'    => $_POST['trans_id'],
      'neft_trans_br'    => $_POST['trans_bank'],
      'card_no'          => $_POST['card_no'],
      'card_name'        => $_POST['card_name'],
      'swipt_on'         => $_POST['swipt_on'],
      'card_type'        => $_POST['card_type'],
      'package_booking'  => $_POST['package_booking'],
      'package_details'  => $_POST['package_details'],
      'generated_by'    => $_POST['generated_name_receipt']
    );

    $wpdb->insert( $receipt_table, $receipt_data );
      
    wp_redirect("receipt-list");
    }


    //Update data from Database ~~~~~~~
    if ( isset( $_POST['submit-receipt']) && $action=="edit" ){

      $receipt_data = array(
        'user_id'          => $_POST['current_user_id'],
        'receipt_no'       => $_POST['receipt_no'],
        'client_name'      => $_POST['client_name'],
        'receipt_address'  => $_POST['client_address'],
        'receipt_phone'    => $_POST['client_phone'],
        'receipt_date'     => $_POST['receipt_date'],
        'amount'           => $_POST['amount'],
        'payment_mode'     => $_POST['payment_mode'],
        'transaction_date' => $_POST['transaction_date'],
        'cheque_no'        => $_POST['cheque_no'],
        'cheque_issued_br' => $_POST['issued_br_name'],
        'neft_trans_id'    => $_POST['trans_id'],
        'neft_trans_br'    => $_POST['trans_bank'],
        'card_no'          => $_POST['card_no'],
        'card_name'        => $_POST['card_name'],
        'swipt_on'         => $_POST['swipt_on'],
        'card_type'        => $_POST['card_type'],
        'package_booking'  => $_POST['package_booking'],
        'package_details'  => $_POST['package_details'],
        'generated_by'     => $_POST['generated_name_receipt']
      );

      $success = $wpdb->update( $receipt_table, $receipt_data, array( 'ID'=>$editId ) );
      wp_redirect("receipt-list");
    }

  get_header();

?>


    <!-- Layout wrapper -->

    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <!-- Menu -->
        <?php include( get_template_directory() . '/template-parts/parts/side-menu.php'); ?>       

        <!-- / Menu -->



        <!-- Layout container -->
        <div class="layout-page">       

        <!--  Navbar -->

        <?php include( get_template_directory() . '/template-parts/parts/dashboard-nav.php'); ?>

        <!-- / Navbar -->

        	

          <!-- Content wrapper -->

          <div class="content-wrapper">

            <!-- Content -->



            <div class="container flex-grow-1 container-p-y">

              <div class="row">
                <div class="col-md-6">
                  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span>
                  <?php echo (!empty( $editId )) ? 'Edit' : 'Create'; ?> Money Receipt</h4>
                </div>

                <div class="col-md-6">
                  <div class="btn-create-invoice py-3 mb-4 float-right">
                    <a href="<?php echo home_url('receipt-list');?>" class="btn rounded-pill btn-primary">Money Receipt List</a>
                  </div>
                </div>
              </div>

              <!-- Basic Layout -->
              <div class="row justify-content-center">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header mb-2 d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Receipt Details</h5>
                      <small class="text-muted float-end">Default label</small>
                    </div>
                    <div class="card-body">
        <?php

          if( !empty( $editId ) && $action=="edit" ){
            $editId = $_GET['editId'];
            $row = $wpdb->prepare( "SELECT * FROM $receipt_table WHERE ID=%s", $editId );
            $receipt_details = $wpdb->get_row($row, ARRAY_A);
          ?>

            <form method="post" id="receiptValid" action="<?php echo $_SERVER['REQUEST_URI'];?>">
                <input type="hidden" name="current_user_id" value="<?php echo get_current_user_id(); ?>">
                <div class="row">
                  <div class="mb-3 col-md-3">
                    <label class="form-label" for="basic-default-invoice-no">Receipt No.</label>
                    <input type="text" name="receipt_no" class="form-control" id="basic-default-invoice-no" value="<?php echo $receipt_details['receipt_no']; ?>" />
                  </div>

                  <div class="mb-3 col-md-3">
                    <label class="form-label" for="dt-receipt">Date of Receipt</label>
                    <input type="text" name="receipt_date" id="dt-receipt" class="form-control" value="<?php echo $receipt_details['receipt_date']; ?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="client-name">Client Name</label>
                    <input type="text" name="client_name" class="form-control" id="client-name" placeholder="Ex: John Doe" value="<?php echo $receipt_details['client_name']; ?>" />
                  </div>
                </div>

                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="default-address">Address</label>
                    <textarea name="client_address" id="default-address" class="form-control" placeholder="Hi, Please type client address here." ><?php echo $receipt_details['receipt_address']; ?></textarea>
                  </div>                  
                  <div class="mb-3 col-md-3">
                    <label class="form-label" for="default-phone">Phone No</label>
                    <input type="text" name="client_phone" id="default-phone" class="form-control phone-mask" placeholder="658 799 8941" value="<?php echo $receipt_details['receipt_phone']; ?>"  />
                  </div>
                  <div class="mb-3 col-md-3">
                    <label class="form-label" for="client-amount">Amount</label>
                    <input type="text" name="amount" id="client-amount" class="form-control phone-mask" value="<?php echo $receipt_details['amount']; ?>"  />
                  </div>
                </div>

                <div class="row">
                  <div class="mb-3 col-md-2">
                    <label class="form-label" for="payment-mode">Mode of Payment</label>
                    <select name="payment_mode" id="receipt-payment-mode" class="form-control">
                      <option id="receipt-cash" <?php selected( $receipt_details['payment_mode'], 'cash' ); ?> value="cash">Cash</option>
                      <option id="receipt-cheuqe" <?php selected( $receipt_details['payment_mode'], 'cheque' ); ?> value="cheque">Cheque</option>
                      <option id="receipt-neft" <?php selected( $receipt_details['payment_mode'], 'neft' ); ?> value="neft">NEFT/Transaction</option>
                      <option id="receipt-card" <?php selected( $receipt_details['payment_mode'], 'card' ); ?> value="card">C.Card/D.Card</option>
                    </select>
                  </div>

                  <div class="col-md-2">
                    <label class="form-label" for="dt-trans-bank">Transaction Date</label>
                    <input type="text" name="transaction_date" id="dt-trans-bank" class="form-control" placeholder="Transfer Date" value="<?php echo $receipt_details['transaction_date']; ?>" />
                  </div>
                  <div class="mb-3 col-md-8">
                    <div id="receipt-cheque-fld" style="display:<?php echo ($receipt_details['payment_mode'] == 'cheque') ? 'block;' : 'none';?>">
                      <label class="form-label">Cheque Details</label>
                      <div class="row">
                        <div class="col">
                          <input type="text" name="cheque_no" class="form-control" placeholder="Cheque no." value="<?php echo $receipt_details['cheque_no']; ?>" />
                        </div>
                        <div class="col">
                          <input type="text" name="issued_br_name" class="form-control" placeholder="Issued Bank Name" value="<?php echo $receipt_details['cheque_issued_br']; ?>" />
                        </div>
                      </div>                           
                    </div>

                    <div id="receipt-transaction-fld" style="display:<?php echo ($receipt_details['payment_mode'] == 'neft') ? 'block' : 'none';?>">
                      <label class="form-label">Transaction Details</label>
                      <div class="row">
                        <div class="col">
                          <input type="text" name="trans_id" class="form-control" placeholder="Transaction ID" value="<?php echo $receipt_details['neft_trans_id']; ?>" />
                        </div>
                        <div class="col-md-6">
                          <textarea row="3" name="trans_bank" class="form-control" placeholder="Transaction from Bank" ><?php echo $receipt_details['neft_trans_br']; ?></textarea>
                        </div>
                      </div>
                    </div>

                    <div id="receipt-card-fld" style="display:<?php echo ($receipt_details['payment_mode'] == 'card') ? 'block;' : 'none';?>">
                      <label class="form-label">Card Details</label>
                      <div class="row">
                        <div class="col">
                          <input type="number" name="card_no" class="form-control" placeholder="Last four digit no" value="<?php echo $receipt_details['card_no']; ?>" />
                        </div>
                        <div class="col-md-3">
                          <input type="text" name="card_name" class="form-control" placeholder="Transaction Card Name" value="<?php echo $receipt_details['card_name']; ?>" />
                        </div>
                        <div class="col">
                          <input type="text" name="swipt_on" class="form-control" placeholder="Swipt on" value="<?php echo $receipt_details['swipt_on']; ?>" />
                        </div>
                        <div class="col">
                          <input type="text" name="card_type" class="form-control" placeholder="Card type" value="<?php echo $receipt_details['card_type']; ?>" />
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

              <div class="row">
                <div class="mb-3 col-md-2">
                  <label class="form-label" for="package-booking">Package</label>
                  <select name="package_booking" id="package-booking" class="form-control">
                    <option <?php selected( $receipt_details['package_booking'], 'Hotel-booking'); ?> value="Hotel-booking">Hotel booking</option>
                    <option <?php selected( $receipt_details['package_booking'], 'package'); ?> value="package">Package</option>
                    <option <?php selected( $receipt_details['package_booking'], 'transportation'); ?> value="transportation">Transportation</option>
                    <option <?php selected( $receipt_details['package_booking'], 'Air-ticket'); ?> value="Air-ticket">Air ticket</option>
                  </select>
                </div>
                <div class="mb-3 col">
                  <label class="form-label" for="service-details">Package Details</label>
                  <textarea name="package_details" id="service-details" class="form-control" placeholder="Hi, Type here service details." ><?php echo $receipt_details['package_details']; ?></textarea>
                </div>
                <div class="mb-3 col-md-3">
                  <label class="form-label" for="generated-by-receipt">Generated Person Name</label>
                  <input type="text" name="generated_name_receipt" class="form-control" id="generated-by-receipt" placeholder="Generated Person Name" value="<?php echo $receipt_details['generated_by']; ?>" />
                </div> 
              </div>

              <button type="submit" name="submit-receipt" class="btn btn-primary">Update</button>

            </form>

              <?php }else{ ?>

                <form method="post" id="receiptValid" action="<?php echo $_SERVER['REQUEST_URI'];?>">
                    <input type="hidden" name="current_user_id" value="<?php echo get_current_user_id(); ?>">
                    <div class="row">
                      <div class="mb-3 col-md-3">
                        <label class="form-label" for="basic-default-invoice-no">Receipt No.</label>
                        <input type="text" name="receipt_no" class="form-control" id="basic-default-invoice-no" value="<?php echo $new_recpt_number; ?>" />
                      </div>
                      <div class="mb-3 col-md-3">
                        <label class="form-label" for="dt-receipt">Date of Receipt</label>
                        <input type="text" name="receipt_date" id="dt-receipt" class="form-control" placeholder="Select a date"/>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="client-name">Client Name</label>
                        <input type="text" name="client_name" class="form-control" id="client-name" placeholder="Ex: John Doe" />
                      </div>
                    </div>

                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="default-address">Address</label>
                        <textarea name="client_address" id="default-address" class="form-control" placeholder="Hi, Please type client address here." ></textarea>
                      </div>
                      <div class="mb-3 col-md-3">
                        <label class="form-label" for="default-phone">Phone No</label>
                        <input type="text" name="client_phone" id="default-phone" class="form-control phone-mask" placeholder="658 799 8941"  />
                      </div>
                      <div class="mb-3 col-md-3">
                        <label class="form-label" for="client-amount">Amount</label>
                        <input type="text" name="amount" id="client-amount" class="form-control phone-mask" placeholder="18547"  />
                      </div> 
                    </div>

                    <div class="row">
                      <div class="mb-3 col-md-2">
                        <label class="form-label" for="payment-mode">Mode of Payment</label>
                        <select name="payment_mode" id="receipt-payment-mode" class="form-control">
                          <option id="receipt-cash" value="cash">Cash</option>
                          <option id="receipt-cheuqe" value="cheque">Cheque</option>
                          <option id="receipt-neft" value="neft">NEFT/Transaction</option>
                          <option id="receipt-card" value="card">C.Card/D.Card</option>
                        </select>
                      </div>                                           
                    <div class="col-md-2">
                      <label class="form-label" for="dt-trans-bank">Transaction Date</label>
                      <input type="date" name="transaction_date" id="dt-trans-bank" class="form-control" placeholder="Transfer Date"/>
                    </div>
                      <div class="mb-3 col-md-8"> 
                        <div id="receipt-cheque-fld" style="display:none;">
                          <label class="form-label">Cheque Details</label>
                          <div class="row">
                            <div class="col">
                              <input type="text" name="cheque_no" id="" class="form-control" placeholder="Cheque no."  />
                            </div>
                            <div class="col">
                              <input type="text" name="issued_br_name" id="" class="form-control" placeholder="Issued Bank Name"  />
                            </div>
                          </div>                           
                        </div>

                        <div id="receipt-transaction-fld" style="display:none;">
                          <label class="form-label">Transaction Details</label>
                          <div class="row">
                            <div class="col">
                              <input type="text" name="trans_id" id="" class="form-control" placeholder="Transaction ID"  />
                            </div>
                            <div class="col-md-6">
                              <textarea row="3" name="trans_bank" id="" class="form-control" placeholder="Transaction from Bank" ></textarea>
                            </div>
                          </div>
                        </div>

                        <div id="receipt-card-fld" style="display:none;">
                          <label class="form-label">Card Details</label>
                          <div class="row">
                            <div class="col">
                              <input type="number" name="card_no" class="form-control" placeholder="Last four digit no"  />
                            </div>
                            <div class="col-md-3">
                              <input type="text" name="card_name" class="form-control" placeholder="Transaction Card Name"  />
                            </div>
                            <div class="col">
                              <input type="text" name="swipt_on" class="form-control" placeholder="Swipt on"  />
                            </div>
                            <div class="col">
                              <input type="text" name="card_type" class="form-control" placeholder="Card type"  />
                            </div>
                          </div>
                        </div>
                     </div>
                  </div>

                    <div class="row">
                      <div class="mb-3 col-md-2">
                        <label class="form-label" for="package-booking">Package</label>
                        <select name="package_booking" id="package-booking" class="form-control">
                          <option value="Hotel-booking">Hotel booking</option>
                          <option value="package">Package</option>
                          <option value="transportation">Transportation</option>
                          <option value="Air-ticket">Air ticket</option>
                        </select>
                      </div>
                      <div class="mb-3 col">
                        <label class="form-label" for="service-details">Package Details</label>
                        <textarea name="package_details" id="service-details" class="form-control" placeholder="Hi, Type here service details." ></textarea>
                      </div>
                        <div class="mb-3 col-md-3">
                          <label class="form-label" for="generated-by-receipt">Generated Person Name</label>
                          <input type="text" name="generated_name_receipt" class="form-control" id="generated-by-receipt" placeholder="Generated Person Name" value="" />
                        </div> 
                    </div>

              <button type="submit" name="submit-receipt" class="btn btn-primary">Create</button>
          </form>

    <?php }?>   

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->
</div>

<?php get_footer(); ?>