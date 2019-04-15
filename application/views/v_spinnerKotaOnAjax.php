<?php

  $IdProvinsi = $this->input->post("spinner_User_Provinsi");
  $this->m_wilayah->GetKotaOnAjax($IdProvinsi);

?>
