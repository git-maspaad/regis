<?php

  $User_ID = $this->uri->segment('3');
  if ($User_ID == NULL)
  {
      $User_ID = "0";
  }

  $this->m_saksi->GetAccount($User_ID);

?>
