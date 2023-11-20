<div class="toggle-menu">
  <a class="menu-slide" href="javascript:void(0);"><i class="bx bx-menu bx-sm"></i></a>
</div>


<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme side-menu">

  <?php 
    if( current_user_can('adventure_admin') || current_user_can('adventure_subscriber') ){?>

      <div class="app-brand demo">
        <img src="<?php echo get_template_directory_uri(). '/assets/img/wa-adventure.jpg'?>">
      </div>

    <?php }else{ ?>

      <div class="app-brand demo">
        <img src="<?php echo get_template_directory_uri(). '/assets/img/wandering.png'?>">
      </div>

    <?php }
  ?>

  <div class="menu-inner-shadow"></div>
  <ul class="menu-inner py-1">           

    <!-- Layouts -->

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="Layouts">Invoice</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="<?php echo site_url('create-invoice') ?>" class="menu-link">
            <div data-i18n="Without menu">Create</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?php echo site_url('invoice-list'); ?>" class="menu-link">
            <div data-i18n="Without navbar">List</div>
          </a>
        </li>
      </ul>
    </li>


    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="Layouts">Receipt</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="<?php echo site_url('create-receipt') ?>" class="menu-link">
            <div data-i18n="Without menu">Create</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?php echo site_url('receipt-list'); ?>" class="menu-link">
            <div data-i18n="Without navbar">List</div>
          </a>
        </li>
      </ul>
    </li>

    <?php
      if (current_user_can('adventure_admin') || current_user_can('travel_admin') || current_user_can('administrator') ){ ?>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-layout"></i>
              <div data-i18n="Layouts">Users</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="<?php echo site_url('/wp-admin/users.php') ?>" class="menu-link">
                  <div data-i18n="Without menu">Edit</div>
                </a>
              </li>
            </ul>
          </li>
    <?php } ?>

  </ul>
</aside>