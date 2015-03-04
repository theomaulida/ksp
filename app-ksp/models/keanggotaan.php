<?php
class Keanggotaan extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        // $this->output->enable_profiler(TRUE);
    }

    function getOptionKeanggotaan()
    {
    	$query = $this->db->get('keanggotaan');
    	$dropdown[0] = '-- Pilih Keanggotaan --';
        foreach ($query->result() as $row) {
            $dropdown[$row->id] = $row->jenis;
        }
        return $dropdown;
    }
}