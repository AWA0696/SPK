<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_spk extends CI_Model
{

	public function getSpk()
	{ 

		$query = $this->db->query("SELECT * FROM table_spk")->result();
		return $query; 

	}

	//Untuk Dropdown Nama Perumahan di 
	public function getPerumahan()
	{

		$this->db->select('*');
		$this->db->from('perumahan_spk');
		$this->db->order_by('id_perumahan','asc');
		$query = $this->db->get();
		return $query->result();

	}

    public function getBiayaSpkEdit($id_table_spk)
	{

		$this->db->select('*');
		$this->db->from('biaya_spk');
		$this->db->where('id_table_spk',$id_table_spk);
		$query = $this->db->get();
		return $query->result();

	}

	public function getBlok()
	{

		$query = $this->db->query("SELECT * FROM blok_spk")->result();
		return $query; 

	}

	public function edit_query()
	{

		$query = $this->db->query("INSERT INTO `type_rumah_spk` (`nama_type`) VALUES 
		('36'), 
		('40'), 
		('43'), 
		('45'), 
		('60');")->result();
		return $query; 

	}

	public function simpanSpk($data, $table)
	{
		$this->db->insert($table, $data);
	}
	

	public function spkByPerumahan1($id_perumahan)
{
    $this->db->select('*');
    $this->db->from('table_spk');
    $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
    $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
    $this->db->join('penambahan_hari_spk', 'penambahan_hari_spk.id_table_spk = table_spk.id_table_spk');
    $this->db->where('table_spk.id_perumahan', $id_perumahan);
    $this->db->order_by('table_spk.tanggal_approve_spk', 'desc');
    $this->db->order_by('table_spk.id_table_spk', 'desc');
    $query = $this->db->get();
    return $query->result();
}

public function spkByPerumahan($id_perumahan)
{
    $subquery = $this->db->select('id_table_spk, SUM(penambahan_hari) AS total_penambahan_hari')
                        ->from('penambahan_hari_spk')
                        ->group_by('id_table_spk')
                        ->get_compiled_select();

    $this->db->select('table_spk.*, perumahan_spk.nama_perumahan, blok_spk.nama_blok, ph.total_penambahan_hari');
    $this->db->from('table_spk');
    $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan', 'left');
    $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok', 'left');
    $this->db->join("($subquery) as ph", 'ph.id_table_spk = table_spk.id_table_spk', 'left');
    $this->db->where('table_spk.id_perumahan', $id_perumahan);
    $this->db->order_by('table_spk.tanggal_approve_spk', 'desc');
    $this->db->order_by('table_spk.id_table_spk', 'desc');

    $query = $this->db->get();
    return $query->result();
}

	

	// Input JS untuk penambahan dan pengurangan SPK 
	public function insert_data($data,$table){
		$this->db->insert($table,$data);
	}

	public function delete_data($where,$table){
		$this->db->delete($table,$where);
	}

	public function simpanSpkDimodel(
	
	$nama_perumahan, 
	$blok_spk, 
	$type, 
	$nilai_borongan, 
	$tanggal_pengajuan_spk, 
	$tanggal_awal_spk, 
	$tanggal_akhir_spk, 
	$nama_kontraktor,
	$jenis_spk,
	$rincian)
    {
        $data = array(
			
			'id_perumahan' => $nama_perumahan,
			'id_blok' => $blok_spk,		
			'type_perumahan' => $type,
			'nilai_borongan' => $nilai_borongan,
			'tanggal_pengajuan_spk' => $tanggal_pengajuan_spk,
			'tanggal_awal_spk' => $tanggal_awal_spk,
			'tanggal_akhir_spk' => $tanggal_akhir_spk,
			'nama_kontraktor' => $nama_kontraktor,
			'jenis_spk' => $jenis_spk,
			'rincian' => $rincian
		);

        $this->db->insert('stagging_table_spk', $data);
        return $this->db->insert_id();
    }

	// public function getSpkPenambahanHari()
	// {

	// 	$query = $this->db->query("SELECT * FROM table_spk")->row();
	// 	return $query; 

	// }

	public function getSpkPenambahanHari($id_table_spk)
	{
		$this->db->select('*');
		$this->db->from('table_spk');
		$this->db->where('table_spk.id_table_spk', $id_table_spk);
		$query = $this->db->get();
		return $query->row();
		
	}

    function updatePenambahanHari($data, $table, $id_table_spk)
{
    $this->db->where('id_table_spk', $id_table_spk);
    $this->db->update($table, $data);
}

 public	function updatePenambahanHari1(

    
    $nama_perumahan, 
	$blok_spk, 
	$type, 
	$nilai_borongan, 
	$tanggal_pengajuan_spk, 
	$tanggal_awal_spk, 
	$tanggal_akhir_spk, 
	$nama_kontraktor,
	$jenis_spk,
	$rincian)
    {
        $data = array(
			
			'id_perumahan' => $nama_perumahan,
			'id_blok' => $blok_spk,		
			'type_perumahan' => $type,
			'nilai_borongan' => $nilai_borongan,
			'tanggal_pengajuan_spk' => $tanggal_pengajuan_spk,
			'tanggal_awal_spk' => $tanggal_awal_spk,
			'tanggal_akhir_spk' => $tanggal_akhir_spk,
			'nama_kontraktor' => $nama_kontraktor,
			'jenis_spk' => $jenis_spk,
			'rincian' => $rincian
		);

        $this->db->insert('stagging_table_spk', $data);
        return $this->db->insert_id();
}

public function getSpkDataById($id_table_spk)
	{
		$this->db->select('*');
		$this->db->from('table_spk');
		$this->db->where('table_spk.id_table_spk', $id_table_spk);
		$query = $this->db->get();
		return $query->row();
		
	}

// 	public function getSpkDataUntukPrint($id_table_spk)   
// {
//     $this->db->select('*');
//     $this->db->from('table_spk');
//     $this->db->where('table_spk.id_table_spk', $id_table_spk);
//     $query = $this->db->get();
//     return $query->row();
// }

public function getSpkDataUntukEdit($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('table_spk.id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->row();
    }

public function getSpkDataUntukPrint($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('table_spk.id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getBiayaSpk($id_table_spk) 
    {
        $this->db->select('*');
        $this->db->from('biaya_spk');
        $this->db->where('biaya_spk.id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getListOpname($id_table_spk) 
    {
        $this->db->select('*');
        $this->db->from('opname_spk');
        $this->db->join('table_spk', 'table_spk.id_table_spk = opname_spk.id_table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('table_spk.id_table_spk', $id_table_spk);
        $this->db->order_by('opname_spk.opini', 'asc');
        $query = $this->db->get();
        return $query->result(); 
    }

public function getListOpnameHpp($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('opname_hpp_spk');
        $this->db->join('table_spk', 'table_spk.id_table_spk = opname_hpp_spk.id_table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('table_spk.id_table_spk', $id_table_spk);
        $this->db->order_by('opname_hpp_spk.id_opname_hpp_spk', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

public function getListOpnameLain2($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('opname_lain2_spk');
        $this->db->join('table_spk', 'table_spk.id_table_spk = opname_lain2_spk.id_table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('opname_lain2_spk.id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    }

    public function getListOpnameLain2View($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('opname_lain2_spk_view');
        $this->db->join('table_spk', 'table_spk.id_table_spk = opname_lain2_spk_view.id_table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('opname_lain2_spk_view.id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getBiayaRetensi($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('biaya_retensi_spk');
        $this->db->where('id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result(); 
    }

public function getListRetensi($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('retensi_spk');
        $this->db->where('id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result(); 
    }

public function detailRetensi($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('retensi_spk');
        $this->db->where('id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->row(); 
    }

public function getAllOpnameHpp($id_opname_hpp_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('opname_hpp_spk', 'opname_hpp_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('opname_hpp_spk.id_opname_hpp_spk', $id_opname_hpp_spk);
        $query = $this->db->get();
        return $query->result();
    }   

public function getAllOpnameLain2($id_opname_lain2_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('opname_lain2_spk', 'opname_lain2_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('opname_lain2_spk.id_opname_lain2_spk', $id_opname_lain2_spk);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllOpnameLain2View($id_opname_lain2_spk_view)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('opname_lain2_spk_view', 'opname_lain2_spk_view.id_table_spk = table_spk.id_table_spk');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('opname_lain2_spk_view.id_opname_lain2_spk_view', $id_opname_lain2_spk_view);
        $query = $this->db->get();
        return $query->result();
    }

public function getPerumahanDanBlokOpname($id_table_spk)
	{

		$this->db->select('*');
		$this->db->from('table_spk');
		$this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
		$this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
		$this->db->where('id_table_spk',$id_table_spk);
		$query = $this->db->get();
		return $query->row();

	}

	

public function getListSpmbRumah($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->join('opname_spk', 'opname_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->group_by('table_spk.id_table_spk');
        $this->db->where('table_spk.id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getAllOpname($id_opname_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('opname_spk', 'opname_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('opname_spk.id_opname_spk', $id_opname_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getDataOpname($id_opname_spk) 
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('opname_spk', 'opname_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->where('opname_spk.id_opname_spk', $id_opname_spk);
        $query = $this->db->get();
        $result = $query->result_array();

        if ($result) {
            $id_table_spk_array = array_column($result, 'id_table_spk');
            return $id_table_spk_array;
        } else {
            return array();
        } 
    }

public function getDataOpnameHpp($id_opname_hpp_spk) 
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('opname_hpp_spk', 'opname_hpp_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->where('opname_hpp_spk.id_opname_hpp_spk', $id_opname_hpp_spk);
        $query = $this->db->get();
        $result = $query->result_array();

        if ($result) {
            $id_table_spk_array = array_column($result, 'id_table_spk'); 
            return $id_table_spk_array;
        } else {
            return array();
        }
    }

    public function getDataOpnameLain2View($id_opname_lain2_spk_view) 
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('opname_lain2_spk_view', 'opname_lain2_spk_view.id_table_spk = table_spk.id_table_spk');
        $this->db->where('opname_lain2_spk_view.id_opname_lain2_spk_view', $id_opname_lain2_spk_view);
        $query = $this->db->get();
        $result = $query->result_array();

        if ($result) {
            $id_table_spk_array = array_column($result, 'id_table_spk'); 
            return $id_table_spk_array;
        } else {
            return array();
        }
    }




public function getAdendumSpk($id_table_spk)
	{

		$this->db->select('*');
		$this->db->from('biaya_adendum_spk');
		$this->db->where('id_table_spk', $id_table_spk);
		$query = $this->db->get();
		return $query->result();

	}

public function getRetensiSpk($id_table_spk)
	{

		$this->db->select('*');
		$this->db->from('biaya_retensi_spk');
		$this->db->where('id_table_spk', $id_table_spk);
		$query = $this->db->get();
		return $query->result();

	}

public function simpanAdendumDimodel(
    $id_table_spk, 
    $nama_konsumen_adendum, 
    $alamat, 
    $no_telp, 
    $rincian_adendum,
    $tanggal_input_adendum
    )
    {
        $data = array(
            'id_table_spk' => $id_table_spk,
            'nama_konsumen_adendum' => $nama_konsumen_adendum,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'rincian_adendum' => $rincian_adendum,
            'tanggal_input_adendum' => $tanggal_input_adendum	
            
        );

        $this->db->insert('adendum_spk', $data);
        return $this->db->insert_id();
    }
public function simpanPenguranganRetensiDimodel(
    $id_table_spk, 
    $rincian_retensi,
    $tanggal_input_retensi
    )
    {
        $data = array(
            'id_table_spk' => $id_table_spk,
            'rincian_retensi' => $rincian_retensi,
            'tanggal_input_retensi' => $tanggal_input_retensi	
            
        );

        $this->db->insert('retensi_spk', $data);
        return $this->db->insert_id();
    }

public function getOpnameByIdSpkForSpmb($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('opname_spk', 'opname_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('opname_spk.id_opname_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getSpkForSpmb($id_table_spk)
    {
        $this->db->select('
        table_spk.*, 
        penambahan_hari_spk.*, 
        SUM(penambahan_hari_spk.penambahan_hari) AS total_penambahan_hari, 
        perumahan_spk.nama_perumahan,
        blok_spk.nama_blok');
        $this->db->from('table_spk');
        $this->db->join('penambahan_hari_spk', 'penambahan_hari_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('table_spk.id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getRincianPenambahanHari($id_table_spk)
    {
        // Menggunakan Query Builder CI untuk melakukan join dan agregasi
        $this->db->select("*");
        $this->db->from('penambahan_hari_spk');
        $this->db->where('penambahan_hari_spk.id_table_spk', $id_table_spk);
        // Grouping data berdasarkan id_table_spk
       
    
        // Eksekusi query dan ambil hasilnya
        $query = $this->db->get();
        return $query->result();
    }

public function getPenambahanHari1($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('penambahan_hari');
        $this->db->where('penambahan_hari.id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getDataOpnameSpk($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('opname_spk');
        $this->db->where('id_table_spk', $id_table_spk);
        $this->db->order_by('opini', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

public function getOpnameTanggalPencairan($id_opname_spk)
	{
		$this->db->select('*');
		$this->db->from('opname_spk');
		$this->db->where('opname_spk.id_opname_spk', $id_opname_spk);
		$query = $this->db->get();
		return $query->row();
		
	}

public function getIdSpkFormOpname($id_opname_spk)
	{
		$this->db->select('*');
		$this->db->from('opname_spk');
		$this->db->where('opname_spk.id_opname_spk', $id_opname_spk);
		$query = $this->db->get();
		return $query->row();
		
	}

public function updateTanggalPencairan($data, $table, $id_opname_spk)
    {
        $this->db->where('id_opname_spk', $id_opname_spk);
        $this->db->update($table, $data);
    }

public function getidSpk($id_table_spk)
    {
        $this->db->select('id_table_spk');
        $this->db->from('table_spk');
        $this->db->where('table_spk.id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->row();
    }

public function getListForAdendum($id_table_adendum)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->join('adendum_spk', 'adendum_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->where('adendum_spk.id_table_spk', $id_table_adendum);
        $query = $this->db->get();
        return $query->result();
    }

public function getSpkforAdendum($id_table_adendum)
    {
        $this->db->select('*');
        $this->db->from('adendum_spk');
        $this->db->join('table_spk', 'table_spk.id_table_spk = adendum_spk.id_table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('adendum_spk.id_table_adendum', $id_table_adendum);
        $query = $this->db->get();
        return $query->result();
    }

public function getListSpmbRumahHpp($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->join('opname_hpp_spk', 'opname_hpp_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->group_by('table_spk.id_table_spk');
        $this->db->where('table_spk.id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    } 

public function getListSpmbLain2($id_table_spk)  
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->join('opname_lain2_spk', 'opname_lain2_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->group_by('table_spk.id_table_spk');
        $this->db->where('table_spk.id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    }

    public function getListSpmbLain2View($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->join('opname_lain2_spk_view', 'opname_lain2_spk_view.id_table_spk = table_spk.id_table_spk');
        $this->db->group_by('table_spk.id_table_spk');
        $this->db->where('table_spk.id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    }
 

public function getDataOpnameSpkHpp($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('opname_hpp_spk');
        $this->db->where('id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataOpnameSpkLain2View($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('opname_lain2_spk_view');
        $this->db->where('id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result(); 
    }

public function getDataOpnameSpkLain2($id_table_spk)
    {
        $this->db->select('*');
        $this->db->from('opname_lain2_spk');
        $this->db->where('id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getAdendumSpkHpp($id_opname_hpp_spk)
	{

		$this->db->select('*');
		$this->db->from('biaya_adendum_spk_hpp');
		$this->db->where('id_opname_hpp_spk', $id_opname_hpp_spk);
		$query = $this->db->get();
		return $query->result();

	}

public function getBiayaSpkHpp($id_opname_hpp_spk)
    {
        $this->db->select('*');
        $this->db->from('biaya_spk_hpp');
        $this->db->where('biaya_spk_hpp.id_opname_hpp_spk', $id_opname_hpp_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getRequestOpname()
	{

		$this->db->select('*');
		$this->db->from('stagging_opname_spk');
		$this->db->join('perumahan_spk','perumahan_spk.id_perumahan = stagging_opname_spk.id_perumahan');
		$this->db->join('blok_spk','blok_spk.id_blok = stagging_opname_spk.id_blok');
		$this->db->order_by('stagging_opname_spk.id_stagging_opname_spk','desc');
		$query = $this->db->get();
		return $query->result();
	}

public function getDataOpnameTableSpkStagging($id_stagging_opname_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('stagging_opname_spk', 'stagging_opname_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('stagging_opname_spk.id_stagging_opname_spk', $id_stagging_opname_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getDataOpnameStaging($id_stagging_opname_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('stagging_opname_spk', 'stagging_opname_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->where('stagging_opname_spk.id_stagging_opname_spk', $id_stagging_opname_spk);
        $query = $this->db->get();
        $result = $query->result_array();

        if ($result) {
            $id_table_spk_array = array_column($result, 'id_table_spk');
            return $id_table_spk_array;
        } else {
            return array();
        }
    }

public function getRequestOpnameHpp()
	{

		$this->db->select('*');
		$this->db->from('stagging_opname_hpp_spk');
		$this->db->join('perumahan_spk','perumahan_spk.id_perumahan = stagging_opname_hpp_spk.id_perumahan');
		$this->db->join('blok_spk','blok_spk.id_blok = stagging_opname_hpp_spk.id_blok');
		$this->db->order_by('stagging_opname_hpp_spk.id_stagging_opname_hpp_spk','desc');
		$query = $this->db->get();
		return $query->result();
	}

public function getDataOpnameHppTableSpkStagging($id_stagging_opname_hpp_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('stagging_opname_hpp_spk', 'stagging_opname_hpp_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('stagging_opname_hpp_spk.id_stagging_opname_hpp_spk', $id_stagging_opname_hpp_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getDataOpnameHppStaging($id_stagging_opname_hpp_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('stagging_opname_hpp_spk', 'stagging_opname_hpp_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->where('stagging_opname_hpp_spk.id_stagging_opname_hpp_spk', $id_stagging_opname_hpp_spk);
        $query = $this->db->get();
        $result = $query->result_array();

        if ($result) {
            $id_table_spk_array = array_column($result, 'id_table_spk');
            return $id_table_spk_array;
        } else {
            return array(); 
        } 
    }

public function getBiayaSpkForHpp($id_table_spk)
	{

		$this->db->select('*');
		$this->db->from('biaya_spk_approve');
		$this->db->where('id_table_spk', $id_table_spk);
		$query = $this->db->get();
		return $query->result();

	}

public function getAdendumSpkForHpp($id_table_spk)
    {

        $this->db->select('*');
        $this->db->from('biaya_adendum_spk_approve');
        $this->db->where('id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();

    }

public function getRequestOpnameLain2()
    {

        $this->db->select('*');
        $this->db->from('stagging_opname_lain2_spk');
        $this->db->join('perumahan_spk','perumahan_spk.id_perumahan = stagging_opname_lain2_spk.id_perumahan');
        $this->db->join('blok_spk','blok_spk.id_blok = stagging_opname_lain2_spk.id_blok');
        $this->db->order_by('stagging_opname_lain2_spk.id_stagging_opname_lain2_spk','desc');
        $query = $this->db->get();
        return $query->result();
    }

public function getDataOpnameLain2TableSpkStagging($id_stagging_opname_lain2_spk)
    {
        $this->db->select('*');
        $this->db->from('table_spk');
        $this->db->join('perumahan_spk', 'perumahan_spk.id_perumahan = table_spk.id_perumahan');
        $this->db->join('stagging_opname_lain2_spk', 'stagging_opname_lain2_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->join('blok_spk', 'blok_spk.id_blok = table_spk.id_blok');
        $this->db->where('stagging_opname_lain2_spk.id_stagging_opname_lain2_spk', $id_stagging_opname_lain2_spk);
        $query = $this->db->get();
        return $query->result();
    }

public function getDataOpnameLain2Staging($id_stagging_opname_lain2_spk)
    {
        $this->db->select('*'); 
        $this->db->from('table_spk');
        $this->db->join('stagging_opname_lain2_spk', 'stagging_opname_lain2_spk.id_table_spk = table_spk.id_table_spk');
        $this->db->where('stagging_opname_lain2_spk.id_stagging_opname_lain2_spk', $id_stagging_opname_lain2_spk);
        $query = $this->db->get();
        $result = $query->result_array();

        if ($result) {
            $id_table_spk_array = array_column($result, 'id_table_spk');
            return $id_table_spk_array;
        } else {
            return array(); 
        } 
    }

public function getBiayaSpkForLain2($id_table_spk)
	{

		$this->db->select('*');
		$this->db->from('biaya_spk_approve');
		$this->db->where('id_table_spk', $id_table_spk);
		$query = $this->db->get();
		return $query->result();

	}

public function getAdendumSpkForLain2($id_table_spk)
    {

        $this->db->select('*');
        $this->db->from('biaya_adendum_spk_approve');
        $this->db->where('id_table_spk', $id_table_spk);
        $query = $this->db->get();
        return $query->result();

    }

    

}