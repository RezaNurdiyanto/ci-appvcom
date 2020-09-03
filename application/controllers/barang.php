<?php

defined("BASEPATH") OR exit('No direct script access allowed');

class Barang extends CI_Controller{
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('masuk') !=TRUE){
				$url=base_url();
				redirect($url);
		 };
		$this->load->model('m_barang');
	}


	function index() {
		$data['barang']=$this->m_barang->tampil_barang();
		$this->load->view('v_barang', $data);
	}


	public function delete() {
		$id=$this->input->post("id");
		$this->m_barang->delete($id);
		redirect("barang");
	}

	public function importexcel() {
		$this->load->view('v_importbarang');
	}
	function tambah_barang() {
		$id=$this->m_barang->get_plu();
		$nama=$this->input->post('description');
		$satuan=$this->input->post('satuan');
		$kdcat=$this->input->post('category');
		$harga=str_replace(',','', $this->input->post('price'));

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

		$image_name=$id.'.png'; //buat name dari qr code sesuai dengan nim

		$params['data'] = $id; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
		

		//$this->load->library('Zend');
		//$this->zend->load('Zend/Barcode');
		//$image_resource=Zend_Barcode::factory('code128','image',array('text'=>$plu), array())->draw();
		//$image = $plu.'.jpg';
		//$image_dir ='/assets/images/';
		//imagejpg($image_resource, $image_dir, $image);


		$this->m_barang->simpan_barang($id,$nama,$satuan,$kdcat, $harga, $image_name);
		echo $this->session->set_flashdata('msg', 'Data Tersimpan');
		redirect('barang');
	}

	function edit_barang() {
		$id=$this->input->post('id');
		$nm=$this->input->post('description');
		$st=$this->input->post('satuan');
		$pr=str_replace(',','', $this->input->post('price'));
		$this->m_barang->update_barang($id, $nm, $st, $pr);
		redirect('barang');

	}

	function hapus_barang(){
		$id=$this->input->post('id');
		$this->m_barang->hapus_barang($id);
		redirect('barang');
	}

	public function export() {
		//Load Plugin phpexcel
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';

		//panggil class phpexcel
		$excel = new PHPExcel();

		//setting awal fil excel
		$excel -> getProperties()->setCreator('My Notes Code')
				->setLastModifiedBy('My Notes Code')
				->setTitle("Data Barang")
				->setSubject("barang")
				->setDescription("Laporan Semua Data Siswa")
				->setKeywords("Data Siswa");

		//Buat sebuat variable untuk menampung pengaturan sytle dari header label
				$style_col = array(
					'font' => array('bold => true'), //set font nya menjadi bold
					'aligment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, //set text jadi ditengah secara horizontal (center)))
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER), // set text jadi ditengah secara vertical (middle)
					'borders' => array(
						'top' => array('style' => PHPExcel_style_Border::BORDER_THIN),
						'right' => array('style' => PHPExcel_style_Border::BORDER_THIN),
						'bottom' => array('style' => PHPExcel_style_Border::BORDER_THIN),
						'left' => array('style' => PHPExcel_style_Border::BORDER_THIN)
					)
				);

				//Membuat sebuah variable untuk menampung pangaturan style dari isi tabel

				$style_row = array(
					'aligment' => array(
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER //set text di tengah secara vertical (middle)
					),
					'borders' => array(
						'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'right' => array('style'=> PHPExcel_Style_Border::BORDER_THIN),
						'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
					)
				);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "MASTER BARANG"); // set kolom A1 dengan tulisan data siswa
		$excel->getActiveSheet()->mergeCells('A1:E1'); // set merge cell pada kolom A1 Sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); //set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); //set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('A3',"NO"); // set kolom a3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B3',"KODE"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3','DESCRIPTION');
		$excel->setActiveSheetIndex(0)->setCellValue('D3','SATUAN');
		$excel->setActiveSheetIndex(0)->setCellValue('E3','PRICE');

		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);

		//panggil function view yang ada di siswamodel untuk menampilkan semua data siswanya
		$barang = $this->m_barang->view();

		$no= 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; //set baris pertama untuk is tabel adalah baris ke 4
		foreach($barang as $data) {
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->plu_id);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->Description);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->satuan);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->Price);

			//apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);

			$no++;
			$numrow++;

		}
			//set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
    	$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
    	$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
    	$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
    	$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E


 // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Data Barang");
    $excel->setActiveSheetIndex(0);

 // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Data Barang.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');

	}


	public function upload() {
		include APPPATH. 'third_party/PHPExcel/PHPExcel.php';

		$config['upload_path'] = realpath('excel');
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['max_size'] = '10000';
		$config['encrypt_name'] =true;

		$this->load->library('upload',$config);
		if (!$this->upload->do_upload()) {
			//upload gagal
			$this->session->set_flashdata('notif','<div class="alert alert-danger"<b>Proses inport gagal! </b> '. $this->upload->display_errors().'</div>');
			redirect('barang/importexcel');

		} else {
			$data_upload = $this->upload->data();
			$excelreader = new PHPExcel_Reader_Excel2007();

			$loadexcel = $excelreader->load('excel/'.$data_upload['file_name']); //load file yang telah di uplaod ke folder excel
			$sheet = $loadexcel->getActiveSheet()->toArray(true, true, true, true);
			$data = array();
			$numrow = 1;


			foreach($sheet as $row ){
				if($numrow > 1){


			$this->load->library('ciqrcode');

			$config['cacheable']	= true;
			$config['cachedir']		='./assets/';
			$config['errorlog']		='./assets/';
			$config['imagedir']		='./assets/images/';
			$config['quality']		= true;
			$config['size']			='1024';
			$config['black']		=array(224, 255, 255);
			$config['white']		= array(70, 130, 180);

			$this->ciqrcode->initialize($config);

			$image_name=$row['A'].'.png';

			$params['data'] =$row['A'];
			$params['level'] ='H';
			$params['size']	=10;
			$params['savename'] = FCPATH.$config['imagedir'].$image_name;
			$this->ciqrcode->generate($params);

					array_push($data, array(
						'plu_id' => $row['A'],
						'Description' => $row['B'],
						'satuan' => $row['C'],
						'Price' => $row['D'],
						'qr_code' => $image_name
					));
				}
				$numrow++;
			}



			$this->db->insert_batch('plu', $data);
			unlink(realpath('excel/'.$data_upload['file_name']));
			//upload success
			$this->session->set_flashdata('notif', '<div class="alert alert-success"><b>proses import berhasil!</b> data berhasil diimport!</div>');
			//redirect halaman
			redirect('barang/importexcel');
		}
	}

	public function exportpdf() {
		$data = $this->m_barang->get_all();
		$tanggal = date('d-M-Y');

		// mengatur ukuran page 
		// $pdf = new FPDF('1','mm','A5');
		$pdf = new \ TCPDF ();
		$pdf->AddPage();
		$pdf->SetFont('', 'B', 20);
		$pdf->Cell(115, 0, "Informasi data master barang - Tgl = ".$tanggal, 0, 0,
		$pdf->SetAutoPageBreak(true, 0));

		//Add Header
		$pdf->Ln(10);
		$pdf->cell(10, 7, '' ,0, 1);
		$pdf->SetFont('','B',12);
		$pdf->cell(10, 8, "No", 1, 0, 'L');
		$pdf->cell(25, 8, "plu_id", 1, 0, 'L');
		$pdf->cell(80, 8, "Description", 1, 0, 'L');
		$pdf->cell(20, 8, "satuan", 1, 0 ,'C');
		$pdf->cell(50, 8, "Price", 1, 1 ,'R');
		$pdf->setfont('','',12);
		foreach($data->result_array() as $k => $barang) {
			$this->addRow($pdf, $k+1, $barang);
		}
		$tanggal = date('d-M-Y');
		$pdf->output('informasi data master barang - ' .$tanggal.'.pdf');
	}

	private function addrow($pdf, $no, $barang) {
		$pdf->cell(10, 8, $no, 1, 0, 'C');
		$pdf->cell(25, 8, $barang['plu_id'], 1, 0, '');
		//$pdf->cell(35, 8, date('d-m-Y', strtotime($order['tanggal'])), 1, 0, 'C');
		$pdf->cell(80, 8, $barang['Description'], 1, 0, 'L');
		$pdf->cell(20, 8, $barang['satuan'], 1, 0, 'C');
		$pdf->cell(50, 8, "Rp." .number_format($barang['Price'], 2, ',', '.'), 1, 1, 'R');
	}


}

