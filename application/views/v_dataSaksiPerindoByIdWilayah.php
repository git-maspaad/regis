<?php

  $IdWilayah = $this->uri->segment('3');
  if ($IdWilayah == NULL)
  {
      $IdWilayah = "0";
  }

  $this->m_saksi->ListDataSaksiPerindoByIdWilayah($IdWilayah);

?>
