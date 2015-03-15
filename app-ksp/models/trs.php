<?php
/* Automatic transaction [bunga,cicilan, denda dsb]*/
class Trs extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function addBunga()
    {
        $this->load->model('nasabah');
        $this->load->model('mdb');
        $n0 = $this->mdb->get('nasabah');
        foreach ($n0 as $key0) {
            $kode = $key0->kode;
            $cek = $this->cekBunga($kode);
            if(!$cek){
                $n1 = $this->nasabah->getDetail($kode);
                if($n1){
                    foreach ($n1 as $key1);
                    $n2 = $this->mdb->getSaldoTerakhir($kode);
                    if($n2){
                        foreach ($n2 as $key2);
                        if($key1->keanggotaan_id=="1" && $key2->saldo>=1000000){ //bunga masyarakat setelah simpanan > 1jt
                            $bunga = ($key1->bunga_simpanan/100)*$key2->saldo;
                            $this->insertBunga($kode, $bunga);
                        }
                        else if($key1->keanggotaan_id=="2" && $this->cekSimpananPokok($kode)){ //bunga anggota setelah ada simpanan pokok
                            $bunga = ($key1->bunga_simpanan/100)*$key2->saldo;
                            $this->insertBunga($kode, $bunga);
                        }
                    }
                }
            }   
        }
        $this->db->update('preference',array('value'=>date('Y-m-d')),'attr = "last_check_bunga"');
    }

    function insertBunga($kode, $bunga)
    {
        $this->kode_nasabah = $kode;
        $this->tanggal = date('Y-m').'-01';
        $this->jenis = 'Bunga';
        $this->jumlah = $bunga;
        $this->sld = '0';
        $this->created = now();
        $this->db->insert('simpanan',$this);
    }

    function cekBunga($kode){
        $this->db->where('kode_nasabah',$kode);
        $this->db->where('jenis','Bunga');
        $this->db->where('tanggal', date('Y-m').'-01');
        $query = $this->db->get('simpanan');
        return $query->result();
    }

    function cekSimpananPokok($kode){
        $this->db->where('kode_nasabah',$kode);
        $this->db->where('jenis','Pokok');
        $this->db->where('date_format(tanggal, "%Y-%m") =', date('Y-m'));
        $query = $this->db->get('simpanan');
        return $query->result();
    }

    function last_check_bunga()
    {
        $this->db->where('attr','last_check_bunga');
        $query = $this->db->get('preference');
        foreach ($query->result() as $key);
        if(substr($key->value,0,7) == date('Y-m')){
            return 1;
        }else{
            return 0;
        }
    }

    function getCicilan($kode, $cicilan_ke)
    {
        $this->db->where('kode_nasabah', $kode);
        $this->db->where('cicilan_ke', $cicilan_ke);
        $query = $this->db->get('cicilan');
        return $query->result();
    }
}