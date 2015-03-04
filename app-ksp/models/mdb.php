<?php
class Mdb extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        // $this->output->enable_profiler(TRUE);
    }

    function check_login($data){
        $query = $this->db->get_where('user',$data);
        return $query->result();
    }

    function buatrp($angka){
        $jadi = "Rp " . number_format($angka,2,',','.');
        return $jadi;
    }

    function import($arr)
    {
        $this->db->truncate('import_temp');
        $this->db->insert_batch('import_temp', $arr);
    }

    function get_import(){
        $this->db->join('nasabah','nasabah.kode=import_temp.kode');
        $query = $this->db->get('import_temp');
        return $query->result();
    }

    function get_nasabah($kode)
    {
        $this->db->where('kode', $kode);
        $query = $this->db->get('nasabah');
        return $query->result();
    }

    function add_nasabah()
    {
        $this->kode = $this->input->post('kode');
        $this->nama = $this->input->post('nama');
        $this->alamat = $this->input->post('alamat');
        $this->hp = $this->input->post('hp');
        $this->keanggotaan_id = $this->input->post('keanggotaan_id');
        $this->departemen = $this->input->post('departemen');
        $this->tgl_masuk = $this->input->post('tgl_masuk');
        // $this->created = now();
        $this->db->insert('nasabah',$this);
    }

    function edit_nasabah($id)
    {
        $this->kode = $this->input->post('kode');
        $this->nama = $this->input->post('nama');
        $this->departemen = $this->input->post('departemen');
        $this->tgl_masuk = $this->input->post('tgl_masuk');
        $this->db->update('nasabah',$this,array('id'=>$id));
    }

    function add_simpanan()
    {
        $this->kode_nasabah = $this->input->post('kode_nasabah');

        $time = strtotime($this->input->post('tanggal'));
        $tanggal = mdate('%Y-%m-%d',$time);
        
        $this->tanggal = $tanggal;
        $this->jenis = $this->input->post('jenis');
        $this->jumlah = $this->input->post('nominal');
        $this->sld = '0';
        $this->created = now();
        $this->db->insert('simpanan',$this);
    }

    function ambil_simpanan()
    {
        $this->kode_nasabah = $this->input->post('kode_nasabah');

        $time = strtotime($this->input->post('tanggal'));
        $tanggal = mdate('%Y-%m-%d',$time);
        
        $this->tanggal = $tanggal;
        $this->jenis = 'Ambil';
        $this->jumlah = '-'.$this->input->post('nominal');
        $this->created = now();
        $this->db->insert('simpanan',$this);
    }

    function add_pinjaman()
    {
        $this->kode_nasabah = $this->input->post('kode');

        $time = strtotime($this->input->post('tanggal'));
        $tanggal = mdate('%Y-%m-%d',$time);
        
        $this->tanggal = $tanggal;
        $this->jenis = $this->input->post('jenis');
        $this->jumlah = $this->input->post('nominal');
        $this->lama = $this->input->post('lama');
        $this->status = '0';

        $this->db->insert('pinjaman',$this);
    }

    function formSimpan($kode)
    {
        $this->db->select('nasabah.kode, nasabah.nama, nasabah.departemen, simpanan2.jumlah, simpanan2.id, simpanan2.sld as saldo', FALSE);
        $this->db->from('nasabah');
        $this->db->join('(select * from simpanan where kode_nasabah ='.$kode.' order by tanggal desc limit 1) as simpanan2','simpanan2.kode_nasabah=nasabah.kode', 'left');
        $this->db->where('nasabah.kode', $kode);
        $this->db->group_by('simpanan2.kode_nasabah');
        $query = $this->db->get();
        return $query->result();
    }

    function formPinjam($kode)
    {
        $query = $this->db->select('nasabah.*, pinjaman.id as pinjaman_id, pinjaman.lama as pinjaman_lama, pinjaman.status as pinjaman_status');
        $query = $this->db->where('nasabah.kode', $kode);
        $query = $this->db->from('nasabah');
        $query = $this->db->join('pinjaman', 'nasabah.kode=pinjaman.kode_nasabah', 'left');
        $query = $this->db->get();
        
        return $query->result();
    }

    function getSaldoTerakhir($kode)
    {
        $this->db->select('nasabah.kode, nasabah.nama, nasabah.departemen, simpanan2.jumlah, simpanan2.id, simpanan2.sld as saldo', FALSE);
        $this->db->from('nasabah');
        $this->db->join('(select * from simpanan where kode_nasabah ='.$kode.' order by tanggal desc limit 1) as simpanan2','simpanan2.kode_nasabah=nasabah.kode');
        $this->db->where('simpanan2.kode_nasabah', $kode);
        $this->db->group_by('simpanan2.kode_nasabah');
        $query = $this->db->get();
        return $query->result();
    }

    function preSaldo($kode, $periode)
    {
        $query = $this->db->select('sum(simpanan.jumlah) as saldo');
        $query = $this->db->where('nasabah.kode',$kode);
        $query = $this->db->where('simpanan.tanggal <',$periode.'-01');
        $query = $this->db->from('nasabah');
        $query = $this->db->join('simpanan','simpanan.kode_nasabah=nasabah.kode');
        $query = $this->db->group_by('simpanan.kode_nasabah');
        $query = $this->db->get();

        foreach ($query->result() as $row);
        $return = ($row->saldo) ? $row->saldo : 0 ;
        return $return;
    }

    function getDetailSimpanan($kode,$per='')
    {
        $periode = '';
        $presaldo = 0;
        // $bunga = 0.0075;
        if($per)
            {
                $presaldo = $this->preSaldo($kode,$per);
                $periode = 'and DATE_FORMAT(tanggal, "%Y-%m") = "'.$per.'"';
            }
        $query = $this->db->query(
            'SELECT `nasabah`.*, `simpanan`.`jenis`, `simpanan`.`tanggal`, `simpanan`.`jumlah`, `simpanan`.`id`, @Balance := @Balance + `simpanan`.`jumlah` AS `saldo` 
            FROM (`nasabah`,(SELECT @Balance := '.$presaldo.') AS variableInit) JOIN `simpanan` ON `simpanan`.`kode_nasabah`=`nasabah`.`kode` 
            WHERE `nasabah`.`kode` =  '.$kode.' '.$periode.' 
            ORDER BY simpanan.tanggal');

        $data = array();
        foreach ($query->result() as $k) 
        {
            array_push($data, array('id'=>$k->id, 'sld'=>$k->saldo));
        }
        $this->db->update_batch('simpanan', $data, 'id'); 
        return $query->result();
    }

    function getPeriodeSimpanan($kode='')
    {
        if($kode!='')
        {
            $where='where `kode_nasabah`='.$kode;
        } 
        else
        {
            $where = '';
        }
        $query = $this->db->query('SELECT DATE_FORMAT(tanggal, "%Y-%m") as ukey, DATE_FORMAT(tanggal, "%M %Y") as periode  FROM `simpanan` '.$where.' order by tanggal asc');
        $dropdown[''] = '-- Semua --';
        foreach ($query->result() as $row) {
            $dropdown[$row->ukey] = $row->periode;
        }
        return $dropdown;
    }

    function getPeriodePinjaman()
    {
        $query = $this->db->query('SELECT DATE_FORMAT(tanggal, "%Y-%m") as ukey, DATE_FORMAT(tanggal, "%M %Y") as periode  FROM `pinjaman` order by tanggal asc');
        $dropdown[''] = '-- Semua --';
        foreach ($query->result() as $row) {
            $dropdown[$row->ukey] = $row->periode;
        }
        return $dropdown;
    }

    function getLaporanSimpanan()
    {
        if($this->input->get('jenis')) $this->db->where('simpanan.jenis', $this->input->get('jenis'));
        if($this->input->get('per')) $this->db->where('DATE_FORMAT(simpanan.tanggal, "%Y-%m") =', $this->input->get('per'));

        $this->db->select('nasabah.kode, nasabah.nama, simpanan.tanggal, simpanan.jumlah, simpanan.id, FORMAT(sum(simpanan.jumlah), 0) as jumlah', FALSE);
        $this->db->from('nasabah');

        $this->db->join('(select * from simpanan order by tanggal desc) as simpanan','simpanan.kode_nasabah=nasabah.kode');
        $this->db->group_by('simpanan.kode_nasabah');
        $query = $this->db->get();
        return $query->result();
    } 

    function getLaporanPinjaman()
    {
        if($this->input->get('jenis')) $this->db->where('pinjaman.jenis', $this->input->get('jenis'));
        if($this->input->get('per')) $this->db->where('DATE_FORMAT(pinjaman.tanggal, "%Y-%m") =', $this->input->get('per'));
        $this->db->select('nasabah.kode, nasabah.nama, pinjaman.tanggal, pinjaman.jenis, FORMAT(pinjaman.jumlah, 0) as jumlah, pinjaman.lama, pinjaman.status, pinjaman.id, nasabah.kode', FALSE);
        $this->db->from('nasabah');
        $this->db->join('pinjaman','pinjaman.kode_nasabah=nasabah.kode');
        $query = $this->db->get();
        return $query->result();
    }

    function getDetailJenis($kode)
    {
        $this->db->select('jenis, sum(jumlah) as total');
        $this->db->where('kode_nasabah', $kode);
        $this->db->group_by('jenis');
        $query = $this->db->get('simpanan');

        return $query->result();
    }

    function getPinjaman($id)
    {
        $this->db->select('*');
        $this->db->where('pinjaman.kode_nasabah', $id);
        $this->db->join('nasabah', 'nasabah.kode=pinjaman.kode_nasabah');
        $query = $this->db->get('pinjaman');
        
        return $query->result();
    }

    function bayarPinjaman()
    {
        $this->kode_nasabah = $this->input->post('kode_nasabah');
        $this->cicilan_ke = $this->input->post('cicilan_ke');
        $this->jumlah = $this->input->post('nominal');

        $time = strtotime($this->input->post('tanggal'));
        $tanggal = mdate('%Y-%m-%d',$time);
        $this->tanggal = $tanggal;

        $this->db->insert('cicilan', $this);
        $this->setStatusPinjaman($this->kode_nasabah, $this->cicilan_ke);
    }

    function setStatusPinjaman($kode, $ke)
    {
        $this->db->where('kode_nasabah', $kode);
        $this->db->where('status !=', 'LUNAS');
        $this->db->update('pinjaman', array('status'=>$ke));
    }

  
    function tambah_user($data){
        $status=$this->db->insert('user',$data);
        return $status;
    }
 
    function get($tabel){
        $query=$this->db->get($tabel);
        return $query->result();
    }

    function getTable($table,$id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($table);
    	return $query->result();
    }

    function get_user($id){
        $query=$this->db->where('id',$id);
        $query=$this->db->get('user');
        return $query->result();
    }
 
    function update($tabel,$data,$id){
        $query=$this->db->where('id',$id);
        $query=$this->db->update($tabel,$data);
        return $query;
    }
    function exportnasabah(){
    	$query=$this->db->query('SELECT n.nis,n.nama,k.nama kelas,n.saldo FROM nasabah n  join kelas k on k.id=n.id_kelas');
    	return $query;
    }
    function delete_nasabah($id){
    	$this->db->where('id',$id);
    	$this->db->delete('nasabah');
    }
    function delete($page, $id){
        $this->db->where('id',$id);
        $this->db->delete($page);
    }
    function delete_user($id){
        $this->db->where('id',$id);
        $this->db->delete('user');
    }
   
}