<?php

  $IdKecamatan = $this->uri->segment('3');
  if ($IdKecamatan == NULL)
  {
      $IdKecamatan = "0";
  }

  $this->m_wilayah->GetKecamatan3($IdKecamatan);

?>
