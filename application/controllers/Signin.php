<?php

  #if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Signin extends CI_Controller
  {
    public function __construct()
    {
  		parent::__construct();
  		$this->load->model('m_signin');
  	}

  	public function index()
    {
        # $VarPassword = base64_decode(base64_decode(base64_decode("VVVRNVUxbFhhR2hqTW14b1RVUkZkMDFxUVhwTVp6MDk=")));
        # $VarPassword = base64_encode(base64_encode(base64_encode("Jakarta01!")));
        # die($VarPassword);

        if (@$_SESSION == NULL)
        {
            session_start();
        }

        if (@$_SESSION["AppSignin"] == NULL || @$_SESSION["AppSignin"] == false)
        {
            $this->load->view('v_signin');
        }
        else
        {
            $User_IdLevel = @$_SESSION["User_IdLevel"];

            switch ($User_IdLevel)
            {
                case 1:
                    # super admin
                    $this->load->helper('url');
                    redirect('Dashboard');
                    break;
                case 2:
                    # admin
                    $this->load->helper('url');
                    redirect('Admin');
                    break;
                default:
                    # unknown
                    $this->RemoveMessage();

                    $this->load->helper('url');
                    redirect('Signin');
                    break;
            }
        }
  	}

    public function RemoveMessage()
    {
        $_SESSION["Response_Message"] = "";
    }

    public function ValidateForm ()
    {
      $UserLog = $this->input->post("text_User_UserLog");
      $KeyLog = $this->input->post("text_User_KeyLog");
      $Recaptcha = $this->input->post("text_User_Recaptcha");

      #echo "<pre>";
      #echo $UserLog;
      #echo $KeyLog;
      #echo $Recaptcha;
      #echo "</pre>";
      #die();

      # echo '<script>'.'alert("Data : "+'.$UserLog.')'.'</script>';
      # die($UserLog);

      $data = $this->m_signin->Signin($UserLog, $KeyLog, $Recaptcha);

      if ($data["Response_ID"] == "0")
      {
        $this->load->view('v_signin');

        $_SESSION["Response_Message"] = $data["Response_Message"];

        # $this->session->set_userdata($data);

        echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
        echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
        echo '
          <script type="text/javascript">
              window.onload = function ()
              {
                  setTimeout(function()
                  {
                      window.location = "'.base_url().'Signin'.'";
                  }, 3000);

                  Snackbar.show({
                      actionText: "Ok",
                      actionTextColor: "#ffffff",
                      pos: "bottom-right",
                      showAction: false,
                      text: \' <small>'.$data["Response_Message"].'</small> \',
                  });
              }
          </script>
        ';

        # $this->load->helper('url');
        # redirect('Signin');
      }
      else
      {
        # set session
        $_SESSION["Response_Message"] = $data["Response_Message"];

        $_SESSION["User_ID"] = $data["User_ID"];
        $_SESSION["User_IdLevel"] = $data["User_IdLevel"];
        $_SESSION["User_Level"] = $data["User_Level"];
        $_SESSION["User_IsActive"] = $data["User_IsActive"];

        $_SESSION["User_UserLog"] = $data["User_UserLog"];
        $_SESSION["User_KeyLog"] = $data["User_KeyLog"];

        $_SESSION["User_NamaLengkap"] = $data["User_NamaLengkap"];
        $_SESSION["User_Kontak"] = $data["User_Kontak"];

        #$_SESSION["User_NamaDepan"] = $data["User_NamaDepan"];
        #$_SESSION["User_NamaBelakang"] = $data["User_NamaBelakang"];
        #$_SESSION["User_JenisKelamin"] = $data["User_JenisKelamin"];
        #$_SESSION["User_TempatLahir"] = $data["User_TempatLahir"];
        #$_SESSION["User_TanggalLahirYYYY"] = $data["User_TanggalLahirYYYY"];
        #$_SESSION["User_TanggalLahirMM"] = $data["User_TanggalLahirMM"];
        #$_SESSION["User_TanggalLahirDD"] = $data["User_TanggalLahirDD"];

        #$_SESSION["User_IdProvinsi"] = $data["User_IdProvinsi"];
        #$_SESSION["User_NamaProvinsi"] = $data["User_NamaProvinsi"];
        #$_SESSION["User_IdKota"] = $data["User_IdKota"];
        #$_SESSION["User_KategoriKota"] = $data["User_KategoriKota"];
        #$_SESSION["User_NamaKota"] = $data["User_NamaKota"];
        #$_SESSION["User_IdKecamatan"] = $data["User_IdKecamatan"];
        #$_SESSION["User_NamaKecamatan"] = $data["User_NamaKecamatan"];
        #$_SESSION["User_IdKelurahan"] = $data["User_IdKelurahan"];
        #$_SESSION["User_NamaKelurahan"] = $data["User_NamaKelurahan"];
        #$_SESSION["User_AlamatLengkap"] = $data["User_AlamatLengkap"];

        #$_SESSION["User_Kontak"] = $data["User_Kontak"];
        #$_SESSION["User_Email"] = $data["User_Email"];
        #$_SESSION["User_NomorKTP"] = $data["User_NomorKTP"];

        $this->session->set_userdata($data);

        # check id level
        switch ($data["User_IdLevel"])
        {
            case 1:
                # super admin, signin success
                $_SESSION["AppSignin"] = true;

                $this->load->helper('url');
                redirect('Dashboard');
                break;
            case 2:
                # admin, signin success
                $_SESSION["AppSignin"] = true;

                $this->load->helper('url');
                redirect('Admin');
                break;
            default:
                # unknown
                # access denied
                $_SESSION["AppSignin"] = false;

                $this->load->view('v_signin');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
                          setTimeout(function()
                          {
                              window.location = "'.base_url().'Signin'.'";
                          }, 3000);

                          Snackbar.show({
                              actionText: "Ok",
                              actionTextColor: "#ffffff",
                              pos: "bottom-right",
                              showAction: false,
                              text: \' <small>'.$data["Response_Message"].'</small> \',
                          });
                      }
                  </script>
                ';
                break;
        }
      }

      # echo '<script type="text/javascript">alert("'.$data["Response_Message"].'");</script>';

      # echo "<br/><br/>";
      # echo json_encode($data);
    }
  }

?>
