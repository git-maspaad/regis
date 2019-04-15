<?php

  $IdKelurahan = $this->uri->segment('3');
  if ($IdKelurahan == NULL)
  {
      $IdKelurahan = "0";
  }

  $this->m_wilayah->GetKelurahan3($IdKelurahan);

?>
