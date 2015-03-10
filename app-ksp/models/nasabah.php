<?php
class Nasabah extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getDetail($kode)
    {
        $query = $this->db->join('keanggotaan', 'nasabah.keanggotaan_id=keanggotaan.id');
        $query = $this->db->where('nasabah.kode', $kode);
    	$query = $this->db->get('nasabah');
        return $query->result();
    }
}