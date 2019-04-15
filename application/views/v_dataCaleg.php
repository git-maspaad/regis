<?php

    $IdTipeCaleg = $this->uri->segment('3');
    if ($IdTipeCaleg == NULL)
    {
        $IdTipeCaleg = "0";
    }

    $IdPartai = "9";
    
    $this->m_caleg->ListCalegByTipe($IdTipeCaleg, $IdPartai);

?>