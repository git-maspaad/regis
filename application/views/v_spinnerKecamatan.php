<?php

  $IdProvinsi = @$_SESSION["User_IdProvinsi"];
  if ($IdProvinsi == NULL)
  {
      $IdProvinsi = "0";
  }

  $IdKota = @$_SESSION["User_IdKota"];
  if ($IdKota == NULL)
  {
      $IdKota = "0";
  }

  $this->m_wilayah->GetKecamatan($IdProvinsi, $IdKota);

?>
