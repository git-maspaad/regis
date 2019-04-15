<?php

  $IdProvinsi = @$_SESSION["User_IdProvinsi"];
  if ($IdProvinsi == NULL)
  {
      $IdProvinsi = "0";
  }

  $this->m_wilayah->GetKota($IdProvinsi);

?>
