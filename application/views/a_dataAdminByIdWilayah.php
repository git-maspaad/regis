<?php

  $IdWilayah = $this->uri->segment('3');
  if ($IdWilayah == NULL)
  {
      $IdWilayah = "0";
  }

  $this->m_admin->ListDataAdminByIdWilayah_v2($IdWilayah);

?>