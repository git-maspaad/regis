<?php

  $User_ID = $this->uri->segment('3');
  if ($User_ID == NULL)
  {
      $User_ID = "0";
  }

  $this->m_admin->GetAccount($User_ID);

?>
