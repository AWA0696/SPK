<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akuntan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->model('Akun');
		$this->load->model('Transaksi');
		$this->load->model('Jurnal_umum');
		$this->load->model('Cashflow');
		$this->load->library('Pitih');

		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('msg_danger', 'Anda harus login untuk mengakses halaman ini');
			redirect('Auth/login');
		}

		$this->db->query("SET SESSION sql_mode = ''");
	}

	public function index()
	{
		$dv['transaksi'] = $this->Transaksi->get_all_transaksi_kas();

		$dt['style'] = 'input';
		$db['script'] = 'input';

		$this->load->view('t/top', $dt);
		$this->load->view('input/all_transaksi', $dv);
		$this->load->view('t/bottom', $db);

		// redirect(base_url("Akuntan/input"));
	}

	public function input($id = "", $type = "")
	{
		$this->form_validation->set_rules("tanggal", "Tanggal", "required");
		$this->form_validation->set_rules("transaksi", "Transaksi", "required");
		$this->form_validation->set_rules("akun_debet[]", "Akun pada Debet", "required");
		$this->form_validation->set_rules("akun_kredit[]", "Akun pada Kredit", "required");
		$this->form_validation->set_rules("cashflow", "Jenis Cashflow", "in_list[0,1,2,3]");
		$this->form_validation->set_rules("angka_debet[]", "Jumlah transaksi pada debet (Rp.)", "required");
		$this->form_validation->set_rules("angka_kredit[]", "Jumlah transaksi pada kredit (Rp.)", "required");
		$this->form_validation->set_rules("id", "ID", "required");

		if ($this->form_validation->run() == TRUE) {
			// validasi berhasil, simpan data.
			// print_r($_POST);
			// proteksi agar jumlah angka_kredit = angka_debet
			$total_angka_kredit = 0;
			foreach ($this->input->post('angka_kredit') as $ang_kredit) {
				$total_angka_kredit += intval(preg_replace('/\D/', '', $ang_kredit));
			}

			$total_angka_debet = 0;
			foreach ($this->input->post('angka_debet') as $ang_debet) {

				$total_angka_debet += intval(preg_replace('/\D/', '', $ang_debet));
			}

			if ($total_angka_kredit != $total_angka_debet) {
				$this->session->set_flashdata('msg_danger', 'Total Debet dan Kredit tidak sama!');
				redirect(base_url('Akuntan/input'));
			}

			// simpan transaksi
			$id_transaksi = $this->Transaksi->simpanTransaksi($this->input->post('tanggal'), $this->input->post('transaksi'));
			if (!$id_transaksi) {
				$this->session->set_flashdata('msg_danger', 'Error menyimpan data transaksi.');
				redirect(base_url('Akuntan/input'));
			}


			// simpan jurnal umum
			$ju = $this->Transaksi->simpanJurnalUmum($id_transaksi);

			// simpan akun debet			
			foreach ($this->input->post('akun_debet') as $key => $a_debet) {
				$debet_flag = 0;
				if (substr($a_debet, 0, 1) == 'a') {
					$debet_flag = 1;
				} else {
					$debet_flag = 2;
				}

				$sub_akun = substr($a_debet, 1);

				$id_akun = 0;
				if ($debet_flag == 1) {
					$id_akun = $this->Akun->getAkunBySub($sub_akun);
				} else {
					$id_akun = $this->Akun->getIsAkunBySub($sub_akun);
				}

				$angka_debet = intval(preg_replace('/\D/', '', $this->input->post("angka_debet[" . $key . "]")));

				$this->Transaksi->simpanAkunDebet($ju, $debet_flag, $sub_akun, $id_akun, $angka_debet);
				// echo "Flag: ".$debet_flag." Akun: ".$akun."<br>";
			}

			// simpan akun kredit 
			foreach ($this->input->post('akun_kredit') as $key => $a_kredit) {
				$kredit_flag = 0;
				if (substr($a_kredit, 0, 1) == 'a') {
					$kredit_flag = 1;
				} else {
					$kredit_flag = 2;
				}

				$sub_akun = substr($a_kredit, 1);
				$id_akun = 0;
				if ($kredit_flag == 1) {
					$id_akun = $this->Akun->getAkunBySub($sub_akun);
				} else {
					$id_akun = $this->Akun->getIsAkunBySub($sub_akun);
				}

				$angka_kredit = intval(preg_replace('/\D/', '', $this->input->post("angka_kredit[" . $key . "]")));
				// echo "Flag: ".$kredit_flag." Akun: ".$akun."<br>";
				$this->Transaksi->simpanAkunKredit($ju, $kredit_flag, $sub_akun, $id_akun, $angka_kredit);
			}


			// simpan cashflow simpanCashflow($id_transaksi, $tipe)
			$posisi_cashflow = 1;
			$jumlah_cashflow = 0;
			$input_cashflow = 0;

			// koreksi nilai cashflow 
			if (empty($this->input->post("angka_cashflow"))) {
				$input_cashflow = 0;
			} else {
				$input_cashflow = intval(preg_replace('/\D/', '', $this->input->post("angka_cashflow")));
			}

			if ($this->input->post('posisi_cashflow') == 0) {
				$jumlah_cashflow = ($input_cashflow * -1);
			} else {
				$jumlah_cashflow = $input_cashflow;
			}
			$cf = $this->Transaksi->simpanCashflow($id_transaksi, $this->input->post('cashflow'), $jumlah_cashflow, $this->input->post('posisi_cashflow'));

			// if(($ju) AND ($cf))
			// {

			// untuk mengubah status transaksi,
			$tipe = $this->input->post('tipe');
			$ids = $this->input->post('id');

			if ($tipe == 2) {
				$this->db->where("id", $ids);
				$this->db->update('administrator_pengeluaran',  array("status" => 1));
			} else if ($tipe == 1) {
				$this->db->where("id", $ids);
				$this->db->update('kasir_kas_besar', array('status' => 1));
			} else if ($tipe == 3) {
				$this->db->where("id", $ids);
				$this->db->update('administrator_operasional', array('status' => 1));
			}



			$this->session->set_flashdata('msg_success', 'Transaksi berhasil disimpan.');
			redirect(base_url('Akuntan/index'));
			// }
			// else
			// {
			// 	$this->session->set_flashdata('msg_danger', 'Transaksi gagal disimpan.');
			// 	redirect(base_url('Akuntan/input'));
			// }

		} else {
			// validasi gagal, tampikan form:

			if ($type == 1) {
				$dv['transaksi'] = $this->Transaksi->get_all_transaksi_kas_besar_byid($id);
			} else if ($type == 2) {
				$dv['transaksi'] = $this->Transaksi->get_all_transaksi_kas_kecil_byid($id);
			} else if ($type == 3) {
				$dv['transaksi'] = $this->Transaksi->get_all_transaksi_kas_operasional_byid($id);
			}
			$dv['akun'] = $this->Akun->getSubAkun();
			$dv['akun_is'] = $this->Akun->getIsAkun();

			$dt['style'] = 'input';
			$db['script'] = 'input';

			$this->load->view('t/top', $dt);
			$this->load->view('input/content', $dv);
			$this->load->view('t/bottom', $db);
		}
	}

	public function delete_transaksi()
	{
		// untuk mengubah status transaksi
		$tipe = $this->input->post('tipe');
		$ids = $this->input->post('id');

		if ($tipe == 2) {
			$this->db->where("id", $ids);
			$this->db->update('administrator_pengeluaran',  array("status" => 1));
		} else if ($tipe == 1) {
			$this->db->where("id", $ids);
			$this->db->update('kasir_kas_besar', array('status' => 1));
		} else if ($tipe == 3) {
			$this->db->where("id", $ids);
			$this->db->update('administrator_operasional', array('status' => 1));
		}

		$this->session->set_flashdata('msg_success', 'Transaksi berhasil Dihapus.');
		redirect(base_url('Akuntan/index'));
	}

	// manajemen transaksi:
	public function transaksi($page = '')
	{
		if (intval($page) < 1) {
			$offset =	0;
		} else {
			$offset = $page;
		}

		// $data_transaksi = $this->Transaksi->getTransaksiByOffset($offset);
		$data_transaksi = $this->Transaksi->getTransaksi($offset);

		$this->load->library('pagination');

		$config['base_url'] = base_url('Akuntan/transaksi');
		$config['total_rows'] = $this->Transaksi->getNumTransaksi();
		$config['per_page'] = 20;

		$this->pagination->initialize($config);

		$dv['page'] = $this->pagination->create_links();

		// $dv["transaksi"] = $this->Transaksi->getTransaksi();
		$dv["transaksi"] = $data_transaksi;
		$db['script'] = 'transaksi';
		$this->load->view('t/top');
		$this->load->view('transaksi/content', $dv);
		$this->load->view('t/bottom', $db);
	}

	public function hapus_transaksi()
	{
		$this->form_validation->set_rules("id_transaksi_delete", "ID Transaksi", "required|numeric");
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata("msg_danger", "Kesalahan input ID transaksi.");
			redirect(base_url("Akuntan/transaksi"));
		}

		$id_transaksi = $this->input->post("id_transaksi_delete");

		// dapatkan id jurnal umum:
		$ju = $this->Transaksi->getIdJurnalUmum($id_transaksi);

		// hapus cashflow:
		$this->Transaksi->deleteCashflow($id_transaksi);

		// hapus jurnal debet:
		$this->Transaksi->deleteJurnalDebet($ju);

		// hapus jurnal kredit:
		$this->Transaksi->deleteJurnalKredit($ju);

		// hapus jurnal umum:
		$this->Transaksi->deleteJurnalUmum($ju);

		// hapus transaksi:
		$res = $this->Transaksi->deleteTransaksi($id_transaksi);
		if ($res) {
			$this->session->set_flashdata("msg_success", "Transaksi berhasil dihapus.");
			redirect(base_url("Akuntan/transaksi"));
		} else {
			$this->session->set_flashdata("msg_danger", "Transaksi gagal dihapus.");
			redirect(base_url("Akuntan/transaksi"));
		}
	}

	public function jurnal_umum($page = '')
	{
		// pagination
		if (intval($page) < 1) {
			$offset =	0;
		} else {
			$offset = $page;
		}

		$data_jurnal_umum = $this->Jurnal_umum->getJurnalUmumByOffset($offset);

		// data:
		$dv['akun'] = $this->Akun->getSubAkun();
		$dv['akun_is'] = $this->Akun->getIsAkun();
		$dv['jurnal_umum'] = $data_jurnal_umum;

		$this->load->library('pagination');

		$config['base_url'] = base_url('Akuntan/jurnal_umum');
		$config['total_rows'] = $this->Jurnal_umum->getNumJurnalUmum();
		$config['per_page'] = 20;

		$this->pagination->initialize($config);

		$dv['page'] = $this->pagination->create_links();

		// $db['script'] = 'jurnal_umum';

		$this->load->view('t/top');
		$this->load->view('jurnal_umum/content', $dv);
		$this->load->view('t/bottom');
	}

	public function cashflow()
	{
		$dv['cashflow'] = $this->Cashflow->getCashflow();
		$dv['rekap_cashflow'] = $this->Cashflow->rekapCashflow();
		$dv['all_cashflow'] = $this->Cashflow->allCashflow();
		$dt['style'] = "cashflow";
		$db['script'] = "cashflow";
		$this->load->view('t/top');
		$this->load->view('cashflow/content', $dv);
		$this->load->view('t/bottom', $db);
	}

	public function cashflow_pertahun()
	{
		$this->form_validation->set_rules("tahun", "Tahun", "required|numeric");
		if ($this->form_validation->run() == TRUE) {
			$dv['tahun'] = $this->input->post("tahun");
			$this->load->view('t/top');
			$this->load->view('cashflow_pertahun/content', $dv);
			$this->load->view('t/bottom');
		} else {
			$this->session->set_flashdata("msg_danger", "Terjadi kesalahan pada input tahun.");
			redirect(base_url("Akuntan/cashflow"));
		}
	}

	public function balance_sheet()
	{
		$this->load->model('Balance_sheet');
		$dv['akun'] = $this->Akun->getAkun();
		$dv['sub_akun'] = $this->Akun->getSubAkun();
		$dv['balance_sheet'] = $this->Balance_sheet->getBalanceSheet();
		$dv['akun_debet'] = $this->Balance_sheet->getDebet();
		$dv['akun_kredit'] = $this->Balance_sheet->getKredit();
		$dv['sum_akun_debet'] = $this->Balance_sheet->getSumDebet();
		$dv['sum_akun_kredit'] = $this->Balance_sheet->getSumKredit();

		// +++++++++++++++++++++ Init data:
		$this->load->model("Init");
		$dv['init_debet'] = $this->Init->getInitBsDebet();
		$dv['init_kredit'] = $this->Init->getInitBsKredit();

		// +++++++++++++++++++++ Earnings:
		$this->load->model("Income_statement");

		$is_sub_akun = $this->Akun->getIsAkun();
		$is_akun_debet = $this->Income_statement->getDebet();
		$is_akun_kredit = $this->Income_statement->getKredit();
		$is_sum_akun_debet = $this->Income_statement->getSumDebet();
		$is_sum_akun_kredit = $this->Income_statement->getSumKredit();
		$is_zakat_debet = $this->Income_statement->getZakatDebet()->jumlah;
		$is_zakat_kredit = $this->Income_statement->getZakatKredit()->jumlah;

		$sub_akun_is = array();
		$income_s = array();

		foreach ($is_sub_akun as $s_ak) {
			array_push($sub_akun_is, array('id_sub_akun' => $s_ak->id, 'id_akun' => $s_ak->id_akun, 'nama_sub_akun' => $s_ak->nama, 'jumlah' => 0, 'sum_debet' => 0, 'sum_kredit' => 0, 'jenis' => $s_ak->jenis, 'dk' => 0));
		}

		// update jumlah:
		foreach ($sub_akun_is as $sais) {
			// akun debet
			foreach ($is_sum_akun_debet as $ak_d) {
				if ($ak_d->id_sub_akun == $sais["id_sub_akun"]) {
					$sais['jumlah'] = $sais['jumlah'] + $ak_d->jumlah;
					$sais['sum_debet'] = $sais['sum_debet'] + $ak_d->jumlah;
					$sais['dk'] = 1; // debet 1, kredit 0
					// echo $sais['jumlah'];
					break;
				}
			}

			// akun kredit
			foreach ($is_sum_akun_kredit as $ak_k) {
				if ($ak_k->id_sub_akun == $sais["id_sub_akun"]) {
					$sais['jumlah'] = $sais['jumlah'] - $ak_k->jumlah;
					$sais['sum_kredit'] = $sais['sum_kredit'] + $ak_k->jumlah;
					$sais['dk'] = 0;
					// echo $sais['jumlah'];
					break;
				}
			}

			// print_r($sais);
			array_push($income_s, $sais);
		}

		$total_gross_profit = 0;
		// sales 
		foreach ($income_s as $sais) {
			if ($sais['id_akun'] == 1) {

				$jumlah = ($sais['sum_debet'] - $sais['sum_kredit']) * -1;
				if ($jumlah < 0) {
					$angka = '(' . $this->pitih->formatrupiah(($jumlah * -1)) . ')';
				} else {
					$angka = $this->pitih->formatrupiah($jumlah);
				}

				$total_gross_profit += $jumlah;
			}
		}

		// other income:
		foreach ($income_s as $sais) {
			if ($sais['id_akun'] == 2) {
				$jumlah = ($sais['sum_debet'] - $sais['sum_kredit']) * -1;
				if ($jumlah < 0) {
					$angka = '(' . $this->pitih->formatrupiah(($jumlah * -1)) . ')';
				} else {
					$angka = $this->pitih->formatrupiah($jumlah);
				}

				$total_gross_profit += $jumlah;
			}
		}

		// cost of good sold
		foreach ($income_s as $sais) {
			if ($sais['id_akun'] == 3) {
				$jumlah = ($sais['sum_debet'] - $sais['sum_kredit']) * -1;
				if ($jumlah < 0) {
					$angka = '(' . $this->pitih->formatrupiah(($jumlah * -1)) . ')';
				} else {
					$angka = $this->pitih->formatrupiah($jumlah);
				}

				$total_gross_profit += $jumlah;
			}
		}

		// echo $total_gross_profit;

		$total_operating_expense = 0;

		// operating expense
		foreach ($income_s as $sais) {
			if ($sais['id_akun'] == 4) {
				$jumlah = ($sais['sum_debet'] - $sais['sum_kredit']) * -1;
				if ($jumlah < 0) {
					$angka = '(' . $this->pitih->formatrupiah(($jumlah * -1)) . ')';
				} else {
					$angka = $this->pitih->formatrupiah($jumlah);
				}

				$total_operating_expense += $jumlah;
			}
		}

		// echo $total_operating_expense;

		$total_ebitda = $total_gross_profit + $total_operating_expense;

		// ebit
		$total_ebit = 0;
		foreach ($income_s as $sais) {
			if ($sais['jenis'] == "3") {
				$jumlah = ($sais['sum_debet'] - $sais['sum_kredit']) * -1;
				if ($jumlah < 0) {
					$angka = '(' . $this->pitih->formatrupiah(($jumlah * -1)) . ')';
				} else {
					$angka = $this->pitih->formatrupiah($jumlah);
				}

				$total_ebit += $jumlah;
			}
		}
		$total_ebit = $total_ebit + $total_ebitda;

		// ebt
		$total_ebt = 0;
		foreach ($income_s as $sais) {
			if ($sais['jenis'] == "4") {

				$jumlah = ($sais['sum_debet'] - $sais['sum_kredit']) * -1;
				if ($jumlah < 0) {
					$angka = '(' . $this->pitih->formatrupiah(($jumlah * -1)) . ')';
				} else {
					$angka = $this->pitih->formatrupiah($jumlah);
				}

				$total_ebt += $jumlah;
			}
		}
		$total_ebt = $total_ebt + $total_ebit;

		// net profit			
		$total_net_profit = 0;
		foreach ($income_s as $sais) {
			if ($sais['jenis'] == "5") {
				$jumlah = ($sais['sum_debet'] - $sais['sum_kredit']) * -1;
				if ($jumlah < 0) {
					$angka = '(' . $this->pitih->formatrupiah(($jumlah * -1)) . ')';
				} else {
					$angka = $this->pitih->formatrupiah($jumlah);
				}

				$total_net_profit += $jumlah;
			}
		}
		$total_net_profit = $total_net_profit + $total_ebt;

		$zakat = (($is_zakat_debet - $is_zakat_kredit) * -1);

		// net profit after zakat
		$net_profit_after_zakat = $total_net_profit + $zakat;

		$dv['earnings'] = $net_profit_after_zakat;


		$this->load->view('t/top');
		$this->load->view('balance_sheet/content', $dv);
		$this->load->view('t/bottom');
	}

	public function income_statement()
	{
		$this->load->model('Income_statement');
		$dv['income_statement'] = $this->Income_statement->getIs();
		$dv['sub_akun'] = $this->Akun->getIsAkun();
		$dv['akun_debet'] = $this->Income_statement->getDebet();
		$dv['akun_kredit'] = $this->Income_statement->getKredit();
		$dv['sum_akun_debet'] = $this->Income_statement->getSumDebet();
		$dv['sum_akun_kredit'] = $this->Income_statement->getSumKredit();
		$dv['zakat_debet'] = $this->Income_statement->getZakatDebet()->jumlah;
		$dv['zakat_kredit'] = $this->Income_statement->getZakatKredit()->jumlah;

		// +++++++++++++++++++++ Init data:
		$this->load->model("Init");
		$dv['init_debet'] = $this->Init->getInitIsDebet();
		$dv['init_kredit'] = $this->Init->getInitIsKredit();

		$this->load->view('t/top');
		$this->load->view('income_statement/content', $dv);
		$this->load->view('t/bottom');
	}

	// detail history akun
	public function history($id_sub_akun = '', $tipe = '')
	{
		// if((intval($id_sub_akun) < 1) OR (intval($tipe) < 1))
		// {
		// 	$this->session->set_flashdata("msg_danger", "Error input id sub akun atau tipe akun.");
		// 	redirect(base_url("Akuntan/jurnal_umum"));
		// }

		// validation:
		$data = array("id_sub_akun" => $id_sub_akun, "tipe" => $tipe);
		$this->form_validation->set_data($data);

		$this->form_validation->set_rules("id_sub_akun", "ID Sub Akun", "required|numeric");
		$this->form_validation->set_rules("tipe", "Tipe Akun", "required|in_list[1,2]");

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("msg_danger", "Error input id sub akun atau tipe akun.");
			redirect(base_url("Akuntan/jurnal_umum"));
		}

		$this->load->model("Akun");
		$arr1 = $this->Akun->history_kredit($id_sub_akun, $tipe);
		$arr2 = $this->Akun->history_debet($id_sub_akun, $tipe);

		$result = array_merge($arr1, $arr2);

		usort($result, array($this, "date_cmp"));

		$dv["history"] = $result;

		if ($tipe == 1) {
			$nama_sub_akun = $this->Akun->getNamaAkun($id_sub_akun);
		} else {
			$nama_sub_akun = $this->Akun->getIsNamaAkun($id_sub_akun);
		}

		$dv["nama_sub_akun"] = $nama_sub_akun;

		$this->load->view('t/top');
		$this->load->view('history/content', $dv);
		$this->load->view('t/bottom', array("script" => "history"));
	}

	// ganti password
	public function ganti_password()
	{
		$this->load->view('t/top');
		$this->load->view('ganti_password/content');
		$this->load->view('t/bottom');
	}

	// inisialisasi balance sheet:
	public function init_balance_sheet()
	{
		$this->load->model('Init');

		if ($this->input->post("submit") === NULL) {
			$db['script'] = 'init_balance_sheet';
			$this->load->view('t/top');
			$this->load->view('init_balance_sheet/content');
			$this->load->view('t/bottom', $db);
		} else {

			$koleksi_debet = array();
			$koleksi_kredit = array();
			foreach ($_POST as $key => $value) {
				# code...
				if (!empty($value)) {
					// echo $key.": ".$value."<br>";
					if (substr($key, 0, 1) == "d") {
						// simpan ke koleksi debet:
						array_push($koleksi_debet, array("id_sub_akun" => substr($key, 1), "jumlah" => intval(preg_replace('/\D/', '', $value))));
					} else {
						array_push($koleksi_kredit, array("id_sub_akun" => substr($key, 1), "jumlah" => intval(preg_replace('/\D/', '', $value))));
					}
				}
			}

			// print_r($koleksi_debet);
			// echo "<br><br>";
			// print_r($koleksi_kredit);

			// simpan ke dalam database:
			foreach ($koleksi_debet as $k_deb) {
				$this->Akun->init_akun_debet("1", $k_deb['id_sub_akun'], $k_deb['jumlah']);
			}

			foreach ($koleksi_kredit as $k_kre) {
				$this->Akun->init_akun_kredit("1", $k_kre['id_sub_akun'], $k_kre['jumlah']);
			}

			$this->session->set_flashdata("msg_success", "Data init sudah disimpan.");
			redirect(base_url("Akuntan/balance_sheet"));
		}
	}

	// inisialisasi income statement
	public function init_income_statement()
	{
		$this->load->model('Init');

		if ($this->input->post("submit") === NULL) {
			$db['script'] = 'init_income_statement';
			$this->load->view('t/top');
			$this->load->view('init_income_statement/content');
			$this->load->view('t/bottom', $db);
		} else {

			$koleksi_debet = array();
			$koleksi_kredit = array();
			foreach ($_POST as $key => $value) {
				# code...
				if (!empty($value)) {
					// echo $key.": ".$value."<br>";
					if (substr($key, 0, 1) == "d") {
						// simpan ke koleksi debet:
						array_push($koleksi_debet, array("id_sub_akun" => substr($key, 1), "jumlah" => intval(preg_replace('/\D/', '', $value))));
					} else {
						array_push($koleksi_kredit, array("id_sub_akun" => substr($key, 1), "jumlah" => intval(preg_replace('/\D/', '', $value))));
					}
				}
			}

			// print_r($koleksi_debet);
			// echo "<br><br>";
			// print_r($koleksi_kredit);

			// simpan ke dalam database:
			foreach ($koleksi_debet as $k_deb) {
				$this->Akun->init_akun_debet("2", $k_deb['id_sub_akun'], $k_deb['jumlah']);
			}

			foreach ($koleksi_kredit as $k_kre) {
				$this->Akun->init_akun_kredit("2", $k_kre['id_sub_akun'], $k_kre['jumlah']);
			}

			$this->session->set_flashdata("msg_success", "Data init sudah disimpan.");
			redirect(base_url("Akuntan/income_statement"));
		}
	}

	// hapus data ini:
	public function del_bs_init($id_sub_akun = '')
	{
		$this->load->model("Init");

		$this->form_validation->set_data(array("id_sub_akun" => $id_sub_akun));
		$this->form_validation->set_rules("id_sub_akun", "ID Sub Akun", "required|numeric");

		if ($this->form_validation->run() == TRUE) {
			$res = $this->Init->del_init_debet("1", $id_sub_akun);
			$res2 = $this->Init->del_init_kredit("1", $id_sub_akun);

			$this->session->set_flashdata("msg_info", "Operasi penghapusan telah dilakukan.");
			redirect(base_url("Akuntan/init_balance_sheet"));
		} else {
			$this->session->set_flashdata("msg_danger", "Kesalahan input data.");
			redirect(base_url("Akuntan/init_balance_sheet"));
		}
	}

	public function del_is_init($id_sub_akun = '')
	{
		$this->load->model("Init");

		$this->form_validation->set_data(array("id_sub_akun" => $id_sub_akun));
		$this->form_validation->set_rules("id_sub_akun", "ID Sub Akun", "required|numeric");

		if ($this->form_validation->run() == TRUE) {
			$res = $this->Init->del_init_debet("2", $id_sub_akun);
			$res2 = $this->Init->del_init_kredit("2", $id_sub_akun);

			$this->session->set_flashdata("msg_info", "Operasi penghapusan telah dilakukan.");
			redirect(base_url("Akuntan/init_income_statement"));
		} else {
			$this->session->set_flashdata("msg_danger", "Kesalahan input data.");
			redirect(base_url("Akuntan/init_income_statement"));
		}
	}


	public function debug()
	{
		// print_r($_POST);
		$koleksi_debet = array();
		$koleksi_kredit = array();
		foreach ($_POST as $key => $value) {
			# code...
			if (!empty($value)) {
				// echo $key.": ".$value."<br>";
				if (substr($key, 0, 1) == "d") {
					// simpan ke koleksi debet:
					array_push($koleksi_debet, array("id_sub_akun" => substr($key, 1), "jumlah" => intval(preg_replace('/\D/', '', $value))));
				} else {
					array_push($koleksi_kredit, array("id_sub_akun" => substr($key, 1), "jumlah" => intval(preg_replace('/\D/', '', $value))));
				}
			}
		}

		print_r($_POST);
		echo "<br><br>";
		print_r($koleksi_debet);
		echo "<br><br>";
		print_r($koleksi_kredit);

		// simpan ke dalam database

	}

	private function date_cmp($a, $b)
	{
		// $t1 = strtotime($a->tanggal);
		// $t2 = strtotime($b->tanggal);
		// return $t1 - $t2; 

		if (strtotime($a->tanggal) == strtotime($b->tanggal)) return 0;
		return strtotime($a->tanggal) < strtotime($b->tanggal) ? 1 : -1;
	}

	public function request_hapus_transaksi()
	{
		$this->form_validation->set_rules("id_transaksi_delete", "ID Transaksi", "required|numeric");
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata("msg_danger", "Kesalahan input ID transaksi.");
			redirect(base_url("Akuntan/transaksi"));
		}

		$data = array(
			'id_transaksi' => $this->input->post("id_transaksi_delete"),
			'nama_transaksi' => $this->input->post("nama_transaksi_delete"),
			'jumlah_transaksi' => $this->input->post("jumlah_transaksi_delete"),
			'status_hapus' => 0
		);
		$res = $this->db->insert('request_hapus_transaksi_akuntan', $data);

		if ($res) {
			$this->session->set_flashdata("msg_success", "Permintaan Hapus Transaksi Berhasil.");
			redirect(base_url("Akuntan/transaksi"));
		} else {
			$this->session->set_flashdata("msg_danger", "Transaksi gagal dihapus.");
			redirect(base_url("Akuntan/transaksi"));
		}
	}

	// history cashflow
	public function history_cashflow($month = '', $year = '')
	{
		$this->load->model("Cashflow");

		$data = array("month" => $month, "year" => $year);
		$this->form_validation->set_data($data);

		$this->form_validation->set_rules("month", "Bulan", "required|numeric");
		$this->form_validation->set_rules("year", "Tahun", "required|numeric");

		if ($this->form_validation->run() == TRUE) {
			$dv["cashflow"] = $this->Cashflow->cashflowHistory($month, $year);
			$dv["month"] = $month;
			$dv["year"] = $year;
			$this->load->view('t/top');
			$this->load->view('history_cashflow/content', $dv);
			$this->load->view('t/bottom');
		} else {
			$this->session->set_flashdata("msg_danger", "Input bulan dan tahun salah!");
			redirect(base_url("Akuntan/cashflow"));
		}
	}

	public function de($id)
	{
		$this->load->model("Transaksi");
		print_r($this->Transaksi->get_all_transaksi_kas_byid($id));
	}
}
