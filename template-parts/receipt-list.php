<?php

/*

	Template Name: Receipt List

*/



  if (!is_user_logged_in()) {

    wp_redirect( home_url('login') );

  }



  global $wpdb;

  $receipt_table = $wpdb->prefix . 'receipt';

  $action  = isset($_GET['action'])  ? trim($_GET['action'])   : ""; // exists action
  $editId  = isset($_GET['editId'])  ? intval($_GET['editId']) : ""; // For update
  $delId   = isset($_GET['delId'])   ? intval($_GET['delId'])  : ""; // For delete  

    if( !empty( $editId ) && $action=="edit" ){
        wp_redirect("create-receipt/?action=edit&editId=$editId");
      }

    //Delete data from Database ~~~~~~~

    if ( !empty($delId) && $action=="delete" ) {
      $delId  = $_GET['delId'];
      $wpdb->query( "DELETE FROM $receipt_table WHERE ID='$delId'" );
      wp_redirect("receipt-list");
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
                  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> List Money Receipt</h4>
                </div>

                <div class="col-md-4">
                  <div class="row justify-content-md-center mt-4">
                    <div class="form-group row">
                      <label for="receiptYearFilter" class="col-sm-6 col-form-label">Select Financial Yr.:</label>
                      <div class="col-sm-6">
                        <select id="receiptYearFilter" class="form-control">
                          <option value="">Show All</option>
                        </select>
                      </div>
                    </div>
                    <!-- <div class="btn-create-invoice py-3 mb-4 float-right">
                    <button onclick="exportDataTableToCSVReceipt('data')" class="btn rounded-pill btn-primary">Export CSV</button>
                  </div> -->
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="btn-create-invoice py-3 mb-4 mr-2 float-right">
                    <a href="<?php echo home_url('create-receipt');?>" class="btn rounded-pill btn-primary">Create Receipt</a>
                  </div>
                </div>
              </div>



              <!-- Basic Layout -->

              <div class="row justify-content-center">
                <div class="col-xl">
                  <div class="mb-4">
                    <div class="table-responsive">
                      <table id="receiptTable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                              <tr>
                                  <th>Sl.</th>
                                  <th>Receipt No.</th>
                                  <th>Name</th>
                                  <th>Receipt Date</th>
                                  <th>Amount</th>
                                  <th>Payment Mode</th>
                                  <th>Transaction Date</th>
                                  <th>Packages</th>
                                  <?php echo ( current_user_can('administrator') || current_user_can('adventure_admin') || current_user_can('travel_admin') ) ? "<th>Users</th>" : ""; ?>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                    <?php
                        $logedinUser = get_current_user_id();

                        if ( current_user_can('administrator') ){
                          $receipts = $wpdb->get_results(( "SELECT * FROM $receipt_table"), ARRAY_A);

                        }elseif( current_user_can('adventure_admin') ){
                          $adventure_admin_users = get_users(array(
                                'role' => 'adventure_subscriber',
                                'fields' => 'ID'
                            ));

                          $implode_users = implode(', ', $adventure_admin_users);
                          $implode_users .= ', ' . $logedinUser;
                          $receipts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $receipt_table WHERE user_id IN ($implode_users)" ), ARRAY_A);

                        }elseif ( current_user_can('travel_admin') ) {

                            $travel_admin_users = get_users(array(
                                'role' => 'travel_subscriber',
                                'fields' => 'ID'
                            ));

                          $implode_users = implode(', ', $travel_admin_users);
                          $implode_users .= ', ' . $logedinUser;

                          $receipts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $receipt_table WHERE user_id IN ($implode_users)" ), ARRAY_A);

                          }else{

                          $receipts = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $receipt_table WHERE user_id=%d", $logedinUser ), ARRAY_A);
                        }                         

                        foreach( $receipts as $key=>$receipt ){
                          $user_id          = $receipt['user_id'];
                          $receipt_id       = $receipt['ID'];
                          $receipt_no       = $receipt['receipt_no'];
                          $receipt_date     = $receipt['receipt_date'];
                          $name             = $receipt['client_name'];
                          $amount           = $receipt['amount'];
                          $payment_mode     = $receipt['payment_mode'];
                          $transaction_date = $receipt['transaction_date'];
                          $packages         = $receipt['package_booking'];
                      ?>

                        <tr>
                          <td><?php echo $key+1;?></td>
                          <td><?php echo $receipt_no;?></td>
                          <td><?php echo $name;?></td>
                          <td><?php echo $receipt_date;?></td>
                          <td><?php echo $amount;?></td>
                          <td class="pay-mode"><?php echo $payment_mode;?></td>
                          <td><?php echo $transaction_date;?></td>
                          <td><?php echo $packages;?></td>
                      <?php
                      if ( current_user_can('administrator') || current_user_can('adventure_admin') || current_user_can('travel_admin') ){ ?>
                        <td> <?php echo get_userdata($user_id)->display_name; ?> </td>
                      <?php }?>

                        <td>

  <button type="button" class="dropdown-toggle list-action" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>

  <ul class="dropdown-menu">
    <li><button value="<?php echo $receipt_id; ?>" class="btn dropdown-item btn-receipt-modal" ><i class="fa-regular fa-eye"></i> Preview</button></li>
    <li><a href="?action=edit&editId=<?php echo $receipt_id; ?>"class="btn dropdown-item"><i class="fa-regular fa-pen-to-square"></i> Edit</a></li>

    <?php
        if ( current_user_can('administrator') || current_user_can('adventure_admin') || current_user_can('travel_admin') ){ ?>          
          <li><a href="?action=delete&delId=<?php echo $receipt_id; ?>" class="btn dropdown-item" onClick="return confirm('Are you sure to want to delete?')"><i class="fa-regular fa-trash-can"></i> Delete</a></li>
    <?php } ?>

  </ul>

                                    </td>
                                  </tr>
                               <?php } ?>

                          </tbody>
                          <tfoot>
                              <tr>
                                  <th>Sl.</th>
                                  <th>Receipt No.</th>
                                  <th>Name</th>
                                  <th>Receipt Date</th>
                                  <th>Amount</th>
                                  <th>Payment Mode</th>
                                  <th>Transaction Date</th>
                                  <th>Packages</th>
                                  <?php echo ( current_user_can('administrator') || current_user_can('adventure_admin') || current_user_can('travel_admin') ) ? "<th>Users</th>" : ""; ?>
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

      <div class="modal" tabindex="-1" id="receiptModalPrev" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div id="receipt-pdf">
              <style type="text/css">
                .inv-container{
                  width: 100%;
                }
                .col-receipt, .col-dt{
                  width: 30%;
                  float: left;
                }
                .col-logo{
                  width: 40%;
                  float: left;
                }
                .receipt-dt{
                  float: right;
                }
                p.receipt-body{
                  line-height: 32px;
                }
                h5.wander-nm {
                  font-family: 'Oswald', sans-serif;
                  font-size: 25px;
                  font-weight: 400;
                }
                .company-details p{
                  text-align: center;
                  font-weight: bold;
                }
                /*.col-details{
                  width: 65%;
                  float: left;
                }*/
                .col-amount{
                  width: 55%;
                  float: left;
                }
                .col-amount p{
                  margin-bottom: 3px;
                }
              </style>

              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

            <div class="modal-body">
              <div class="inv-container">
                <div style="display: -ms-flexbox; display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap;">
                  <div style="width: 30%; float: left;">
                    <p class="receipt-no">Receipt No.: <?php echo ( current_user_can('adventure_admin') || current_user_can('adventure_subscriber') ) ? "WA" : "WTTPL"; ?>/MR/<span></span></p>
                  </div>
                  <?php 
                      if( current_user_can('adventure_admin') || current_user_can('adventure_subscriber') ){?>

                        <div style="width: 40%; float: left;">
                          <img class="receipt-company-logo" src="<?php echo get_template_directory_uri(). '/assets/img/wa-adventure-invoice.jpg'?>">
                        </div>

                      <?php }else{ ?>

                        <div style="width: 40%; float: left;">
                          <img class="receipt-company-logo" src="<?php echo get_template_directory_uri(). '/assets/img/wandering.png'?>">
                        </div>

                      <?php } ?>
                  
                  <div style="width: 30%; float: left;">
                    <p class="receipt-dt">Date: <span></span></p>
                  </div>
                </div>                

                <?php 
                    if( current_user_can('adventure_admin') || current_user_can('adventure_subscriber') ){?>

                  <div class="row justify-content-center">
                    <div class="company-details col-md-7 mb-0">                      
                       <h5 class="wander-nm">Wandervogel Adventure</h5>
                       <p class="wander-address">1/2C Ballygunge Place East, Kolkata, West Bengal 700019</p>
                       <p class="wander-tel"><span>Ph:</span> 033 24401872</p>
                       <p class="wander-mail"><span>Mail:</span> indianwildtours@gmail.com</p>
                       <p class="wander-gstin"><span>GSTIN:</span> 19AAAFW5966H1ZO</p>
                       <p class="wander-pan"><span>PAN No.:</span> AAAFW5966H</p>
                    </div>
                  </div>

                    <?php }else{ ?>

                  <div class="row justify-content-center">
                    <div class="company-details col-md-7 mb-0">                      
                       <h5 class="wander-nm">Wandervogel Tours and Travels Pvt. Ltd</h5>
                       <p class="wander-address">1/2C Ballygunge Place East, Kolkata, West Bengal 700019</p>
                       <p class="wander-tel"><span>Ph:</span> 033 24401872</p>
                       <p class="wander-mail"><span>Mail:</span> wandervogeltours@gmail.com</p>
                       <p class="wander-gstin"><span>GSTIN:</span> 19AABCW5180F1Z7</p>
                       <p class="wander-pan"><span>PAN No.:</span> AABCW5180F</p>
                    </div>
                  </div>
                      <?php } ?>
              </div>

              <div class="container">
                <div class="row">
                  <div class="col-details">
                    <h4>Money Receipt</h4>
                    <p class="receipt-body"></p>
                  </div>
                </div> 

                <div class="row">
                  <div class="col-amount">
                    <h5>Rs. <span class="receipt-amount"></span>/-</h5>
                    <p>*Cheques are subject to realisation.</p>
                    <p>*This is system generated receipt. Does not require a signature.</p>
                  </div>

                  <?php
                      $co_name = ( current_user_can('adventure_admin') || current_user_can('adventure_subscriber') ) ? 'Wandervogel Adventure' : 'Wandervogel Tours and Travels Pvt. Ltd.';
                    ?>

                  <div class="receipt-generater">
                    <p>Money Receipt Generated by: <span></span></p>                    
                  </div>
                  <p class="com-name">For <span><?php echo $co_name;?></span></p>
                </div>
              </div>

                <div class="clone-receipt" style="display: none; margin-top: 25px;">
                  <div class="inv-container">
                    <div style="display: -ms-flexbox; display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap;">
                      <div style="width: 30%; float: left;">
                        <p class="receipt-no">Receipt No.: WTTPL/MR/<span></span></p>
                      </div>
                      <?php 
                          if( current_user_can('adventure_admin') || current_user_can('adventure_subscriber') ){?>

                            <div style="width: 40%; float: left;">
                              <img class="receipt-company-logo" src="<?php echo get_template_directory_uri(). '/assets/img/wa-adventure-invoice.jpg'?>">
                            </div>

                          <?php }else{ ?>

                            <div style="width: 40%; float: left;">
                              <img class="receipt-company-logo" src="<?php echo get_template_directory_uri(). '/assets/img/wandering.png'?>">
                            </div>

                          <?php } ?>
                      
                      <div style="width: 30%; float: left;">
                        <p class="receipt-dt">Date: <span></span></p>
                      </div>
                    </div>                

                    <?php 
                        if( current_user_can('adventure_admin') || current_user_can('adventure_subscriber') ){?>

                      <div class="row justify-content-center">
                        <div class="company-details col-md-7 mb-0">                      
                           <h5 class="wander-nm">Wandervogel Adventure</h5>
                           <p class="wander-address">1/2C Ballygunge Place East, Kolkata, West Bengal 700019</p>
                           <p class="wander-tel"><span>Ph:</span> 033 24401872</p>
                           <p class="wander-mail"><span>Mail:</span> indianwildtours@gmail.com</p>
                           <p class="wander-gstin"><span>GSTIN:</span> 19AAAFW5966H1ZO</p>
                           <p class="wander-pan"><span>PAN No.:</span> AAAFW5966H</p>
                        </div>
                      </div>

                        <?php }else{ ?>

                      <div class="row justify-content-center">
                        <div class="company-details col-md-7 mb-0">                      
                           <h5 class="wander-nm">Wandervogel Tours and Travels Pvt. Ltd</h5>
                           <p class="wander-address">1/2C Ballygunge Place East, Kolkata, West Bengal 700019</p>
                           <p class="wander-tel"><span>Ph:</span> 033 24401872</p>
                           <p class="wander-mail"><span>Mail:</span> wandervogeltours@gmail.com</p>
                           <p class="wander-gstin"><span>GSTIN:</span> 19AABCW5180F1Z7</p>
                           <p class="wander-pan"><span>PAN No.:</span> AABCW5180F</p>
                        </div>
                      </div>
                          <?php } ?>
                  </div>

                  <div class="container">
                    <div class="row">
                      <div class="col-details">
                        <h4>Money Receipt</h4>
                        <p class="receipt-body"></p>
                      </div>
                    </div> 

                    <div class="row">
                      <div class="col-amount">
                        <h5>Rs. <span class="receipt-amount"></span>/-</h5>
                        <p>*Cheques are subject to realisation.</p>
                        <p>*This is system generated receipt. Does not require a signature.</p>
                      </div>

                      <?php
                          $co_name = ( current_user_can('adventure_admin') || current_user_can('adventure_subscriber') ) ? 'Wandervogel Adventure' : 'Wandervogel Tours and Travels Pvt. Ltd.';
                        ?>

                      <div class="receipt-generater">
                        <p>Money Receipt Generated by: <span></span></p>                    
                      </div>
                      <p class="com-name">For <span><?php echo $co_name;?></span></p>
                    </div>
                  </div>

                </div>
            </div>            
          </div>

            <div class="modal-footer">
              <!-- <div class="mail-fld form-inline">
                  <div class="form-group mx-sm-3">
                    <p class="mail-send-msg"></p>
                    <input type="mail" class="form-control mailto" placeholder="Type your mail id">
                  </div>
                  <button type="submit" id="btn-send-mail-receipt" class="btn btn-primary">Mail</button>
              </div> -->
              <button type="button" class="btn btn-outline-secondary" id="receipt-clone">Duplicate</button>
              <button type="button" id="btn-genarate-pdf-receipt" class="btn btn-primary">Generate PDF</button>
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

  <?php get_footer(); ?>