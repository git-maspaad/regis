<?php

    class M_agama extends CI_Model
    {
        function LoadAgama()
        {
            $result = $this->db->query(
                'SELECT
                 tbl_agama.id AS "Agama_IdAgama",
                 tbl_agama.agama AS "Agama_NamaAgama"
                 FROM
                 tbl_agama
                 ORDER BY
                 tbl_agama.agama ASC;'
            );

            $x = $result->num_rows();

            if($x >= 0)
            {
                echo '<option value="0" selected>Pilih</option>';

                foreach ($result->result() as $data)
                {
                    echo '<option value="'.$data->Agama_IdAgama.'">'.$data->Agama_NamaAgama.'</option>';
                }
            }

            return $result;
        }
    }

?>