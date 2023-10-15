<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Database_spk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth'); 
		$this->load->model('Model_spk');
		$this->load->library('Pitih');


		if ((!$this->ion_auth->logged_in()) and (!$this->ion_auth->in_group(array(1, 2), FALSE, TRUE))) {
			$this->session->set_flashdata('msg_danger', 'Anda Harus Login Sebagai Arsitek, Admin, Akuntan, Atau Owner untuk Mengakses Halaman ini!');
			redirect('Auth/login');
		}

		$this->db->query("SET SESSION sql_mode = ''");
	}


	public function index()  
{   
    //function mengambil dan menampilkan data 
	
    //pindahkan variable $data ke form yang ingin di tampilkan
    $this->load->view('t/top'); 
    $this->load->view('index/index');
    $this->load->view('t/bottom');
}

public function perumahan()
	{ 

		$data['tampil'] = $this->Model_spk->getPerumahan();
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['script'] = 'perumahan';
		
		$this->load->view('t/top');
		$this->load->view('perumahan/content', $data);
		$this->load->view('t/bottom');
	}

    public function perumahan_opname()
	{ 

		$data['tampil'] = $this->Model_spk->getPerumahan();
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['script'] = 'perumahan';
		
		$this->load->view('t/top');
		$this->load->view('perumahan/content_opname', $data);
		$this->load->view('t/bottom');
	}

    public function perumahan_adendum()
	{ 

		$data['tampil'] = $this->Model_spk->getPerumahan();
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['script'] = 'perumahan';
		
		$this->load->view('t/top');
		$this->load->view('perumahan/content_adendum', $data);
		$this->load->view('t/bottom');
	}

    public function perumahan_spmb()
	{ 

		$data['tampil'] = $this->Model_spk->getPerumahan();
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['script'] = 'perumahan';
		
		$this->load->view('t/top');
		$this->load->view('perumahan/content_spmb', $data);
		$this->load->view('t/bottom');
	}

    public function perumahan_pen_hari()
	{ 

		$data['tampil'] = $this->Model_spk->getPerumahan();
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['script'] = 'perumahan';
		
		$this->load->view('t/top');
		$this->load->view('perumahan/content_pen_hari', $data);
		$this->load->view('t/bottom');
	}
    

// public function data_spk()  
// {   
  
// 	$data['tampil'] = $this->Model_spk->getSpk();
// 	 // datatables
// 	$data['script'] = 'data_spk';
// 	$data['ion_auth'] = $this->ion_auth->user()->row();
	
   
//     $this->load->view('t/top');
//     $this->load->view('data_spk/content',$data);
//     $this->load->view('t/bottom');
// }

public function input_spk_rumah()
{   
  
		$data['tampil_perumahan'] = $this->Model_spk->getPerumahan();
		$data['tampil_blok'] = $this->Model_spk->getBlok();
		$dt['script'] = 'input_spk_rumah';
		$db['style'] = 'input_spk_rumah';


		$this->load->view('t/top',$dt);
		$this->load->view('input_spk_rumah/content', $data);
		$this->load->view('t/bottom', $db);
}

public function simpan_spk1()  
{   
	
	
	$nama_perumahan = $this->input->post('nama_perumahan');
	$blok_spk = $this->input->post('blok_spk');
	$type = $this->input->post('type');
	$nilai_borongan = intval(preg_replace('/\D/', '', $this->input->post("nilai_borongan")));
	$tanggal_pengajuan_spk = $this->input->post('tanggal_pengajuan_spk');
	$tanggal_awal_spk = $this->input->post('tanggal_awal_spk');
	$tanggal_akhir_spk = $this->input->post('tanggal_akhir_spk');
	$nama_kontraktor = $this->input->post('nama_kontraktor');
	$rincian = $this->input->post('rincian');
	
	$data = array(
		
		'id_perumahan' => $nama_perumahan,
		'id_blok' => $blok_spk,		
		'type_perumahan' => $type,
		'nilai_borongan' => $nilai_borongan,
		'tanggal_pengajuan_spk' => $tanggal_pengajuan_spk,
		'tanggal_awal_spk' => $tanggal_awal_spk,
		'tanggal_akhir_spk' => $tanggal_akhir_spk,
		'rincian' => $rincian,
		'nama_kontraktor' => $nama_kontraktor
	);

	$this->Model_spk->simpanSpk($data, 'stagging_table_spk');
	$this->session->set_flashdata('msg_success', 'Berhasil disimpan.');
	redirect(base_url("Database_spk/input_spk_rumah"));
}

public function simpan_spk()
{
    // Form validation
    $this->form_validation->set_rules('nama_perumahan', 'Perumahan', 'required');
    // ... (add other form validation rules)

    // Cek validasi form
    if ($this->form_validation->run() == TRUE) {
        // Validasi berhasil

        $jenis_spk = $this->input->post('jenis_spk');
        if ($jenis_spk !== '3') {
            $id_blok = $this->input->post('blok_spk');
            $id_perumahan = $this->input->post('nama_perumahan');
            $isDataExist = $this->db->get_where("table_spk", [
                "id_blok" => $id_blok,
                "id_perumahan" => $id_perumahan,
            ])->row();

            if ($isDataExist) {
                $this->session->set_flashdata('msg_danger', 'Data sudah ada.');
                redirect(base_url('Database_spk/input_spk_rumah'));
                return;
            }
        } else {
            // Jika $jenis_spk bernilai '3', abaikan validasi $isDataExist
        }

        // Simpan data
        $this->load->model('Model_spk');
        $nilai_borongan = preg_replace('/\D/', '', $this->input->post('nilai_borongan'));
        $res = $this->Model_spk->simpanSpkDimodel(
            $this->input->post('nama_perumahan'),
            $this->input->post('blok_spk'),
            $this->input->post('type'),
            $nilai_borongan,
            $this->input->post('tanggal_pengajuan_spk'),
            $this->input->post('tanggal_awal_spk'),
            $this->input->post('tanggal_akhir_spk'),
            $this->input->post('nama_kontraktor'),
            $jenis_spk,
            $this->input->post('rincian')
        );

        if ($res) {
            // Input berhasil

            // Insert ke tabel stagging_temp_koreksi_biaya_spk
            $this->db->query("INSERT INTO stagging_temp_koreksi_biaya_spk (id_stagging_table_spk,koreksi,keterangan,jumlah)SELECT '$res',koreksi,keterangan,jumlah from temp_koreksi_biaya_spk");
            
            $this->db->empty_table('temp_koreksi_biaya_spk');
            $this->session->set_flashdata('msg_success', 'Input data berhasil. Menunggu Persetujuan Owner.');
            //Jika berhasil Redirect Ke halaman Perumahan
            redirect(base_url('Database_spk/perumahan'));
        } else {
            $this->session->set_flashdata('msg_danger', 'Input data gagal.');
            //Jika Gagal Redirect Tetap berada di form Input
            redirect(base_url('Database_spk/input_spk_rumah'));
        }
    } else {
        // Validasi form gagal
        $this->session->set_flashdata('msg_danger', 'Input data gagal: ' . validation_errors());
        redirect(base_url('Database_spk/input_spk_rumah'));
    }
}
    public function edit_spk($id_table_spk)
    {


        $data['tampil_perumahan'] = $this->Model_spk->getPerumahan();
		$data['tampil_blok'] = $this->Model_spk->getBlok();

        
        $data['print'] = $this->Model_spk->getSpkDataUntukEdit($id_table_spk);
  
        $data['biaya_spk'] = $this->Model_spk->getBiayaSpk($id_table_spk);

        $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
	    $id_perumahan = $spk_data->id_perumahan;
        $data['id_perumahan'] = $id_perumahan;

        $dt['script'] = 'spk_by_perumahan';
		$db['style'] = 'spk_by_perumahan';

		$this->load->view('t/top',$dt);
		$this->load->view('spk_by_perumahan/content_tampil_edit_spk', $data);
		$this->load->view('t/bottom',$db);

    }

    public function data_temp_koreksi_edit_spk($id_table_spk)
    {
        // $data = $this->db->get('biaya_spk')->result();
        $data = $this->Model_spk->getBiayaSpkEdit($id_table_spk);
    
        echo json_encode($data);
    }

    public function simpan_temp_koreksi_edit_spk()
    {
        $save = array(
            'koreksi' => $this->input->post('koreksi'),
            'keterangan' => $this->input->post('keterangan'),
            'jumlah' => $this->input->post('jumlah')
        );
        $data = $this->Model_spk->insert_data($save, 'temp_koreksi_biaya_spk');
        echo json_encode($data);
    }

    public function hapus_temp_koreksi_edit_spk()
    {
        $id = $this->input->post('id');
        $where = array(
            'id' => $id
        );

        $data = $this->Model_spk->delete_data($where, 'temp_koreksi_biaya_spk');
        echo json_encode($data);
    }

    public function data_temp_koreksi()
    {
        $data = $this->db->get('temp_koreksi_biaya_spk')->result();
        echo json_encode($data);
    }

    public function simpan_temp_koreksi()
    {
        $save = array(
            'koreksi' => $this->input->post('koreksi'),
            'keterangan' => $this->input->post('keterangan'),
            'jumlah' => $this->input->post('jumlah')
        );
        $data = $this->Model_spk->insert_data($save, 'temp_koreksi_biaya_spk');
        echo json_encode($data);
    }

    public function hapus_temp_koreksi()
    {
        $id = $this->input->post('id');
        $where = array(
            'id' => $id
        );

        $data = $this->Model_spk->delete_data($where, 'temp_koreksi_biaya_spk');
        echo json_encode($data);
    }

    public function spk_by_perumahan($id_perumahan)
	{ 

		$data['tampil'] = $this->Model_spk->spkByPerumahan($id_perumahan);
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['script'] = 'spk_by_perumahan';
		
		$this->load->view('t/top');
		$this->load->view('spk_by_perumahan/content', $data); 
		$this->load->view('t/bottom');
	}

    public function spk_by_perumahan_opname($id_perumahan)
	{ 

		$data['tampil'] = $this->Model_spk->spkByPerumahan($id_perumahan);
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['script'] = 'spk_by_perumahan';
		
		$this->load->view('t/top');
		$this->load->view('spk_by_perumahan/content_opname', $data); 
		$this->load->view('t/bottom');
	}

    public function spk_by_perumahan_adendum($id_perumahan)
	{ 

		$data['tampil'] = $this->Model_spk->spkByPerumahan($id_perumahan);
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['script'] = 'spk_by_perumahan'; 
		
		$this->load->view('t/top');
		$this->load->view('spk_by_perumahan/content_adendum', $data); 
		$this->load->view('t/bottom');
	}

    public function spk_by_perumahan_spmb($id_perumahan)
	{ 

		$data['tampil'] = $this->Model_spk->spkByPerumahan($id_perumahan);
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['script'] = 'spk_by_perumahan';
		
		$this->load->view('t/top');
		$this->load->view('spk_by_perumahan/content_spmb', $data); 
		$this->load->view('t/bottom');
	}

    public function spk_by_perumahan_pen_hari($id_perumahan)
	{ 

		$data['tampil'] = $this->Model_spk->spkByPerumahan($id_perumahan);
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['script'] = 'spk_by_perumahan';
		
		$this->load->view('t/top');
		$this->load->view('spk_by_perumahan/content_pen_hari', $data); 
		$this->load->view('t/bottom');
	}

    public function tampil_edit_penambahan_hari($id_table_spk) 
	{
		
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['tampil'] = $this->Model_spk->getSpkPenambahanHari($id_table_spk);

		$this->load->view('t/top');
		$this->load->view('spk_by_perumahan/content_edit_penambahan_hari', $data);
		$this->load->view('t/bottom');
	}

    public function tampil_edit_penambahan_hari_view($id_table_spk) 
	{
		
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['tampil'] = $this->Model_spk->getSpkPenambahanHari($id_table_spk);

		$this->load->view('t/top');
		$this->load->view('spk_by_perumahan/content_edit_penambahan_hari_view', $data);
		$this->load->view('t/bottom');
	}

    public function edit_penambahan_hari()  
    {   
       
        $id_table_spk = $this->input->post('id_table_spk');
        $penambahan_hari = $this->input->post('penambahan_hari');
        $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
        $id_perumahan = $spk_data->id_perumahan;
        
        $data = array(
            
            'penambahan_hari' => $penambahan_hari
        );
        
        $this->Model_spk->updatePenambahanHari($data, 'table_spk',$id_table_spk);
        $this->session->set_flashdata('msg_success', 'Berhasil disimpan.');
        redirect(base_url("Database_spk/spk_by_perumahan/$id_perumahan"));
    }

   
public function simpan_penambahan_hari()  
{   
        
    
        $id_table_spk = $this->input->post("id_table_spk");
        $tgl_awal_penhari = $this->input->post("tgl_awal_penhari");
        $tgl_akhir_penhari = $this->input->post("tgl_akhir_penhari");
        $penambahan_hari = $this->input->post("penambahan_hari");
        $ket_penam_hari = $this->input->post("ket_penam_hari");

        $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
        $id_perumahan = $spk_data->id_perumahan;
  
        $data = [
        "id_table_spk" => $id_table_spk,
        "tgl_awal_penhari" => $tgl_awal_penhari,
        "tgl_akhir_penhari" => $tgl_akhir_penhari,
        "tanggal_input" => date('Y-m-d'),
        "penambahan_hari" => $penambahan_hari,
        "ket_penam_hari" => $ket_penam_hari,

        ];

        $this->db->insert("stagging_penambahan_hari_spk", $data);

        // redirect ke halaman sebelumnya dengan notifikasi
        $this->session->set_flashdata("msg_success", "Data Behasil Disimpan!");
        redirect(base_url("Database_spk/spk_by_perumahan/$id_perumahan"));
}

public function rincian_penambahan_hari($id_table_spk)
{
    $data["rincian"] = $this->Model_spk->getRincianPenambahanHari($id_table_spk);

    $this->load->view('t/top');
    $this->load->view('spmb/content_rincian_penambahan_hari', $data);
    $this->load->view('t/bottom');
}


public function print_spk($id_table_spk) 
{
    
    $data['print'] = $this->Model_spk->getSpkDataUntukPrint($id_table_spk);
  
    $data['biaya_spk'] = $this->Model_spk->getBiayaSpk($id_table_spk);
    
   

    $this->load->view('t/top');
    $this->load->view('spk_by_perumahan/content_print_spk', $data);
    $this->load->view('t/bottom');
}

public function input_opname($id_table_spk)
{   
        
		$data['tampil_perumahan_dan_blok'] = $this->Model_spk->getPerumahanDanBlokOpname($id_table_spk);
        $data['ion_auth'] = $this->ion_auth->user()->row();
        $data['id_table_spk'] = $id_table_spk;

		$spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
	    $id_perumahan = $spk_data->id_perumahan;
        $data['id_perumahan'] = $id_perumahan;


		$dt['script'] = 'input_opname';
		$db['style'] = 'input_opname';


		$this->load->view('t/top',$dt);
		$this->load->view('input_opname/content', $data);
		$this->load->view('t/bottom', $db);
}

public function input_opname_view($id_table_spk)
{   
        
		$data['tampil_perumahan_dan_blok'] = $this->Model_spk->getPerumahanDanBlokOpname($id_table_spk);
        $data['ion_auth'] = $this->ion_auth->user()->row();
        $data['id_table_spk'] = $id_table_spk;

		$spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
	    $id_perumahan = $spk_data->id_perumahan;
        $data['id_perumahan'] = $id_perumahan;


		$dt['script'] = 'input_opname';
		$db['style'] = 'input_opname';


		$this->load->view('t/top',$dt);
		$this->load->view('input_opname/content_opname_view', $data);
		$this->load->view('t/bottom', $db);
}

public function simpan_opname()
{
    $id_table_spk = $this->input->post("id_table_spk");
    $pengaju_opname = $this->input->post("pengaju_opname");
    $id_perumahan = $this->input->post("id_perumahan");
    $id_blok = $this->input->post("id_blok");
    $type = $this->input->post("type");
    $tanggal_input_opname = $this->input->post("tanggal_input_opname");
    $opini = $this->input->post("opini");
    // var_dump($opini);exit;

        if (empty($opini) 
        || empty($_FILES['foto_depan']['name']) 
        || empty($_FILES['foto_ruang_tamu']['name'])
        || empty($_FILES['foto_kamar_1']['name'])
        || empty($_FILES['foto_kamar_2']['name'])
        || empty($_FILES['foto_kamar_3']['name'])
        || empty($_FILES['foto_kamar_mandi']['name'])
        || empty($_FILES['foto_dapur']['name'])
        || empty($_FILES['foto_kiri']['name'])
        || empty($_FILES['foto_kanan']['name'])
        || empty($_FILES['foto_belakang']['name'])) {
            $this->session->set_flashdata("msg_danger", "Ada data yang tidak boleh kosong!");
            redirect(base_url("Database_spk/input_opname/$id_table_spk"));
            die();
        }

        $isDataExist = $this->db->get_where("opname_spk", [
            "id_blok" => $id_blok,
            "id_perumahan" => $id_perumahan
        ])->result();
        
        $existingOpinions = [];
        
        foreach ($isDataExist as $data) {
            // Menyimpan opini yang sudah ada berdasarkan id_table_spk
            $existingOpinions[$data->id_table_spk][] = $data->opini;
        }
            
            // Flag untuk menandakan apakah ditemukan data yang cocok
        $dataFound = false;
        
        // Pengecekan apakah terdapat data yang sesuai dengan nilai input
        foreach ($existingOpinions as $idTableSpk => $opinions) {
            if ($idTableSpk == $id_table_spk && in_array($opini, $opinions)) {
                // Data ditemukan dengan opini yang cocok
                $dataFound = true;
                $this->session->set_flashdata("msg_danger", "Data sudah ada.");
                redirect(base_url("Database_spk/input_opname/$id_table_spk"));
                die(); // Menghentikan eksekusi lebih lanjut
            }
        }
            
        if ($dataFound) {
            $this->session->set_flashdata("msg_danger", "Data ini sudah ada.");
            redirect(base_url("Database_spk/input_opname/$id_table_spk"));
            die(); // Menghentikan eksekusi lebih lanjut
        }
                // Data tidak ditemukan dengan opini yang cocok
             
    
        // Mengambil nama file foto dari inputan
        $foto_depan = $_FILES["foto_depan"]["name"];
        $foto_ruang_tamu = $_FILES["foto_ruang_tamu"]["name"];
        $foto_kamar_1 = $_FILES["foto_kamar_1"]["name"];
        $foto_kamar_2 = $_FILES["foto_kamar_2"]["name"];
        $foto_kamar_3 = $_FILES["foto_kamar_3"]["name"];
        $foto_kamar_mandi = $_FILES["foto_kamar_mandi"]["name"];
        $foto_dapur = $_FILES["foto_dapur"]["name"];
        $foto_kiri = $_FILES["foto_kiri"]["name"];
        $foto_kanan = $_FILES["foto_kanan"]["name"];
        $foto_belakang = $_FILES["foto_belakang"]["name"];

        // Konfigurasi upload foto depan
        $config['upload_path']   = './upload_spk/foto_opname';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2000;

        $this->load->library('upload', $config);

        // Upload foto depan
    if (!$this->upload->do_upload('foto_depan')) {
        $this->session->set_flashdata("msg_danger", "Foto Depan Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_depan = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_ruang_tamu')) {
        $this->session->set_flashdata("msg_danger", "Foto Ruang Tamu Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_ruang_tamu = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kamar_1')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 1 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_kamar_1 = $this->upload->data('file_name');
    }
    
    if (!$this->upload->do_upload('foto_kamar_2')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 2 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_kamar_2 = $this->upload->data('file_name');
    }
    
    if (!$this->upload->do_upload('foto_kamar_3')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 3 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_kamar_3 = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kamar_mandi')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar Mandi Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_kamar_mandi = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_dapur')) {
        $this->session->set_flashdata("msg_danger", "Foto Dapur Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_dapur = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kiri')) {
        $this->session->set_flashdata("msg_danger", "Foto Kiri Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_kiri = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kanan')) {
        $this->session->set_flashdata("msg_danger", "Foto Kanan Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_kanan = $this->upload->data('file_name');
    }

        // Upload foto belakang
    if (!$this->upload->do_upload('foto_belakang')) {
        
        $this->session->set_flashdata("msg_danger", "Foto Belakang Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
    } else {
        $foto_belakang = $this->upload->data('file_name');
    }

    $data = [
        "id_table_spk" => $id_table_spk,
        "pengaju_opname" => $pengaju_opname,
        "id_perumahan" => $id_perumahan,
        "id_blok" => $id_blok,
        "type" => $type,
        "tanggal_input_opname" => $tanggal_input_opname,
        "opini" => $opini,
        "foto_depan" => $foto_depan,
        "foto_ruang_tamu" => $foto_ruang_tamu,
        "foto_kamar_1" => $foto_kamar_1,
        "foto_kamar_2" => $foto_kamar_2,
        "foto_kamar_3" => $foto_kamar_3,
        "foto_kamar_mandi" => $foto_kamar_mandi,
        "foto_dapur" => $foto_dapur,
        "foto_kiri" => $foto_kiri,
        "foto_kanan" => $foto_kanan,
        "foto_belakang" => $foto_belakang
    ];

    $this->db->insert("stagging_opname_spk", $data);
    $this->session->set_flashdata("msg_success", "Data telah berhasil disimpan.");
    redirect(base_url("Database_spk/input_opname/$id_table_spk"));

}

public function simpan_opname_view()
{
    $id_table_spk = $this->input->post("id_table_spk");
    $pengaju_opname = $this->input->post("pengaju_opname");
    $id_perumahan = $this->input->post("id_perumahan");
    $id_blok = $this->input->post("id_blok");
    $type = $this->input->post("type");
    $tanggal_input_opname = $this->input->post("tanggal_input_opname");
    $opini = $this->input->post("opini");
    // var_dump($opini);exit;

        if (empty($opini) 
        || empty($_FILES['foto_depan']['name']) 
        || empty($_FILES['foto_ruang_tamu']['name'])
        || empty($_FILES['foto_kamar_1']['name'])
        || empty($_FILES['foto_kamar_2']['name'])
        || empty($_FILES['foto_kamar_3']['name'])
        || empty($_FILES['foto_kamar_mandi']['name'])
        || empty($_FILES['foto_dapur']['name'])
        || empty($_FILES['foto_kiri']['name'])
        || empty($_FILES['foto_kanan']['name'])
        || empty($_FILES['foto_belakang']['name'])) {
            $this->session->set_flashdata("msg_danger", "Ada data yang tidak boleh kosong!");
            redirect(base_url("Database_spk/input_opname_view/$id_table_spk"));
            die();
        }

        $isDataExist = $this->db->get_where("opname_spk", [
            "id_blok" => $id_blok,
            "id_perumahan" => $id_perumahan
        ])->result();
        
        $existingOpinions = [];
        
        foreach ($isDataExist as $data) {
            // Menyimpan opini yang sudah ada berdasarkan id_table_spk
            $existingOpinions[$data->id_table_spk][] = $data->opini;
        }
            
            // Flag untuk menandakan apakah ditemukan data yang cocok
        $dataFound = false;
        
        // Pengecekan apakah terdapat data yang sesuai dengan nilai input
        foreach ($existingOpinions as $idTableSpk => $opinions) {
            if ($idTableSpk == $id_table_spk && in_array($opini, $opinions)) {
                // Data ditemukan dengan opini yang cocok
                $dataFound = true;
                $this->session->set_flashdata("msg_danger", "Data sudah ada.");
                redirect(base_url("Database_spk/input_opname_view/$id_table_spk"));
                die(); // Menghentikan eksekusi lebih lanjut
            }
        }
            
        if ($dataFound) {
            $this->session->set_flashdata("msg_danger", "Data ini sudah ada.");
            redirect(base_url("Database_spk/input_opname_view/$id_table_spk"));
            die(); // Menghentikan eksekusi lebih lanjut
        }
                // Data tidak ditemukan dengan opini yang cocok
             
    
        // Mengambil nama file foto dari inputan
        $foto_depan = $_FILES["foto_depan"]["name"];
        $foto_ruang_tamu = $_FILES["foto_ruang_tamu"]["name"];
        $foto_kamar_1 = $_FILES["foto_kamar_1"]["name"];
        $foto_kamar_2 = $_FILES["foto_kamar_2"]["name"];
        $foto_kamar_3 = $_FILES["foto_kamar_3"]["name"];
        $foto_kamar_mandi = $_FILES["foto_kamar_mandi"]["name"];
        $foto_dapur = $_FILES["foto_dapur"]["name"];
        $foto_kiri = $_FILES["foto_kiri"]["name"];
        $foto_kanan = $_FILES["foto_kanan"]["name"];
        $foto_belakang = $_FILES["foto_belakang"]["name"];

        // Konfigurasi upload foto depan
        $config['upload_path']   = './upload_spk/foto_opname';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2000;

        $this->load->library('upload', $config);

        // Upload foto depan
    if (!$this->upload->do_upload('foto_depan')) {
        $this->session->set_flashdata("msg_danger", "Foto Depan Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_view/$id_table_spk")); die();
       
    } else {
        $foto_depan = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_ruang_tamu')) {
        $this->session->set_flashdata("msg_danger", "Foto Ruang Tamu Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_view/$id_table_spk")); die();
       
    } else {
        $foto_ruang_tamu = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kamar_1')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 1 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_view/$id_table_spk")); die();
       
    } else {
        $foto_kamar_1 = $this->upload->data('file_name');
    }
    
    if (!$this->upload->do_upload('foto_kamar_2')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 2 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_view/$id_table_spk")); die();
       
    } else {
        $foto_kamar_2 = $this->upload->data('file_name');
    }
    
    if (!$this->upload->do_upload('foto_kamar_3')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 3 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_view/$id_table_spk")); die();
       
    } else {
        $foto_kamar_3 = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kamar_mandi')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar Mandi Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_view/$id_table_spk")); die();
       
    } else {
        $foto_kamar_mandi = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_dapur')) {
        $this->session->set_flashdata("msg_danger", "Foto Dapur Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_view/$id_table_spk")); die();
       
    } else {
        $foto_dapur = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kiri')) {
        $this->session->set_flashdata("msg_danger", "Foto Kiri Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_view/$id_table_spk")); die();
       
    } else {
        $foto_kiri = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kanan')) {
        $this->session->set_flashdata("msg_danger", "Foto Kanan Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_view/$id_table_spk")); die();
       
    } else {
        $foto_kanan = $this->upload->data('file_name');
    }

        // Upload foto belakang
    if (!$this->upload->do_upload('foto_belakang')) {
        
        $this->session->set_flashdata("msg_danger", "Foto Belakang Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_view/$id_table_spk")); die();
    } else {
        $foto_belakang = $this->upload->data('file_name');
    }

    $data = [
        "id_table_spk" => $id_table_spk,
        "pengaju_opname" => $pengaju_opname,
        "id_perumahan" => $id_perumahan,
        "id_blok" => $id_blok,
        "type" => $type,
        "tanggal_input_opname" => $tanggal_input_opname,
        "opini" => $opini,
        "foto_depan" => $foto_depan,
        "foto_ruang_tamu" => $foto_ruang_tamu,
        "foto_kamar_1" => $foto_kamar_1,
        "foto_kamar_2" => $foto_kamar_2,
        "foto_kamar_3" => $foto_kamar_3,
        "foto_kamar_mandi" => $foto_kamar_mandi,
        "foto_dapur" => $foto_dapur,
        "foto_kiri" => $foto_kiri,
        "foto_kanan" => $foto_kanan,
        "foto_belakang" => $foto_belakang
    ];

    $this->db->insert("stagging_opname_spk", $data);
    $this->session->set_flashdata("msg_success", "Data telah berhasil disimpan.");
    redirect(base_url("Database_spk/input_opname_view/$id_table_spk"));

}


public function input_opname_hpp($id_table_spk)
{   
        
		$data['tampil_perumahan_dan_blok'] = $this->Model_spk->getPerumahanDanBlokOpname($id_table_spk);
        $data['ion_auth'] = $this->ion_auth->user()->row();
        $data['id_table_spk'] = $id_table_spk;

		$spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
	    $id_perumahan = $spk_data->id_perumahan;
        $data['id_perumahan'] = $id_perumahan;

        //Nilai Borongan
        $table_spk = $this->db->get_where("table_spk", ["id_table_spk" => $id_table_spk])->row();
        $nilai_borongan_spk = $table_spk->nilai_borongan;
        
        //Total Biaya Adendum
        $jumlah_biaya_spk=0;
        $biaya_spk_koreksi = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 1])->row();
        $biaya_spk_pengurangan = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 2])->row();

       
        $jumlah_biaya_spk += ($biaya_spk_koreksi->jumlah ?? 0);
        $jumlah_biaya_spk -= ($biaya_spk_pengurangan->jumlah ?? 0);

        //Total Biaya Adendum
       
        $biaya_adendum_spk_koreksi = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 1])->row();
        $biaya_adendum_spk_pengurangan = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 2])->row();

        $jumlah_biaya_adendum_spk=0;
        $jumlah_biaya_adendum_spk += ($biaya_adendum_spk_koreksi->jumlah_adendum ?? 0);
        $jumlah_biaya_adendum_spk -= ($biaya_adendum_spk_pengurangan->jumlah_adendum ?? 0);
      

        //Total Denda
        $denda = $this->db->select_sum("denda")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
        $total_denda = $denda->denda;
       
        if (empty($total_denda)) {
            $total_denda = 0;
        }

        $nilai_borongan_spk_akhir= $nilai_borongan_spk+$jumlah_biaya_spk+$jumlah_biaya_adendum_spk;

        // Mengambil total pencairan dari tabel opname_hpp_spk
        $total_pencairan = $this->db->select_sum("pencairan")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
    
        $total_pencairan_spk = $total_pencairan->pencairan;

        // Menghitung selisih_spk
        $selisih_spk =$nilai_borongan_spk_akhir- $total_pencairan_spk-$total_denda;

        if($selisih_spk<0){
            $selisih_spk=0;
           }
          
        $data['selisih_spk'] = $selisih_spk;

		$dt['script'] = 'input_opname';
		$db['style'] = 'input_opname';


		$this->load->view('t/top',$dt);
		$this->load->view('input_opname/content_opname_hpp', $data);
		$this->load->view('t/bottom', $db);
}

public function input_opname_hpp_view($id_table_spk)
{   
        
		$data['tampil_perumahan_dan_blok'] = $this->Model_spk->getPerumahanDanBlokOpname($id_table_spk);
        $data['ion_auth'] = $this->ion_auth->user()->row();
        $data['id_table_spk'] = $id_table_spk;

		$spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
	    $id_perumahan = $spk_data->id_perumahan;
        $data['id_perumahan'] = $id_perumahan;

        //Nilai Borongan
        $table_spk = $this->db->get_where("table_spk", ["id_table_spk" => $id_table_spk])->row();
        $nilai_borongan_spk = $table_spk->nilai_borongan;
        
        //Total Biaya Adendum
        $jumlah_biaya_spk=0;
        $biaya_spk_koreksi = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 1])->row();
        $biaya_spk_pengurangan = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 2])->row();

       
        $jumlah_biaya_spk += ($biaya_spk_koreksi->jumlah ?? 0);
        $jumlah_biaya_spk -= ($biaya_spk_pengurangan->jumlah ?? 0);

        //Total Biaya Adendum
       
        $biaya_adendum_spk_koreksi = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 1])->row();
        $biaya_adendum_spk_pengurangan = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 2])->row();

        $jumlah_biaya_adendum_spk=0;
        $jumlah_biaya_adendum_spk += ($biaya_adendum_spk_koreksi->jumlah_adendum ?? 0);
        $jumlah_biaya_adendum_spk -= ($biaya_adendum_spk_pengurangan->jumlah_adendum ?? 0);
      

        //Total Denda
        $denda = $this->db->select_sum("denda")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
        $total_denda = $denda->denda;
       
        if (empty($total_denda)) {
            $total_denda = 0;
        }

        $nilai_borongan_spk_akhir= $nilai_borongan_spk+$jumlah_biaya_spk+$jumlah_biaya_adendum_spk;

        // Mengambil total pencairan dari tabel opname_hpp_spk
        $total_pencairan = $this->db->select_sum("pencairan")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
    
        $total_pencairan_spk = $total_pencairan->pencairan;

        // Menghitung selisih_spk
        $selisih_spk =$nilai_borongan_spk_akhir- $total_pencairan_spk-$total_denda;

        if($selisih_spk<0){
            $selisih_spk=0;
           }
          
        $data['selisih_spk'] = $selisih_spk;

		$dt['script'] = 'input_opname';
		$db['style'] = 'input_opname';


		$this->load->view('t/top',$dt);
		$this->load->view('input_opname/content_opname_hpp_view', $data);
		$this->load->view('t/bottom', $db);
}

public function simpan_opname_hpp()
{
    $id_table_spk = $this->input->post("id_table_spk");
    $pengaju_opname = $this->input->post("pengaju_opname");
    $id_perumahan = $this->input->post("id_perumahan");
    $id_blok = $this->input->post("id_blok");
    $type = $this->input->post("type");
    $tanggal_input_opname = $this->input->post("tanggal_input_opname");
    $nilai_borongan = preg_replace('/\D/', '', $this->input->post('nilai_borongan'));
    $jenis_hpp = $this->input->post("jenis_hpp");

    //ini untuk mendapatkan nilai_borongan
    $table_spk = $this->db->get_where("table_spk", ["id_table_spk" => $id_table_spk])->row();
    $nilai_borongan_spk = $table_spk->nilai_borongan;
    
   //Total Biaya Adendum
   $jumlah_biaya_spk=0;
   $biaya_spk_koreksi = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 1])->row();
   $biaya_spk_pengurangan = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 2])->row();

  
   $jumlah_biaya_spk += ($biaya_spk_koreksi->jumlah ?? 0);
   $jumlah_biaya_spk -= ($biaya_spk_pengurangan->jumlah ?? 0);

   //Total Biaya Adendum   
   $biaya_adendum_spk_koreksi = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 1])->row();
   $biaya_adendum_spk_pengurangan = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 2])->row();

   $jumlah_biaya_adendum_spk=0;
   $jumlah_biaya_adendum_spk += ($biaya_adendum_spk_koreksi->jumlah_adendum ?? 0);
   $jumlah_biaya_adendum_spk -= ($biaya_adendum_spk_pengurangan->jumlah_adendum ?? 0);

   //Total Adendum
    $denda = $this->db->select_sum("denda")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
    $total_denda = $denda->denda;
   
    if (empty($total_denda)) {
        $total_denda = 0;
    }

    //ini untuk nilai_borongan_akhir
    $nilai_borongan_spk_akhir= $nilai_borongan_spk+$jumlah_biaya_spk+$jumlah_biaya_adendum_spk;

    // Mengambil total pencairan dari tabel opname_hpp_spk
    $total_pencairan = $this->db->select_sum("pencairan")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();

    $total_pencairan_spk = $total_pencairan->pencairan;

    // Menghitung selisih_spk
    $selisih_spk =$nilai_borongan_spk_akhir- $total_pencairan_spk-$total_denda;

   if($selisih_spk<0){
    $selisih_spk=0;
   }
    
    // Membandingkan nilai_borongan dengan selisih_spk
    if ($nilai_borongan > $selisih_spk) {
        $this->session->set_flashdata("msg_danger", "Nilai pencairan melebihi Sisa Pencairan.");
        redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk"));
        die();
    }

    if (empty($nilai_borongan) 
    || empty($_FILES['foto_depan']['name']) 
    || empty($_FILES['foto_ruang_tamu']['name'])
    || empty($_FILES['foto_kamar_1']['name'])
    || empty($_FILES['foto_kamar_2']['name'])
    || empty($_FILES['foto_kamar_3']['name'])
    || empty($_FILES['foto_kamar_mandi']['name'])
    || empty($_FILES['foto_dapur']['name'])
    || empty($_FILES['foto_kiri']['name'])
    || empty($_FILES['foto_kanan']['name'])
    || empty($_FILES['foto_belakang']['name'])) {
        $this->session->set_flashdata("msg_danger", "Ada data yang tidak boleh kosong!");
        redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk"));
        die();
    } 
       
        // Mengambil nama file foto dari inputan
        $foto_depan = $_FILES["foto_depan"]["name"];
        $foto_ruang_tamu = $_FILES["foto_ruang_tamu"]["name"];
        $foto_kamar_1 = $_FILES["foto_kamar_1"]["name"];
        $foto_kamar_2 = $_FILES["foto_kamar_2"]["name"];
        $foto_kamar_3 = $_FILES["foto_kamar_3"]["name"];
        $foto_kamar_mandi = $_FILES["foto_kamar_mandi"]["name"];
        $foto_dapur = $_FILES["foto_dapur"]["name"];
        $foto_kiri = $_FILES["foto_kiri"]["name"];
        $foto_kanan = $_FILES["foto_kanan"]["name"];
        $foto_belakang = $_FILES["foto_belakang"]["name"];

        // Konfigurasi upload foto depan
        $config['upload_path']   = './upload_spk/foto_opname';
        $config['allowed_types'] = 'gif|png|jpeg|jpg';
        $config['max_size'] = 2000;

        $this->load->library('upload', $config);

        // Upload foto depan
        if (!$this->upload->do_upload('foto_depan')) {
            // Mengambil pesan kesalahan dari aturan validasi
            $error = $this->upload->display_errors();
            
            // Menyimpan pesan kesalahan ke dalam flashdata
            $this->session->set_flashdata("msg_danger", "Foto Depan Gagal di Upload! Error: $error");
            
            // Redirect ke halaman yang sesuai
            redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk"));
            die();
        }
       
     else {
        $foto_depan = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_ruang_tamu')) {
        $this->session->set_flashdata("msg_danger", "Foto Ruang Tamu Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk")); die();
       
    } else {
        $foto_ruang_tamu = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kamar_1')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 1 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk")); die();
       
    } else {
        $foto_kamar_1 = $this->upload->data('file_name');
    }
    
    if (!$this->upload->do_upload('foto_kamar_2')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 2 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk")); die();
       
    } else {
        $foto_kamar_2 = $this->upload->data('file_name');
    }
    
    if (!$this->upload->do_upload('foto_kamar_3')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 3 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk")); die();
       
    } else {
        $foto_kamar_3 = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kamar_mandi')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar Mandi Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk")); die();
       
    } else {
        $foto_kamar_mandi = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_dapur')) {
        $this->session->set_flashdata("msg_danger", "Foto Dapur Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk")); die();
       
    } else {
        $foto_dapur = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kiri')) {
        $this->session->set_flashdata("msg_danger", "Foto Kiri Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk")); die();
       
    } else {
        $foto_kiri = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kanan')) {
        $this->session->set_flashdata("msg_danger", "Foto Kanan Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk")); die();
       
    } else {
        $foto_kanan = $this->upload->data('file_name');
    }

        // Upload foto belakang
    if (!$this->upload->do_upload('foto_belakang')) {
        
        $this->session->set_flashdata("msg_danger", "Foto Belakang Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk")); die();
    } else {
        $foto_belakang = $this->upload->data('file_name');
    }
    
    $data = [
        "id_table_spk" => $id_table_spk,
        "pengaju_opname" => $pengaju_opname,
        "id_perumahan" => $id_perumahan,
        "id_blok" => $id_blok,
        "type" => $type,
        "tanggal_input_opname" => $tanggal_input_opname,
        "pencairan" => $nilai_borongan,
        "jenis_hpp" => $jenis_hpp,
        "foto_depan" => $foto_depan,
        "foto_ruang_tamu" => $foto_ruang_tamu,
        "foto_kamar_1" => $foto_kamar_1,
        "foto_kamar_2" => $foto_kamar_2,
        "foto_kamar_3" => $foto_kamar_3,
        "foto_kamar_mandi" => $foto_kamar_mandi,
        "foto_dapur" => $foto_dapur,
        "foto_kiri" => $foto_kiri,
        "foto_kanan" => $foto_kanan,
        "foto_belakang" => $foto_belakang
    ];

    $this->db->insert("stagging_opname_hpp_spk", $data);
    $this->session->set_flashdata("msg_success", "Data telah berhasil disimpan.");
    redirect(base_url("Database_spk/input_opname_hpp/$id_table_spk"));

}

public function simpan_opname_hpp_view()
{
    $id_table_spk = $this->input->post("id_table_spk");
    $pengaju_opname = $this->input->post("pengaju_opname");
    $id_perumahan = $this->input->post("id_perumahan");
    $id_blok = $this->input->post("id_blok");
    $type = $this->input->post("type");
    $tanggal_input_opname = $this->input->post("tanggal_input_opname");
    $nilai_borongan = preg_replace('/\D/', '', $this->input->post('nilai_borongan'));
    $jenis_hpp = $this->input->post("jenis_hpp");

    //ini untuk mendapatkan nilai_borongan
    $table_spk = $this->db->get_where("table_spk", ["id_table_spk" => $id_table_spk])->row();
    $nilai_borongan_spk = $table_spk->nilai_borongan;
    
   //Total Biaya Adendum
   $jumlah_biaya_spk=0;
   $biaya_spk_koreksi = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 1])->row();
   $biaya_spk_pengurangan = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 2])->row();

  
   $jumlah_biaya_spk += ($biaya_spk_koreksi->jumlah ?? 0);
   $jumlah_biaya_spk -= ($biaya_spk_pengurangan->jumlah ?? 0);

   //Total Biaya Adendum   
   $biaya_adendum_spk_koreksi = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 1])->row();
   $biaya_adendum_spk_pengurangan = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 2])->row();

   $jumlah_biaya_adendum_spk=0;
   $jumlah_biaya_adendum_spk += ($biaya_adendum_spk_koreksi->jumlah_adendum ?? 0);
   $jumlah_biaya_adendum_spk -= ($biaya_adendum_spk_pengurangan->jumlah_adendum ?? 0);

   //Total Adendum
    $denda = $this->db->select_sum("denda")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
    $total_denda = $denda->denda;
   
    if (empty($total_denda)) {
        $total_denda = 0;
    }

    //ini untuk nilai_borongan_akhir
    $nilai_borongan_spk_akhir= $nilai_borongan_spk+$jumlah_biaya_spk+$jumlah_biaya_adendum_spk;

    // Mengambil total pencairan dari tabel opname_hpp_spk
    $total_pencairan = $this->db->select_sum("pencairan")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();

    $total_pencairan_spk = $total_pencairan->pencairan;

    // Menghitung selisih_spk
    $selisih_spk =$nilai_borongan_spk_akhir- $total_pencairan_spk-$total_denda;

   if($selisih_spk<0){
    $selisih_spk=0;
   }
    
    // Membandingkan nilai_borongan dengan selisih_spk
    if ($nilai_borongan > $selisih_spk) {
        $this->session->set_flashdata("msg_danger", "Nilai pencairan melebihi Sisa Pencairan.");
        redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk"));
        die();
    }

    if (empty($nilai_borongan) 
    || empty($_FILES['foto_depan']['name']) 
    || empty($_FILES['foto_ruang_tamu']['name'])
    || empty($_FILES['foto_kamar_1']['name'])
    || empty($_FILES['foto_kamar_2']['name'])
    || empty($_FILES['foto_kamar_3']['name'])
    || empty($_FILES['foto_kamar_mandi']['name'])
    || empty($_FILES['foto_dapur']['name'])
    || empty($_FILES['foto_kiri']['name'])
    || empty($_FILES['foto_kanan']['name'])
    || empty($_FILES['foto_belakang']['name'])) {
        $this->session->set_flashdata("msg_danger", "Ada data yang tidak boleh kosong!");
        redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk"));
        die();
    } 
       
        // Mengambil nama file foto dari inputan
        $foto_depan = $_FILES["foto_depan"]["name"];
        $foto_ruang_tamu = $_FILES["foto_ruang_tamu"]["name"];
        $foto_kamar_1 = $_FILES["foto_kamar_1"]["name"];
        $foto_kamar_2 = $_FILES["foto_kamar_2"]["name"];
        $foto_kamar_3 = $_FILES["foto_kamar_3"]["name"];
        $foto_kamar_mandi = $_FILES["foto_kamar_mandi"]["name"];
        $foto_dapur = $_FILES["foto_dapur"]["name"];
        $foto_kiri = $_FILES["foto_kiri"]["name"];
        $foto_kanan = $_FILES["foto_kanan"]["name"];
        $foto_belakang = $_FILES["foto_belakang"]["name"];

        // Konfigurasi upload foto depan
        $config['upload_path']   = './upload_spk/foto_opname';
        $config['allowed_types'] = 'gif|png|jpeg|jpg';
        $config['max_size'] = 2000;

        $this->load->library('upload', $config);

        // Upload foto depan
        if (!$this->upload->do_upload('foto_depan')) {
            // Mengambil pesan kesalahan dari aturan validasi
            $error = $this->upload->display_errors();
            
            // Menyimpan pesan kesalahan ke dalam flashdata
            $this->session->set_flashdata("msg_danger", "Foto Depan Gagal di Upload! Error: $error");
            
            // Redirect ke halaman yang sesuai
            redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk"));
            die();
        }
       
     else {
        $foto_depan = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_ruang_tamu')) {
        $this->session->set_flashdata("msg_danger", "Foto Ruang Tamu Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk")); die();
       
    } else {
        $foto_ruang_tamu = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kamar_1')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 1 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk")); die();
       
    } else {
        $foto_kamar_1 = $this->upload->data('file_name');
    }
    
    if (!$this->upload->do_upload('foto_kamar_2')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 2 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk")); die();
       
    } else {
        $foto_kamar_2 = $this->upload->data('file_name');
    }
    
    if (!$this->upload->do_upload('foto_kamar_3')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 3 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk")); die();
       
    } else {
        $foto_kamar_3 = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kamar_mandi')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar Mandi Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk")); die();
       
    } else {
        $foto_kamar_mandi = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_dapur')) {
        $this->session->set_flashdata("msg_danger", "Foto Dapur Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk")); die();
       
    } else {
        $foto_dapur = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kiri')) {
        $this->session->set_flashdata("msg_danger", "Foto Kiri Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk")); die();
       
    } else {
        $foto_kiri = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kanan')) {
        $this->session->set_flashdata("msg_danger", "Foto Kanan Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk")); die();
       
    } else {
        $foto_kanan = $this->upload->data('file_name');
    }

        // Upload foto belakang
    if (!$this->upload->do_upload('foto_belakang')) {
        
        $this->session->set_flashdata("msg_danger", "Foto Belakang Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk")); die();
    } else {
        $foto_belakang = $this->upload->data('file_name');
    }
    
    $data = [
        "id_table_spk" => $id_table_spk,
        "pengaju_opname" => $pengaju_opname,
        "id_perumahan" => $id_perumahan,
        "id_blok" => $id_blok,
        "type" => $type,
        "tanggal_input_opname" => $tanggal_input_opname,
        "pencairan" => $nilai_borongan,
        "jenis_hpp" => $jenis_hpp,
        "foto_depan" => $foto_depan,
        "foto_ruang_tamu" => $foto_ruang_tamu,
        "foto_kamar_1" => $foto_kamar_1,
        "foto_kamar_2" => $foto_kamar_2,
        "foto_kamar_3" => $foto_kamar_3,
        "foto_kamar_mandi" => $foto_kamar_mandi,
        "foto_dapur" => $foto_dapur,
        "foto_kiri" => $foto_kiri,
        "foto_kanan" => $foto_kanan,
        "foto_belakang" => $foto_belakang
    ];

    $this->db->insert("stagging_opname_hpp_spk", $data);
    $this->session->set_flashdata("msg_success", "Data telah berhasil disimpan.");
    redirect(base_url("Database_spk/input_opname_hpp_view/$id_table_spk"));

}

public function list_opname($id_table_spk) 
{
    
    $data['list'] = $this->Model_spk->getListOpname($id_table_spk);
    $data['list_hpp'] = $this->Model_spk->getListOpnameHpp($id_table_spk);
    $data['list_lain2'] = $this->Model_spk->getListOpnameLain2($id_table_spk);
  
    $data['biaya_spk'] = $this->Model_spk->getBiayaSpk($id_table_spk);
    $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
    $id_perumahan = $spk_data->id_perumahan;
    $data['id_perumahan'] = $id_perumahan;
   
    
   

    $this->load->view('t/top');
    $this->load->view('input_opname/content_list_opname', $data);
    $this->load->view('t/bottom');
}

public function list_opname_view($id_table_spk) 
{
    
    $data['list'] = $this->Model_spk->getListOpname($id_table_spk);
    $data['list_hpp'] = $this->Model_spk->getListOpnameHpp($id_table_spk);
    // $data['list_lain2'] = $this->Model_spk->getListOpnameLain2($id_table_spk);
    $data['list_lain2'] = $this->Model_spk->getListOpnameLain2View($id_table_spk);
  
    $data['biaya_spk'] = $this->Model_spk->getBiayaSpk($id_table_spk);
    $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
    $id_perumahan = $spk_data->id_perumahan;
    $data['id_perumahan'] = $id_perumahan; 
   

    $this->load->view('t/top');
    $this->load->view('input_opname/content_list_opname_view', $data);
    $this->load->view('t/bottom');
}

public function list_retensi($id_table_spk) 
{
    
    $data['list_pengurangan_retensi'] = $this->Model_spk->getListRetensi($id_table_spk);
    
    $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
    $id_perumahan = $spk_data->id_perumahan;
    $data['id_perumahan'] = $id_perumahan;

    $this->load->view('t/top');
    $this->load->view('input_pengurangan_retensi/content_list_pengurangan_retensi', $data);
    $this->load->view('t/bottom');
}

public function list_retensi_view($id_table_spk) 
{
    
    $data['list_pengurangan_retensi'] = $this->Model_spk->getListRetensi($id_table_spk);
    
    $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
    $id_perumahan = $spk_data->id_perumahan;
    $data['id_perumahan'] = $id_perumahan;

    $this->load->view('t/top');
    $this->load->view('input_pengurangan_retensi/content_list_pengurangan_retensi_view', $data);
    $this->load->view('t/bottom');
}



public function detail_retensi($id_table_spk)
{
    

    $data['ion_auth'] = $this->ion_auth->user()->row();
   
    $data["detail_retensi"] = $this->Model_spk->detailRetensi($id_table_spk);
  
    $data["biaya_retensi"] = $this->Model_spk->getBiayaRetensi($id_table_spk);
   
   
  
    $this->load->view('t/top');
    $this->load->view('input_pengurangan_retensi/content_detail_retensi', $data);
    $this->load->view('t/bottom');
}


public function print_opname($id_opname_spk)
{
    $data['ion_auth'] = $this->ion_auth->user()->row();
    $data["opname_spk"] = $this->Model_spk->getAllOpname($id_opname_spk);
    $data["opname"] = $this->Model_spk->getDataOpname($id_opname_spk);

    
    // Memeriksa apakah id_table_spk ditemukan dalam hasil query
    if (!empty($data["opname"])) {
        $id_table_spk = $data["opname"][0]; // Mengambil elemen pertama dari array

        $data["biaya_spk"] = $this->Model_spk->getBiayaSpk($id_table_spk);
        $data["adendum_spk"] = $this->Model_spk->getAdendumSpk($id_table_spk);
        $data["retensi_spk"] = $this->Model_spk->getRetensiSpk($id_table_spk);
    } else {
        // Tidak ada id_table_spk ditemukan
        $data["biaya_spk"] = array();
        $data["adendum_spk"] = array();
        $data["retensi_spk"] = array();
    }

    $pen_hari = $this->db->select_sum("penambahan_hari")->get_where("penambahan_hari_spk",["id_table_spk"=>$id_table_spk])->result();
    $data["pen_hari"] = $pen_hari;
  
    $this->load->view('t/top');
    $this->load->view('input_opname/content_print_opname', $data);
    $this->load->view('t/bottom');
}

public function print_opname_hpp($id_opname_hpp_spk)
{
    $data['ion_auth'] = $this->ion_auth->user()->row();
   
    $data["opname_spk"] = $this->Model_spk->getAllOpnameHpp($id_opname_hpp_spk);
    $data["opname_hpp"] = $this->Model_spk->getDataOpnameHpp($id_opname_hpp_spk);
    
    // $data["biaya_spk"] = $this->Model_spk->getBiayaSpkHpp($id_opname_hpp_spk);
    // $data["adendum_spk"] = $this->Model_spk->getAdendumSpkHpp($id_opname_hpp_spk);
    
    //(SCRIPT DIBAWAH INI DI PERLUKAN UNTUK MENGAMBIL id_table_spk DARI TABLE 
    //opname_hpp_spk UNTUK MENDAPATKAN NILAI BORONGAN AKHIR DI PRINT OPNAME HPP )
    
    if (!empty($data["opname_hpp"])) {
        $id_table_spk = $data["opname_hpp"][0]; // Mengambil elemen pertama dari array,

        $data["biaya_spk"] = $this->Model_spk->getBiayaSpk($id_table_spk);
        $data["adendum_spk"] = $this->Model_spk->getAdendumSpk($id_table_spk);
       
    } 
    else 
    {
        //Tidak ada id_table_spk ditemukan
        $data["biaya_spk"] = array();
        $data["adendum_spk"] = array();
    }

        $table_spk = $this->db->get_where("table_spk", ["id_table_spk" => $id_table_spk])->row();
        $nilai_borongan_spk = $table_spk->nilai_borongan;
        $pen_hari = $this->db->select_sum("penambahan_hari")->get_where("penambahan_hari_spk",["id_table_spk"=>$id_table_spk])->result();
        $data["pen_hari"] = $pen_hari;
        //Total Biaya Adendum
        $jumlah_biaya_spk=0;
        $biaya_spk_koreksi = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 1])->row();
        $biaya_spk_pengurangan = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 2])->row();

       
        $jumlah_biaya_spk += ($biaya_spk_koreksi->jumlah ?? 0);
        $jumlah_biaya_spk -= ($biaya_spk_pengurangan->jumlah ?? 0);

        //Total Biaya Adendum
       
        $biaya_adendum_spk_koreksi = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 1])->row();
        $biaya_adendum_spk_pengurangan = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 2])->row();

        $jumlah_biaya_adendum_spk=0;
        $jumlah_biaya_adendum_spk += ($biaya_adendum_spk_koreksi->jumlah_adendum ?? 0);
        $jumlah_biaya_adendum_spk -= ($biaya_adendum_spk_pengurangan->jumlah_adendum ?? 0);
      

        //Total Denda
        $denda = $this->db->select_sum("denda")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
        $total_denda = $denda->denda;
       
        if (empty($total_denda)) {
            $total_denda = 0;
        }

        $nilai_borongan_spk_akhir= $nilai_borongan_spk+$jumlah_biaya_spk+$jumlah_biaya_adendum_spk;

        // Mengambil total pencairan dari tabel opname_hpp_spk
        $total_pencairan = $this->db->select_sum("pencairan")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
    
        $total_pencairan_spk = $total_pencairan->pencairan;

        // Menghitung selisih_spk
        $nilai_borongan_spk_akhir;

        
          
        $data['nilai_borongan_spk_akhir'] = $nilai_borongan_spk_akhir;
    
  
    $this->load->view('t/top');
    $this->load->view('input_opname/content_print_opname_hpp', $data);
    $this->load->view('t/bottom');
}

public function input_opname_lain2($id_table_spk)
{   
        
		$data['tampil_perumahan_dan_blok'] = $this->Model_spk->getPerumahanDanBlokOpname($id_table_spk);
        $data['ion_auth'] = $this->ion_auth->user()->row();
        $data['id_table_spk'] = $id_table_spk;

		$spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
	    $id_perumahan = $spk_data->id_perumahan;
        $data['id_perumahan'] = $id_perumahan;


		$dt['script'] = 'input_opname';
		$db['style'] = 'input_opname';


		$this->load->view('t/top',$dt);
		$this->load->view('input_opname/content_opname_lain2', $data);
		$this->load->view('t/bottom', $db);
}

public function input_opname_lain2_view($id_table_spk)
{   
        
		$data['tampil_perumahan_dan_blok'] = $this->Model_spk->getPerumahanDanBlokOpname($id_table_spk);
        $data['ion_auth'] = $this->ion_auth->user()->row();
        $data['id_table_spk'] = $id_table_spk;

		$spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
	    $id_perumahan = $spk_data->id_perumahan;
        $data['id_perumahan'] = $id_perumahan;

        //Nilai Borongan
        $table_spk = $this->db->get_where("table_spk", ["id_table_spk" => $id_table_spk])->row();
        $nilai_borongan_spk = $table_spk->nilai_borongan;
        
        //Total Biaya Adendum
        $jumlah_biaya_spk=0;
        $biaya_spk_koreksi = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 1])->row();
        $biaya_spk_pengurangan = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 2])->row();

       
        $jumlah_biaya_spk += ($biaya_spk_koreksi->jumlah ?? 0);
        $jumlah_biaya_spk -= ($biaya_spk_pengurangan->jumlah ?? 0);

        //Total Biaya Adendum
       
        $biaya_adendum_spk_koreksi = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 1])->row();
        $biaya_adendum_spk_pengurangan = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 2])->row();

        $jumlah_biaya_adendum_spk=0;
        $jumlah_biaya_adendum_spk += ($biaya_adendum_spk_koreksi->jumlah_adendum ?? 0);
        $jumlah_biaya_adendum_spk -= ($biaya_adendum_spk_pengurangan->jumlah_adendum ?? 0);
      

        //Total Denda
        $denda = $this->db->select_sum("denda")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
        $total_denda = $denda->denda;
       
        if (empty($total_denda)) {
            $total_denda = 0;
        }

        $nilai_borongan_spk_akhir= $nilai_borongan_spk+$jumlah_biaya_spk+$jumlah_biaya_adendum_spk;

        // Mengambil total pencairan dari tabel opname_hpp_spk
        $total_pencairan = $this->db->select_sum("pencairan")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
    
        $total_pencairan_spk = $total_pencairan->pencairan;

        // Menghitung selisih_spk
        $selisih_spk =$nilai_borongan_spk_akhir- $total_pencairan_spk-$total_denda;

        if($selisih_spk<0){
            $selisih_spk=0;
           }
          
        $data['selisih_spk'] = $selisih_spk;

		$dt['script'] = 'input_opname';
		$db['style'] = 'input_opname';


		$this->load->view('t/top',$dt);
		$this->load->view('input_opname/content_opname_lain2_view', $data);
		$this->load->view('t/bottom', $db);
}

public function simpan_opname_lain2()
{
    $id_table_spk = $this->input->post("id_table_spk");
    $pengaju_opname = $this->input->post("pengaju_opname");
    $id_perumahan = $this->input->post("id_perumahan");
    $id_blok = $this->input->post("id_blok");
    $type = $this->input->post("type");
    $tanggal_input_opname = $this->input->post("tanggal_input_opname");
    $satuan = $this->input->post("satuan");
    $masukan_angka = $this->input->post("masukan_angka");
    $rincian_opname_lain2 = $this->input->post("rincian_opname_lain2");
    $opini = $this->input->post("opini");
    // var_dump($opini);exit;

        // Mengambil nama file foto dari inputan
        $foto_depan = $_FILES["foto_depan"]["name"];
        $foto_ruang_tamu = $_FILES["foto_ruang_tamu"]["name"];
        $foto_kamar_1 = $_FILES["foto_kamar_1"]["name"];
        $foto_kamar_2 = $_FILES["foto_kamar_2"]["name"];
        $foto_kamar_3 = $_FILES["foto_kamar_3"]["name"];
        $foto_kamar_mandi = $_FILES["foto_kamar_mandi"]["name"];
        $foto_dapur = $_FILES["foto_dapur"]["name"];
        $foto_kiri = $_FILES["foto_kiri"]["name"];
        $foto_kanan = $_FILES["foto_kanan"]["name"];
        $foto_belakang = $_FILES["foto_belakang"]["name"];

        // Konfigurasi upload foto depan
        $config['upload_path']   = './upload_spk/foto_opname';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2000;

        $this->load->library('upload', $config);

        // Upload foto depan
    if (!$this->upload->do_upload('foto_depan')) {
        $this->session->set_flashdata("msg_danger", "Foto Depan Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_lain2/$id_table_spk")); die();
       
    } else {
        $foto_depan = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_ruang_tamu')) {
        $this->session->set_flashdata("msg_danger", "Foto Ruang Tamu Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_ruang_tamu = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kamar_1')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 1 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_kamar_1 = $this->upload->data('file_name');
    }
    
    if (!$this->upload->do_upload('foto_kamar_2')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 2 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_kamar_2 = $this->upload->data('file_name');
    }
    
    if (!$this->upload->do_upload('foto_kamar_3')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 3 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_kamar_3 = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kamar_mandi')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar Mandi Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_kamar_mandi = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_dapur')) {
        $this->session->set_flashdata("msg_danger", "Foto Dapur Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_dapur = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kiri')) {
        $this->session->set_flashdata("msg_danger", "Foto Kiri Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_kiri = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kanan')) {
        $this->session->set_flashdata("msg_danger", "Foto Kanan Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname/$id_table_spk")); die();
       
    } else {
        $foto_kanan = $this->upload->data('file_name');
    }
    
        // Upload foto belakang
    if (!$this->upload->do_upload('foto_belakang')) {
        
        $this->session->set_flashdata("msg_danger", "Foto Belakang Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_lain2/$id_table_spk")); die();
    } else {
        $foto_belakang = $this->upload->data('file_name');
    }

    $data = [
        "id_table_spk" => $id_table_spk,
        "pengaju_opname" => $pengaju_opname,
        "id_perumahan" => $id_perumahan,
        "id_blok" => $id_blok,
        "type" => $type,
        "tanggal_input_opname" => $tanggal_input_opname,
        "satuan" => $satuan,
        "masukan_angka" => $masukan_angka,
        "rincian_opname_lain2" => $rincian_opname_lain2,
        "opini" => $opini,
        "foto_depan" => $foto_depan,
        "foto_ruang_tamu" => $foto_ruang_tamu,
        "foto_kamar_1" => $foto_kamar_1,
        "foto_kamar_2" => $foto_kamar_2,
        "foto_kamar_3" => $foto_kamar_3,
        "foto_kamar_mandi" => $foto_kamar_mandi,
        "foto_dapur" => $foto_dapur,
        "foto_kiri" => $foto_kiri,
        "foto_kanan" => $foto_kanan,
        "foto_belakang" => $foto_belakang
    ];

    $this->db->insert("stagging_opname_lain2_spk", $data);
    $this->session->set_flashdata("msg_success", "Data telah berhasil disimpan.");
    redirect(base_url("Database_spk/input_opname_lain2/$id_table_spk"));

}

public function simpan_opname_lain2_view()
{
    $id_table_spk = $this->input->post("id_table_spk");
    $pengaju_opname = $this->input->post("pengaju_opname");
    $id_perumahan = $this->input->post("id_perumahan");
    $id_blok = $this->input->post("id_blok");
    $type = $this->input->post("type");
    $tanggal_input_opname = $this->input->post("tanggal_input_opname");
    $nilai_borongan = preg_replace('/\D/', '', $this->input->post('nilai_borongan'));
    $jenis_hpp = $this->input->post("jenis_hpp");
    $rincian_opname_lain2 = $this->input->post("rincian_opname_lain2");

    //ini untuk mendapatkan nilai_borongan
    $table_spk = $this->db->get_where("table_spk", ["id_table_spk" => $id_table_spk])->row();
    $nilai_borongan_spk = $table_spk->nilai_borongan;
    
   //Total Biaya Adendum
   $jumlah_biaya_spk=0;
   $biaya_spk_koreksi = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 1])->row();
   $biaya_spk_pengurangan = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 2])->row();

  
   $jumlah_biaya_spk += ($biaya_spk_koreksi->jumlah ?? 0);
   $jumlah_biaya_spk -= ($biaya_spk_pengurangan->jumlah ?? 0);

   //Total Biaya Adendum   
   $biaya_adendum_spk_koreksi = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 1])->row();
   $biaya_adendum_spk_pengurangan = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 2])->row();

   $jumlah_biaya_adendum_spk=0;
   $jumlah_biaya_adendum_spk += ($biaya_adendum_spk_koreksi->jumlah_adendum ?? 0);
   $jumlah_biaya_adendum_spk -= ($biaya_adendum_spk_pengurangan->jumlah_adendum ?? 0);

   //Total Adendum
    $denda = $this->db->select_sum("denda")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
    $total_denda = $denda->denda;
   
    if (empty($total_denda)) {
        $total_denda = 0;
    }

    //ini untuk nilai_borongan_akhir
    $nilai_borongan_spk_akhir= $nilai_borongan_spk+$jumlah_biaya_spk+$jumlah_biaya_adendum_spk;

    // Mengambil total pencairan dari tabel opname_hpp_spk
    $total_pencairan = $this->db->select_sum("pencairan")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();

    $total_pencairan_spk = $total_pencairan->pencairan;

    // Menghitung selisih_spk
    $selisih_spk =$nilai_borongan_spk_akhir- $total_pencairan_spk-$total_denda;

   if($selisih_spk<0){
    $selisih_spk=0;
   }
    
    // Membandingkan nilai_borongan dengan selisih_spk
    if ($nilai_borongan > $selisih_spk) {
        $this->session->set_flashdata("msg_danger", "Nilai pencairan melebihi Sisa Pencairan.");
        redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk"));
        die();
    }

    if (empty($nilai_borongan) 
    || empty($_FILES['foto_depan']['name']) 
    || empty($_FILES['foto_ruang_tamu']['name'])
    || empty($_FILES['foto_kamar_1']['name'])
    || empty($_FILES['foto_kamar_2']['name'])
    || empty($_FILES['foto_kamar_3']['name'])
    || empty($_FILES['foto_kamar_mandi']['name'])
    || empty($_FILES['foto_dapur']['name'])
    || empty($_FILES['foto_kiri']['name'])
    || empty($_FILES['foto_kanan']['name'])
    || empty($_FILES['foto_belakang']['name'])) {
        $this->session->set_flashdata("msg_danger", "Ada data yang tidak boleh kosong!");
        redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk"));
        die();
    } 
       
        // Mengambil nama file foto dari inputan
        $foto_depan = $_FILES["foto_depan"]["name"];
        $foto_ruang_tamu = $_FILES["foto_ruang_tamu"]["name"];
        $foto_kamar_1 = $_FILES["foto_kamar_1"]["name"];
        $foto_kamar_2 = $_FILES["foto_kamar_2"]["name"];
        $foto_kamar_3 = $_FILES["foto_kamar_3"]["name"];
        $foto_kamar_mandi = $_FILES["foto_kamar_mandi"]["name"];
        $foto_dapur = $_FILES["foto_dapur"]["name"];
        $foto_kiri = $_FILES["foto_kiri"]["name"];
        $foto_kanan = $_FILES["foto_kanan"]["name"];
        $foto_belakang = $_FILES["foto_belakang"]["name"];

        // Konfigurasi upload foto depan
        $config['upload_path']   = './upload_spk/foto_opname';
        $config['allowed_types'] = 'gif|png|jpeg|jpg';
        $config['max_size'] = 2000;

        $this->load->library('upload', $config);

        // Upload foto depan
        if (!$this->upload->do_upload('foto_depan')) {
            // Mengambil pesan kesalahan dari aturan validasi
            $error = $this->upload->display_errors();
            
            // Menyimpan pesan kesalahan ke dalam flashdata
            $this->session->set_flashdata("msg_danger", "Foto Depan Gagal di Upload! Error: $error");
            
            // Redirect ke halaman yang sesuai
            redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk"));
            die();
        }
       
     else {
        $foto_depan = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_ruang_tamu')) {
        $this->session->set_flashdata("msg_danger", "Foto Ruang Tamu Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk")); die();
       
    } else {
        $foto_ruang_tamu = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kamar_1')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 1 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk")); die();
       
    } else {
        $foto_kamar_1 = $this->upload->data('file_name');
    }
    
    if (!$this->upload->do_upload('foto_kamar_2')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 2 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk")); die();
       
    } else {
        $foto_kamar_2 = $this->upload->data('file_name');
    }
    
    if (!$this->upload->do_upload('foto_kamar_3')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar 3 Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk")); die();
       
    } else {
        $foto_kamar_3 = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kamar_mandi')) {
        $this->session->set_flashdata("msg_danger", "Foto Kamar Mandi Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk")); die();
       
    } else {
        $foto_kamar_mandi = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_dapur')) {
        $this->session->set_flashdata("msg_danger", "Foto Dapur Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk")); die();
       
    } else {
        $foto_dapur = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kiri')) {
        $this->session->set_flashdata("msg_danger", "Foto Kiri Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk")); die();
       
    } else {
        $foto_kiri = $this->upload->data('file_name');
    }

    if (!$this->upload->do_upload('foto_kanan')) {
        $this->session->set_flashdata("msg_danger", "Foto Kanan Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk")); die();
       
    } else {
        $foto_kanan = $this->upload->data('file_name');
    }

        // Upload foto belakang
    if (!$this->upload->do_upload('foto_belakang')) {
        
        $this->session->set_flashdata("msg_danger", "Foto Belakang Gagal di Upload!, cek format dan ukuran gambar.");
        redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk")); die();
    } else {
        $foto_belakang = $this->upload->data('file_name');
    }
    
    $data = [
        "id_table_spk" => $id_table_spk,
        "pengaju_opname" => $pengaju_opname,
        "id_perumahan" => $id_perumahan,
        "id_blok" => $id_blok,
        "type" => $type,
        "tanggal_input_opname" => $tanggal_input_opname,
        "pencairan" => $nilai_borongan,
        "jenis_hpp" => $jenis_hpp,
        "rincian_opname_lain2" => $rincian_opname_lain2,
        "foto_depan" => $foto_depan,
        "foto_ruang_tamu" => $foto_ruang_tamu,
        "foto_kamar_1" => $foto_kamar_1,
        "foto_kamar_2" => $foto_kamar_2,
        "foto_kamar_3" => $foto_kamar_3,
        "foto_kamar_mandi" => $foto_kamar_mandi,
        "foto_dapur" => $foto_dapur,
        "foto_kiri" => $foto_kiri,
        "foto_kanan" => $foto_kanan,
        "foto_belakang" => $foto_belakang
        
    ];

    $this->db->insert("stagging_opname_lain2_spk_view", $data);
    $this->session->set_flashdata("msg_success", "Data telah berhasil disimpan.");
    redirect(base_url("Database_spk/input_opname_lain2_view/$id_table_spk"));

}

public function input_adendum($id_table_spk)
{   
        
		$data['tampil_perumahan_dan_blok'] = $this->Model_spk->getPerumahanDanBlokOpname($id_table_spk);
        $data['ion_auth'] = $this->ion_auth->user()->row();
        $data['id_table_spk'] = $id_table_spk;

		$spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
	    $id_perumahan = $spk_data->id_perumahan;
        $data['id_perumahan'] = $id_perumahan;


		$dt['script'] = 'input_adendum';
		$db['style'] = 'input_adendum';


		$this->load->view('t/top',$dt);
		$this->load->view('input_adendum/content', $data);
		$this->load->view('t/bottom', $db);
}

public function input_adendum_view($id_table_spk)   
{   
        
		$data['tampil_perumahan_dan_blok'] = $this->Model_spk->getPerumahanDanBlokOpname($id_table_spk);
        $data['ion_auth'] = $this->ion_auth->user()->row();
        $data['id_table_spk'] = $id_table_spk;

		$spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
	    $id_perumahan = $spk_data->id_perumahan;
        $data['id_perumahan'] = $id_perumahan;


		$dt['script'] = 'input_adendum';
		$db['style'] = 'input_adendum';


		$this->load->view('t/top',$dt);
		$this->load->view('input_adendum/content_adendum_view', $data);
		$this->load->view('t/bottom', $db);
}

public function data_temp_koreksi_adendum()
{
    $data = $this->db->get('temp_koreksi_biaya_spk_adendum')->result();
    echo json_encode($data);
}

public function simpan_temp_koreksi_adendum()
{
    $save = array(
        'koreksi' => $this->input->post('koreksi'),
        'keterangan' => $this->input->post('keterangan'),
        'jumlah' => $this->input->post('jumlah')
    );
    $data = $this->Model_spk->insert_data($save, 'temp_koreksi_biaya_spk_adendum');
    echo json_encode($data);
}

public function hapus_temp_koreksi_adendum()
{
    $id = $this->input->post('id');
    $where = array(
        'id' => $id
    );

    $data = $this->Model_spk->delete_data($where, 'temp_koreksi_biaya_spk_adendum');
    echo json_encode($data);
}

public function simpan_adendum()
    {
        // Form validation
        $this->form_validation->set_rules('nama_konsumen_adendum', 'Nama Konsumen', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_telp', 'No HP/Telp', 'required');
        $this->form_validation->set_rules('rincian_adendum', 'Rincian', 'required');
        $this->form_validation->set_rules('tanggal_input_adendum', 'Tanggal Input', 'required');

        if ($this->form_validation->run() == TRUE) {
            // Inisialisasi $id_table_spk
            $id_table_spk = $this->input->post('id_table_spk');

        
            // Validasi berhasil, simpan data
            $this->load->model('Model_spk');
            $res_arr = array(); // Array untuk menyimpan id_adendum
            $res = $this->Model_spk->simpanAdendumDimodel(
                $this->input->post('id_table_spk'),
                $this->input->post('nama_konsumen_adendum'),
                $this->input->post('alamat'),
                $this->input->post('no_telp'),
                $this->input->post('rincian_adendum'),
                $this->input->post('tanggal_input_adendum')
            );
            $spk_data = $this->Model_spk->getSpkDataById($id_table_spk); 
            $id_perumahan = $spk_data->id_perumahan;
        
            if ($res) {
                // Input berhasil

                $this->db->query("INSERT INTO biaya_adendum_spk (id_table_spk, id_table_adendum, koreksi_adendum, keterangan_adendum, jumlah_adendum) SELECT '$id_table_spk', '$res', koreksi, keterangan, jumlah FROM temp_koreksi_biaya_spk_adendum");
                $this->db->query("INSERT INTO biaya_adendum_spk_approve (id_table_spk, id_table_adendum, koreksi_adendum, keterangan_adendum, jumlah_adendum) SELECT '$id_table_spk', '$res', koreksi, keterangan, jumlah FROM temp_koreksi_biaya_spk_adendum");
                $this->db->empty_table('temp_koreksi_biaya_spk_adendum');
                
                $res_arr[] = $res; // Menambahkan id_spk ke dalam array $res_arr
                
                $res = end($res_arr); // Mengambil id_spk terakhir dari array

                $this->session->set_flashdata('msg_success', 'Input data berhasil.');
                redirect(base_url("Database_spk/spk_by_perumahan/$id_perumahan"));
            } else {
                $this->session->set_flashdata('msg_danger', 'Input data gagal.');
                redirect(base_url("Database_spk/spk_by_perumahan/$id_perumahan"));
            }
        } else {
            // Validasi form gagal
            $this->session->set_flashdata('msg_danger', 'Input data gagal: ' . validation_errors());
            redirect(base_url("Database_spk/spk_by_perumahan/$id_perumahan"));
        }
    }

    public function simpan_adendum_view()
    {
        // Form validation
        $this->form_validation->set_rules('nama_konsumen_adendum', 'Nama Konsumen', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_telp', 'No HP/Telp', 'required');
        $this->form_validation->set_rules('rincian_adendum', 'Rincian', 'required');
        $this->form_validation->set_rules('tanggal_input_adendum', 'Tanggal Input', 'required');

        if ($this->form_validation->run() == TRUE) {
            // Inisialisasi $id_table_spk
            $id_table_spk = $this->input->post('id_table_spk');

        
            // Validasi berhasil, simpan data
            $this->load->model('Model_spk');
            $res_arr = array(); // Array untuk menyimpan id_adendum
            $res = $this->Model_spk->simpanAdendumDimodel(
                $this->input->post('id_table_spk'),
                $this->input->post('nama_konsumen_adendum'),
                $this->input->post('alamat'),
                $this->input->post('no_telp'),
                $this->input->post('rincian_adendum'),
                $this->input->post('tanggal_input_adendum')
            );
            $spk_data = $this->Model_spk->getSpkDataById($id_table_spk); 
            $id_perumahan = $spk_data->id_perumahan;
        
            if ($res) {
                // Input berhasil

                $this->db->query("INSERT INTO biaya_adendum_spk (id_table_spk, id_table_adendum, koreksi_adendum, keterangan_adendum, jumlah_adendum) SELECT '$id_table_spk', '$res', koreksi, keterangan, jumlah FROM temp_koreksi_biaya_spk_adendum");
                $this->db->query("INSERT INTO biaya_adendum_spk_approve (id_table_spk, id_table_adendum, koreksi_adendum, keterangan_adendum, jumlah_adendum) SELECT '$id_table_spk', '$res', koreksi, keterangan, jumlah FROM temp_koreksi_biaya_spk_adendum");
                $this->db->empty_table('temp_koreksi_biaya_spk_adendum');
                
                $res_arr[] = $res; // Menambahkan id_spk ke dalam array $res_arr
                
                $res = end($res_arr); // Mengambil id_spk terakhir dari array

                $this->session->set_flashdata('msg_success', 'Input data berhasil.');
                redirect(base_url("Database_spk/spk_by_perumahan_adendum/$id_perumahan"));
            } else {
                $this->session->set_flashdata('msg_danger', 'Input data gagal.');
                redirect(base_url("Database_spk/spk_by_perumahan_adendum/$id_perumahan"));
            }
        } else {
            // Validasi form gagal
            $this->session->set_flashdata('msg_danger', 'Input data gagal: ' . validation_errors());
            redirect(base_url("Database_spk/spk_by_perumahan_adendum/$id_perumahan"));
        }
    }

public function list_adendum($id_table_spk) 
{
    
    $data['list_adendum'] = $this->Model_spk->getListForAdendum($id_table_spk);
  
    $data['biaya_spk'] = $this->Model_spk->getBiayaSpk($id_table_spk);
    $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
    $id_perumahan = $spk_data->id_perumahan;
    $data['id_perumahan'] = $id_perumahan;
   
    
    

    $this->load->view('t/top');
    $this->load->view('input_adendum/content_list_adendum', $data);
    $this->load->view('t/bottom');
}

public function list_adendum_view($id_table_spk) 
{
    
    $data['list_adendum'] = $this->Model_spk->getListForAdendum($id_table_spk);
  
    $data['biaya_spk'] = $this->Model_spk->getBiayaSpk($id_table_spk);
    $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
    $id_perumahan = $spk_data->id_perumahan;
    $data['id_perumahan'] = $id_perumahan;
   
    
   

    $this->load->view('t/top');
    $this->load->view('input_adendum/content_list_adendum_view', $data);
    $this->load->view('t/bottom');
}


public function print_adendum($id_table_adendum)
{
   
    $data["data_spk"] = $this->Model_spk->getSpkforAdendum($id_table_adendum);
    $data["adendum_spk"] = $this->Model_spk->getAdendumSpk($id_table_adendum);
  
    $this->load->view('t/top');
    $this->load->view('input_adendum/content_print_adendum', $data);
    $this->load->view('t/bottom');
}

public function list_spmb($id_table_spk) 
{
    $data['list_spmb_hpp'] = $this->Model_spk->getListSpmbRumahHpp($id_table_spk);
    $data['list_spmb_lain2'] = $this->Model_spk->getListSpmbLain2($id_table_spk);
    $data['list'] = $this->Model_spk->getListSpmbRumah($id_table_spk);
    $data['biaya_spk'] = $this->Model_spk->getBiayaSpk($id_table_spk);
    $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
    $id_perumahan = $spk_data->id_perumahan;
    $data['id_perumahan'] = $id_perumahan;

    
    $this->load->view('t/top');
    $this->load->view('spmb/content_list_spmb', $data);
    $this->load->view('t/bottom');
}

public function list_spmb_view($id_table_spk) 
{
    $data['list_spmb_hpp'] = $this->Model_spk->getListSpmbRumahHpp($id_table_spk);
    $data['list_spmb_lain2'] = $this->Model_spk->getListSpmbLain2View($id_table_spk);
    $data['list'] = $this->Model_spk->getListSpmbRumah($id_table_spk);
    $data['biaya_spk'] = $this->Model_spk->getBiayaSpk($id_table_spk);
    $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
    $id_perumahan = $spk_data->id_perumahan;
    $data['id_perumahan'] = $id_perumahan;

    
    $this->load->view('t/top');
    $this->load->view('spmb/content_list_spmb_view', $data);
    $this->load->view('t/bottom');
}

public function print_spmb($id_table_spk)
{
    
    $data["id_table_spk"] = $this->Model_spk->getidSpk($id_table_spk);
    $data["data_spk"] = $this->Model_spk->getSpkForSpmb($id_table_spk);
    $data["pencairan_opname"] = $this->Model_spk->getDataOpnameSpk($id_table_spk);
    $data["biaya_spk"] = $this->Model_spk->getBiayaSpk($id_table_spk);
    $data["adendum_spk"] = $this->Model_spk->getAdendumSpk($id_table_spk);
    $data["retensi_spk"] = $this->Model_spk->getRetensiSpk($id_table_spk);

  
    $this->load->view('t/top');
    $this->load->view('spmb/content_print_spmb', $data);
    $this->load->view('t/bottom');
}
 
public function tampil_input_tanggal_pencairan($id_opname_spk) 
	{
		
		$data['ion_auth'] = $this->ion_auth->user()->row();
		$data['tampil'] = $this->Model_spk->getOpnameTanggalPencairan($id_opname_spk);

		$this->load->view('t/top');
		$this->load->view('spmb/content_input_tanggal_pencairan', $data);
		$this->load->view('t/bottom');
	}

    public function update_tanggal_pencairan()  
{   
   
	$id_opname_spk = $this->input->post('id_opname_spk');
	$tanggal_pencairan_opname = $this->input->post('tanggal_pencairan_opname');
    $spk_data = $this->Model_spk->getOpnameTanggalPencairan($id_opname_spk);
	$id_table_spk = $spk_data->id_table_spk;
   
	$data = array(
		
		'tanggal_pencairan' => $tanggal_pencairan_opname
	);
    
	$this->Model_spk->updateTanggalPencairan($data, 'opname_spk',$id_opname_spk);
	$this->session->set_flashdata('msg_success', 'Berhasil disimpan.');
	redirect(base_url("Database_spk/print_spmb/$id_table_spk"));
}

public function print_spmb_hpp($id_table_spk)
{
    
    $data["id_table_spk"] = $this->Model_spk->getidSpk($id_table_spk);
    $data["data_spk"] = $this->Model_spk->getSpkForSpmb($id_table_spk);
    $data["pencairan_opname_hpp"] = $this->Model_spk->getDataOpnameSpkHpp($id_table_spk);
    $data["biaya_spk"] = $this->Model_spk->getBiayaSpk($id_table_spk);
    $data["adendum_spk"] = $this->Model_spk->getAdendumSpk($id_table_spk);
    // $data["penambahan_hari"] = $this->Model_spk->getPenambahanHari($id_table_spk);
    // var_dump($data);exit;
   
 
    $this->load->view('t/top');
    $this->load->view('spmb/content_print_spmb_hpp', $data);
    $this->load->view('t/bottom');
}

public function print_opname_lain2($id_opname_lain2_spk )
{
    $data['ion_auth'] = $this->ion_auth->user()->row();
   
    $data["opname_spk"] = $this->Model_spk->getAllOpnameLain2($id_opname_lain2_spk );
  
    $this->load->view('t/top');
    $this->load->view('input_opname/content_print_opname_lain2', $data);
    $this->load->view('t/bottom');
}

// public function print_opname_lain2_view($id_opname_lain2_spk_view )
// {
//     $data['ion_auth'] = $this->ion_auth->user()->row();
   
//     $data["opname_spk"] = $this->Model_spk->getAllOpnameLain2View($id_opname_lain2_spk_view  );
  
//     $this->load->view('t/top');
//     $this->load->view('input_opname/content_print_opname_lain2_view', $data);
//     $this->load->view('t/bottom');
// }

public function print_opname_lain2_view($id_opname_lain2_spk_view)
{
    $data['ion_auth'] = $this->ion_auth->user()->row();
   
    $data["opname_spk"] = $this->Model_spk->getAllOpnameLain2View($id_opname_lain2_spk_view);
    $data["opname_hpp"] = $this->Model_spk->getDataOpnameLain2View($id_opname_lain2_spk_view);
    
    // $data["biaya_spk"] = $this->Model_spk->getBiayaSpkHpp($id_opname_hpp_spk);
    // $data["adendum_spk"] = $this->Model_spk->getAdendumSpkHpp($id_opname_hpp_spk);
    
    //(SCRIPT DIBAWAH INI DI PERLUKAN UNTUK MENGAMBIL id_table_spk DARI TABLE 
    //opname_hpp_spk UNTUK MENDAPATKAN NILAI BORONGAN AKHIR DI PRINT OPNAME HPP )
    
    if (!empty($data["opname_hpp"])) {
        $id_table_spk = $data["opname_hpp"][0]; // Mengambil elemen pertama dari array,

        $data["biaya_spk"] = $this->Model_spk->getBiayaSpk($id_table_spk);
        $data["adendum_spk"] = $this->Model_spk->getAdendumSpk($id_table_spk);
       
    } 
    else 
    {
        //Tidak ada id_table_spk ditemukan
        $data["biaya_spk"] = array();
        $data["adendum_spk"] = array();
    }

        $table_spk = $this->db->get_where("table_spk", ["id_table_spk" => $id_table_spk])->row();
        $nilai_borongan_spk = $table_spk->nilai_borongan;
        $pen_hari = $this->db->select_sum("penambahan_hari")->get_where("penambahan_hari_spk",["id_table_spk"=>$id_table_spk])->result();
        $data["pen_hari"] = $pen_hari;
        //Total Biaya Adendum
        $jumlah_biaya_spk=0;
        $biaya_spk_koreksi = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 1])->row();
        $biaya_spk_pengurangan = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 2])->row();

       
        $jumlah_biaya_spk += ($biaya_spk_koreksi->jumlah ?? 0);
        $jumlah_biaya_spk -= ($biaya_spk_pengurangan->jumlah ?? 0);

        //Total Biaya Adendum
       
        $biaya_adendum_spk_koreksi = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 1])->row();
        $biaya_adendum_spk_pengurangan = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 2])->row();

        $jumlah_biaya_adendum_spk=0;
        $jumlah_biaya_adendum_spk += ($biaya_adendum_spk_koreksi->jumlah_adendum ?? 0);
        $jumlah_biaya_adendum_spk -= ($biaya_adendum_spk_pengurangan->jumlah_adendum ?? 0);
      

        //Total Denda
        $denda = $this->db->select_sum("denda")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
        $total_denda = $denda->denda;
       
        if (empty($total_denda)) {
            $total_denda = 0;
        }

        $nilai_borongan_spk_akhir= $nilai_borongan_spk+$jumlah_biaya_spk+$jumlah_biaya_adendum_spk;

        // Mengambil total pencairan dari tabel opname_hpp_spk
        $total_pencairan = $this->db->select_sum("pencairan")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
    
        $total_pencairan_spk = $total_pencairan->pencairan;

        // Menghitung selisih_spk
        $nilai_borongan_spk_akhir;

        
          
        $data['nilai_borongan_spk_akhir'] = $nilai_borongan_spk_akhir;
    
  
    $this->load->view('t/top');
    $this->load->view('input_opname/content_print_opname_lain2_view', $data);
    $this->load->view('t/bottom');
}

public function print_spmb_lain2($id_table_spk)
{
    
    $data["id_table_spk"] = $this->Model_spk->getidSpk($id_table_spk);
    $data["data_spk"] = $this->Model_spk->getSpkForSpmb($id_table_spk);
    $data["pencairan_opname_lain2"] = $this->Model_spk->getDataOpnameSpkLain2($id_table_spk);
    $data["biaya_spk"] = $this->Model_spk->getBiayaSpk($id_table_spk);
    $data["adendum_spk"] = $this->Model_spk->getAdendumSpk($id_table_spk);
    // var_dump($data1);exit;
   
  
    $this->load->view('t/top');
    $this->load->view('spmb/content_print_spmb_lain2', $data);
    $this->load->view('t/bottom');
}

public function print_spmb_lain2_view($id_table_spk)
{
    
    $data["id_table_spk"] = $this->Model_spk->getidSpk($id_table_spk);
    $data["data_spk"] = $this->Model_spk->getSpkForSpmb($id_table_spk);
    $data["pencairan_opname_lain2"] = $this->Model_spk->getDataOpnameSpkLain2View($id_table_spk);
    $data["biaya_spk"] = $this->Model_spk->getBiayaSpk($id_table_spk);
    $data["adendum_spk"] = $this->Model_spk->getAdendumSpk($id_table_spk);
    // var_dump($data1);exit;
   
  
    $this->load->view('t/top');
    $this->load->view('spmb/content_print_spmb_lain2_view', $data);
    $this->load->view('t/bottom');
}

public function status_spk($id_table_spk)
{
    // Lakukan pengecekan apakah data dengan ID yang diberikan ada di tabel table_spk
    $data_spk = $this->db->get_where('table_spk', ['id_table_spk' => $id_table_spk])->row();
    if ($data_spk) {
        $id_perumahan = $data_spk->id_perumahan; // Mendapatkan nilai id_perumahan dari data_spk

        // Update nilai status menjadi 1
        $this->db->where('id_table_spk', $id_table_spk);
        $this->db->update('table_spk', ['status' => 1]);

        // Redirect dengan menggunakan id_perumahan
        redirect(base_url("Database_spk/spk_by_perumahan/$id_perumahan"));
    } else {
        // Jika data tidak ditemukan, lakukan tindakan yang sesuai
        $this->session->set_flashdata('msg_danger', 'Gagal mengupdate AKAD.');
    }
}

public function status_ready($id_table_spk)
{
    // Lakukan pengecekan apakah data dengan ID yang diberikan ada di tabel table_spk
    $data_spk = $this->db->get_where('table_spk', ['id_table_spk' => $id_table_spk])->row();
    if ($data_spk) {
        $id_perumahan = $data_spk->id_perumahan; // Mendapatkan nilai id_perumahan dari data_spk

        // Update nilai status menjadi 1
        $this->db->where('id_table_spk', $id_table_spk);
        $this->db->update('table_spk', ['status_ready' => 1]);

        // Redirect dengan menggunakan id_perumahan
        redirect(base_url("Database_spk/spk_by_perumahan/$id_perumahan"));
    } else {
        // Jika data tidak ditemukan, lakukan tindakan yang sesuai
        $this->session->set_flashdata('msg_danger', 'Gagal mengupdate Ready.');
    }
}

public function input_pengurangan_retensi($id_table_spk)
{   
        
		$data['tampil_perumahan_dan_blok'] = $this->Model_spk->getPerumahanDanBlokOpname($id_table_spk);
        $data['ion_auth'] = $this->ion_auth->user()->row();
        $data['id_table_spk'] = $id_table_spk;

		$spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
	    $id_perumahan = $spk_data->id_perumahan;
        $data['id_perumahan'] = $id_perumahan;


		$dt['script'] = 'input_pengurangan_retensi';
		$db['style'] = 'input_pengurangan_retensi';


		$this->load->view('t/top',$dt);
		$this->load->view('input_pengurangan_retensi/content', $data);
		$this->load->view('t/bottom', $db);
}

public function input_pengurangan_retensi_view($id_table_spk)
{   
        
		$data['tampil_perumahan_dan_blok'] = $this->Model_spk->getPerumahanDanBlokOpname($id_table_spk);
        $data['ion_auth'] = $this->ion_auth->user()->row();
        $data['id_table_spk'] = $id_table_spk;

		$spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
	    $id_perumahan = $spk_data->id_perumahan;
        $data['id_perumahan'] = $id_perumahan;


		$dt['script'] = 'input_pengurangan_retensi';
		$db['style'] = 'input_pengurangan_retensi';


		$this->load->view('t/top',$dt);
		$this->load->view('input_pengurangan_retensi/content_view', $data);
		$this->load->view('t/bottom', $db);
}

public function data_temp_koreksi_pengurangan_retensi()
{
    $data = $this->db->get('temp_koreksi_biaya_spk_pengurangan_retensi')->result();
    echo json_encode($data);
}

public function simpan_temp_koreksi_pengurangan_retensi()
{
    $save = array(
        'koreksi' => $this->input->post('koreksi'),
        'keterangan' => $this->input->post('keterangan'),
        'jumlah' => $this->input->post('jumlah')
    );
    $data = $this->Model_spk->insert_data($save, 'temp_koreksi_biaya_spk_pengurangan_retensi');
    echo json_encode($data);
}

public function hapus_temp_koreksi_pengurangan_retensi()
{
    $id = $this->input->post('id');
    $where = array(
        'id' => $id
    );

    $data = $this->Model_spk->delete_data($where, 'temp_koreksi_biaya_spk_pengurangan_retensi');
    echo json_encode($data);
}

public function simpan_pengurangan_retensi()
{
    // Form validation
   
    $this->form_validation->set_rules('rincian_pengurangan_retensi', 'Rincian', 'required');
    $this->form_validation->set_rules('tanggal_input_pengurangan_retensi', 'Tanggal Input', 'required');

    if ($this->form_validation->run() == TRUE) {
        // Inisialisasi $id_table_spk
        $id_table_spk = $this->input->post('id_table_spk');

      
        // Validasi berhasil, simpan data
        $this->load->model('Model_spk');
        $res_arr = array(); // Array untuk menyimpan id_pengurangan_retensi
        $res = $this->Model_spk->simpanPenguranganRetensiDimodel(
            $this->input->post('id_table_spk'),
            $this->input->post('rincian_pengurangan_retensi'),
            $this->input->post('tanggal_input_pengurangan_retensi')
        );
        $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
        $id_perumahan = $spk_data->id_perumahan;
      
        if ($res) {
            // Input berhasil

            $this->db->query("INSERT INTO biaya_retensi_spk (id_table_spk, id_table_retensi, koreksi_retensi, keterangan_retensi, jumlah_retensi) SELECT '$id_table_spk', '$res', koreksi, keterangan, jumlah FROM temp_koreksi_biaya_spk_pengurangan_retensi");
            $this->db->empty_table('temp_koreksi_biaya_spk_pengurangan_retensi');
            
            $res_arr[] = $res; // Menambahkan id_spk ke dalam array $res_arr
            
            $res = end($res_arr); // Mengambil id_spk terakhir dari array

            $this->session->set_flashdata('msg_success', 'Input data berhasil.');
            redirect(base_url("Database_spk/spk_by_perumahan/$id_perumahan"));
        } else {
            $this->session->set_flashdata('msg_danger', 'Input data gagal.');
            redirect(base_url("Database_spk/spk_by_perumahan/$id_perumahan"));
        }
    } else {
        // Validasi form gagal
        $this->session->set_flashdata('msg_danger', 'Input data gagal: ' . validation_errors());
        redirect(base_url("Database_spk/spk_by_perumahan/$id_perumahan"));
    }
}

public function list_pengurangan_retensi($id_table_spk) 
{
    
    $data['list_pengurangan_retensi'] = $this->Model_spk->getListForpengurangan_retensi($id_table_spk);
  
    $data['biaya_spk'] = $this->Model_spk->getBiayaSpk($id_table_spk);
    $spk_data = $this->Model_spk->getSpkDataById($id_table_spk);
    $id_perumahan = $spk_data->id_perumahan;
    $data['id_perumahan'] = $id_perumahan;
   
    
   

    $this->load->view('t/top');
    $this->load->view('input_pengurangan_retensi/content_list_pengurangan_retensi', $data);
    $this->load->view('t/bottom');
}

public function print_pengurangan_retensi($id_table_pengurangan_retensi)
{
   
    $data["data_spk"] = $this->Model_spk->getSpkforpengurangan_retensi($id_table_pengurangan_retensi);
    $data["pengurangan_retensi_spk"] = $this->Model_spk->getpengurangan_retensiSpk($id_table_pengurangan_retensi);
  
    $this->load->view('t/top');
    $this->load->view('input_pengurangan_retensi/content_print_pengurangan_retensi', $data);
    $this->load->view('t/bottom');
}

public function request_opname()  
    {
        $data["request"] = $this->Model_spk->getRequestOpname();

        $this->load->view('t/top');
        $this->load->view('request_opname/content_request_opname', $data);
        $this->load->view('t/bottom');
    }

    public function detail_opname($id_stagging_opname_spk) 
{
    $data['ion_auth'] = $this->ion_auth->user()->row();
   
    $data["spk"] = $this->Model_spk->getDataOpnameTableSpkStagging($id_stagging_opname_spk);
    $data["request"] = $this->Model_spk->getDataOpnameStaging($id_stagging_opname_spk);
    
    // Memeriksa apakah id_table_spk ditemukan dalam hasil query
    if (!empty($data["request"])) {
        $id_table_spk = $data["request"][0]; // Mengambil elemen pertama dari array

        $data["biaya_spk"] = $this->Model_spk->getBiayaSpk($id_table_spk);
        $data["adendum_spk"] = $this->Model_spk->getAdendumSpk($id_table_spk);
        $data["retensi_spk"] = $this->Model_spk->getRetensiSpk($id_table_spk);
       
    } else {
        // Tidak ada id_table_spk ditemukan
        $data["biaya_spk"] = array();
        $data["adendum_spk"] = array();
        $data["retensi_spk"] = array();
    }
  
    $this->load->view('t/top');
    $this->load->view('request_opname/content_detail_opname', $data);
    $this->load->view('t/bottom');
}

public function request_opname_hpp()
    {
        $data["request"] = $this->Model_spk->getRequestOpnameHpp();

        $this->load->view('t/top');
        $this->load->view('request_opname_hpp/content_request_opname_hpp', $data);
        $this->load->view('t/bottom');
    }

    public function detail_opname_hpp($id_stagging_opname_hpp_spk)
{
    $data['ion_auth'] = $this->ion_auth->user()->row();
   
    $data["spk"] = $this->Model_spk->getDataOpnameHppTableSpkStagging($id_stagging_opname_hpp_spk);
    $data["request"] = $this->Model_spk->getDataOpnameHppStaging($id_stagging_opname_hpp_spk);
    
    // Memeriksa apakah id_table_spk ditemukan dalam hasil query
    if (!empty($data["request"])) {
        $id_table_spk = $data["request"][0]; // Mengambil elemen pertama dari array

        $data["biaya_spk"] = $this->Model_spk->getBiayaSpkForHpp($id_table_spk);
        $data["adendum_spk"] = $this->Model_spk->getAdendumSpkForHpp($id_table_spk);
    } else {
        // Tidak ada id_table_spk ditemukan
        $data["biaya_spk"] = array();
        $data["adendum_spk"] = array();
    }

        $table_spk = $this->db->get_where("table_spk", ["id_table_spk" => $id_table_spk])->row();
        $nilai_borongan_spk = $table_spk->nilai_borongan;
        
        //Total Biaya Adendum
        $jumlah_biaya_spk=0;
        $biaya_spk_koreksi = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 1])->row();
        $biaya_spk_pengurangan = $this->db->select_sum("jumlah")->get_where("biaya_spk", ["id_table_spk" => $id_table_spk, "koreksi" => 2])->row();

       
        $jumlah_biaya_spk += ($biaya_spk_koreksi->jumlah ?? 0);
        $jumlah_biaya_spk -= ($biaya_spk_pengurangan->jumlah ?? 0);

        //Total Biaya Adendum
       
        $biaya_adendum_spk_koreksi = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 1])->row();
        $biaya_adendum_spk_pengurangan = $this->db->select_sum("jumlah_adendum")->get_where("biaya_adendum_spk", ["id_table_spk" => $id_table_spk, "koreksi_adendum" => 2])->row();

        $jumlah_biaya_adendum_spk=0;
        $jumlah_biaya_adendum_spk += ($biaya_adendum_spk_koreksi->jumlah_adendum ?? 0);
        $jumlah_biaya_adendum_spk -= ($biaya_adendum_spk_pengurangan->jumlah_adendum ?? 0);
      

        //Total Denda
        $denda = $this->db->select_sum("denda")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
        $total_denda = $denda->denda;
       
        if (empty($total_denda)) {
            $total_denda = 0;
        }

        $nilai_borongan_spk_akhir= $nilai_borongan_spk+$jumlah_biaya_spk+$jumlah_biaya_adendum_spk;

        // Mengambil total pencairan dari tabel opname_hpp_spk
        $total_pencairan = $this->db->select_sum("pencairan")->get_where("opname_hpp_spk", ["id_table_spk" => $id_table_spk])->row();
    
        $total_pencairan_spk = $total_pencairan->pencairan;

        // Menghitung selisih_spk
        $selisih_spk =$nilai_borongan_spk_akhir;

        if($selisih_spk<0){
            $selisih_spk=0;
           }
          
        $data['selisih_spk'] = $selisih_spk;
  
        $this->load->view('t/top');
        $this->load->view('request_opname_hpp/content_detail_opname_hpp', $data);
        $this->load->view('t/bottom');
}

    public function request_opname_lain2()
    {
        $data["request"] = $this->Model_spk->getRequestOpnameLain2();

        $this->load->view('t/top');
        $this->load->view('request_opname_lain2/content_request_opname_lain2', $data);
        $this->load->view('t/bottom');
    }

    public function detail_opname_lain2($id_stagging_opname_lain2_spk)
{
    $data['ion_auth'] = $this->ion_auth->user()->row();
   
    $data["spk"] = $this->Model_spk->getDataOpnameLain2TableSpkStagging($id_stagging_opname_lain2_spk);
    $data["request"] = $this->Model_spk->getDataOpnameLain2Staging($id_stagging_opname_lain2_spk);
    // var_dump($dv1);exit;
    // Memeriksa apakah id_table_spk ditemukan dalam hasil query
    if (!empty($data["request"])) {
        $id_table_spk = $data["request"][0]; // Mengambil elemen pertama dari array

        $data["biaya_spk"] = $this->Model_spk->getBiayaSpkForLain2($id_table_spk);
        $data["adendum_spk"] = $this->Model_spk->getAdendumSpkForLain2($id_table_spk);
    } else {
        // Tidak ada id_table_spk ditemukan
        $data["biaya_spk"] = array();
        $data["adendum_spk"] = array();
    }
  
        $this->load->view('t/top');
        $this->load->view('request_opname_lain2/content_detail_opname_lain2', $data);
        $this->load->view('t/bottom');
}

public function aprove_opname_lain2($id_stagging_opname_lain2_spk) 
    {
        // Ambil data stagging akun debet:
        $this->db->where("id_stagging_opname_lain2_spk", $id_stagging_opname_lain2_spk);
        $data_stagging_opname_lain2_spk = $this->db->get("stagging_opname_lain2_spk")->result();
       
        $nama_pengapprove_opname = $this->ion_auth->user()->row();
        $tanggal_approve_opname = date('Y-m-d'); // Tanggal saat ini
        $nilai_pencairan_akhir = $this->input->get('nilai_pencairan_akhir');

      
        // Insert data baru                  
        foreach ($data_stagging_opname_lain2_spk as $dsols) {
            $data = array( 
                "id_table_spk" => $dsols->id_table_spk,
                "id_perumahan" => $dsols->id_perumahan,
                "id_blok" => $dsols->id_blok,
                "tanggal_input_opname" => $dsols->tanggal_input_opname,
                "foto_depan" => $dsols->foto_depan,
                "foto_ruang_tamu" =>$dsols-> foto_ruang_tamu,
                "foto_kamar_1" =>$dsols-> foto_kamar_1,
                "foto_kamar_2" =>$dsols-> foto_kamar_2,
                "foto_kamar_3" =>$dsols-> foto_kamar_3,
                "foto_kamar_mandi" =>$dsols-> foto_kamar_mandi,
                "foto_dapur" =>$dsols-> foto_dapur,
                "foto_kiri" =>$dsols-> foto_kiri,
                "foto_kanan" =>$dsols-> foto_kanan,
                "foto_belakang" => $dsols->foto_belakang,
                "pengaju_opname" => $dsols->pengaju_opname,
                "type" => $dsols->type,
                "rincian_opname_lain2" => $dsols->rincian_opname_lain2,
                "opini" => $dsols->opini,
                "satuan" => $dsols->satuan,
                "masukan_angka" => $dsols->masukan_angka,
                "tanggal_approve_opname" => $tanggal_approve_opname,
                "pencairan" => $nilai_pencairan_akhir,
                "nama_pengapprove_opname" => $nama_pengapprove_opname->first_name
            );

           
            $this->db->insert("opname_lain2_spk", $data);
           
        }
        //Hapus Data Lama
        $this->db->where("id_stagging_opname_lain2_spk", $id_stagging_opname_lain2_spk);
        $this->db->delete("stagging_opname_lain2_spk");
         // Deklarasi $id_table_spk
         
        $this->session->set_flashdata("msg_success", "Opname Berhasil Diaprove!");
        redirect(base_url("Spv_operasional/request_opname_lain2"));
    }

    public function reject_opname_lain2($id_stagging_opname_lain2_spk) 
    {
        // Dapatkan data foto sebelum penghapusan
        $foto_data = $this->db->get_where("stagging_opname_hpp_spk", ["id_stagging_opname_lain2_spk" => $id_stagging_opname_lain2_spk])->row();
    
        // Hapus entri pada tabel stagging_opname_spk
        $this->db->where("id_stagging_opname_hpp_spk", $id_stagging_opname_lain2_spk); 
        $this->db->delete("stagging_opname_lain2_spk");
    
        // Hapus file foto terkait
        $fields_foto = array("foto_depan", "foto_belakang"); // Ganti dengan nama field foto yang sesuai
        foreach ($fields_foto as $field) {
            $foto_file = $foto_data->$field;
            if (!empty($foto_file)) {
                $file_path = '../tes/upload_spk/foto_opname/' . $foto_file; // Ganti dengan path folder foto yang sesuai
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
        } 
    
        // Notifikasi dan redirect
        $this->session->set_flashdata("msg_success", "Pengajuan Berhasil Ditolak.");
        redirect(base_url("Spv_operasional/request_opname_lain2"));
    }





	 
}