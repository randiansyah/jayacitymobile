<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Admin_Controller.php';
class Customer extends Admin_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('customer_model'); 
  }
  public function index()
  {
    $this->load->helper('url');
    if($this->data['is_can_read']){
      $this->data['content'] = 'admin/pelanggan/list_v';   
    }else{
      $this->data['content'] = 'errors/html/restrict'; 
    }
    
    $this->load->view('admin/layouts/page',$this->data);  
  }

   public function dataList()
  {
    $columns = array( 
            0 => 'id', 
            1 => 'id_pelanggan',
            2 => 'nama',
            3 => 'ktp',
            4 => 'email',
            5 => 'jenis_kelamin',
            6 => 'no_telp',
            7 => 'alamat_sekarang'
        );

      $order = $columns[$this->input->post('order')[0]['column']];
      $dir = $this->input->post('order')[0]['dir'];
      $search = array();
      $limit = 0;
      $start = 0;
      $totalData = $this->customer_model->getCountAllBy($limit,$start,$search,$order,$dir);       

        $searchColumn = $this->input->post('columns');
        $isSearchColumn = false;
        

      if($isSearchColumn){
        $totalFiltered = $this->customer_model->getCountAllBy($limit,$start,$search,$order,$dir); 
      }else{
        $totalFiltered = $totalData;
      }  
       
    $limit = $this->input->post('length');
    $start = $this->input->post('start');
    $datas = $this->customer_model->getAllBy($limit,$start,$search,$order,$dir);
     
        $new_data = array();
        if(!empty($datas))
        {
            foreach ($datas as $key=>$data)
            {   

                if($this->data['is_can_edit']){
          $edit_url = "<a href='".base_url()."Customer/edit/".$data->id_pelanggan."'><i class='fa fa-pencil'></i> Edit</a> ";
                }

                 if($this->data['is_can_delete']){
          $delete_url ="<a href='#' 
                  url='".base_url()."Customer/destroy/".$data->id_pelanggan."'
                  class='delete' 
                   ><i class='fa fa-trash'></i>&nbsp;Hapus
                  </a>";
                }


           
            $nestedData['id']   = $start+$key+1;
            $nestedData['id_pelanggan']          = "<a href='".base_url()."Customer/view/".$data->id_pelanggan."'><i class='fa fa-eye'></i> ".$data->id_pelanggan."</a> ";;
            $nestedData['nama']          = $data->nama;
            $nestedData['ktp']          = $data->ktp;
            $nestedData['email']    = $data->email; 
            $nestedData['jenis_kelamin']    = $data->jenis_kelamin; 
            $nestedData['no_telp']    = $data->no_telp; 
            $nestedData['alamat_sekarang']    = $data->alamat_sekarang;
             $nestedData['action'] = $edit_url." ".$delete_url;
  
         
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


  public function create(){
  $this->form_validation->set_rules('nama',"Nama Lengkap", 'trim|required'); 
   $date = date('y-m-d H:i:s');
   $kode = $this->customer_model->getKode();
  if($this->form_validation->run() === TRUE){
  
    $data_pribadi = array (
    'id_pelanggan' => $this->input->post('id_pelanggan'),
    'nama' => $this->input->post('nama'),
    'ktp' => $this->input->post('ktp'),
    'alamat' => $this->input->post('alamat'),
    'alamat_sekarang' => $this->input->post('alamat_sekarang'),
    'tempat_lahir' => $this->input->post('tempat_lahir'),
    'tgl_lahir' => $this->input->post('tgl_lahir'),
    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
    'no_telp_rumah' => $this->input->post('no_telp_rumah'),
    'no_telp' => $this->input->post('no_telp'),
    'agama' => $this->input->post('agama'),
    'email' => $this->input->post('email'),
    'status_pernikahan' => $this->input->post('status_pernikahan'),
    'pendidikan' => $this->input->post('pendidikan'),
    'status_pelanggan' => $this->input->post('status'),
    'user_input' => $this->input->post('user_input'),
    'waktu_input' => $this->input->post('waktu_input')
     );  

    $penghasilan_pokok1 = str_replace(".","",$this->input->post('penghasilan_pokok'));
    $penghasilan_pokok  = str_replace("Rp","",$penghasilan_pokok1);
    //
    $tunjangan_penghasilan1 = str_replace(".","",$this->input->post('tunjangan_penghasilan'));
    $tunjangan_penghasilan  = str_replace("Rp","",$tunjangan_penghasilan1);

     $penghasilan_usaha1 = str_replace(".","",$this->input->post('penghasilan_usaha'));
    $penghasilan_usaha  = str_replace("Rp","",$penghasilan_usaha1);

    $pengeluaran_rutin1 = str_replace(".","",$this->input->post('pengeluaran_rutin'));
    $pengeluaran_rutin  = str_replace("Rp","",$pengeluaran_rutin1);

    $pengeluaran_kredit1 = str_replace(".","",$this->input->post('pengeluaran_kredit'));
    $pengeluaran_kredit  = str_replace("Rp","",$pengeluaran_kredit1);

    $data_pemohon = array (
    'id_pelanggan' => $this->input->post('id_pelanggan'),
    'pekerjaan' => $this->input->post('pekerjaan'),
    'lama_kerja' => $this->input->post('lama_kerja'),
    'jabatan' => $this->input->post('jabatan'),
    'nama_instansi' => $this->input->post('nama_instansi'),
    'alamat_instansi' => $this->input->post('alamat_perusahaan'),
    'penghasilan_pokok' => $penghasilan_pokok,
    'tunjangan_penghasilan' => $tunjangan_penghasilan,
    'nama_usaha' => $this->input->post('nama_usaha'),
    'alamat_usaha' => $this->input->post('alamat_usaha'),
    'penghasilan_usaha' => $penghasilan_usaha,
    'pengeluaran_rutin' => $pengeluaran_rutin,
    'pengeluaran_kredit' => $pengeluaran_kredit
     );  

     $data_pasangan = array (
    'id_pelanggan' => $this->input->post('id_pelanggan'),
    'nama' => $this->input->post('nama_pasangan'),
    'ktp' => $this->input->post('ktp_pasangan'),
    'tempat_lahir' => $this->input->post('tempat_lahir_pasangan'),
    'tgl_lahir' => $this->input->post('tgl_lahir_pasangan'),
    'no_telp' => $this->input->post('telp_pasangan'),
    'alamat' => $this->input->post('alamat_pasangan'),
    'agama' => $this->input->post('agama_pasangan'),
    'pekerjaan' => $this->input->post('pekerjaan_pasangan'),
    'nama_usaha' => $this->input->post('nama_usaha_pasangan'),
    'alamat_pekerjaan' =>  $this->input->post('alamat_usaha_pasangan')
     );  

     $data_kekayaan = array (
    'id_pelanggan' => $this->input->post('id_pelanggan'),
    'rumah' => $this->input->post('rumah'),
    'rumah_milik' => $this->input->post('rumah_milik'),
    'tanah' => $this->input->post('tanah'),
    'mobil' => $this->input->post('mobil'),
    'motor' => $this->input->post('motor'),
    'laptop' => $this->input->post('laptop'),
    'ac' => $this->input->post('ac'),
    'tv' => $this->input->post('tv'),
    'kulkas' => $this->input->post('kulkas'),
    'tabungan' =>  $this->input->post('tabungan'),
    'lainnya' =>  $this->input->post('kekayaan_lainnya')
     );  
   
    $data_keluarga = array (
    'id_pelanggan' => $this->input->post('id_pelanggan'),
    'nama' => $this->input->post('nama_keluarga'),
    'ktp' => $this->input->post('ktp_keluarga'),
    'alamat' => $this->input->post('alamat_keluarga'),
    'no_hp' => $this->input->post('hp_keluarga'),
    'pekerjaan' => $this->input->post('pekerjaan_keluarga'),
    'hubungan' => $this->input->post('hubungan_keluarga')
     );  
   
    $insert_pribadi  = $this->customer_model->insert_data_pribadi($data_pribadi);
    $insert_pemohon  = $this->customer_model->insert_data_pemohon($data_pemohon);
    $insert_pasangan = $this->customer_model->insert_data_pasangan($data_pasangan);
    $insert_kekayaan = $this->customer_model->insert_data_kekayaan($data_kekayaan);
    $insert_keluarga = $this->customer_model->insert_data_keluarga($data_keluarga);

    if ($insert_pribadi)
      {  
        $this->session->set_flashdata('message', "Pelanggan Baru Berhasil Disimpan");
        redirect("Customer");
      }else{
        $this->session->set_flashdata('message_error',"Pelanggan Baru Gagal Disimpan");
        redirect("Customer");
      }     
                

  }else{
       
    $this->data['content'] = 'admin/pelanggan/create_v';
    $this->data['waktu_input'] = $date;
    $this->data['kode'] = 'P'.$kode;

    $this->load->view('admin/layouts/page',$this->data);
  }
 }

  public function edit($id){
  $this->form_validation->set_rules('nama',"Nama Lengkap", 'trim|required'); 
   $date = date('y-m-d H:i:s');
  if($this->form_validation->run() === TRUE){
  
    $data_pribadi = array (
    'nama' => $this->input->post('nama'),
    'ktp' => $this->input->post('ktp'),
    'alamat' => $this->input->post('alamat'),
    'alamat_sekarang' => $this->input->post('alamat_sekarang'),
    'tempat_lahir' => $this->input->post('tempat_lahir'),
    'tgl_lahir' => $this->input->post('tgl_lahir'),
    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
    'no_telp_rumah' => $this->input->post('no_telp_rumah'),
    'no_telp' => $this->input->post('no_telp'),
    'agama' => $this->input->post('agama'),
    'email' => $this->input->post('email'),
    'status_pernikahan' => $this->input->post('status_pernikahan'),
    'pendidikan' => $this->input->post('pendidikan'),
    'status_pelanggan' => $this->input->post('status'),
    'user_input' => $this->input->post('user_input'),
    'waktu_input' => $this->input->post('waktu_input')
     );  

    $penghasilan_pokok1 = str_replace(".","",$this->input->post('penghasilan_pokok'));
    $penghasilan_pokok  = str_replace("Rp","",$penghasilan_pokok1);
    //
    $tunjangan_penghasilan1 = str_replace(".","",$this->input->post('tunjangan_penghasilan'));
    $tunjangan_penghasilan  = str_replace("Rp","",$tunjangan_penghasilan1);

     $penghasilan_usaha1 = str_replace(".","",$this->input->post('penghasilan_usaha'));
    $penghasilan_usaha  = str_replace("Rp","",$penghasilan_usaha1);

    $pengeluaran_rutin1 = str_replace(".","",$this->input->post('pengeluaran_rutin'));
    $pengeluaran_rutin  = str_replace("Rp","",$pengeluaran_rutin1);

    $pengeluaran_kredit1 = str_replace(".","",$this->input->post('pengeluaran_kredit'));
    $pengeluaran_kredit  = str_replace("Rp","",$pengeluaran_kredit1);

    $data_pemohon = array (
    'pekerjaan' => $this->input->post('pekerjaan'),
    'lama_kerja' => $this->input->post('lama_kerja'),
    'jabatan' => $this->input->post('jabatan'),
    'nama_instansi' => $this->input->post('nama_instansi'),
    'alamat_instansi' => $this->input->post('alamat_perusahaan'),
    'penghasilan_pokok' => $penghasilan_pokok,
    'tunjangan_penghasilan' => $tunjangan_penghasilan,
    'nama_usaha' => $this->input->post('nama_usaha'),
    'alamat_usaha' => $this->input->post('alamat_usaha'),
    'penghasilan_usaha' => $penghasilan_usaha,
    'pengeluaran_rutin' => $pengeluaran_rutin,
    'pengeluaran_kredit' => $pengeluaran_kredit
     );  

     $data_pasangan = array (
    'nama' => $this->input->post('nama_pasangan'),
    'ktp' => $this->input->post('ktp_pasangan'),
    'tempat_lahir' => $this->input->post('tempat_lahir_pasangan'),
    'tgl_lahir' => $this->input->post('tgl_lahir_pasangan'),
    'no_telp' => $this->input->post('telp_pasangan'),
    'alamat' => $this->input->post('alamat_pasangan'),
    'agama' => $this->input->post('agama_pasangan'),
    'pekerjaan' => $this->input->post('pekerjaan_pasangan'),
    'nama_usaha' => $this->input->post('nama_usaha_pasangan'),
    'alamat_pekerjaan' =>  $this->input->post('alamat_usaha_pasangan')
     );  

     $data_kekayaan = array (
    'rumah' => $this->input->post('rumah'),
    'rumah_milik' => $this->input->post('rumah_milik'),
    'tanah' => $this->input->post('tanah'),
    'mobil' => $this->input->post('mobil'),
    'motor' => $this->input->post('motor'),
    'laptop' => $this->input->post('laptop'),
    'ac' => $this->input->post('ac'),
    'tv' => $this->input->post('tv'),
    'kulkas' => $this->input->post('kulkas'),
    'tabungan' =>  $this->input->post('tabungan'),
    'lainnya' =>  $this->input->post('kekayaan_lainnya')
     );  
   
    $data_keluarga = array (
    'nama' => $this->input->post('nama_keluarga'),
    'ktp' => $this->input->post('ktp_keluarga'),
    'alamat' => $this->input->post('alamat_keluarga'),
    'no_hp' => $this->input->post('hp_keluarga'),
    'pekerjaan' => $this->input->post('pekerjaan_keluarga'),
    'hubungan' => $this->input->post('hubungan_keluarga')
     );  
   
$update_pribadi  = $this->customer_model->update_data_pribadi($data_pribadi,array("id_pelanggan"=>$id));
$update_pemohon  = $this->customer_model->update_data_pemohon($data_pemohon,array("id_pelanggan"=>$id));
$update_pasangan = $this->customer_model->update_data_pasangan($data_pasangan,array("id_pelanggan"=>$id));
$update_kekayaan = $this->customer_model->update_data_kekayaan($data_kekayaan,array("id_pelanggan"=>$id));
$update_keluarga = $this->customer_model->update_data_keluarga($data_keluarga,array("id_pelanggan"=>$id));
   
    if ($update_pribadi)
      {  
        $this->session->set_flashdata('message', "Pelanggan Berhasil di Edit");
        redirect("Customer");
      }else{
        $this->session->set_flashdata('message_error',"Pelanggan Gagal Di edit");
        redirect("Customer");
      }     
                

  }else{
     $data = $this->customer_model->getAllById(array("pelanggan.id_pelanggan"=>$id));
     //data pribadi
        $this->data['kode'] =   (!empty($data))?$data[0]->id_pelanggan:"";
        $this->data['nama'] =   (!empty($data))?$data[0]->nama:"";
        $this->data['email'] =   (!empty($data))?$data[0]->email:"";
        $this->data['ktp'] =   (!empty($data))?$data[0]->ktp:"";
        $this->data['alamat'] =   (!empty($data))?$data[0]->alamat:"";
        $this->data['alamat_sekarang'] =   (!empty($data))?$data[0]->alamat_sekarang:"";
        $this->data['tgl_lahir'] =   (!empty($data))?$data[0]->tgl_lahir:"";
        $this->data['tempat_lahir'] =   (!empty($data))?$data[0]->tempat_lahir:"";
        $this->data['jenis_kelamin'] =   (!empty($data))?$data[0]->jenis_kelamin:"";
        $this->data['agama'] =   (!empty($data))?$data[0]->agama:"";
        $this->data['status_pernikahan'] =   (!empty($data))?$data[0]->status_pernikahan:"";
        $this->data['pendidikan'] =   (!empty($data))?$data[0]->pendidikan:"";
        $this->data['no_telp_rumah'] =   (!empty($data))?$data[0]->no_telp_rumah:"";
        $this->data['no_telp'] =   (!empty($data))?$data[0]->no_telp:"";
        $this->data['status'] =   (!empty($data))?$data[0]->status_pelanggan:"";
    //data pemohon
       $this->data['pekerjaan'] =   (!empty($data))?$data[0]->pekerjaan:"";
       $this->data['jabatan'] =   (!empty($data))?$data[0]->jabatan:"";
       $this->data['lama_kerja'] =   (!empty($data))?$data[0]->lama_kerja:"";
       $this->data['nama_instansi'] =   (!empty($data))?$data[0]->nama_instansi:"";
       $this->data['alamat_instansi'] =   (!empty($data))?$data[0]->alamat_instansi:"";
       $this->data['nama_usaha'] =   (!empty($data))?$data[0]->nama_usaha:"";
       $this->data['alamat_usaha'] =   (!empty($data))?$data[0]->alamat_usaha:"";
      
       $this->data['penghasilan_usaha'] = (!empty($data)) ? $data[0]->penghasilan_usaha : "";
       $this->data['pengeluaran_rutin'] = (!empty($data)) ? $data[0]->pengeluaran_rutin : "";
       $this->data['pengeluaran_kredit'] = (!empty($data)) ? $data[0]->pengeluaran_kredit : "";
       $this->data['penghasilan_pokok'] = (!empty($data)) ? $data[0]->penghasilan_pokok : "";
       $this->data['tunjangan_penghasilan'] = (!empty($data)) ? $data[0]->tunjangan_penghasilan : "";
  


      //  $this->data['penghasilan_usaha'] ="Rp. ".number_format((!empty($data))? $data[0]->penghasilan_usaha:"",0,",",".");
      //  $this->data['pengeluaran_rutin'] ="Rp. ".number_format((!empty($data))?$data[0]->pengeluaran_rutin:"",0,",",".");
      //  $this->data['pengeluaran_kredit'] ="Rp. ".number_format((!empty($data))?$data[0]->pengeluaran_kredit:"",0,",",".");
      //   $this->data['penghasilan_pokok'] ="Rp. ".number_format((!empty($data))?$data[0]->penghasilan_pokok:"",0,",",".");
      // $this->data['tunjangan_penghasilan'] ="Rp. ".number_format((!empty($data))?$data[0]->tunjangan_penghasilan:"",0,",",".");
   //data pasangan
       $this->data['nama_pasangan'] =   (!empty($data))?$data[0]->nama_pasangan:"";
       $this->data['ktp_pasangan'] =   (!empty($data))?$data[0]->ktp_pasangan:"";
       $this->data['tempat_lahir_pasangan'] =   (!empty($data))?$data[0]->tempat_lahir_pasangan:"";
       $this->data['tgl_lahir_pasangan'] =   (!empty($data))?$data[0]->tgl_lahir_pasangan:"";
       $this->data['no_telp_pasangan'] =   (!empty($data))?$data[0]->no_telp_pasangan:"";
       $this->data['alamat_pasangan'] =   (!empty($data))?$data[0]->alamat_pasangan:"";
       $this->data['agama_pasangan'] =   (!empty($data))?$data[0]->agama_pasangan:"";
       $this->data['pekerjaan_pasangan'] =   (!empty($data))?$data[0]->pekerjaan_pasangan:"";
       $this->data['nama_usaha_pasangan'] =   (!empty($data))?$data[0]->nama_usaha_pasangan:"";
       $this->data['alamat_pekerjaan_pasangan'] =   (!empty($data))?$data[0]->alamat_pekerjaan_pasangan:"";
 //daftar kekayaan
       $this->data['rumah'] =   (!empty($data))?$data[0]->rumah:"";
       $this->data['rumah_milik'] =   (!empty($data))?$data[0]->rumah_milik:"";
       $this->data['tanah'] =   (!empty($data))?$data[0]->tanah :"";
       $this->data['mobil'] =   (!empty($data))?$data[0]->mobil:"";
       $this->data['motor'] =   (!empty($data))?$data[0]->motor:"";
       $this->data['laptop'] =   (!empty($data))?$data[0]->laptop:"";
       $this->data['ac'] =   (!empty($data))?$data[0]->ac:"";
       $this->data['tv'] =   (!empty($data))?$data[0]->tv:"";
       $this->data['kulkas'] =   (!empty($data))?$data[0]->kulkas:"";
       $this->data['tabungan'] =   (!empty($data))?$data[0]->tabungan:"";
       $this->data['lainnya'] =   (!empty($data))?$data[0]->lainnya:"";
       //data keluarga
       $this->data['nama_keluarga'] =   (!empty($data))?$data[0]->nama_keluarga:"";
       $this->data['ktp_keluarga'] =   (!empty($data))?$data[0]->ktp_keluarga:"";
       $this->data['no_hp_keluarga'] =   (!empty($data))?$data[0]->no_hp_keluarga:"";
       $this->data['alamat_keluarga'] =   (!empty($data))?$data[0]->alamat_keluarga:"";
       $this->data['pekerjaan_keluarga'] =   (!empty($data))?$data[0]->pekerjaan_keluarga:"";
       $this->data['hubungan_keluarga'] =   (!empty($data))?$data[0]->hubungan_keluarga:"";

    $this->data['content'] = 'admin/pelanggan/edit_v';
    $this->data['waktu_input'] = $date;
    $this->load->view('admin/layouts/page',$this->data);
  }
 }

  public function view($id){
   $date = date('y-m-d H:i:s');
     $data = $this->customer_model->getAllById(array("pelanggan.id_pelanggan"=>$id));
     //data pribadi
        $this->data['kode'] =   (!empty($data))?$data[0]->id_pelanggan:"";
        $this->data['nama'] =   (!empty($data))?$data[0]->nama:"";
        $this->data['email'] =   (!empty($data))?$data[0]->email:"";
        $this->data['ktp'] =   (!empty($data))?$data[0]->ktp:"";
        $this->data['alamat'] =   (!empty($data))?$data[0]->alamat:"";
        $this->data['alamat_sekarang'] =   (!empty($data))?$data[0]->alamat_sekarang:"";
        $this->data['tgl_lahir'] =   (!empty($data))?$data[0]->tgl_lahir:"";
        $this->data['tempat_lahir'] =   (!empty($data))?$data[0]->tempat_lahir:"";
        $this->data['jenis_kelamin'] =   (!empty($data))?$data[0]->jenis_kelamin:"";
        $this->data['agama'] =   (!empty($data))?$data[0]->agama:"";
        $this->data['status_pernikahan'] =   (!empty($data))?$data[0]->status_pernikahan:"";
        $this->data['pendidikan'] =   (!empty($data))?$data[0]->pendidikan:"";
        $this->data['no_telp_rumah'] =   (!empty($data))?$data[0]->no_telp_rumah:"";
        $this->data['no_telp'] =   (!empty($data))?$data[0]->no_telp:"";
        $this->data['status'] =   (!empty($data))?$data[0]->status_pelanggan:"";
    //data pemohon
       $this->data['pekerjaan'] =   (!empty($data))?$data[0]->pekerjaan:"";
       $this->data['jabatan'] =   (!empty($data))?$data[0]->jabatan:"";
       $this->data['lama_kerja'] =   (!empty($data))?$data[0]->lama_kerja:"";
       $this->data['nama_instansi'] =   (!empty($data))?$data[0]->nama_instansi:"";
       $this->data['alamat_instansi'] =   (!empty($data))?$data[0]->alamat_instansi:"";
       $this->data['nama_usaha'] =   (!empty($data))?$data[0]->nama_usaha:"";
       $this->data['alamat_usaha'] =   (!empty($data))?$data[0]->alamat_usaha:"";
       $this->data['penghasilan_usaha'] = (!empty($data)) ? $data[0]->penghasilan_usaha : "";
       $this->data['pengeluaran_rutin'] = (!empty($data)) ? $data[0]->pengeluaran_rutin : "";
       $this->data['pengeluaran_kredit'] = (!empty($data)) ? $data[0]->pengeluaran_kredit : "";
       $this->data['penghasilan_pokok'] = (!empty($data)) ? $data[0]->penghasilan_pokok : "";
       $this->data['tunjangan_penghasilan'] = (!empty($data)) ? $data[0]->tunjangan_penghasilan : "";
   
   //data pasangan
       $this->data['nama_pasangan'] =   (!empty($data))?$data[0]->nama_pasangan:"";
       $this->data['ktp_pasangan'] =   (!empty($data))?$data[0]->ktp_pasangan:"";
       $this->data['tempat_lahir_pasangan'] =   (!empty($data))?$data[0]->tempat_lahir_pasangan:"";
       $this->data['tgl_lahir_pasangan'] =   (!empty($data))?$data[0]->tgl_lahir_pasangan:"";
       $this->data['no_telp_pasangan'] =   (!empty($data))?$data[0]->no_telp_pasangan:"";
       $this->data['alamat_pasangan'] =   (!empty($data))?$data[0]->alamat_pasangan:"";
       $this->data['agama_pasangan'] =   (!empty($data))?$data[0]->agama_pasangan:"";
       $this->data['pekerjaan_pasangan'] =   (!empty($data))?$data[0]->pekerjaan_pasangan:"";
       $this->data['nama_usaha_pasangan'] =   (!empty($data))?$data[0]->nama_usaha_pasangan:"";
       $this->data['alamat_pekerjaan_pasangan'] =   (!empty($data))?$data[0]->alamat_pekerjaan_pasangan:"";
 //daftar kekayaan
       $this->data['rumah'] =   (!empty($data))?$data[0]->rumah:"";
       $this->data['rumah_milik'] =   (!empty($data))?$data[0]->rumah_milik:"";
       $this->data['tanah'] =   (!empty($data))?$data[0]->tanah :"";
       $this->data['mobil'] =   (!empty($data))?$data[0]->mobil:"";
       $this->data['motor'] =   (!empty($data))?$data[0]->motor:"";
       $this->data['laptop'] =   (!empty($data))?$data[0]->laptop:"";
       $this->data['ac'] =   (!empty($data))?$data[0]->ac:"";
       $this->data['tv'] =   (!empty($data))?$data[0]->tv:"";
       $this->data['kulkas'] =   (!empty($data))?$data[0]->kulkas:"";
       $this->data['tabungan'] =   (!empty($data))?$data[0]->tabungan:"";
       $this->data['lainnya'] =   (!empty($data))?$data[0]->lainnya:"";
       //data keluarga
       $this->data['nama_keluarga'] =   (!empty($data))?$data[0]->nama_keluarga:"";
       $this->data['ktp_keluarga'] =   (!empty($data))?$data[0]->ktp_keluarga:"";
       $this->data['no_hp_keluarga'] =   (!empty($data))?$data[0]->no_hp_keluarga:"";
       $this->data['alamat_keluarga'] =   (!empty($data))?$data[0]->alamat_keluarga:"";
       $this->data['pekerjaan_keluarga'] =   (!empty($data))?$data[0]->pekerjaan_keluarga:"";
       $this->data['hubungan_keluarga'] =   (!empty($data))?$data[0]->hubungan_keluarga:"";

    $this->data['content'] = 'admin/pelanggan/view_v';
    $this->data['waktu_input'] = $date;
    $this->load->view('admin/layouts/page',$this->data);
  
 }

  public function exportCSV()
    { 
       // file name 
       $filename = 'Pelanggan'.date('Ymd').'.csv'; 
       header("Content-Description: File Transfer"); 
       header("Content-Disposition: attachment; filename=$filename"); 
       header("Content-Type: application/csv; ");
       
       // get data 
       
       $datas = $this->customer_model->getAllById();

       // file creation 
       $file = fopen('php://output', 'w');
     
       $header = array("ID CUSTOMER","NAMA","EMAIL","JENIS KELAMIN","TELPON","ALAMAT"); 
       fputcsv($file, $header);
       foreach ($datas as $line){ 
         fputcsv($file,array($line->id_customer,$line->nama,$line->email,$line->jk,$line->telp,$line->alamat));
       }
       fclose($file); 
       exit; 
      } 

   public function destroy(){
    $response_data = array();
        $response_data['status'] = false;
        $response_data['msg'] = "";
        $response_data['data'] = array();   
    $id =$this->uri->segment(3);
    if(!empty($id)){
       $data = array();
          $delete_pribadi = $this->customer_model->delete_pribadi(array("id_pelanggan"=>$id));
          $delete_pemohon = $this->customer_model->delete_pemohon(array("id_pelanggan"=>$id));
          $delete_pasangan = $this->customer_model->delete_pasangan(array("id_pelanggan"=>$id));
          $delete_kekayaan = $this->customer_model->delete_kekayaan(array("id_pelanggan"=>$id));
          $delete_keluarga = $this->customer_model->delete_keluarga(array("id_pelanggan"=>$id));
         
          $response_data['data'] = $data; 
          $response_data['status'] = true;
    }else{
      $response_data['msg'] = "ID KOSONG";
    }
    
        echo json_encode($response_data); 
  }
  


}
?>