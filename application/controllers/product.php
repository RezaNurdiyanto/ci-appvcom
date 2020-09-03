<?php 
class product extends CI_Controller{
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('masuk') !=TRUE){
				$url=base_url();
				redirect($url);
		 };
		$this->load->model('m_product'); //pemanggilan model mahasiswa
	}

	function index(){
		$data['data']=$this->m_product->getall();
		$this->load->view('v_product',$data);
	}

	function simpan(){
		$plu=$this->input->post('plu');
		$nama=$this->input->post('description');
		$satuan=$this->input->post('satuan');
		$price=$this->input->post('price');
		$barcode='1';

		$this->load->library('ciqrcode'); //pemanggilan library QR CODE

		$config['cacheable']	= true; //boolean, the default is true
		$config['cachedir']		= './assets/'; //string, the default is application/cache/
		$config['errorlog']		= './assets/'; //string, the default is application/logs/
		$config['imagedir']		= './assets/images/'; //direktori penyimpanan qr code
		$config['quality']		= true; //boolean, the default is true
		$config['size']			= '1024'; //interger, the default is 1024
		$config['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

		$image_name=$plu.'.png'; //buat name dari qr code sesuai dengan nim

		$params['data'] = $plu; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

		$this->m_product->simpan_product($plu,$nama,$satuan, $price, $barcode ,$image_name); //simpan ke database
		redirect('product'); //redirect ke mahasiswa usai simpan data
	}
}