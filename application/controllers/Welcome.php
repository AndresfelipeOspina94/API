<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function __construct(){
		 parent::__construct();
		$this->load->helper('url');
	}




	public function index()
	{

		// $data = array();
		// $data["ddsde"]=[(
		// 			"country"=> "Lithuania",
		// 			"litres"=> 501.9),
		// 			("country"=> "Czech Republic",
		// 			"litres"=> 301.9)
		// 		];
				//  [
				// 	"country": "Czech Republic",
				// 	"litres": 301.9
				// ]};
				//
				// }, {
				// 	"country": "Ireland",
				// 	"litres": 201.1
				// }, {
				// 	"country": "Germany",
				// 	"litres": 165.8
				// }, {
				// 	"country": "Australia",
				// 	"litres": 139.9
				// }, {
				// 	"country": "Austria",
				// 	"litres": 128.3
				// }, {
				// 	"country": "UK",
				// 	"litres": 99
				// }, {
				// 	"country": "Belgium",
				// 	"litres": 60
				// }, {
				// 	"country": "The Netherlands",
				// 	"litres": 50
				// }] ;

//echo json_encode( $data );



		$this->load->view('view_pdf');
		//$this->load->view('welcome', $data);

		//URL DRAS TABLA
			//$this->load->view('DrasTabla/dirigente');
			// $this->load->view('DrasTabla/relacional');
			 // $this->load->view('DrasTabla/analitica');
			// $this->load->view('DrasTabla/servicial');

		//URL DRAS PATRON
			 //$this->load->view('DrasPatron/1A');
			 //$this->load->view('DrasPatron/1B');
			// $this->load->view('DrasPatron/2C');
			// $this->load->view('DrasPatron/3D');
			// $this->load->view('DrasPatron/3E');
			// $this->load->view('DrasPatron/4F');
			// $this->load->view('DrasPatron/5G');
			// $this->load->view('DrasPatron/5H');
			// $this->load->view('DrasPatron/6I');
			// $this->load->view('DrasPatron/7J');
			// $this->load->view('DrasPatron/7K');
			//$this->load->view('DrasPatron/8L');
			// $this->load->view('DrasPatron/9M');
			// $this->load->view('DrasPatron/9N');
			// $this->load->view('DrasPatron/10O');
			// $this->load->view('DrasPatron/10P');
	}

   // public function create_pdf()
   //  {
   //      //Carga la librería que agregamos
   //      $this->load->library('pdf');
   //      //$saludo será una variable dentro la vista
   //      $data["data"] = "";
   //      //$html tendrá el contenido de la vista
	 //
   //      $html= $this->load->view('DrasTabla/analitica', $data, true);
		// 		//$html= $this->load->view('DrasPatron/1B', $data, true);
   //      /*
   //       * load_html carga en dompdf la vista
   //       * render genera el pdf
   //       * stream ("nombreDelDocumento.pdf", Attachment: true | false)
   //       * true = forza a descargar el pdf
   //       * false = genera el pdf dentro del navegador
   //       */
   //      $this->pdf->load_html($html);
   //      $this->pdf->render();
   //      $this->pdf->stream("welcome.pdf", array(
   //          "Attachment" => false
   //      ));
   //  }

}
