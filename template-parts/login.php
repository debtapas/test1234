<?php

 /* 

    Template Name: Login 

 */ 

   // $dash_url = home_url('dashboard');



   if( is_user_logged_in() ){

    // echo "<script>window.location.href='dashboard'</script>";

    header( 'Location:' . home_url('create-invoice') );



   }

    

   get_header();



 ?>

    <!-- Content -->



    <div class="container-xxl">

      <div class="authentication-wrapper authentication-basic container-p-y">

        <div class="authentication-inner">

          <!-- Register -->

          <div class="card">

            <div class="card-body">

              <!-- Logo -->

              <div class="app-brand justify-content-center">

                <a href="index.html" class="app-brand-link gap-2">

                  <span class="app-brand-text demo text-body fw-bolder">Wandercrm</span>

                </a>

              </div>

              <!-- /Logo -->

              <h4 class="mb-2">Welcome to Wandercrm!</h4>

              <p class="mb-4">Please sign-in to your account and generate invoice</p>



              <form id="formAuthentication" class="mb-3" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

                <?php wp_nonce_field( 'wandercrm_action', 'wander_login' ); ?>

                <div class="mb-3">

                  <label for="email" class="form-label">Email or Username</label>

                  <input type="email" class="form-control" name="user_email" placeholder="Enter your email" autofocus />

                </div>

                

                <div class="mb-3 form-password-toggle">

                  <div class="d-flex justify-content-between">

                    <label class="form-label" for="password">Password</label>

                    <!-- <a href="#">

                      <small>Forgot Password?</small>

                    </a> -->

                  </div>

                  <div class="input-group input-group-merge">

                    <input type="password" class="form-control" name="user_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />

                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                  </div>

                </div>

                <!-- <div class="mb-3">

                  <div class="form-check">

                    <input class="form-check-input" type="checkbox" id="remember-me" />

                    <label class="form-check-label" for="remember-me"> Remember Me </label>

                  </div>

                </div> -->

                <div class="mb-3">

                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>

                </div>



              </form>



              <!-- <p class="text-center">

                <span>New on our platform?</span>

                <a href="auth-register-basic.html">

                  <span>Create an account</span>

                </a>

              </p> -->

            </div>

          </div>

          <!-- /Register -->

        </div>

      </div>

    </div>



    <!-- / Content -->

<?php get_footer();?>