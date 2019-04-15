<?php

  $IdKota = $this->uri->segment('3');
  if ($IdKota == NULL)
  {
      $IdKota = "0";
  }

  $this->m_wilayah->GetProvinsi5($IdKota);

?>
