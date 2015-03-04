<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("mdb");
		$this->load->model("keanggotaan");
		$this->load->helper("form");
		$this->load->helper("date");
		$this->load->library('export');
		$this->load->library('form_validation');
		// $this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$this->nasabah();
	}

	private function _template($page,$data='')
	{
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view($page,$data);
		$this->load->view('template/script');
	}

	private function _add($page)
	{
		$this->_template($page.'/tambah_'.$page);
	}

	private function _edit($page,$id)
	{
		$data[$page]=$this->mdb->getTable($page,$id);
		$this->_template($page.'/edit_'.$page,$data);
	}

	private function _delete($page,$id)
	{
		$this->mdb->delete($page,$id);
		redirect('main/'.$page);
	}
	
	function login(){
		if($this->session->userdata('logged_in')==TRUE) redirect('main/index');
		if(isset($_POST['username'])&&isset($_POST['password'])){
        $datalogin=array(
            'username'=>$_POST['username'],
            'password'=>md5($_POST['password'])
            );
        $cek=$this->mdb->check_login($datalogin);
        if($cek){
			foreach($cek as $row);
			$nama=$row->nama;
			$id=$row->id;
			$level=$row->level;
            $this->session->set_userdata(array(
                'username'=>$_POST['username'],
				'nama'=>$nama,
				'id'=>$id,
				'level'=>$level,
                'logged_in'=>TRUE
                ));
            redirect('main/index','refresh');
        }else{
            echo "<script>alert('Username atau password salah')</script>";
        }

    }
		$this->load->view('template/head');
		$this->load->view('login');
		$this->load->view('template/script');
	}

	function logout($page='logout')
	{
    	$this->session->sess_destroy();
    	redirect('main/login','refresh');
	}

	public function nasabah($action='', $id='')
	{
		if($this->session->userdata('logged_in')!=TRUE) redirect('main/logout');
		if($this->input->is_ajax_request()/*||$this->input->get('data')*/)
		{
			$this->output->enable_profiler(FALSE);
			$this->load->library('datatables');
	        $this->datatables->select('id, kode, nama, departemen, tgl_masuk');
	        $this->datatables->from('nasabah');
	        $this->datatables->add_column('Action_data', anchor('main/nasabah/edit/$1','EDIT','class="btn btn-warning btn-mini hidden-print"').
	        	anchor('main/nasabah/delete/$1','DELETE',array('class'=>'btn btn-danger btn-mini hidden-print', 'onClick'=>'return confirm(\'Apakah Anda benar-benar akan menghapus data ini?\')')), 'id');
	        $this->datatables->add_column('Action_Simpan/pinjam',
	        	anchor('main/simpanan/add?kode=$1', 'SIMPAN','class="btn btn-success btn-mini hidden-print"').' '.
	        	anchor('main/simpanan/ambil?kode=$1', 'AMBIL','class="btn btn-info btn-mini hidden-print"').' '.
	        	anchor('main/pinjaman/add?kode=$1', 'PINJAM','class="btn btn-default btn-mini hidden-print"').' '.
	        	anchor('main/pinjaman/bayar?kode=$1', 'BAYAR','class="btn btn-inverse btn-mini hidden-print"')
	        	,'kode');
	        echo $this->datatables->generate();
		}
		else
		{
			$this->form_validation->set_rules('nama', 'Nama anggota', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
			$this->form_validation->set_rules('hp', 'HP', 'trim');
			$this->form_validation->set_rules('keanggotaan_id', 'Keanggotaan', 'trim|required');
			$this->form_validation->set_rules('tgl_masuk', 'Tanggal masuk', 'trim|required');
			$this->form_validation->set_message('required', 'Harus diisi.');
			$this->form_validation->set_message('is_unique', 'Sudah ada didatabase.');

			switch ($action) 
			{
				case 'add':
					$this->form_validation->set_rules('kode', 'Kode anggota', 'trim|required|is_unique[nasabah.kode]');
					if ($this->form_validation->run() == FALSE)
					{
						$this->_add('nasabah');
					}
					else
					{
						$this->mdb->add_nasabah();
						redirect('main/nasabah');
					}
					break;
				case 'edit':
					$this->form_validation->set_rules('kode', 'Kode anggota', 'trim|required|is_unique[nasabah.kode.id.'.$id.']');
					if ($this->form_validation->run() == FALSE)
					{
						$this->_edit('nasabah',$id);
					}
					else
					{
						$this->mdb->edit_nasabah($id);
						redirect('main/nasabah');
					}
					break;
				case 'delete':
					$this->_delete('nasabah',$id);
					break;
				default:
					$this->_template('nasabah/nasabah');
					break;
			}
		}
	}

	public function keanggotaan($action='', $id='')
	{
		if($this->session->userdata('logged_in')!=TRUE) redirect('main/logout');
		if($this->input->is_ajax_request()/*||$this->input->get('data')*/)
		{
			$this->output->enable_profiler(FALSE);
			$this->load->library('datatables');
	        $this->datatables->select('id, jenis, bunga_simpanan, denda_pinjaman, keterangan');
	        $this->datatables->from('keanggotaan');
	        $this->datatables->add_column('Action_data', anchor('main/keanggotaan/edit/$1','EDIT','class="btn btn-warning btn-mini hidden-print"').
	        	anchor('main/keanggotaan/delete/$1','DELETE',array('class'=>'btn btn-danger btn-mini hidden-print', 'onClick'=>'return confirm(\'Apakah Anda benar-benar akan menghapus data ini?\')')), 'id');
	        echo $this->datatables->generate();
		}
		else
		{
			$this->form_validation->set_rules('nama', 'Nama anggota', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
			$this->form_validation->set_rules('hp', 'HP', 'trim');
			$this->form_validation->set_rules('keanggotaan_id', 'Keanggotaan', 'trim|required');
			$this->form_validation->set_rules('tgl_masuk', 'Tanggal masuk', 'trim|required');
			$this->form_validation->set_message('required', 'Harus diisi.');
			$this->form_validation->set_message('is_unique', 'Sudah ada didatabase.');

			switch ($action) 
			{
				case 'add':
					$this->form_validation->set_rules('kode', 'Kode anggota', 'trim|required|is_unique[keanggotaan.kode]');
					if ($this->form_validation->run() == FALSE)
					{
						$this->_add('keanggotaan');
					}
					else
					{
						$this->mdb->add_nasabah();
						redirect('main/keanggotaan');
					}
					break;
				case 'edit':
					$this->form_validation->set_rules('kode', 'Kode anggota', 'trim|required|is_unique[keanggotaan.kode.id.'.$id.']');
					if ($this->form_validation->run() == FALSE)
					{
						$this->_edit('keanggotaan',$id);
					}
					else
					{
						$this->mdb->edit_nasabah($id);
						redirect('main/keanggotaan');
					}
					break;
				case 'delete':
					$this->_delete('keanggotaan',$id);
					break;
				default:
					$this->_template('keanggotaan/keanggotaan');
					break;
			}
		}
	}

	public function simpanan($action='', $id='')
	{
		if($this->session->userdata('logged_in')!=TRUE) redirect('main/logout');
		if($this->input->is_ajax_request())
		{
			$this->output->enable_profiler(FALSE);
			$this->load->library('datatables');

	        if($this->input->get('jenis')) $this->datatables->where('simpanan.jenis', $this->input->get('jenis'));
	        if($this->input->get('per')) $this->datatables->where('DATE_FORMAT(simpanan.tanggal, "%Y-%m") =', $this->input->get('per'));

	        $this->datatables->select('nasabah.kode, nasabah.nama, simpanan.tanggal, simpanan.jumlah, simpanan.id, FORMAT(sum(simpanan.jumlah), 0) as jumlah', FALSE);
	        $this->datatables->from('nasabah');

	        $this->datatables->join('(select * from simpanan order by tanggal desc) as simpanan','simpanan.kode_nasabah=nasabah.kode');
	        $this->datatables->group_by('simpanan.kode_nasabah');
	        // $this->datatables->where('simpanan.kode_nasabah');
	        $this->datatables->edit_column('nasabah.nama', anchor('main/simpanan/detail/$1','$2'), 'nasabah.kode, nasabah.nama');
	        $this->datatables->edit_column('simpanan.jumlah', '<div style="text-align:right;">$1</div>', 'simpanan.jumlah');
	        $this->datatables->edit_column('simpanan.id', anchor('main/simpanan/add?kode=$1','SIMPAN','class="btn btn-success btn-mini hidden-print"').' '.anchor('main/simpanan/ambil?kode=$1','AMBIL','class="btn btn-info btn-mini hidden-print"'), 'nasabah.kode');
	        echo $this->datatables->generate();
		}
		else
		{

			switch ($action) 
			{
				case 'add':
					$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
					$this->form_validation->set_rules('jenis', 'Jenis Simpanan', 'trim|required');
					$this->form_validation->set_rules('nominal', 'Nominal', 'trim|required');
					if ($this->form_validation->run() == FALSE)
					{
						$this->_add('simpanan');
					}
					else
					{
						$kode = $this->input->post('kode_nasabah');
						$this->mdb->add_simpanan();
						redirect('main/simpanan/detail/'.$kode);
					}
					break;
				case 'detail':
					$data['kode'] = $id;
					$this->_template('simpanan/detail_simpanan',$data);
					break;
				case 'ambil':
					$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
					$this->form_validation->set_rules('nominal', 'Nominal', 'trim|required');
					if ($this->form_validation->run() == FALSE)
					{
						$this->_template('simpanan/ambil_simpanan');
					}
					else
					{
						$this->mdb->ambil_simpanan();
						redirect('main/simpanan');
					}
					break;
				case 'laporan':
					if($this->input->get('export')){
						header("Content-type: application/vnd.ms-excel");
						header("Content-Disposition: attachment; filename=Laporan-Simpanan.xls");
						$data['simpanan'] = $this->mdb->getLaporanSimpanan();
						$this->load->view('simpanan/export',$data);
					}else{
						$this->_template('simpanan/laporan_simpanan');
					}
					break;
				case 'delete':
					$this->_delete('simpanan',$id);
					break;
				default:
					$this->_template('simpanan/simpanan');
					break;
			}
		}
	}
	
	public function pinjaman($action='', $id='')
	{
		if($this->session->userdata('logged_in')!=TRUE) redirect('main/logout');
		if($this->input->is_ajax_request())
		{
			$this->output->enable_profiler(FALSE);
			$this->load->library('datatables');
			if($this->input->get('jenis')) if($this->input->get('jenis')) $this->db->where('pinjaman.jenis', $this->input->get('jenis'));
			if($this->input->get('per')) $this->datatables->where('DATE_FORMAT(pinjaman.tanggal, "%Y-%m") =', $this->input->get('per'));
	        $this->datatables->select('nasabah.kode, nasabah.nama, pinjaman.tanggal, pinjaman.jenis, FORMAT(pinjaman.jumlah, 0) as jumlah, pinjaman.lama, pinjaman.status, pinjaman.id, nasabah.kode', FALSE);
	        $this->datatables->from('nasabah');
	        $this->datatables->join('pinjaman','pinjaman.kode_nasabah=nasabah.kode');
	        $this->datatables->edit_column('nasabah.nama', anchor('main/pinjaman/detail/$1','$2'), 'nasabah.kode, nasabah.nama');
	        $this->datatables->edit_column('jumlah', '<div style="text-align:right;">$1</div>', 'jumlah');
	        $this->datatables->edit_column('pinjaman.id', anchor('main/pinjaman/bayar?kode=$1','BAYAR','class="btn btn-info btn-mini hidden-print"'), 'nasabah.kode');
	        echo $this->datatables->generate();
		}
		else
		{
			switch ($action) 
			{
				case 'add':
					$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
					$this->form_validation->set_rules('jenis', 'Jenis Simpanan', 'trim|required');
					$this->form_validation->set_rules('nominal', 'Nominal', 'trim|required');
					$this->form_validation->set_rules('lama', 'Waktu angsuran', 'trim|required');
					if ($this->form_validation->run() == FALSE)
					{
						$this->_add('pinjaman');
					}
					else
					{
						$this->mdb->add_pinjaman();
						redirect('main/pinjaman');
					}
					break;
				case 'detail':
					$data['kode'] = $id;
					$this->_template('pinjaman/detail_pinjaman',$data);
					break;
				case 'bayar':
					$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
					$this->form_validation->set_rules('cicilan_ke', 'Nominal', 'trim|required');
					$this->form_validation->set_rules('nominal', 'Nominal', 'trim|required');
					if ($this->form_validation->run() == FALSE)
					{
						$this->_template('pinjaman/bayar_pinjaman');
					}
					else
					{
						$this->mdb->bayarPinjaman();
						redirect('main/pinjaman');
					}
					break;
				case 'delete':
					$this->_delete('pinjaman',$id);
					break;
				case 'laporan':
				if($this->input->get('export')){
						header("Content-type: application/vnd.ms-excel");
						header("Content-Disposition: attachment; filename=Laporan-Pinjaman.xls");
						$data['pinjaman'] = $this->mdb->getLaporanPinjaman();
						$this->load->view('pinjaman/export',$data);
				}else{
					$this->_template('pinjaman/laporan_pinjaman');
				}
					break;
				default:
					$this->_template('pinjaman/pinjaman');
					break;
			}
		}
	}

	public function payroll($action='', $id='')
	{
		if($this->session->userdata('logged_in')!=TRUE) redirect('main/logout');
		if($this->input->is_ajax_request())
		{
			$this->output->enable_profiler(FALSE);
			$this->load->library('datatables');
	        $this->datatables->select('nasabah.nama,nasabah.kode, FORMAT(sukarela.jumlah, 0) as sukarela, FORMAT(srplus.jumlah, 0) as srplus, FORMAT(import_temp.amount, 0) as jkt', FALSE);
	        $this->datatables->from('nasabah');
	        $this->datatables->join('(SELECT kode_nasabah, sum(jumlah) as jumlah FROM `simpanan` where jenis = "Sukarela" group by kode_nasabah) as sukarela', 'sukarela.kode_nasabah=nasabah.kode');
	        $this->datatables->join('(SELECT kode_nasabah, sum(jumlah) as jumlah FROM `simpanan` where jenis = "Surplus" group by kode_nasabah) as srplus', 'srplus.kode_nasabah=nasabah.kode');
	        $this->datatables->join('import_temp', 'import_temp.kode=nasabah.kode', 'left');
	        echo $this->datatables->generate();
		}
		else
		{

			switch ($action) 
			{
				case 'import':
					$this->_add('payroll');
					break;
				case 'upload':
					$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/assets/";
					$config['overwrite'] = true;
					$config['allowed_types'] = '*';
					$config['max_size']	= '1000000';

					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('payroll'))
					{
						$error = array('error' => $this->upload->display_errors());
						print_r($error);
						// $this->_add('payroll');
					}
					else
					{
						$data['file'] = $this->upload->data();
						$this->_template('payroll/overview', $data);
					}
					break;
				default:
					$this->_template('payroll/payroll');
					break;
			}
		}
	}


	function user()
	{
		if($this->session->userdata('logged_in')!=TRUE) redirect('main/logout');
		$data['nasabah']=$this->mdb->get('user');
		$this->_template('user',$data);
	}

	function form_user(){
		if($this->session->userdata('logged_in')!=TRUE) redirect('main/logout');
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tambah_user');
		$this->load->view('template/script');
	}

	function tambah_user(){
		if($this->session->userdata('logged_in')!=TRUE) redirect('main/logout');
		$data=array('nama'=>$this->input->post('nama'),
			'level'=>$this->input->post('level'),
			'username'=>$this->input->post('username'),
			'password'=>md5($this->input->post('password'))
			);
		$status=$this->mdb->tambah_user($data);
		if($status){
			echo '<script>alert("Berhasil menambah data.");window.location="../main/user";</script>';
		}else{echo '<script>alert("Gagal menambah data.");window.location="../main/user";</script>';}
	}



	function edit_user($id){
		if($this->session->userdata('logged_in')!=TRUE || $this->session->userdata('level')!="admin") redirect('main/logout');
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$data['admin']=$this->mdb->get_user($id);
		$this->load->view('edit_user',$data);
		$this->load->view('template/script');
	}
	function edit_user_submit($id){
		if($this->session->userdata('logged_in')!=TRUE || $this->session->userdata('level')!="admin") redirect('main/logout');
		$data=array('nama'=>$this->input->post('nama'),
			'level'=>$this->input->post('level'),
			'username'=>$this->input->post('username'),
			'password'=>md5($this->input->post('password'))
			);
		$status=$this->mdb->update('user',$data,$id);
		if($status){
			echo '<script>alert("Berhasil mengedit data.");window.location="../../main/user";</script>';
		}else{echo '<script>alert("Gagal mengedit data.");window.location="../../main/user";</script>';}
		 //redirect('main/kelas');
	}
	function delete_user($id){
		if($this->session->userdata('logged_in')!=TRUE || $this->session->userdata('level')!="admin") redirect('main/logout');
		$this->mdb->delete_user($id);
		redirect('main/user');
	}

}