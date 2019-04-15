<?php

  $IdCaleg = $this->uri->segment('3');
  if ($IdCaleg == NULL)
  {
      $IdCaleg = "0";
  }

  $this->m_caleg->GetCalegForEdit($IdCaleg);

?>