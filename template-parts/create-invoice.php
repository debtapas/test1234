<?php
/*
	Template Name: Create Invoice
*/
  if (!is_user_logged_in()) {
    wp_redirect( home_url('login') );
  }

  global $wpdb;  
  $tableInvoice = $wpdb->prefix . 'invoice';
  $tableReceipt = $wpdb->prefix . 'receipt';
  $tableInvoiceItem = $wpdb->prefix . 'invoice_items';
  $action   = isset($_GET['action'])  ? trim($_GET['action'])   : ""; // exists action
  $editId   = isset($_GET['editId'])  ? intval($_GET['editId']) : ""; // For update
  $delid    = isset($_GET['delid'])   ? intval($_GET['delid'])  : ""; // For delete 

  $last_number = $wpdb->get_var("SELECT invoice_no  FROM $tableInvoice ORDER BY invoice_no DESC LIMIT 1");
  $new_inv_number = $last_number ? $last_number + 1 : 1000;

  //Insert data from Database ~~~~~~~
    if ( isset( $_POST['submit-invoice']) && empty($action) ) {

      $items = $_POST['item'];
      $tax_items = serialize($_POST['invoice_tax']);
      $exist_client_name = $_POST['exist_client_name'];
      $client_name = $_POST['client_name'];

       $invoice_data = array(
          'user_id'          => $_POST['current_user_id'],
          'invoice_no'       => $_POST['invoice_no'],
          'client_name'      => $exist_client_name ? $exist_client_name : $client_name,
          'client_address'   => stripslashes($_POST['client_address']),
          'client_phone'     => $_POST['client_phone'],
          'client_mail'      => $_POST['client_mail'],
          'client_pan'       => $_POST['client_pan'],
          'client_gst'       => $_POST['client_gst'],
          'invoice_type'     => $_POST['package_type'],
          'payment_mode'     => $_POST['payment_mode'],
          'invoice_fin_yr'   => $_POST['fin_yr'],
          'invoice_tax'      => $tax_items,
          'generated_by'     => $_POST['generated_fullname']
        );

      $wpdb->insert( $tableInvoice, $invoice_data );
      $invoice_id = $wpdb->insert_id;

        if ($invoice_id) {
          foreach($items as $item){
            $invoice_item_data = array(
              'invoice_id' => $invoice_id,
              'item_description' => stripslashes($item['item_description']),
              'item_quantity' => $item['item_quantity'],
              'item_rate' => $item['item_rate'],
            );

            $wpdb->insert( $tableInvoiceItem, $invoice_item_data );
            echo "Data has been saved";
            wp_redirect('invoice-list');
          }
        }else{
          echo "Data insert failed";
        }
      }


    //Update data from Database ~~~~~~~
     if ( isset( $_POST['submit-invoice']) && $action=="edit" ){
      $items = $_POST['item'];
      $tax_items = serialize($_POST['invoice_tax']);

      $invoice_data = array(
        'user_id'        => $_POST['current_user_id'],
        'invoice_no'     => $_POST['invoice_no'],
        'client_name'    => $_POST['client_name'],
        'client_address' => stripslashes($_POST['client_address']),
        'client_phone'   => $_POST['client_phone'],
        'client_mail'    => $_POST['client_mail'],
        'client_pan'     => $_POST['client_pan'],
        'client_gst'     => $_POST['client_gst'],
        'invoice_type'   => $_POST['package_type'],
        'payment_mode'   => $_POST['payment_mode'],
        'invoice_fin_yr' => $_POST['fin_yr'],
        'invoice_tax'    => $tax_items,
        'generated_by'   => $_POST['generated_fullname']
      );

      $success = $wpdb->update( $tableInvoice, $invoice_data, array( 'ID'=>$editId ) );

      if( $editId ) {

        $invoice_items = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $tableInvoiceItem WHERE invoice_id=%d", $editId ), ARRAY_A);

        $del_items = array_diff_key($invoice_items, $items);

        if(isset($del_items) && count($del_items)>0){
          foreach($del_items as $del_item){
            $wpdb->delete( $tableInvoiceItem, ['ID'=>$del_item['ID']]);
          }
        }

        foreach($items as $item){
          $invoice_item_data = array(
            'invoice_id' => $editId,
            'item_description' => stripslashes($item['item_description']),
            'item_quantity' => $item['item_quantity'],
            'item_rate' => $item['item_rate'],
          );
          
          if( isset($item['ID']) ) {
            $wpdb->update( $tableInvoiceItem, $invoice_item_data, array( 'ID'=>$item['ID'] ) );
          }else{
            $wpdb->insert( $tableInvoiceItem, $invoice_item_data );
          }
          
          echo "Data has been updated";
          wp_redirect('invoice-list');
        }
      }else{
        echo "Data update failed";
      }
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
                  <?php echo (!empty( $editId )) ? 'Edit' : 'Create'; ?> Invoice</h4>
                </div>
                <div class="col-md-6">
                  <div class="btn-create-invoice py-3 mb-4 float-right">
                    <a href="<?php echo home_url('invoice-list');?>" class="btn rounded-pill btn-primary">Invoice List</a>
                  </div>
                </div>
              </div>

              <!-- Basic Layout -->
              <div class="row justify-content-center">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Invoice Details</h5>
                      <small class="text-muted float-end">Default label</small>
                    </div>
                    <div class="card-body">
                      <?php
                        if( !empty( $editId ) && $action=="edit" ){
                          $editId = $_GET['editId'];
                          $row = $wpdb->prepare( "SELECT * FROM $tableInvoice WHERE ID=%s", $editId );
                          $invoice_details = $wpdb->get_row($row, ARRAY_A);

                          $invoice_items = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $tableInvoiceItem WHERE invoice_id=%d", $invoice_details['ID'] ), ARRAY_A);

                          $disable_input = ( current_user_can('adventure_subscriber') || current_user_can('travel_subscriber') ) ? 'disabled' : '';
                        ?>

                    <form method="post" id="invoiceValid" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" name="current_user_id" value="<?php echo get_current_user_id(); ?>">

                        <div class="row">
                          <div class="mb-3 col-md-3">
                            <label class="form-label" for="basic-default-invoice">Invoice</label>
                            <input type="text" class="form-control" id="basic-default-invoice" name="invoice_no" value="<?php echo $invoice_details['invoice_no']; ?>">
                          </div>

                          <div class="mb-3 col-md-3">
                            <label class="form-label" for="basic-default-date">Date of Invoice</label>
                            <input type="text" <?php echo $disable_input; ?> name="fin_yr" id="basic-default-date" class="form-control" value="<?php echo $invoice_details['invoice_fin_yr']; ?>" />
                          </div>   
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="basic-inv-fullname">Full Name</label>
                            <input type="text" name="client_name" class="form-control" id="basic-inv-fullname" placeholder="Client Name" value="<?php echo $invoice_details['client_name']; ?>" />
                          </div>                                            
                        </div>

                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="basic-default-message">Address</label>
                            <textarea name="client_address" id="basic-default-message" class="form-control" ><?php echo $invoice_details['client_address']; ?></textarea>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="basic-default-email">Email</label>
                            <div class="input-group input-group-merge">
                              <input type="text" name="client_mail" id="basic-default-email" placeholder="Client Mail" class="form-control" value="<?php echo $invoice_details['client_mail']; ?>" aria-describedby="basic-default-email2" />
                              <span class="input-group-text" id="basic-default-email2">@example.com</span>
                            </div>
                            <div class="form-text">You can use letters, numbers & periods</div>
                          </div>    
                        </div>

                        <div class="row">
                          <div class="mb-3 col-md-3">
                            <label class="form-label" for="basic-default-phone">Phone No</label>
                            <input type="text" name="client_phone" id="basic-default-phone" class="form-control phone-mask" placeholder="Client Phone" value="<?php echo $invoice_details['client_phone']; ?>"  />
                          </div> 
                          <div class="mb-3 col-md-3">
                            <label class="form-label" for="client-type">Type of Client</label>
                            <select name="package_type" id="client-type" class="form-control">
                              <option value="individual" <?php selected($invoice_details['invoice_type'], 'individual'); ?> >Individual</option>
                              <option value="company" <?php selected($invoice_details['invoice_type'], 'company'); ?>>Company</option>
                            </select>
                          </div>                         
                          <div class="mb-3 col-md-3">
                            <label class="form-label" for="basic-default-phone">PAN No</label>
                            <input type="text" name="client_pan" id="basic-default-phone" class="form-control" placeholder="PAN No." value="<?php echo $invoice_details['client_pan']; ?>"  />
                          </div>

                          <div class="mb-3 col-md-3 gst-show" style="display:<?php echo ($invoice_details['invoice_type'] == 'individual') ? 'none' : '' ?>" >
                            <label class="form-label" for="basic-default-phone">GST No</label>
                            <input type="text" name="client_gst" id="basic-default-phone" class="form-control" placeholder="GST No." value="<?php echo $invoice_details['client_gst']; ?>" />
                          </div>
                        </div>

                        <div class="row">                           
                          <div class="mb-3 col-md-4">
                            <label class="form-label" for="generated-by-fullname">Generated Person Name</label>
                            <input type="text" name="generated_fullname" class="form-control" id="generated-by-fullname" placeholder="Invoice generated by" value="<?php echo $invoice_details['generated_by']?>" />
                          </div>

                            <?php 
                              if( current_user_can('adventure_admin') || current_user_can('adventure_subscriber') ){?>

                                <div class="mb-3 col-md-2">
                                  <label class="form-label" for="payment-mode">BANK ACCOUNT DETAILS</label>
                                  <select name="payment_mode" id="bank-option" class="form-control">
                                    <option <?php selected($invoice_details['payment_mode'], 'hdfc'); ?> value="hdfc">HDFC Bank</option>
                                  </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                  <div id="hdfcBank" style="display:<?php echo ($invoice_details['payment_mode'] == 'hdfc')?'block':'none'; ?>">
                                    <label class="form-label">HDFC Bank Details</label>
                                    <div class="account-details">
                                        <p><span>Account Name:</span> WANDERVOGEL ADVENTURES</p> 
                                        <p><span>Account Type:</span> Current Account</p> 
                                        <p><span>Bank Name:</span> HDFC Bank</p> 
                                        <p><span>Branch:</span> Ballygunge, Navjivan, 1st Floor, 54/1A Hazra Road, Kolkata-700019, West Bengal, India</p>
                                        <p><span>Account No: </span>05162560001370</p> 
                                        <p><span>RTGS/NEFT/IFSC Code: </span>HDFC0000516</p> 
                                        <p><span>Swift Code: </span>HDFCINBBCAL</p> 
                                    </div>
                                  </div>
                                </div>

                              <?php }else{ ?>

                                <div class="mb-3 col-md-2">
                                  <label class="form-label" for="payment-mode">BANK ACCOUNT DETAILS</label>
                                  <select name="payment_mode" id="bank-option" class="form-control">
                                    <option <?php selected($invoice_details['payment_mode'], 'hdfc'); ?> value="hdfc">HDFC Bank</option>
                                    <option <?php selected($invoice_details['payment_mode'], 'icici'); ?> value="icici">ICICI Bank</option>
                                    <option <?php selected($invoice_details['payment_mode'], 'axis'); ?> value="axis">AXIS Bank</option>
                                  </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                  <div id="hdfcBank" style="display:<?php echo ($invoice_details['payment_mode'] == 'hdfc')?'block':'none'; ?>">
                                    <label class="form-label">HDFC Bank Details</label>
                                    <div class="account-details">
                                        <p><span>Account Name:</span> WANDERVOGEL TOURS AND TRAVELS PVT LTD.</p> 
                                        <p><span>Account Type:</span> Current Account</p> 
                                        <p><span>Bank Name:</span> HDFC Bank</p> 
                                        <p><span>Branch:</span> Ballygunge, Navjivan, 1st Floor, 54/1A Hazra Road, Kolkata-700019, West Bengal, India</p>
                                        <p><span>Account No: </span>50200005928942</p> 
                                        <p><span>RTGS/NEFT/IFSC Code: </span>HDFC0000516</p> 
                                        <p><span>Swift Code: </span>HDFCINBBCAL</p> 
                                    </div>
                                  </div>

                                  <div id="iciciBank" style="display:<?php echo ($invoice_details['payment_mode'] == 'icici')?'block':'none'; ?>">
                                    <label class="form-label">ICICI Bank Details</label>
                                    <div class="account-details">
                                        <p><span>Account Name:</span> WANDERVOGEL TOURS AND TRAVELS PVT LTD.</p> 
                                        <p><span>Account Type:</span> Current Account</p> 
                                        <p><span>Bank Name:</span> ICICI Bank</p> 
                                        <p><span>Branch:</span> Ballygunge, Rishikesh,1/1 Asutosh Chowdhury Avenue, Kolkata-700019</p>
                                        <p><span>Account No: </span>003405012275</p> 
                                        <p><span>RTGS/NEFT/IFSC Code: </span>ICIC0000034</p> 
                                        <p><span>Swift Code: </span>ICICINBBXXX</p> 
                                    </div>
                                  </div>

                                  <div id="axisBank" style="display:<?php echo ($invoice_details['payment_mode'] == 'axis')?'block':'none'; ?>">
                                    <label class="form-label">AXIS Bank Details</label>
                                    <div class="account-details">
                                        <p><span>Account Name:</span> WANDERVOGEL TOURS AND TRAVELS PVT LTD.</p> 
                                        <p><span>Account Type:</span> Current Account</p> 
                                        <p><span>Bank Name:</span> AXIS Bank Ltd.</p> 
                                        <p><span>Branch:</span> Salt Lake, Kolkata (WB), BD-20, Sector I, Salt Lake City, Kolkata-700064</p>
                                        <p><span>Account No: </span>917020058003025</p> 
                                        <p><span>RTGS/NEFT/IFSC Code: </span>UTIB0000025</p> 
                                        <p><span>Swift Code: </span>AXISINBB025</p> 
                                    </div>
                                  </div>
                                </div>

                        <?php } ?>

                        </div>

                         <div class="row">
                          <div class="mb-3">
                            <div class="remove-container" >
                              <p class="form-label">Invoice Details</p>
                              
                    <?php
                    foreach ($invoice_items as $key => $invoice_item) { ?>
                      <div class='element' id='div_<?php echo $invoice_item['ID'];?>'>
                          <div class="row">
                            <input type='hidden' name="item[<?php echo $key;?>][ID]" value="<?php echo $invoice_item['ID'];?>" />

                            <div class="mb-3 col-7">
                              <textarea name="item[<?php echo $key;?>][item_description]" id= "txt_1" class="form-control my-custom-textarea" placeholder="Item Description"><?php echo $invoice_item['item_description'];?></textarea>
                            </div>
                            <div class="mb-3 col">
                              <input type='text' <?php echo $disable_input; ?> name="item[<?php echo $key;?>][item_quantity]" id= "txt_1" class="form-control" placeholder="Quantity" value="<?php echo $invoice_item['item_quantity'];?>"/>
                            </div>
                            <div class="mb-3 col">
                              <input type='text' <?php echo $disable_input; ?> name="item[<?php echo $key;?>][item_rate]" class="form-control" placeholder="Rate" value="<?php echo $invoice_item['item_rate'];?>"/>
                            </div>
                          <div class="mb-3 col">
                            <button type="button" <?php echo $disable_input; ?> class="btn btn-outline-info add">Add</button>
                            <span>&nbsp</span>
                            <button type="button" <?php echo $disable_input; ?> id="<?php echo $invoice_item['ID'];?>" class="btn btn-outline-danger remove">Del</button>
                          </div>
                        </div>
                      </div>
                    <?php } ?>

                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mb-3">
                            <p class="form-label">TAX</p>
                            <?php 
                              $checked_taxes = unserialize($invoice_details['invoice_tax']);
                              
                                $checked_cgst  = in_array('CGST', $checked_taxes)  ? 'checked' : '' ;
                                $checked_sgst  = in_array('SGST', $checked_taxes)  ? 'checked' : '' ;
                                $checked_igst  = in_array('IGST', $checked_taxes)  ? 'checked' : '' ;
                                $checked_20tcs = in_array('20TCS', $checked_taxes) ? 'checked' : '' ;
                                $checked_5tcs  = in_array('5TCS', $checked_taxes)  ? 'checked' : '' ;
                               ?>

                              <div class="form-check form-check-inline">
                              <input class="form-check-input" name="invoice_tax[]" type="checkbox" id="cgst_tax" value="CGST" <?php echo $checked_cgst; ?> />
                              <label class="form-check-label" for="cgst_tax">CGST</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="invoice_tax[]"  type="checkbox" id="sgst_tax" value="SGST"  <?php echo $checked_sgst; ?>/>
                              <label class="form-check-label" for="sgst_tax">SGST</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="invoice_tax[]"  type="checkbox" id="igst_tax" value="IGST" <?php echo $checked_igst; ?> />
                              <label class="form-check-label" for="igst_tax">IGST</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="invoice_tax[]"  type="checkbox" id="tcs_tax20" value="20TCS" <?php echo $checked_20tcs;?> />
                              <label class="form-check-label" for="tcs_tax20">TCS (20%)</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="invoice_tax[]"  type="checkbox" id="tcs_tax5" value="5TCS" <?php echo $checked_5tcs;?> />
                              <label class="form-check-label" for="tcs_tax5">TCS (5%)</label>
                            </div>

                            <?php ?>
                            
                          </div>
                      </div>

                        <button type="submit" name="submit-invoice" class="btn btn-primary">Update</button>

                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal"> Preview </button> -->
                      </form>

                        <?php }else{ ?>

                      <form method="post" id="invoiceValid" action="<?php echo $_SERVER['REQUEST_URI'];?>">
                        <input type="hidden" name="current_user_id" value="<?php echo get_current_user_id(); ?>">

                        <div class="row">
                          <div class="mb-3 col-md-2">
                            <label class="form-label" for="basic-default-invoice-no">Invoice No.</label>
                            <input type="text" name="invoice_no" class="form-control" id="basic-default-invoice-no" value="<?php echo $new_inv_number; ?>" />
                          </div>
                          <div class="mb-3 col-md-2">
                            <label class="form-label" for="basic-default-date">Date of Invoice</label>
                            <input type="text" name="fin_yr" id="basic-default-date" value="" class="form-control" placeholder="Select a date"/>
                          </div>
                          <div class="mb-3 col">
                            <div class="custom-control custom-switch mt-4">
                                <input type="checkbox" class="custom-control-input" id="toggleSwitch">
                                <label class="custom-control-label" for="toggleSwitch">Existing</label>
                            </div>
                          </div>

                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="search-input">Full Name</label>
                            <div id="search-container">
                              <input type="text" name="client_name" class="form-control" id="search-input" placeholder="Ex: John Doe" />
                            </div>

                            <div id="select-container">
                              <select class="invoice-form-data form-control" name="exist_client_name" id="custom-select">
                                <option value=""></option>
                                <?php
                                  $invoice_details = $wpdb->get_results( "SELECT * FROM $tableInvoice", ARRAY_A);
                                  $invoice_details = array_map(function($item){
                                    $item['table'] = 'invoice';
                                    return $item ;
                                  }, $invoice_details) ;

                                  $receipt_details = $wpdb->get_results( "SELECT * FROM $tableReceipt", ARRAY_A);
                                  $receipt_details = array_map(function($item){
                                    $item['table'] = 'receipt';
                                    return $item ;
                                  }, $receipt_details) ;

                                  $all_details = array_merge( $invoice_details, $receipt_details );

                                  foreach ($all_details as $name) { ?>                                    
                                    <option id="<?php echo $name['table'].'_'.$name['ID']; ?>"><?php echo $name['client_name']; ?></option>
                                  <?php } ?>
                              </select>
                            </div>

                          </div>
                        </div>

                        <div class="row">  
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="default-address">Address</label>
                            <textarea name="client_address" id="default-address" class="form-control" placeholder="Hi, Please type client address here." ></textarea>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="default-email">Email</label>
                            <div class="input-group input-group-merge">
                              <input type="text" name="client_mail" id="default-email" class="form-control" placeholder="john.doe" aria-label="john.doe" value="" aria-describedby="default-email2" />
                              <span class="input-group-text" id="default-email2">@example.com</span>
                            </div>
                            <div class="form-text">You can use letters, numbers & periods</div>
                          </div>                                                
                        </div>

                        <div class="row">                                                  
                          <div class="mb-3 col-md-3">
                            <label class="form-label" for="default-phone">Phone No</label>
                            <input type="tel" name="client_phone" id="default-phone" value="" class="form-control phone-mask" placeholder="658 799 8941"  />
                          </div>
                          <div class="mb-3 col-md-3">
                            <label class="form-label" for="client-type">Type of Client</label>
                            <select name="package_type" id="client-type" class="form-control phone-mask">
                              <option value="individual">Individual</option>
                              <option value="company">Company</option>
                            </select>
                          </div>
                          <div class="mb-3 col-md-3">
                            <label class="form-label" for="default-pan">PAN No</label>
                            <input type="text" name="client_pan" value="" id="default-pan" class="form-control phone-mask" placeholder="ABCTY1234D"  />
                          </div>
                          <div class="mb-3 col-md-3 gst-show" style="display:none;">
                            <label class="form-label" for="default-gst">GST No</label>
                            <input type="text" name="client_gst" id="default-gst" class="form-control phone-mask" placeholder="22AAAAA0000A1Z5"  />
                          </div>
                        </div>

                        <div class="row">                          
                         <div class="mb-3 col-md-4">
                            <label class="form-label" for="generated-by-fullname">Generated Person Name</label>
                            <input type="text" name="generated_fullname" class="form-control" id="generated-by-fullname" placeholder="Generated Person Name" value="" />
                          </div>
                        <?php 
                            if( current_user_can('adventure_admin') || current_user_can('adventure_subscriber') ){?>
                              <div class="mb-3 col-md-2">
                                <label class="form-label" for="bank-option">Bank Account Details</label>
                                <select name="payment_mode" id="bank-option" class="form-control phone-mask">
                                  <option id="hdfc" value="hdfc">HDFC Bank</option>
                                </select>
                              </div>

                              <div class="mb-3 col-md-6">                            
                                <div id="hdfcBank">
                                  <label class="form-label">HDFC Bank Details</label>
                                  <div class="account-details">
                                      <p><span>Account Name:</span> WANDERVOGEL ADVENTURES</p> 
                                      <p><span>Account Type:</span> Current Account</p> 
                                      <p><span>Bank Name:</span> HDFC Bank</p> 
                                      <p><span>Branch:</span> Ballygunge, Navjivan, 1st Floor, 54/1A Hazra Road, Kolkata-700019, West Bengal, India</p>
                                      <p><span>Account No: </span>05162560001370</p> 
                                      <p><span>RTGS/NEFT/IFSC Code: </span>HDFC0000516</p> 
                                      <p><span>Swift Code: </span>HDFCINBBCAL</p> 
                                  </div>
                                </div>
                              </div>

                        <?php }else{ ?>

                          <div class="mb-3 col-md-2">
                            <label class="form-label" for="bank-option">Bank Account Details</label>
                            <select name="payment_mode" id="bank-option" class="form-control phone-mask">
                              <option id="hdfc" value="hdfc">HDFC Bank</option>
                              <option id="icici" value="icici">ICICI Bank</option>
                              <option id="axis" value="axis">AXIS Bank</option>
                            </select>
                          </div>

                          <div class="mb-3 col-md-6">                            
                            <div id="hdfcBank">
                              <label class="form-label">HDFC Bank Details</label>
                              <div class="account-details">
                                  <p><span>Account Name:</span> WANDERVOGEL TOURS AND TRAVELS PVT LTD.</p> 
                                  <p><span>Account Type:</span> Current Account</p> 
                                  <p><span>Bank Name:</span> HDFC Bank</p> 
                                  <p><span>Branch:</span> Ballygunge, Navjivan,1st Floor,54/1A Hazra Road, Kolkata-700019</p>
                                  <p><span>Account No: </span>50200005928942</p> 
                                  <p><span>RTGS/NEFT/IFSC Code: </span>HDFC0000516</p> 
                                  <p><span>Swift Code: </span>HDFCINBBCAL</p> 
                              </div>
                            </div>

                            <div id="iciciBank" style="display:none;">
                              <label class="form-label">ICICI Bank Details</label>
                              <div class="account-details">
                                  <p><span>Account Name:</span> WANDERVOGEL TOURS AND TRAVELS PVT LTD.</p> 
                                  <p><span>Account Type:</span> Current Account</p> 
                                  <p><span>Bank Name:</span> ICICI Bank</p> 
                                  <p><span>Branch:</span> Ballygunge, Rishikesh,1/1 Asutosh Chowdhury Avenue, Kolkata-700019</p>
                                  <p><span>Account No: </span>003405012275</p> 
                                  <p><span>RTGS/NEFT/IFSC Code: </span>ICIC0000034</p> 
                                  <p><span>Swift Code: </span>ICICINBBXXX</p> 
                              </div>
                            </div>

                            <div id="axisBank" style="display:none;">
                              <label class="form-label">AXIS Bank Details</label>
                              <div class="account-details">
                                  <p><span>Account Name:</span> WANDERVOGEL TOURS AND TRAVELS PVT LTD.</p> 
                                  <p><span>Account Type:</span> Current Account</p> 
                                  <p><span>Bank Name:</span> AXIS Bank Ltd.</p> 
                                  <p><span>Branch:</span> Salt Lake, Kolkata (WB), BD-20, Sector I, Salt Lake City, Kolkata-700064</p>
                                  <p><span>Account No: </span>917020058003025</p> 
                                  <p><span>RTGS/NEFT/IFSC Code: </span>UTIB0000025</p> 
                                  <p><span>Swift Code: </span>AXISINBB025</p> 
                              </div>
                            </div>
                         </div>

                        <?php } ?>                          
                          
                        </div>

                        <div class="row">
                          <div class="mb-3">
                            <div class="remove-container" >
                              <p class="form-label">Invoice Details</p>
                              <div class='element' id='div_1'>
                                <div class="row">
                                  <div class="mb-3 col-7">
                                    <textarea name="item[0][item_description]" placeholder= "Add Invoice Description" id= "txt_1" class="form-control my-custom-textarea"></textarea>
                                  </div>

                                  <div class="mb-3 col-2">
                                    <input type='text' name="item[0][item_quantity]" placeholder= "Quantity" id= "txt_1" class="form-control"/>
                                  </div>

                                  <div class="mb-3 col-2">
                                    <input type='text' name="item[0][item_rate]" placeholder= "Rate" id= "txt_1" class="form-control item-rate"/>
                                    <span class="error"></span>

                                  </div>

                                <div class="mb-3 col">&nbsp;<button type="button" class="btn btn-outline-info add">Add</button></div>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mb-3">
                            <p class="form-label">TAX</p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="invoice_tax[]" type="checkbox" id="cgst_tax" value="CGST" />
                              <label class="form-check-label" for="cgst_tax">CGST</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="invoice_tax[]"  type="checkbox" id="sgst_tax" value="SGST" />
                              <label class="form-check-label" for="sgst_tax">SGST</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="invoice_tax[]"  type="checkbox" id="igst_tax" value="IGST" />
                              <label class="form-check-label" for="igst_tax">IGST</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="invoice_tax[]"  type="checkbox" id="tcs_tax20" value="20TCS" />
                              <label class="form-check-label" for="tcs_tax20">TCS (20%)</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="invoice_tax[]"  type="checkbox" id="tcs_tax5" value="5TCS" />
                              <label class="form-check-label" for="tcs_tax5">TCS (5%)</label>
                            </div>
                          </div>
                      </div>
                    
                <button type="submit" name="submit-invoice" class="btn btn-primary">Create</button>
                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal"> Preview </button> -->
              </form>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->



      <!-- Extra Large Modal -->
      <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel4">Invoice No.: WTTPLINV/1</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row g-2">
                    <div class="col-5 mb-0">
                       <img class="company-logo" src="<?php echo get_template_directory_uri(). '/assets/img/wandering.png'?>">
                       <h5 class="company-nm">WANDERVOGEL TOURS AND TRAVELS PVT. LTD.</h5>
                       <p class="address">1/2C, Ballygunge Place East, Ballygunge Place, Ballygunge, Kolkata, West Bengal 700019</p>
                       <p class="tel"><span>Ph:</span> 033 24401872 / 24401</p>
                       <p class="mail"><span>Mail:</span> wandervogeltours@gmail.com</p>
                       <p class="gstin"><span>GSTIN:</span> 19AABCW5180F1Z7</p>
                       <p class="pan"><span>PAN No.:</span> AABCW5180F</p>
                    </div>
                    <div class="col-4 mb-0">
                      <p class="bill">BILL TO</p>
                      <h5 class="company-nm">Hallmark Aquaequipment Pvt. Ltd.</h5>
                       <p class="address">208, Rashbehari Avenue, 2nd Floor, Kolkata-700029</p>
                       <p class="tel"><span>Ph:</span> 7898767654</p>
                       <p class="mail"><span>Mail:</span> aquaequipment@gmail.com</p>
                       <p class="gstin"><span>GSTIN:</span> 19GGBCW5765F1Z7</p>
                       <p class="pan"><span>PAN No.:</span> RRGGTW5180W</p>
                    </div>
                    <div class="col mb-0">
                      <p class="inv-no"><span>Invoice No.:</span> WTTPL/INV/345</p>
                      <h5 class="bill-dt"><span>Date:</span> 2023-06-09</h5>
                    </div>
                  </div>
              </div>

              <div class="container">
                  <div class="row">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Sl. No.</th>
                            <th scope="col">ITEM / DESCRIPTION</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col">RATE</th>
                            <th scope="col">AMOUNT</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="invoice_desc">
                            <th scope="row">1</th>
                            <td><strong>Package</strong> Custom Package to Tadoba NP including 01 night stay ata Nagpur, return transfers to Park, 2n3d accomodation ata Moharli and 04 nos exclusive safari in the park</td>
                            <td>1</td>
                            <td class="rate">65642</td>
                            <td class="rate">65642</td>
                          </tr>
                          <tr class="invoice_desc">
                            <th scope="row">2</th>
                            <td><strong>Flight Ticket</strong>CCU-NAG return airfare by ecomony class</td>
                            <td>1</td>
                            <td class="rate">15989</td>
                            <td class="rate">15989</td>
                          </tr>
                          <tr class="invoice_desc">
                            <th scope="row"></th>
                            <td></td>
                            <td width="150px"><strong>Sub Total</strong></td>
                            <td></td>
                            <td class="rate">65642</td>
                          </tr>
                          <tr class="invoice_desc">
                            <th scope="row"></th>
                            <td></td>
                            <td width="150px"><strong>Add: CGST</strong></td>
                            <td class="rate">2.5%</td>
                            <td class="rate">2,040.775</td>
                          </tr>
                          <tr class="invoice_desc">
                            <th scope="row"></th>
                            <td></td>
                            <td width="150px"><strong>Add: SGST</strong></td>
                            <td class="rate">2.5%</td>
                            <td class="rate">2,040.775</td>
                          </tr>
                          <tr class="invoice_desc">
                            <th scope="row"></th>
                            <td></td>
                            <td width="150px"><strong>Total</strong></td>
                            <td></td>
                            <td class="rate">69,724</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <h6><strong>Amount in Words:</strong> Sixtynine Thousand Seven Hundred Twentyfour</h6>
                  </div>
              </div>
              <div class="container">
                <div class="row">
                  <div class="terms mt-3">
                    <h5>Terms & Conditions:</h5>
                    <p><strong>Cash:</strong> t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <p><strong>Cheque:</strong> t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <p><strong>Late Payment:</strong> t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <p><strong>Very lmp:</strong> t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                  </div>
                </div>                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php get_footer(); ?>