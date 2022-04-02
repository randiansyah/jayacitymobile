<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'core/Admin_Controller.php';
class Surat_akad extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pengaturan_model');
		$this->load->model('rekening_model');
		$this->load->model('surat_akad_model');
	}

	public function index()
	{
		$this->load->helper('url');
		if ($this->data['is_can_read']) {
			$this->data['content'] = 'admin/surat_akad/list_v';
		} else {
			$this->data['content'] = 'errors/html/restrict';
		}

		$this->load->view('admin/layouts/page', $this->data);
	}

	public function dataList()
	{
		$columns = array(
			0 => 'id_surat_akad',
			1 => 'sub_judul',
			2 => 'nama_pk',
			3 => 'tempat_tgl_lahir_pk',
			4 => 'nik_pk',
			5 => 'pekerjaan_pk',
			6 => 'hp_pk',
			7 => 'nama_pk',
			8 => 'nama_pk',
			9 => '',
			10 => '',

		);

		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
		$search = array();
		$limit = 0;
		$start = 0;
		$totalData = $this->surat_akad_model->getCountAllBy($limit, $start, $search, $order, $dir);

		$searchColumn = $this->input->post('columns');
		$isSearchColumn = false;


		if ($isSearchColumn) {
			$totalFiltered = $this->surat_akad_model->getCountAllBy($limit, $start, $search, $order, $dir);
		} else {
			$totalFiltered = $totalData;
		}

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$datas = $this->surat_akad_model->getAllBy($limit, $start, $search, $order, $dir);

		$new_data = array();
		if (!empty($datas)) {
			foreach ($datas as $key => $data) {

				if ($this->data['is_can_delete']) {
					$delete_url = "<a href='#' 
                  url='" . base_url() . "surat_akad/destroy/" . $data->id_surat_akad . "'
                  class='delete' 
                   ><i class='fa fa-trash'></i>&nbsp;Hapus
                  </a>";
				}
				if ($this->data['is_can_edit']) {
					//   $view_url = "<a href='" . base_url() . "Setoran_angsuran/view/" . $data->id_akad . "'><i class='fa fa-eye'></i> Rincian</a> ";
					$edit_url = "<a href='" . base_url() . "surat_akad/edit/" . $data->id_surat_akad . "'><i class='fa fa-pencil'></i> Edit</a> ";
					$cetak_url = "<a target='blank' href='" . base_url() . "surat_akad/print_pdf/" . $data->id_surat_akad . "' target='blank'><i class='fa fa-file-pdf-o'></i> PDF</a> ";
				}
				$nestedData['id']   = $start + $key + 1;
				// $nestedData['id']   = $data->id_surat_akad;
				$nestedData['nama']         = $data->nama_pk;
				$nestedData['kode']         = $data->sub_judul;
				$nestedData['tempat_tgl_lahir']         = $data->tempat_tgl_lahir_pk;
				$nestedData['NIK']         = $data->nik_pk;
				$nestedData['no_hp']         = $data->hp_pk;
				$nestedData['pekerjaan']         = $data->pekerjaan_pk;
				$nestedData['status'] = $edit_url . " " . $delete_url;
				$nestedData['cetak'] = $cetak_url;
				$new_data[] = $nestedData;
			}
		}
		$json_data = array(
			"draw"            => intval($this->input->post('draw')),
			"recordsTotal"    => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"            => $new_data
		);

		echo json_encode($json_data);
	}
	function print_pdf()
	{

		$id = $this->uri->segment(3);
		$surat = $this->surat_akad_model->getOneBy(array("id_surat_akad" => $id));
		$this->data['surat'] = $surat;
		$pengaturan = $this->pengaturan_model->getOneBy();
		$id_bank = (!empty($pengaturan)) ? $pengaturan->id_bank : "";
		$bank = $this->rekening_model->getOneBy(array("id" => $id_bank));
		$this->data['pengaturan'] = $pengaturan;
		$this->data['bank'] = $bank;
		$this->load->library('Pdf');
		$this->pdf->setPaper('A4', 'portrait');
		$this->pdf->filename = "Kartu-Angsuran" . date('dmy') . ".pdf";
		$this->pdf->load_view('admin/surat_akad/cetak_v', $this->data, true);
	}

	public function create()
	{
		$this->form_validation->set_rules('judul', "judul Akad", 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$data = array(
				'judul' => $this->input->post('judul'),
				'sub_judul' => $this->input->post('sub_judul'),
				'nama_pk' => $this->input->post('nama_pk'),
				'tempat_tgl_lahir_pk' => $this->input->post('tempat_tgl_lahir_pk'),
				'nik_pk' => $this->input->post('nik_pk'),
				'pekerjaan_pk' => $this->input->post('pekerjaan_pk'),
				'alamat_ktp_pk' => $this->input->post('alamat_ktp_pk'),
				'alamat_sekarang_pk' => $this->input->post('alamat_sekarang_pk'),
				'hp_pk' => $this->input->post('hp_pk'),
				'nama_barang_pk' => $this->input->post('nama_barang_pk'),
				'sn_pk' => $this->input->post('sn_pk'),
				'imei1_pk' => $this->input->post('imei1_pk'),
				'imei2_pk' => $this->input->post('imei2_pk'),
				'keuntungan_pp' => $this->input->post('keuntungan_pp'),
				'harga_jual_pk' => $this->input->post('harga_jual_pk'),
				'uang_muka_pk' => $this->input->post('uang_muka_pk'),
				'biaya_admin_pk' => $this->input->post('biaya_admin_pk'),
				'asuransi_jiwa_pk' => $this->input->post('asuransi_jiwa_pk'),
				'asuransi_jiwa_pk' => $this->input->post('asuransi_jiwa_pk'),
				'harga_pokok_pk' => $this->input->post('harga_pokok_pk'),
				'besaran_terbilang' => $this->input->post('besaran_terbilang'),
				'besaran_cicilan_pk' => $this->input->post('besaran_cicilan_pk'),
				'cicilan' => $this->input->post('cicilan'),
				'jatuh_tempo_pertama_pk' => $this->input->post('jatuh_tempo_pertama_pk'),
				'jatuh_tempo_terakhir_pk' => $this->input->post('jatuh_tempo_terakhir_pk'),
				'nama_pp' => $this->input->post('nama_pp'),
				'alamat_pp' => $this->input->post('alamat_pp'),
				'jabatan_pp' => $this->input->post('jabatan_pp'),
				'keterangan_1' => $this->input->post('keterangan1'),
				'keterangan_2' => $this->input->post('keterangan2'),
				'keterangan_3' => $this->input->post('keterangan3'),
				'keterangan_4' => $this->input->post('keterangan4'),
				'keterangan_5' => $this->input->post('keterangan5'),
				'keterangan_6' => $this->input->post('keterangan6'),
				'keterangan_7' => $this->input->post('keterangan7'),
				'keterangan_8' => $this->input->post('keterangan8'),
				'keterangan_9' => $this->input->post('keterangan9'),
				'saksi1' => $this->input->post('saksi1'),
				'saksi2' => $this->input->post('saksi2'),

				'created_on' => date('Y-m-d')
			);

			$update = $this->surat_akad_model->insert($data);
			$this->session->set_flashdata('message', "Surat akad Berhasil di simpan");
			redirect("surat_akad", "refresh");
		} else {
			if (!empty($_POST)) {

				$this->session->set_flashdata('message_error', validation_errors());
				return redirect("surat_akad");
			} else {
				$data = $this->surat_akad_model->getOneBy(array("id_surat_akad" => 1));
				$this->data['data'] = $data;
				$this->data['label'] = 'Surat akad';
				$this->data['title'] = 'Surat Akad';
				$this->data['content'] = 'admin/surat_akad/create_v';
				$this->load->view('admin/layouts/page', $this->data);
			}
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('judul', "judul Akad", 'trim|required');

		if ($this->form_validation->run() === TRUE) {
			$data = array(
				'judul' => $this->input->post('judul'),
				'sub_judul' => $this->input->post('sub_judul'),
				'nama_pk' => $this->input->post('nama_pk'),
				'tempat_tgl_lahir_pk' => $this->input->post('tempat_tgl_lahir_pk'),
				'nik_pk' => $this->input->post('nik_pk'),
				'pekerjaan_pk' => $this->input->post('pekerjaan_pk'),
				'alamat_ktp_pk' => $this->input->post('alamat_ktp_pk'),
				'alamat_sekarang_pk' => $this->input->post('alamat_sekarang_pk'),
				'hp_pk' => $this->input->post('hp_pk'),
				'nama_barang_pk' => $this->input->post('nama_barang_pk'),
				'sn_pk' => $this->input->post('sn_pk'),
				'imei1_pk' => $this->input->post('imei1_pk'),
				'imei2_pk' => $this->input->post('imei2_pk'),
				'keuntungan_pp' => $this->input->post('keuntungan_pp'),
				'harga_jual_pk' => $this->input->post('harga_jual_pk'),
				'uang_muka_pk' => $this->input->post('uang_muka_pk'),
				'biaya_admin_pk' => $this->input->post('biaya_admin_pk'),
				'asuransi_jiwa_pk' => $this->input->post('asuransi_jiwa_pk'),
				'asuransi_jiwa_pk' => $this->input->post('asuransi_jiwa_pk'),
				'harga_pokok_pk' => $this->input->post('harga_pokok_pk'),
				'besaran_terbilang' => $this->input->post('besaran_terbilang'),
				'besaran_cicilan_pk' => $this->input->post('besaran_cicilan_pk'),
				'cicilan' => $this->input->post('cicilan'),
				'jatuh_tempo_pertama_pk' => $this->input->post('jatuh_tempo_pertama_pk'),
				'jatuh_tempo_terakhir_pk' => $this->input->post('jatuh_tempo_terakhir_pk'),
				'nama_pp' => $this->input->post('nama_pp'),
				'alamat_pp' => $this->input->post('alamat_pp'),
				'jabatan_pp' => $this->input->post('jabatan_pp'),
				'keterangan_1' => $this->input->post('keterangan1'),
				'keterangan_2' => $this->input->post('keterangan2'),
				'keterangan_3' => $this->input->post('keterangan3'),
				'keterangan_4' => $this->input->post('keterangan4'),
				'keterangan_5' => $this->input->post('keterangan5'),
				'keterangan_6' => $this->input->post('keterangan6'),
				'keterangan_7' => $this->input->post('keterangan7'),
				'keterangan_8' => $this->input->post('keterangan8'),
				'keterangan_9' => $this->input->post('keterangan9'),
				'saksi1' => $this->input->post('saksi1'),
				'saksi2' => $this->input->post('saksi2'),

				'created_on' => date('Y-m-d')
			);

			$update = $this->surat_akad_model->update($data, array("id_surat_akad" => $id));
			$this->session->set_flashdata('message', "Surat akad Berhasil di ubah");
			redirect("surat_akad", "refresh");
		} else {
			if (!empty($_POST)) {

				$this->session->set_flashdata('message_error', validation_errors());
				return redirect("surat_akad");
			} else {
				$data = $this->surat_akad_model->getOneBy(array("id_surat_akad" => $id));
				$this->data['data'] = $data;
				$this->data['label'] = 'Surat akad';
				$this->data['title'] = 'Surat Akad';
				$this->data['content'] = 'admin/surat_akad/edit_v';
				$this->load->view('admin/layouts/page', $this->data);
			}
		}
	}

	public function destroy()
	{
		$response_data = array();
		$response_data['status'] = false;
		$response_data['msg'] = "";
		$response_data['data'] = array();
		$id = $this->uri->segment(3);
		if (!empty($id)) {
			$delete = $this->surat_akad_model->delete(array("id_surat_akad" => $id));


			$response_data['data'] = $data;
			$response_data['status'] = true;
		} else {
			$response_data['msg'] = "ID KOSONG";
		}

		echo json_encode($response_data);
	}
}
