<?php

/*

	Template Name: Invoice List

*/



  if (!is_user_logged_in()) {

    wp_redirect( home_url('login') );

  }



  global $wpdb;

  $tableInvoice = $wpdb->prefix . 'invoice';

  $action  = isset($_GET['action'])  ? trim($_GET['action'])   : ""; // exists action
  $editId  = isset($_GET['editId'])  ? intval($_GET['editId']) : ""; // For update
  $delId   = isset($_GET['delId'])   ? intval($_GET['delId'])  : ""; // For delete  



    if( !empty( $editId ) && $action=="edit" ){
        wp_redirect("create-invoice/?action=edit&editId=$editId");

      }



    //Delete data from Database ~~~~~~~

    if ( !empty($delId) && $action=="delete" ) {
      $delId  = $_GET['delId'];
      $wpdb->query( "DELETE FROM $tableInvoice WHERE ID='$delId'" );
      wp_redirect("invoice-list");
      exit();
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



            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-4">
                  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> List Invoice</h4>
                </div>

                <div class="col-md-4">
                  <div class="row justify-content-md-center mt-4">
                    <div class="form-group row">
                      <label for="yearFilterInv" class="col-sm-6 col-form-label">Select Financial Yr.:</label>
                      <div class="col-sm-6">
                        <select id="yearFilterInv" class="form-control">
                          <option value="">Show All</option>
                        </select>
                      </div>
                    </div>

                    <!-- <div class="btn-create-invoice py-3 mb-4 float-right">
                      <button onclick="exportDataTableToCSV('data')" class="btn rounded-pill btn-primary">Export CSV</button>
                    </div> -->
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="btn-create-invoice py-3 mb-4 float-right">
                    <a href="<?php echo home_url('create-invoice');?>" class="btn rounded-pill btn-primary">Create Invoice</a>
                  </div>
                </div>

              </div>


              <!-- Basic Layout -->
              <div class="row justify-content-center">
                <div class="col-xl">
                  <div class="mb-4">                    
                    <div class="table-responsive">
                      <table id="invoiceTable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                              <tr>
                                  <th>Sl.</th>
                                  <th>Inv. No.</th>
                                  <th>Name</th>
                                  <th>Address</th>
                                  <th>Phone</th>
                                  <th>Email</th>
                                  <th>Pan No.</th>
                                  <th>GST No.</th>
                                  <th>Type</th>
                                  <th>Date</th>
                                  <?php echo (current_user_can('administrator') ) ? "<th>Users</th>" : ""; ?>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                      <?php

                          global $wpdb;
                          $tableName = $wpdb->prefix . 'invoice';
                          $tableInvoiceItem = $wpdb->prefix . 'invoice_items';
                          $logedinUser = get_current_user_id();

                          if (current_user_can('administrator') ){ 
                            $invoices = $wpdb->get_results(( "SELECT * FROM $tableName"), ARRAY_A);

                          }else{
                            $invoices = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $tableName WHERE user_id=%d", $logedinUser ), ARRAY_A);
                          }

                          foreach( $invoices as $key=>$invoice ){
                            $user_id    = $invoice['user_id'];
                            $invoice_id = $invoice['ID'];
                            $invoice_no = $invoice['invoice_no'];
                            $name       = $invoice['client_name'];
                            $address    = $invoice['client_address'];
                            $phone      = $invoice['client_phone'];
                            $email      = $invoice['client_mail'];
                            $pan_no     = $invoice['client_pan'];
                            $gst_no     = !empty($invoice['client_gst']) ? $invoice['client_gst'] : 'Nil';
                            $type       = $invoice['invoice_type'];
                            $fin_yr     = $invoice['invoice_fin_yr'];
                        ?>

                        <tr>
                          <td><?php echo $key+1;?></td>
                          <td><?php echo $invoice_no;?></td>
                          <td><?php echo $name;?></td>
                          <td><?php echo $address;?></td>
                          <td><?php echo $phone;?></td>
                          <td><?php echo $email;?></td>
                          <td><?php echo $pan_no;?></td>
                          <td><?php echo $gst_no;?></td>
                          <td><?php echo $type;?></td>
                          <td><?php echo $fin_yr;?></td>
                            <?php
                            if (current_user_can('administrator') ){ ?>
                              <td> <?php  echo get_userdata($user_id)->display_name; ?> </td>
                            <?php }?>

                          <td>
  <button type="button" class="dropdown-toggle list-action" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>

  <ul class="dropdown-menu">
    <li><button value="<?php echo $invoice_id; ?>" class="btn dropdown-item btn-inv-modal" ><i class="fa-regular fa-eye"></i> Preview</button>
    <li><a href="?action=edit&editId=<?php echo $invoice_id; ?>"class="btn dropdown-item"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
    <li><a href="?action=delete&delId=<?php echo $invoice_id; ?>" class="btn dropdown-item" onClick="return confirm('Are you sure to want to delete?')"><i class="fa-regular fa-trash-can"></i> Delete</a>
  </ul>

                                    </td>
                                  </tr>
                               <?php } ?>
                      </tbody>

                      <tfoot>
                          <tr>
                              <th>Sl.</th>
                              <th>Inv. No.</th>
                              <th>Name</th>
                              <th>Address</th>
                              <th>Phone</th>
                              <th>Email</th>
                              <th>Pan No.</th>
                              <th>GST No.</th>
                              <th>Type</th>
                              <th>Date</th>
                              <?php echo (current_user_can('administrator') ) ? "<th>Users</th>" : ""; ?>
                              <th>Action</th>
                          </tr>
                      </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

   <!-- Extra Large Modal -->

      <div class="modal" tabindex="-1" id="exLargeModalPrev" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div id="invoice-pdf">
            <div class="modal-header">
              <h5 class="modal-title inv-no">Invoice No.: WTTPL/INV/<span></span></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row g-2">
                    <div class="col-6 mb-0">
                       <img class="company-logo" src="<?php echo get_template_directory_uri(). '/assets/img/wandering.png'?>">
                       <h5 class="wander-nm">WANDERVOGEL TOURS AND TRAVELS PVT. LTD.</h5>
                       <p class="wander-address">1/2C, Ballygunge Place East, Kolkata, West Bengal 700 019</p>
                       <p class="wander-tel"><span>Ph:</span> 033 24401872</p>
                       <p class="wander-mail"><span>Mail:</span> wandervogeltours@gmail.com</p>
                       <p class="wander-gstin"><span>GSTIN:</span> 19AABCW5180F1Z7</p>
                       <p class="wander-pan"><span>PAN No.:</span> AABCW5180F</p>
                    </div>

                    <div class="col-3 mb-0">
                      <p class="bill">BILL TO</p>
                      <h5 class="company-nm"></h5>
                       <p class="address"></p>
                       <p class="tel">Ph: <span></span></p>
                       <p class="mail">Mail: <span></span></p>
                       <p class="gstin">GSTIN: <span></span></p>
                       <p class="pan">PAN No.: <span></span></p>
                    </div>

                    <div class="col mb-0">
                      <p class="inv-no">Invoice No.: WTTPL/INV/<span></span></p>
                      <h5 class="bill-dt">Date: <span></span></h5>
                    </div>
                  </div>
              </div>



              <div class="container">
                  <div class="row">
                    <div class="table-responsive">
                      <table class="table table-striped" id="wander_invoice_items">
                        <thead>
                          <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">ITEM / DESCRIPTION</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col" >RATE</th>
                            <th scope="col" >AMOUNT</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                    <h6 class="amount_in_word"><strong>Amount in Words:</strong> Rupees <span></span> only.</h6>
                  </div>
              </div>

              <div class="container">
                <div class="row">
                  <div class="terms mt-3">
                    <h5>Terms & Conditions:</h5>
                    <p><strong>Cash:</strong> Payment to be made to the cashier & printed official receipt must be obtained.</p>
                    <p><strong>Cheque:</strong> All cheques / demand drafts in payment of bill must be crossed “A/c Payee Only” Cheque: and drawn in favour of Wandervogel Adventures.</p>
                    <p><strong>Late Payment:</strong> Interest @ 24% per annum will be charged on all outstanding bills after due date.</p>
                    <p><strong>Very lmp:</strong> It is computer generated invoice signature not mandatory. Subject to Kolkata jurisdiction only.</p>
                  </div>                  
                  <h5 class="mt-3">Bank Details</h5>
                  <div class="payment-option-display"></div>
                  <div class="invoice-generated-by mt-4">
                    <p class="float-right">Invoice Generated by: <span></span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>

            <div class="modal-footer">
              <!-- <div class="mail-fld form-inline">
                  <div class="form-group mx-sm-3">
                    <p class="mail-send-inv-msg"></p>
                    <input type="mail" class="form-control mailtoinvoice" placeholder="Type your mail id">
                  </div>
                  <button type="submit" id="btn-send-mail-invoice" class="btn btn-primary">Mail</button>
              </div> -->
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" id="btn-genarate-pdf-invoice" class="btn btn-primary">Generate PDF</button>
            </div>
          </div>
        </div>
      </div>



  <?php get_footer(); ?>