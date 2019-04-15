<?php

  $IdDapil = $this->uri->segment('3');
  if ($IdDapil == NULL)
  {
      $IdDapil = "0";
  }

  $this->m_dapil->GetDapil($IdDapil);

?>