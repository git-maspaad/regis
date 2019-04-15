<?php

  $IdProvinsi = $this->uri->segment('3');
  if ($IdProvinsi == NULL)
  {
      $IdProvinsi = "0";
  }

  $this->m_wilayah->GetProvinsi4($IdProvinsi);

?>
