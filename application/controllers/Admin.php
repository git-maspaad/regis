<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    
    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Style\Fill;
    use PhpOffice\PhpSpreadsheet\Style\Border;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    class Admin extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('m_wilayah');
            $this->load->model('m_profile');
            $this->load->model('m_saksi');
            $this->load->model('m_admin');
        }

        function index()
        {
            #$this->load->view('a_dashboard');
            $this->load->view('a_excelSaksiForm');
        }

        function CreateNewAdmin ()
        {
            $User_NamaLengkap = $this->input->post("text_User_NamaLengkap");
            #$User_NamaDepan = $this->input->post("text_User_NamaDepan");
            #$User_NamaBelakang = $this->input->post("text_User_NamaBelakang");
            #$User_JenisKelamin = $this->input->post("radio_User_JenisKelamin");
            #$User_TempatLahir = $this->input->post("text_User_Tempatlahir");
            #$User_TanggalLahirDD = $this->input->post("text_User_TanggalLahirDD");
            #$User_TanggalLahirMM = $this->input->post("spinner_User_TanggalLahir");
            #$User_TanggalLahirYYYY = $this->input->post("text_User_TanggalLahirYYYY");

            #$User_IdProvinsi = $this->input->post("spinner_User_Provinsi");
            #$User_IdKota = $this->input->post("spinner_User_Kota");
            #$User_IdKecamatan = $this->input->post("spinner_User_Kecamatan");
            #$User_IdKelurahan = $this->input->post("spinner_User_Kelurahan");
            #$User_AlamatLengkap = $this->input->post("text_User_AlamatLengkap");

            $User_Kontak = $this->input->post("text_User_Kontak");
            #$User_Email = $this->input->post("text_User_Email");
            #$User_NomorKTP = $this->input->post("text_User_NomorKTP");

            $data = $this->m_admin->CreateNewAdmin(
                $User_NamaLengkap,
                #$User_NamaDepan, $User_NamaBelakang, $User_JenisKelamin,
                #$User_TempatLahir, $User_TanggalLahirDD, $User_TanggalLahirMM, $User_TanggalLahirYYYY,
                #$User_IdProvinsi, $User_IdKota, $User_IdKecamatan, $User_IdKelurahan, $User_AlamatLengkap,
                $User_Kontak
                #$User_Email, $User_NomorKTP
            );

            if ($data["Response_ID"] == "0")
            {
                $this->load->view('a_adminNew');
                # $this->load->helper('url');
                # redirect('Dashboard/Admin');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
                          Snackbar.show({
                              actionText: "Ok",
                              actionTextColor: "#ffffff",
                              pos: "bottom-right",
                              showAction: false,
                              text: \' <small>'.$data["Response_Message"].'</small> \'
                          });
                      }
                  </script>
                ';
            }
            else
            {
                ## update session
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->session->set_userdata($data);

                # redirect to database admin all provinsi
                $this->load->helper('url');
                redirect('Admin/DbAdminAll');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
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
            }
        }

        function CreateNewKecamatan ()
        {
            $Provinsi_IdProvinsi = $this->input->post("spinner_Provinsi_IdProvinsi");
            $Kota_IdKota = $this->input->post("spinner_Kota_IdKota");
            $Kecamatan_NamaKecamatan = $this->input->post("text_Kecamatan_NamaKecamatan");

            $data = $this->m_wilayah->CreateNewKecamatan(
                $Provinsi_IdProvinsi, $Kota_IdKota, $Kecamatan_NamaKecamatan
            );

            if ($data["Response_ID"] == "0")
            {
              $this->load->view('a_kecamatanNew');

              echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
              echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
              echo '
                <script type="text/javascript">
                    window.onload = function ()
                    {
                        Snackbar.show({
                            actionText: "Ok",
                            actionTextColor: "#ffffff",
                            pos: "bottom-right",
                            showAction: false,
                            text: \' <small>'.$data["Response_Message"].'</small> \'
                        });
                    }
                </script>
              ';
            }
            else
            {
                # update session
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->session->set_userdata($data);

                # redirect to database kota
                $this->load->helper('url');
                redirect('Admin/DbKecamatan');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
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
            }
        }

        function CreateNewKelurahan ()
        {
            $Provinsi_IdProvinsi = $this->input->post("spinner_Provinsi_IdProvinsi");
            $Kota_IdKota = $this->input->post("spinner_Kota_IdKota");
            $Kecamatan_IdKecamatan = $this->input->post("spinner_Kecamatan_IdKecamatan");
            $Kelurahan_NamaKelurahan = $this->input->post("text_Kelurahan_NamaKelurahan");

            $data = $this->m_wilayah->CreateNewKelurahan(
                $Provinsi_IdProvinsi, $Kota_IdKota, $Kecamatan_IdKecamatan, $Kelurahan_NamaKelurahan
            );

            if ($data["Response_ID"] == "0")
            {
                $this->load->view('a_kelurahanNew');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
                          Snackbar.show({
                              actionText: "Ok",
                              actionTextColor: "#ffffff",
                              pos: "bottom-right",
                              showAction: false,
                              text: \' <small>'.$data["Response_Message"].'</small> \'
                          });
                      }
                  </script>
                ';
            }
            else
            {
                # update session
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->session->set_userdata($data);

                # redirect to database kota
                $this->load->helper('url');
                redirect('Admin/DbKelurahan');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
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
            }
        }

        function CreateNewKota ()
        {
            $Provinsi_IdProvinsi = $this->input->post("spinner_Provinsi_IdProvinsi");
            $Kota_KategoriKota = $this->input->post("spinner_Kota_KategoriKota");
            $Kota_NamaKota = $this->input->post("text_Kota_NamaKota");

            $data = $this->m_wilayah->CreateNewKota(
                $Provinsi_IdProvinsi, $Kota_KategoriKota, $Kota_NamaKota
            );

            if ($data["Response_ID"] == "0")
            {
                $this->load->view('a_kotaNew');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
                          Snackbar.show({
                              actionText: "Ok",
                              actionTextColor: "#ffffff",
                              pos: "bottom-right",
                              showAction: false,
                              text: \' <small>'.$data["Response_Message"].'</small> \'
                          });
                      }
                  </script>
                ';
            }
            else
            {
                # update session
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->session->set_userdata($data);

                # redirect to database kota
                $this->load->helper('url');
                redirect('Admin/DbKota');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
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
            }
        }

        function CreateNewProvinsi ()
        {
            $Provinsi_NamaProvinsi = $this->input->post("text_Provinsi_NamaProvinsi");
            $Provinsi_IdWilayah = $this->input->post("spinner_Provinsi_IdWilayah");

            $data = $this->m_wilayah->CreateNewProvinsi(
                $Provinsi_NamaProvinsi, $Provinsi_IdWilayah
            );

            if ($data["Response_ID"] == "0")
            {
                $this->load->view('a_provinsiNew');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
                          Snackbar.show({
                              actionText: "Ok",
                              actionTextColor: "#ffffff",
                              pos: "bottom-right",
                              showAction: false,
                              text: \' <small>'.$data["Response_Message"].'</small> \'
                          });
                      }
                  </script>
                ';
            }
            else
            {
              ## update session
              $_SESSION["Response_Message"] = $data["Response_Message"];

              $this->session->set_userdata($data);

              # redirect to database provinsi
              $this->load->helper('url');
              redirect('Admin/DbProvinsi');

              echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
              echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
              echo '
                <script type="text/javascript">
                    window.onload = function ()
                    {
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
            }
        }

        function CreateNewSaksiPerindo ()
        {
            $User_NamaDepan = $this->input->post("text_User_NamaDepan");
            $User_NamaBelakang = $this->input->post("text_User_NamaBelakang");
            $User_JenisKelamin = $this->input->post("radio_User_JenisKelamin");
            $User_TempatLahir = $this->input->post("text_User_Tempatlahir");
            $User_TanggalLahirDD = $this->input->post("text_User_TanggalLahirDD");
            $User_TanggalLahirMM = $this->input->post("spinner_User_TanggalLahir");
            $User_TanggalLahirYYYY = $this->input->post("text_User_TanggalLahirYYYY");

            $User_IdProvinsi = $this->input->post("spinner_User_Provinsi");
            $User_IdKota = $this->input->post("spinner_User_Kota");
            $User_IdKecamatan = $this->input->post("spinner_User_Kecamatan");
            $User_IdKelurahan = $this->input->post("spinner_User_Kelurahan");
            $User_AlamatLengkap = $this->input->post("text_User_AlamatLengkap");

            $User_Kontak = $this->input->post("text_User_Kontak");
            $User_Email = $this->input->post("text_User_Email");
            $User_NomorKTP = $this->input->post("text_User_NomorKTP");

            # echo '<script type="text/javascript">alert("'.$User_Email.'");</script>';
            # die();

            $data = $this->m_saksi->CreateNewSaksiPerindo(
                $User_NamaDepan, $User_NamaBelakang, $User_JenisKelamin,
                $User_TempatLahir, $User_TanggalLahirDD, $User_TanggalLahirMM, $User_TanggalLahirYYYY,
                $User_IdProvinsi, $User_IdKota, $User_IdKecamatan, $User_IdKelurahan, $User_AlamatLengkap,
                $User_Kontak, $User_Email, $User_NomorKTP
            );

            if ($data["Response_ID"] == "0")
            {
                $this->load->view('a_saksiNew');
                # $this->load->helper('url');
                # redirect('Dashboard/Admin');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
                          Snackbar.show({
                              actionText: "Ok",
                              actionTextColor: "#ffffff",
                              pos: "bottom-right",
                              showAction: false,
                              text: \' <small>'.$data["Response_Message"].'</small> \'
                          });
                      }
                  </script>
                ';
            }
            else
            {
                ## update session
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->session->set_userdata($data);

                # redirect to database admin all provinsi
                $this->load->helper('url');
                redirect('Admin/DbSaksiPerindoAll');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
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
            }
        }

        function DbAdmin ($IdWilayah)
        {
            $this->load->view('a_dbAdminByIdWilayah');
        }

        function DbAdminAll ()
        {
            $this->load->view('a_dbAdminAll');
        }

        function DbAksesSaksiPerindo ()
        {
            $this->load->view('a_dbSaksiPerindoAksesLogin');
        }

        function DbKecamatan ()
        {
            $this->load->view('a_dbKecamatan');
        }

        function DbKelurahan ()
        {
            $this->load->view('a_dbKelurahan');
        }

        function DbKota ()
        {
            $this->load->view('a_dbKota');
        }

        function DbProvinsi ()
        {
            $this->load->view('a_dbProvinsi');
        }

        function DbSaksiPerindo ($IdWilayah)
        {
            $this->load->view('a_dbSaksiPerindoByIdWilayah');
        }

        function DbSaksiPerindoAll ()
        {
            $this->load->view('a_dbSaksiPerindoAll');
        }

        function DbSaksiPerindoExcel ()
        {
            $this->load->view("a_dbSaksiPerindoExcel");
        }

        function DbSaksiPerindoTmp ()
        {
            $this->load->view('a_dbSaksiPerindoTmp');
        }

        function DeleteAdmin ($User_ID)
        {
            $this->m_admin->DeleteAccount($User_ID);
        }

        function DeleteKecamatan ($IdKecamatan)
        {
            $this->m_wilayah->DeleteKecamatan($IdKecamatan);
        }

        function DeleteKelurahan ($IdKelurahan)
        {
            $this->m_wilayah->DeleteKelurahan($IdKelurahan);
        }

        function DeleteKota ($IdKota)
        {
            $this->m_wilayah->DeleteKota($IdKota);
        }

        function DeleteProvinsi ($IdProvinsi)
        {
            $this->m_wilayah->DeleteProvinsi($IdProvinsi);
        }

        function DeleteSaksiPerindo ($User_ID)
        {
            $this->m_saksi->DeleteAccount($User_ID);
        }

        function EditAdmin ($IdUser)
        {
            $this->load->view('a_adminEdit');
        }

        function EditKecamatan ()
        {
            $this->load->view('a_kecamatanEdit');
        }

        function EditKelurahan ()
        {
            $this->load->view('a_kelurahanEdit');
        }

        function EditKota ()
        {
            $this->load->view('a_kotaEdit');
        }

        function EditProvinsi ()
        {
            $this->load->view('a_provinsiEdit');
        }

        function EditSaksiPerindo ($IdUser)
        {
            $this->load->view('a_saksiEdit');
        }

        function ExcelExportAdminAll ()
        {
            $User_NamaLengkap = (@$_SESSION["User_NamaLengkap"] == NULL ? "User" : $_SESSION["User_NamaLengkap"]);

            $data = $this->m_admin->PreparedExportAdminAll();

            #echo "<pre>";
                #echo count($data);
                #echo json_encode($data);
                #print_r($data);
            #echo "</pre>";
            #die();

            // Create new Spreadsheet object
            $spreadsheet = new Spreadsheet();

            // Set document properties
            $spreadsheet->getProperties()->setCreator($User_NamaLengkap.' - '.'Partai Perindo')
                        ->setLastModifiedBy($User_NamaLengkap.' - '.'Partai Perindo')
                        ->setTitle('Office 2007 XLSX Document')
                        ->setSubject('Office 2007 XLSX Document')
                        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
                        ->setKeywords('Office 2007 OpenXml Php')
                        ->setCategory('Admin Partai Perindo');
            
            // Add some data
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'DATA ADMIN PERINDO - PEMILU 2019')
            ->setCellValue('A2', 'PARTAI PERINDO')

            ->setCellValue('A5', 'NO')
            ->setCellValue('B5', 'NAMA LENGKAP')
            ->setCellValue('C5', 'NO. HP/WA')
            ->setCellValue('D5', 'USERNAME')
            ->setCellValue('E5', 'PASSWORD');

            // Miscellaneous glyphs, UTF-8
            #echo "<pre>";
            #$i=6;
            $ix = count($data);
            #echo count($data);
            for ($i = 0; $i < $ix; $i++)
            {
                #echo ('B'.($i+6).' '.$data[$i]['namalengkap'].'<br/>');
                $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'.($i+6), ($i+1))
                ->setCellValue('B'.($i+6), $data[$i]['namalengkap'])
                ->setCellValue('C'.($i+6), $data[$i]['nohp'])
                ->setCellValue('D'.($i+6), $data[$i]['username'])
                ->setCellValue('E'.($i+6), $data[$i]['password']);

                $spreadsheet->getActiveSheet()->getStyle('A'.($i+6))->getAlignment()->setHorizontal("center");
                $spreadsheet->getActiveSheet()->getStyle('E'.($i+6))->getAlignment()->setHorizontal("center");

                $spreadsheet->getActiveSheet()->getStyle("A".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("A".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("B".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("B".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("C".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("C".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("D".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("D".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("E".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("E".($i+6))->getFont()->setSize(12);

                $spreadsheet->getActiveSheet()->getStyle('A'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('B'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('C'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('D'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('E'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
            }

            // Rename worksheet
            $spreadsheet->getActiveSheet()->setTitle('Sheet1');

            // width
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
            
            // merge and cell -> title and subtitle
            $spreadsheet->getActiveSheet()->mergeCells('A1:E1');
            $spreadsheet->getActiveSheet()->mergeCells('A2:E2');

            // align text -> title and subtitle
            $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal("center");
            $spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal("center");
            $spreadsheet->getActiveSheet()->getStyle('A5:E5')->getAlignment()->setHorizontal("center");

            // set font -> title and subtitle
            #$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle("A2")->getFont()->setName("Arial");
            $spreadsheet->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("A1:A2")->getFont()->setSize(14);

            $spreadsheet->getActiveSheet()->getStyle("A5:E5")->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("A5:E5")->getFont()->setBold(true);

            // set borders
            $spreadsheet->getActiveSheet()->getStyle('A5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('B5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('C5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('D5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('E5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );

            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $spreadsheet->setActiveSheetIndex(0);

            // Redirect output to a client’s web browser (Xlsx)
            #header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            #header('Content-Type: application/vnd.ms-excel'); 
            header('Content-Type: application/openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="DataAdminPerindo.xlsx"');
            header('Cache-Control: max-age=0');

            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            #$writer->save('FormRekruitmenSaksi.xlsx');
            $writer->save('php://output');
            exit;
        }

        function ExcelExportDbSaksiPerindoTmp ()
        {
            $User_NamaLengkap = (@$_SESSION["User_NamaLengkap"] == NULL ? "User" : $_SESSION["User_NamaLengkap"]);

            $data = $this->m_saksi->UploadExcelSaksiTmp3();

            #echo "<pre>";
                #echo count($data);
                #echo json_encode($data);
                #print_r($data);
            #echo "</pre>";
            #die();

            // Create new Spreadsheet object
            $spreadsheet = new Spreadsheet();

            // Set document properties
            $spreadsheet->getProperties()->setCreator($User_NamaLengkap.' - '.'Pertai Perindo')
                        ->setLastModifiedBy($User_NamaLengkap.' - '.'Pertai Perindo')
                        ->setTitle('Office 2007 XLSX Document')
                        ->setSubject('Office 2007 XLSX Document')
                        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
                        ->setKeywords('Office 2007 OpenXml Php')
                        ->setCategory('Saksi Partai Perindo');
            
            // Add some data
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'FORM REKRUITMEN SAKSI TPS - PEMILU 2019')
            ->setCellValue('A2', 'PARTAI PERINDO')

            ->setCellValue('A5', 'NO')
            ->setCellValue('B5', 'NAMA LENGKAP')
            ->setCellValue('C5', 'NIK')
            ->setCellValue('D5', 'ALAMAT LENGKAP SESUAI KTP')
            ->setCellValue('E5', 'KELURAHAN / DESA')
            ->setCellValue('F5', 'KECAMATAN')
            ->setCellValue('G5', 'KAB. / KOTA')
            ->setCellValue('H5', 'TPS')
            ->setCellValue('I5', 'NO. HP/WA')
            ->setCellValue('J5', 'REKOMENDASI')
            ->setCellValue('K5', 'STATUS');

            // Miscellaneous glyphs, UTF-8
            #echo "<pre>";
            #$i=6;
            $ix = count($data);
            #echo count($data);
            for ($i = 0; $i < $ix; $i++)
            {
                #echo ('B'.($i+6).' '.$data[$i]['namalengkap'].'<br/>');
                $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'.($i+6), ($i+1))
                ->setCellValue('B'.($i+6), $data[$i]['namalengkap'])
                ->setCellValue('C'.($i+6), "'".$data[$i]['nik'])
                ->setCellValue('D'.($i+6), $data[$i]['alamatlengkap'])
                ->setCellValue('E'.($i+6), $data[$i]['kelurahan'])
                ->setCellValue('F'.($i+6), $data[$i]['kecamatan'])
                ->setCellValue('G'.($i+6), $data[$i]['kota'])
                ->setCellValue('H'.($i+6), $data[$i]['tps'])
                ->setCellValue('I'.($i+6), "'".$data[$i]['nohp'])
                ->setCellValue('J'.($i+6), $data[$i]['rekomendasi'])
                ->setCellValue('K'.($i+6), $data[$i]['status']);

                $spreadsheet->getActiveSheet()->getStyle('A'.($i+6))->getAlignment()->setHorizontal("center");
                $spreadsheet->getActiveSheet()->getStyle('H'.($i+6))->getAlignment()->setHorizontal("center");

                $spreadsheet->getActiveSheet()->getStyle("A".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("A".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("B".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("B".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("C".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("C".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("D".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("D".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("E".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("E".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("F".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("F".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("G".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("G".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("H".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("H".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("I".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("I".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("J".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("J".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("K".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("K".($i+6))->getFont()->setSize(12);

                $spreadsheet->getActiveSheet()->getStyle('A'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('B'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('C'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('D'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('E'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('F'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('G'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('H'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('I'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('J'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('K'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
            }
            
            #echo "</pre>";
            #die();
            #$i = 0;
            #foreach($data as $data)
            #{
                #echo $data[$i]['namalengkap'];
                /*$spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B'.$i, $data[$i]['namalengkap'])
                ->setCellValue('C'.$i, $data[$i]['nik'])
                ->setCellValue('D'.$i, $data[$i]['alamatlengkap'])
                ->setCellValue('E'.$i, $data[$i]['kelurahan'])
                ->setCellValue('F'.$i, $data[$i]['kecamatan'])
                ->setCellValue('G'.$i, $data[$i]['kota'])
                ->setCellValue('H'.$i, $data[$i]['tps'])
                ->setCellValue('I'.$i, $data[$i]['nohp'])
                ->setCellValue('J'.$i, $data[$i]['rekomendasi']);*/
                #$i++;
            #}
            #die();

            // Rename worksheet
            $spreadsheet->getActiveSheet()->setTitle('Sheet1');
            #$spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

            // width
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(40);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            
            // merge and cell -> title and subtitle
            $spreadsheet->getActiveSheet()->mergeCells('A1:K1');
            $spreadsheet->getActiveSheet()->mergeCells('A2:K2');

            // align text -> title and subtitle
            $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal("center");
            $spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal("center");
            $spreadsheet->getActiveSheet()->getStyle('A5:K5')->getAlignment()->setHorizontal("center");

            // set font -> title and subtitle
            #$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle("A2")->getFont()->setName("Arial");
            $spreadsheet->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("A1:A2")->getFont()->setSize(14);

            $spreadsheet->getActiveSheet()->getStyle("A5:K5")->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("A5:K5")->getFont()->setBold(true);

            // set border
            /*$styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => Border::BORDER_THIN,
                        'color' => array('argb' => '000000'),
                    ),
                ),
            );
            $spreadsheet->getActiveSheet()->getStyle('A5:J5')->applyFromArray($styleArray);*/
            $spreadsheet->getActiveSheet()->getStyle('A5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('B5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('C5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('D5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('E5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('F5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('G5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('H5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('I5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('J5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('K5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            /*$spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray(
            [
                'font' => [
                    'name' => 'Arial',
                    'bold' => true,
                    'italic' => false,
                    #'underline' => Font::UNDERLINE_DOUBLE,
                    'strikethrough' => false,
                    'color' => [
                        'rgb' => '808080'
                    ]
                ],
                'borders' => [
                    'bottom' => [
                        'borderStyle' => Border::BORDER_DASHDOT,
                        'color' => [
                            'rgb' => '808080'
                        ]
                    ],
                    'top' => [
                        'borderStyle' => Border::BORDER_DASHDOT,
                        'color' => [
                            'rgb' => '808080'
                        ]
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                #'quotePrefix'    => true
            ]);*/

            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $spreadsheet->setActiveSheetIndex(0);

            // Redirect output to a client’s web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="FormRekruitmenSaksi.xlsx"');
            header('Cache-Control: max-age=0');

            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            exit;
        }

        function ExcelExportDbSaksiPerindoTmp_v2 ()
        {
            $User_NamaLengkap = (@$_SESSION["User_NamaLengkap"] == NULL ? "User" : $_SESSION["User_NamaLengkap"]);

            $data = $this->m_saksi->UploadExcelSaksiTmp7();

            #echo "<pre>";
                #echo count($data);
                #echo json_encode($data);
                #print_r($data);
            #echo "</pre>";
            #die();

            // Create new Spreadsheet object
            $spreadsheet = new Spreadsheet();

            // Set document properties
            $spreadsheet->getProperties()->setCreator($User_NamaLengkap.' - '.'Pertai Perindo')
                        ->setLastModifiedBy($User_NamaLengkap.' - '.'Pertai Perindo')
                        ->setTitle('Office 2007 XLSX Document')
                        ->setSubject('Office 2007 XLSX Document')
                        ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
                        ->setKeywords('Office 2007 OpenXml Php')
                        ->setCategory('Saksi Partai Perindo');
            
            // Add some data
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'FORM REKRUITMEN SAKSI TPS - PEMILU 2019')
            ->setCellValue('A2', 'PARTAI PERINDO')

            ->setCellValue('A5', 'NO')
            ->setCellValue('B5', 'NAMA LENGKAP')
            ->setCellValue('C5', 'NIK')
            ->setCellValue('D5', 'ALAMAT LENGKAP SESUAI KTP')
            ->setCellValue('E5', 'KELURAHAN / DESA')
            ->setCellValue('F5', 'KECAMATAN')
            ->setCellValue('G5', 'KAB. / KOTA')
            ->setCellValue('H5', 'TPS')
            ->setCellValue('I5', 'NO. HP/WA')
            ->setCellValue('J5', 'REKOMENDASI')
            ->setCellValue('K5', 'USERNAME')
            ->setCellValue('L5', 'PASSWORD');

            // Miscellaneous glyphs, UTF-8
            #echo "<pre>";
            #$i=6;
            $ix = count($data);
            #echo count($data);
            for ($i = 0; $i < $ix; $i++)
            {
                #echo ('B'.($i+6).' '.$data[$i]['namalengkap'].'<br/>');
                $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'.($i+6), ($i+1))
                ->setCellValue('B'.($i+6), $data[$i]['namalengkap'])
                ->setCellValue('C'.($i+6), "'".$data[$i]['nik'])
                ->setCellValue('D'.($i+6), $data[$i]['alamatlengkap'])
                ->setCellValue('E'.($i+6), $data[$i]['kelurahan'])
                ->setCellValue('F'.($i+6), $data[$i]['kecamatan'])
                ->setCellValue('G'.($i+6), $data[$i]['kota'])
                ->setCellValue('H'.($i+6), $data[$i]['tps'])
                ->setCellValue('I'.($i+6), "'".$data[$i]['nohp'])
                ->setCellValue('J'.($i+6), $data[$i]['rekomendasi'])
                ->setCellValue('K'.($i+6), $data[$i]['ulog'])
                ->setCellValue('L'.($i+6), $data[$i]['plog']);

                $spreadsheet->getActiveSheet()->getStyle('A'.($i+6))->getAlignment()->setHorizontal("center");
                $spreadsheet->getActiveSheet()->getStyle('H'.($i+6))->getAlignment()->setHorizontal("center");

                $spreadsheet->getActiveSheet()->getStyle("A".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("A".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("B".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("B".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("C".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("C".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("D".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("D".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("E".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("E".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("F".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("F".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("G".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("G".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("H".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("H".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("I".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("I".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("J".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("J".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("K".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("K".($i+6))->getFont()->setSize(12);
                $spreadsheet->getActiveSheet()->getStyle("L".($i+6))->getFont()->setBold(false);
                $spreadsheet->getActiveSheet()->getStyle("L".($i+6))->getFont()->setSize(12);

                $spreadsheet->getActiveSheet()->getStyle('A'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('B'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('C'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('D'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('E'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('F'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('G'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('H'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('I'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('J'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('K'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
                $spreadsheet->getActiveSheet()->getStyle('L'.($i+6) )->applyFromArray(
                    [
                        'borders' => [
                            'bottom' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'top' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'left' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ],
                            'right' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => [
                                    'rgb' => '808080'
                                ]
                            ]
                        ],
                    ]
                );
            }
            
            #echo "</pre>";
            #die();
            #$i = 0;
            #foreach($data as $data)
            #{
                #echo $data[$i]['namalengkap'];
                /*$spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B'.$i, $data[$i]['namalengkap'])
                ->setCellValue('C'.$i, $data[$i]['nik'])
                ->setCellValue('D'.$i, $data[$i]['alamatlengkap'])
                ->setCellValue('E'.$i, $data[$i]['kelurahan'])
                ->setCellValue('F'.$i, $data[$i]['kecamatan'])
                ->setCellValue('G'.$i, $data[$i]['kota'])
                ->setCellValue('H'.$i, $data[$i]['tps'])
                ->setCellValue('I'.$i, $data[$i]['nohp'])
                ->setCellValue('J'.$i, $data[$i]['rekomendasi']);*/
                #$i++;
            #}
            #die();

            // Rename worksheet
            $spreadsheet->getActiveSheet()->setTitle('Sheet1');
            #$spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

            // width
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(40);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);
            
            // merge and cell -> title and subtitle
            $spreadsheet->getActiveSheet()->mergeCells('A1:L1');
            $spreadsheet->getActiveSheet()->mergeCells('A2:L2');

            // align text -> title and subtitle
            $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal("center");
            $spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal("center");
            $spreadsheet->getActiveSheet()->getStyle('A5:L5')->getAlignment()->setHorizontal("center");

            // set font -> title and subtitle
            #$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(14);
            $spreadsheet->getActiveSheet()->getStyle("A2")->getFont()->setName("Arial");
            $spreadsheet->getActiveSheet()->getStyle("A1:A2")->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("A1:A2")->getFont()->setSize(14);

            $spreadsheet->getActiveSheet()->getStyle("A5:L5")->getFont()->setSize(12);
            $spreadsheet->getActiveSheet()->getStyle("A5:L5")->getFont()->setBold(true);

            // set border
            /*$styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => Border::BORDER_THIN,
                        'color' => array('argb' => '000000'),
                    ),
                ),
            );
            $spreadsheet->getActiveSheet()->getStyle('A5:J5')->applyFromArray($styleArray);*/
            $spreadsheet->getActiveSheet()->getStyle('A5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('B5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('C5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('D5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('E5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('F5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('G5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('H5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('I5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('J5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('K5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            $spreadsheet->getActiveSheet()->getStyle('L5')->applyFromArray(
                [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'left' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ],
                        'right' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '808080'
                            ]
                        ]
                    ],
                ]
            );
            /*$spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray(
            [
                'font' => [
                    'name' => 'Arial',
                    'bold' => true,
                    'italic' => false,
                    #'underline' => Font::UNDERLINE_DOUBLE,
                    'strikethrough' => false,
                    'color' => [
                        'rgb' => '808080'
                    ]
                ],
                'borders' => [
                    'bottom' => [
                        'borderStyle' => Border::BORDER_DASHDOT,
                        'color' => [
                            'rgb' => '808080'
                        ]
                    ],
                    'top' => [
                        'borderStyle' => Border::BORDER_DASHDOT,
                        'color' => [
                            'rgb' => '808080'
                        ]
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                #'quotePrefix'    => true
            ]);*/

            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $spreadsheet->setActiveSheetIndex(0);

            // Redirect output to a client’s web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="PrintAksesLoginSaksi.xlsx"');
            header('Cache-Control: max-age=0');

            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            exit;
        }

        function ExcelSaksi ()
        {
            $this->load->view('a_excelSaksiForm');
        }

        function ExcelSaksiProses ()
        {
            // print_r($_FILES['doc_upload']);
            // exit;
            #$this->m_aktivasi->empty();
            $dataSaksi = array();
            $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            // echo "string";
            
            if (isset($_FILES['text_FilepathExcelSaksi']['name']) && in_array($_FILES['text_FilepathExcelSaksi']['type'], $file_mimes))
            {     
                $arr_file = explode('.', $_FILES['text_FilepathExcelSaksi']['name']);
                $extension = end($arr_file);
                if('csv' == $extension)
                {
                    // echo "string";
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                }
                else
                {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
                $spreadsheet = $reader->load($_FILES['text_FilepathExcelSaksi']['tmp_name']);
                $sheetData = $spreadsheet->getActiveSheet();
                $highestRow = $sheetData->getHighestRow();
                
                for ($i=6; $i <=$highestRow ; $i++)
                {
                    $cNamaLengkap = $sheetData->getCellByColumnAndRow(2, $i)->getValue();
                    $cNIK = $sheetData->getCellByColumnAndRow(3, $i)->getValue();
                    $cAlamatLengkap = $sheetData->getCellByColumnAndRow(4, $i)->getValue();
                    
                    $cKelurahan = $sheetData->getCellByColumnAndRow(5, $i)->getValue();
                    $cKecamatan = $sheetData->getCellByColumnAndRow(6, $i)->getValue();
                    $cKota = $sheetData->getCellByColumnAndRow(7, $i)->getValue();
                    #$dDataWilayah = $this->m_wilayah->GenerateDataWilayah(
                        #str_replace("'", "", strtoupper($cKelurahan)),
                        #str_replace("'", "", strtoupper($cKecamatan)),
                        #str_replace("'", "", strtoupper($cKota))
                    #);

                    $cTPS1a = $sheetData->getCellByColumnAndRow(8, $i)->getValue();
                    #$cTPS1b = str_replace("'", "", number_format($cTPS1a, 0, "", ""));
                    #$cTPS = strlen($cTPS1b) == 1 ? "00".$cTPS1b : strlen($cTPS1b) == 2 ? "0".$cTPS1b : $cTPS1b;
                    #$cTPS = (strlen($cTPS1b) == 1 ? "00".$cTPS1b : (strlen($cTPS1b) == 2 ? "0".$cTPS1b : $cTPS1b));
                    $cTPS;
                    if (strlen($cTPS1a) == 1)
                    {
                        $cTPS = "00$cTPS1a";
                    }
                    else if (strlen($cTPS1a) == 2)
                    {
                        $cTPS = "0$cTPS1a";
                    }
                    else
                    {
                        $cTPS = substr("$cTPS1a", 0, 3);
                    }
                    /*if (strlen($cTPS1a) == 1)
                    {
                        $cTPS = "00" . $cTPS1a;
                    }
                    else if (strlen($cTPS1b) == 2)
                    {
                        $cTPS = "0" . $cTPS1a;
                    }
                    else
                    {
                        $cTPS = "" . $cTPS1a;
                    }*/

                    $cNoHandphone1a = $sheetData->getCellByColumnAndRow(9, $i)->getValue();
                    $cNoHandphone1b = str_replace("'", "", ($this->hasLetter($cNoHandphone1a) == true ? $cNoHandphone1a : number_format($cNoHandphone1a, 0, "", "")));
                    $cNoHandphone =
                    (
                        $this->hasLetter($cNoHandphone1a) == true ? $cNoHandphone1a :
                        (
                            substr($cNoHandphone1b, 0, 1) != "0" ? "0".$cNoHandphone1b : 
                            (
                                substr($cNoHandphone1b, 0, 2) != "62" ? "0".$cNoHandphone1b : 
                                (
                                    substr($cNoHandphone1b, 0, 3) != "+62" ? "0".$cNoHandphone1b : $cNoHandphone1b
                                )
                            )
                        )
                    );

                    $cRekomendasi = $sheetData->getCellByColumnAndRow(10, $i)->getValue();

                    #$dUsername = (strlen($cNamaLengkap) >= 3 ? substr($cNamaLengkap, 0, 3).$this->randomNumber(5) : $cNamaLengkap.$this->randomNumber(6));
                    #$dPassword = $this->randomString(6);

                    $dataSaksi[] = array(
                        'namalengkap' => str_replace("'", "", ucwords(strtolower($cNamaLengkap))),
                        'nik' => ($this->hasLetter("$cNIK") == true ? str_replace("'", "", number_format("$cNIK", 0, "", "")) : number_format("$cNIK", 0, "", "")), #str_replace("'", "", number_format($cNIK, 0, "", "")),
                        'alamatlengkap' => str_replace("'", "", $cAlamatLengkap),

                        'kelurahan' => str_replace("'", "", $cKelurahan), #($dDataWilayah["IdKelurahan"] == "0" ? "" : $dDataWilayah["Kelurahan"]),
                        'kecamatan' => str_replace("'", "", $cKecamatan), #($dDataWilayah["IdKecamatan"] == "0" ? "" : $dDataWilayah["Kecamatan"]),
                        'kota' => str_replace("'", "", $cKota), #($dDataWilayah["IdKota"] == "0" ? "" : $dDataWilayah["Kota"]),

                        'tps' => $cTPS, #str_replace("'", "", number_format($cTPS, 0, "", "")),
                        'nohp' => $cNoHandphone, #str_replace("'", "", number_format($cNoHandphone, 0, "", "")),
                        'rekomendasi' => str_replace("'", "", $cRekomendasi),
                        
                        #'username' => $dUsername,
                        #'password' => $dPassword,
                        'idadmin' => (@$_SESSION["User_ID"] == NULL ? "0" : $_SESSION["User_ID"])
                    );

                    #$provinsi = $sheetData->getCellByColumnAndRow(1, $i)->getValue();
                    #$dapil = $sheetData->getCellByColumnAndRow(2, $i)->getValue();
                    #$dpr_ri = $sheetData->getCellByColumnAndRow(3, $i)->getValue();
                    #$dprd_1 = $sheetData->getCellByColumnAndRow(4, $i)->getValue();
                    #$dprd_2 = $sheetData->getCellByColumnAndRow(5, $i)->getValue();
                    #$jumlah_aktivasi = $sheetData->getCellByColumnAndRow(6, $i)->getValue();
                    
                    // $reject = $sheetData->getCellByColumnAndRow(7, $i)->getValue();
                    // $tgl_request = substr($tgl_request, 0,2).'-'.substr($tgl_request, 2,2).'-'.substr($tgl_request, 4,4);
                    // $tgl_request = date_format(date_create($tgl_request),"Y-m-d");
                    #$data[] = array(
                        // 'provinsi' => $provinsi,
                        #'dapil' => $dapil,
                        #'dpr_ri' => $dpr_ri,
                        #'dprd_1' => $dprd_1,
                        #'dprd_2' => $dprd_2,
                        #'jumlah_aktivasi' => $jumlah_aktivasi,
                        #'id_request'
                        // 'reject' => $reject
                    #);
                }
            }

            #echo "<pre>";print_r($dataSaksi);echo "</pre>";
            #die();

            if ($dataSaksi)
            {
                $data = $this->m_saksi->UploadExcelSaksiLog($dataSaksi);

                if ($data["Response_ID"] == "0")
                {
                    # update session
                    $_SESSION["Response_Message"] = $data["Response_Message"];

                    $this->session->set_userdata($data);

                    # redirect to database kota
                    $this->load->helper('url');
                    redirect('Admin/ExcelSaksi');

                    echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                    echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                    echo '
                        <script type="text/javascript">
                            window.onload = function ()
                            {
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
                }
                else if ($data["Response_ID"] == "1")
                {
                    # update session
                    $_SESSION["Response_Message"] = $data["Response_Message"];

                    $this->session->set_userdata($data);

                    # redirect to database kota
                    $this->load->helper('url');
                    redirect('Admin/ExcelSaksi');

                    echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                    echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                    echo '
                        <script type="text/javascript">
                            window.onload = function ()
                            {
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
                }
                else
                {
                    #echo "<pre>";
                    #print_r(json_decode(json_encode($data["Response_Array"])));
                    #print_r(json_encode($data["Response_Array"]));
                    #echo "</pre>";
                    #die();

                    # update session
                    $_SESSION["Response_Message"] = $data["Response_Message"];
                    $_SESSION["Response_Array"] = $data["Response_Array"];

                    $this->session->set_userdata($data);

                    # redirect to database kota
                    $this->load->helper('url');
                    redirect('Admin/DbSaksiPerindoTmp');

                    echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                    echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                    echo '
                        <script type="text/javascript">
                            window.onload = function ()
                            {
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
                }
            }
            else
            {
                $data = array(
                    "Response_ID" => "0",
                    "Response_Message" => "Cek kembali data saksi pada file excel anda."
                );
                
                # update session
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->session->set_userdata($data);

                # redirect to database kota
                $this->load->helper('url');
                redirect('Admin/ExcelSaksi');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                    <script type="text/javascript">
                        window.onload = function ()
                        {
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
            }
            
            #if ($data)
            #{
                #$this->m_aktivasi->insert($data);
                #echo "data success";
            #}
            #else
            #{
                #echo "your data empty";
            #}
            // $this->load->view('pages/page',$data);
        }

        function ExcelSaksiSubmit_v2 ()
        {
            $dataSaksi = $this->m_saksi->UploadExcelSaksiTmp4();

            #echo "<pre>";
            #print_r($dataSaksi);
            #echo "</pre>";
            #die();

            $data = $this->m_saksi->UploadExcelSaksiTmp5($dataSaksi);

            if ($data["Response_ID"] == "0")
            {
                # update session
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->session->set_userdata($data);

                echo "0";

                /*# redirect to database kota
                $this->load->helper('url');
                redirect('Dashboard/ExcelSaksi');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                    <script type="text/javascript">
                        window.onload = function ()
                        {
                            Snackbar.show({
                                actionText: "Ok",
                                actionTextColor: "#ffffff",
                                pos: "bottom-right",
                                showAction: false,
                                text: \' <small>'.$data["Response_Message"].'</small> \',
                            });
                        }
                    </script>
                ';*/
            }
            else
            {
                # update session
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->session->set_userdata($data);

                echo "1";

                # redirect to database kota
                /*$this->load->helper('url');
                redirect('Dashboard/DbSaksiPerindoExcel');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                    <script type="text/javascript">
                        window.onload = function ()
                        {
                            Snackbar.show({
                                actionText: "Ok",
                                actionTextColor: "#ffffff",
                                pos: "bottom-right",
                                showAction: false,
                                text: \' <small>'.$data["Response_Message"].'</small> \',
                            });
                        }
                    </script>
                ';*/
            }
        }

        function Kecamatan ()
        {
            $this->load->view('a_kecamatanNew');
        }

        function Kelurahan ()
        {
            $this->load->view('a_kelurahanNew');
        }

        function Kota ()
        {
            $this->load->view('a_kotaNew');
        }

        function NewAdmin ()
        {
            $this->load->view('a_adminNew');
        }

        function Profile ()
        {
            # $this->load->helper('url');
            # redirect('Dashboard');

            $this->load->view('a_profile');
        }

        function ProfileUpdate ()
        {
            $User_NamaLengkap = $this->input->post("text_User_NamaLengkap");
            #$User_NamaDepan = $this->input->post("text_User_NamaDepan");
            #$User_NamaBelakang = $this->input->post("text_User_NamaBelakang");
            #$User_JenisKelamin = $this->input->post("radio_User_JenisKelamin");
            #$User_TempatLahir = $this->input->post("text_User_Tempatlahir");
            #$User_TanggalLahirDD = $this->input->post("text_User_TanggalLahirDD");
            #$User_TanggalLahirMM = $this->input->post("spinner_User_TanggalLahir");
            #$User_TanggalLahirYYYY = $this->input->post("text_User_TanggalLahirYYYY");

            #$User_IdProvinsi = $this->input->post("spinner_User_Provinsi");
            #$User_IdKota = $this->input->post("spinner_User_Kota");
            #$User_IdKecamatan = $this->input->post("spinner_User_Kecamatan");
            #$User_IdKelurahan = $this->input->post("spinner_User_Kelurahan");
            #$User_AlamatLengkap = $this->input->post("text_User_AlamatLengkap");

            $User_Kontak = $this->input->post("text_User_Kontak");
            #$User_Email = $this->input->post("text_User_Email");
            #$User_NomorKTP = $this->input->post("text_User_NomorKTP");

            $data = $this->m_profile->UpdateProfile(
                $User_NamaLengkap,
                #$User_NamaDepan, $User_NamaBelakang, $User_JenisKelamin,
                #$User_TempatLahir, $User_TanggalLahirDD, $User_TanggalLahirMM, $User_TanggalLahirYYYY,
                #$User_IdProvinsi, $User_IdKota, $User_IdKecamatan, $User_IdKelurahan, $User_AlamatLengkap,
                $User_Kontak
                #$User_Email, $User_NomorKTP
            );

            if ($data["Response_ID"] == "0")
            {
                $this->load->view('a_profile');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
                          Snackbar.show({
                              actionText: "Ok",
                              actionTextColor: "#ffffff",
                              pos: "bottom-right",
                              showAction: false,
                              text: \' <small>'.$data["Response_Message"].'</small> \'
                          });
                      }
                  </script>
                ';
            }
            else
            {
                # update session
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $_SESSION["User_NamaLengkap"] = $data["User_NamaLengkap"];
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

                $_SESSION["User_Kontak"] = $data["User_Kontak"];
                #$_SESSION["User_Email"] = $data["User_Email"];
                #$_SESSION["User_NomorKTP"] = $data["User_NomorKTP"];

                $this->session->set_userdata($data);

                # $this->load->view('v_profile');
                $this->load->helper('url');
                redirect('Admin/Profile');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
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
            }
        }

        function Provinsi ()
        {
            $this->load->view('a_provinsiNew.php');
        }

        function RemoveMessage ()
        {
            $message = "";

            $_SESSION["Response_Message"] = $message;

            $result = array(
                "Response_ID" => "1",
                "Response_Message" => $message
            );

            return $result;
        }

        function Saksi ()
        {
            $this->load->view('a_saksiNew');
        }

        function SignOut ()
        {
            $data = array(
                "AppSignin",

                "User_ID",
                "User_IdLevel",
                "User_Level",
                "User_IsActive",

                "User_UserLog",
                "User_KeyLog",

                "User_NamaDepan",
                "User_NamaBelakang",
                "User_JenisKelamin",
                "User_TempatLahir",
                "User_TanggalLahirYYYY",
                "User_TanggalLahirMM",
                "User_TanggalLahirDD",

                "User_IdProvinsi",
                "User_NamaProvinsi",
                "User_IdKota",
                "User_KategoriKota",
                "User_NamaKota",
                "User_IdKecamatan",
                "User_NamaKecamatan",
                "User_IdKelurahan",
                "User_NamaKelurahan",
                "User_AlamatLengkap",

                "User_Kontak",
                "User_Email",
                "User_NomorKTP"
            );

            $this->session->unset_userdata($data);

            $this->load->helper('url');
            redirect('Signin');
        }

        function SpinnerKotaOnAjax ($IdProvinsi)
        {
            # $IdProvinsi = $this->input->post("spinner_User_Provinsi");
            if ($IdProvinsi == NULL)
            {
                $IdProvinsi = "0";
            }
            $this->m_wilayah->GetKotaOnAjax($IdProvinsi);
        }

        function SpinnerKecamatanOnAjax ($IdProvinsi, $IdKota)
        {
            if ($IdProvinsi == NULL)
            {
                $IdProvinsi = "0";
            }

            if ($IdKota == NULL)
            {
                $IdKota = "0";
            }

            $this->m_wilayah->GetKecamatanOnAjax($IdProvinsi, $IdKota);
        }

        function SpinnerKelurahanOnAjax ($IdProvinsi, $IdKota, $IdKecamatan)
        {
            if ($IdProvinsi == NULL)
            {
                $IdProvinsi = "0";
            }

            if ($IdKota == NULL)
            {
                $IdKota = "0";
            }

            if ($IdKecamatan == NULL)
            {
                $IdKecamatan = "0";
            }

            $this->m_wilayah->GetKelurahanOnAjax($IdProvinsi, $IdKota, $IdKecamatan);
        }

        function UpdateAdminProfile ()
        {
            $User_ID = $this->input->post("text_User_ID");
            $User_NamaLengkap = $this->input->post("text_User_NamaLengkap");
            #$User_NamaDepan = $this->input->post("text_User_NamaDepan");
            #$User_NamaBelakang = $this->input->post("text_User_NamaBelakang");
            #$User_JenisKelamin = $this->input->post("radio_User_JenisKelamin");
            #$User_TempatLahir = $this->input->post("text_User_Tempatlahir");
            #$User_TanggalLahirDD = $this->input->post("text_User_TanggalLahirDD");
            #$User_TanggalLahirMM = $this->input->post("spinner_User_TanggalLahir");
            #$User_TanggalLahirYYYY = $this->input->post("text_User_TanggalLahirYYYY");

            #$User_IdProvinsi = $this->input->post("spinner_User_Provinsi");
            #$User_IdKota = $this->input->post("spinner_User_Kota");
            #$User_IdKecamatan = $this->input->post("spinner_User_Kecamatan");
            #$User_IdKelurahan = $this->input->post("spinner_User_Kelurahan");
            #$User_AlamatLengkap = $this->input->post("text_User_AlamatLengkap");

            $User_Kontak = $this->input->post("text_User_Kontak");
            #$User_Email = $this->input->post("text_User_Email");
            #$User_NomorKTP = $this->input->post("text_User_NomorKTP");

            $data = $this->m_admin->UpdateProfile(
                $User_ID,
                $User_NamaLengkap,
                #$User_NamaDepan, $User_NamaBelakang, $User_JenisKelamin,
                #$User_TempatLahir, $User_TanggalLahirDD, $User_TanggalLahirMM, $User_TanggalLahirYYYY,
                #$User_IdProvinsi, $User_IdKota, $User_IdKecamatan, $User_IdKelurahan, $User_AlamatLengkap,
                $User_Kontak
                #$User_Email, $User_NomorKTP
            );

            if ($data["Response_ID"] == "0")
            {
                $this->load->view('a_adminEdit');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
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
            }
            else
            {
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->load->helper('url');
                redirect('Admin/DbAdminAll');
            }
        }

        function UpdateProvinsi ()
        {
            $Provinsi_IdProvinsi = $this->input->post("text_Provinsi_IdProvinsi");
            $Provinsi_NamaProvinsi = $this->input->post("text_Provinsi_NamaProvinsi");
            $Provinsi_IdWilayah = $this->input->post("spinner_Provinsi_IdWilayah");

            $data = $this->m_wilayah->UpdateProvinsi(
                $Provinsi_IdProvinsi, $Provinsi_NamaProvinsi, $Provinsi_IdWilayah
            );

            if ($data["Response_ID"] == "0")
            {
                $this->load->view('a_saksiEdit');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
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
            }
            else
            {
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->load->helper('url');
                redirect('Admin/DbProvinsi');
            }
        }

        function UpdateKecamatan ()
        {
            $Kecamatan_IdKecamatan = $this->input->post("text_Kecamatan_IdKecamatan");
            $Provinsi_IdProvinsi = $this->input->post("spinner_Provinsi_IdProvinsi");
            $Kota_IdKota = $this->input->post("spinner_Kota_IdKota");
            $Kecamatan_NamaKecamatan = $this->input->post("text_Kecamatan_NamaKecamatan");

            $data = $this->m_wilayah->UpdateKecamatan(
                $Kecamatan_IdKecamatan, $Provinsi_IdProvinsi, $Kota_IdKota, $Kecamatan_NamaKecamatan
            );

            if ($data["Response_ID"] == "0")
            {
                $this->load->view('a_kecamatanEdit');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
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
            }
            else
            {
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->load->helper('url');
                redirect('Admin/DbKecamatan');
            }
        }

        function UpdateKelurahan ()
        {
            $Kelurahan_IdKelurahan = $this->input->post("text_Kelurahan_IdKelurahan");
            $Provinsi_IdProvinsi = $this->input->post("spinner_Provinsi_IdProvinsi");
            $Kota_IdKota = $this->input->post("spinner_Kota_IdKota");
            $Kecamatan_IdKecamatan = $this->input->post("spinner_Kecamatan_IdKecamatan");
            $Kelurahan_NamaKelurahan = $this->input->post("text_Kelurahan_NamaKelurahan");

            $data = $this->m_wilayah->UpdateKelurahan(
                $Kelurahan_IdKelurahan, $Provinsi_IdProvinsi, $Kota_IdKota, $Kecamatan_IdKecamatan, $Kelurahan_NamaKelurahan
            );

            if ($data["Response_ID"] == "0")
            {
                $this->load->view('a_kelurahanEdit');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
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
            }
            else
            {
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->load->helper('url');
                redirect('Admin/DbKelurahan');
            }
        }

        function UpdateKota ()
        {
            $Kota_IdKota = $this->input->post("text_Kota_IdKota");
            $Provinsi_IdProvinsi = $this->input->post("spinner_Provinsi_IdProvinsi");
            $Kota_KategoriKota = $this->input->post("spinner_Kota_KategoriKota");
            $Kota_NamaKota = $this->input->post("text_Kota_NamaKota");

            $data = $this->m_wilayah->UpdateKota(
                $Kota_IdKota, $Provinsi_IdProvinsi, $Kota_KategoriKota, $Kota_NamaKota
            );

            if ($data["Response_ID"] == "0")
            {
                $this->load->view('a_kotaEdit');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
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
            }
            else
            {
                $_SESSION["Response_Message"] = $data["Response_Message"];

                $this->load->helper('url');
                redirect('Admin/DbKota');
            }
        }

        function UpdateSaksiPerindoProfile ()
        {
            $User_ID = $this->input->post("text_User_ID");
            $User_NamaDepan = $this->input->post("text_User_NamaDepan");
            $User_NamaBelakang = $this->input->post("text_User_NamaBelakang");
            $User_JenisKelamin = $this->input->post("radio_User_JenisKelamin");
            $User_TempatLahir = $this->input->post("text_User_Tempatlahir");
            $User_TanggalLahirDD = $this->input->post("text_User_TanggalLahirDD");
            $User_TanggalLahirMM = $this->input->post("spinner_User_TanggalLahir");
            $User_TanggalLahirYYYY = $this->input->post("text_User_TanggalLahirYYYY");

            $User_IdProvinsi = $this->input->post("spinner_User_Provinsi");
            $User_IdKota = $this->input->post("spinner_User_Kota");
            $User_IdKecamatan = $this->input->post("spinner_User_Kecamatan");
            $User_IdKelurahan = $this->input->post("spinner_User_Kelurahan");
            $User_AlamatLengkap = $this->input->post("text_User_AlamatLengkap");

            $User_Kontak = $this->input->post("text_User_Kontak");
            $User_Email = $this->input->post("text_User_Email");
            $User_NomorKTP = $this->input->post("text_User_NomorKTP");

            $data = $this->m_saksi->UpdateProfile(
                $User_ID,
                $User_NamaDepan, $User_NamaBelakang, $User_JenisKelamin,
                $User_TempatLahir, $User_TanggalLahirDD, $User_TanggalLahirMM, $User_TanggalLahirYYYY,
                $User_IdProvinsi, $User_IdKota, $User_IdKecamatan, $User_IdKelurahan, $User_AlamatLengkap,
                $User_Kontak, $User_Email, $User_NomorKTP
            );

            if ($data["Response_ID"] == "0")
            {
                $this->load->view('a_saksiEdit');

                echo '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/snackbar/dist/snackbar.css" />';
                echo '<script src="'.base_url().'assets/snackbar/dist/snackbar.min.js"></script>';
                echo '
                  <script type="text/javascript">
                      window.onload = function ()
                      {
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
            }
            else
            {
                $this->load->helper('url');
                redirect('Admin/DbSaksiPerindoAll');
            }
        }

        function hasLetter($x)
        {
            if (preg_match("/[\p{L}]/u",$x))
            {
                return true;
            }
            return false;
        }

        function hasNumber($x)
        {
            if (preg_match("/[\p{N}]/u",$x))
            {
                return true;
            }
            return false; 
        }

    ###
    }

?>
