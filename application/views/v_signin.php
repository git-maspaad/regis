<?php

  if (@$_SESSION == NULL)
  {
    session_start();
  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Real Count</title>

    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/img_chartbar1_32px.png">

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url() ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url() ?>assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url() ?>assets/build/css/custom.min.css" rel="stylesheet">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script type="text/javascript">
        function callback()
        {
            document.getElementById("idRecaptcha").value = 1;
        }
    </script>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="<?php echo base_url().'Signin/ValidateForm';?>">
              <h1>Real Count</h1>
              <div>
                <input type="text" class="form-control" id="idTextUserLog" name="text_User_UserLog" placeholder="Username" required/>
              </div>
              <div>
                <input type="password" class="form-control" id="idTextKeyLog" name="text_User_KeyLog" placeholder="Password" required/>
              </div>
              <div align="left">
                <div class="g-recaptcha" data-sitekey="6Lc5tmkUAAAAAI4Yu_9L5A3o8C9y99747rameEYb" class="box-recaptcha" data-callback="callback" required></div>
                <input id="idRecaptcha" name="text_User_Recaptcha" type="text" value="" hidden/><br/>
              </div>
              <div>
                <button id="idButtonLogin" class="btn btn-default submit" type="none" style="margin-left: -167.50px;" onclick="ClickValidateForm()">Log in</button>
                <a class="reset_pass" href="#" style="margin-right: 0px;">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link" style="margin-top: 25px;">&copy
                  <a href="http://www.partaiperindo.com" class="to_register"> Partai Perindo </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div hidden>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "assets/snackbar/dist/snackbar.css"; ?>" />
    <script src="<?php echo base_url() . "assets/snackbar/dist/snackbar.min.js"; ?>"></script>

    <script type="text/javascript">
        $(document).ready(function ()
        {
            var message = '<?php echo $_SESSION["Response_Message"]; ?>';
            if (message != '')
            {
                ShowMessage(message);

                $.ajax({
                    url: '<?php echo base_url()."Dashboard/RemoveMessage"; ?>',
                    success: function(r)
                    {
                        /*setTimeout(function()
                        {
                            location.reload();
                        }, 3000);*/
                    }
                });
            }
        })

        function ClickValidateForm ()
        {
            var UserLog = document.getElementById('idTextUserLog').value;
            var KeyLog = document.getElementById('idTextKeyLog').value;
            var Recaptcha = document.getElementById('idRecaptcha').value;

            if (UserLog == "")
            {
                ShowMessage("Username belum diisi.");
            }
            else if (KeyLog == "")
            {
                ShowMessage("Password belum diisi.");
            }
            else if (Recaptcha == "")
            {
                ShowMessage("Recaptcha belum dilengkapi.");
            }
            else
            {
                // signin
            }
        }

        function ShowMessage (message)
        {
            Snackbar.show({
                actionText: "Ok",
                actionTextColor: "#ffffff",
                pos: "bottom-right",
                showAction: false,
                text: "<small>" + message + "</small>"
            });
        }
    </script>
  </body>
</html>
