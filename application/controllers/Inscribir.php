<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include 'barcode.php';
include('phpqrcode/qrlib.php');
require_once('php_image_magician.php');
class Inscribir extends CI_Controller {

    public function index()
    {
        if($_SESSION['ci']==""){
            header("Location: ".base_url());
        }
        $data['css']="
        		<!-- Specific Page Vendor CSS -->
                <link rel='stylesheet' href='".base_url()."assets/vendor/select2/select2.css' />
                <link rel='stylesheet' href='".base_url()."assets/vendor/jquery-datatables-bs3/assets/css/datatables.css' />        
                ";
        $data['title']="Realizar inscripcion";
        $this->load->View("templates/header",$data);
        $this->load->View("inscribir",$data);
        $data['js']="
                <!-- Specific Page Vendor -->
                <script src='".base_url()."assets/vendor/select2/select2.js'></script>
                <script src='".base_url()."assets/vendor/jquery-datatables/media/js/jquery.dataTables.js'></script>
                <script src='".base_url()."assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js'></script>
                <script src='".base_url()."assets/vendor/jquery-datatables-bs3/assets/js/datatables.js'></script>
           		<!-- Examples -->
                <script src='".base_url()."assets/javascripts/tables/examples.datatables.default.js'></script>
                <script src='".base_url()."assets/javascripts/tables/examples.datatables.row.with.details.js'></script>
                <script src='".base_url()."assets/javascripts/tables/examples.datatables.tabletools.js'></script>
                <script src='".base_url()."assets/javascripts/inscribir.js'></script>
            ";
        $this->load->View("templates/footer",$data);
    }
    public function registro(){
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $cedula=($_POST['ci']);
        $numero=$this->db->query("SELECT * FROM inscritos1")->num_rows()+1;
        $nombres=strtoupper($_POST['nombres']);
        $apellidos=$_POST['apellidos'];
        $celular=$_POST['celular'];
        $correo=$_POST['correo'];
        $ocupacion=$_POST['ocupacion'];
        $tipo="EFECTIVO";
        $ciudad=strtoupper($_POST['ciudad']);
        $facultad=$_POST['facultad'];
        $fechanac=$_POST['fechanac'];
        $fecha = str_replace("/","-",$fechanac);
        $cumpleanos = new DateTime($fechanac);
        $hoy = new DateTime();
        $edad = $hoy->diff($cumpleanos)->y;
         $fechai=date('Y-m-d');
        $carrera=$_POST['carrera'];
        $mension=$_POST['mension'];
        $sobrenombre=$nombres.' '.$apellidos;
        $monto=$_POST['monto'];
        $qr='0';
        $recibo=$_POST['recibo'];
        $cargo=$_POST['cargo'];
        $row=$this->db->query("SELECT qr FROM inscritos1 ORDER BY qr DESC")->row();
        $qr=$row->qr+5;

        /*
        try {
            $mi_archivo = 'foto';
            $config['upload_path'] = "fotos/";
            $config['file_name'] = $ciestudiante;
            $config['allowed_types'] = "*";
            $config['max_size'] = "50000";
            $config['max_width'] = "2000";
            $config['max_height'] = "2000";
            $config['overwrite']=true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($mi_archivo)) {
                //*** ocurrio un error
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();

            }

            $data['uploadSuccess'] = $this->upload->data();
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }*/

        //if ($tipopago=="")
        /*$now = date("Y-m-d H:i:s");
        $date = "2018-11-08 00:00:00";
        if( $now <= $date ){
            if($tipopago=="ESTUDIANTE INTERNO"){
                $monto="200";

            }else{
                $monto="300";
            }
        }else{
            if($tipopago=="ESTUDIANTE INTERNO"){
                $monto="250";
            }else{
                $monto="350";
            }
        }*/
//        $monto1=30;
//        if($estudianteinterno==""){
//        $this->db->query("INSERT INTO estudiante VALUES('$ciestudiante','$nombre','$celular','$email','$codigo','$carrera','$sede')");
//        $this->db->query("INSERT INTO inscripcion(monto,tipo,codigoboleta,material,certificado,ci,ciestudiante,tipopago) VALUES('$monto1','$tipo','$codigoboleta','$material','$certificado','".$_SESSION['ci']."','$ciestudiante','$tipopago')");
//        }else{
//            if ($monto2=="0" || $monto2==""){
//            $this->db->query("UPDATE estudiante SET celular='$celular',correo='$email',codigo='$codigo' WHERE ciestudiante='$ciestudiante'");
//            $query=$this->db->query("SELECT * FROM inscripcion WHERE ciestudiante='$ciestudiante'");
//            if ($query->num_rows()==0){
//                $this->db->query("INSERT INTO inscripcion(monto,tipo,codigoboleta,material,certificado,ci,ciestudiante,tipopago) VALUES('$monto1','$tipo','$codigoboleta','$material','$certificado','".$_SESSION['ci']."','$ciestudiante','$tipopago')");
//            }
//            }else{
//                $this->db->query("UPDATE inscripcion SET monto2='$monto2' WHERE ciestudiante='$ciestudiante'");
//            }
//        }
        if ($monto==''){
            $monto='0';
        }
        $this->db->query("INSERT INTO inscritos1 SET 
        ci='".$_SESSION['ci']."',
        numero='$numero',
        nombres='$nombres',
        cedula='$cedula',
        apellidos='$apellidos',
        celular='$celular',
        correo='$correo',
        ocupacion='$ocupacion',
        ciudad='$ciudad',
        facultad='$facultad',
        edad='$edad',
        fechai='$fechai',
        sobrenombre='$sobrenombre',
        qr='$qr',
        mension='$mension',
        recibo='$recibo',
        cargo='$cargo',
        carre='$carrera',
        
        fechanac='$fechanac',
        monto='$monto'
        ");


       header("Location: ".base_url()."inscribir");
    }
    public  function consulta(){
        $mostrar=$_POST['mostrar'];
        $tabla=$_POST['tabla'];
        $where=$_POST['where'];
        $dato=$_POST['dato'];
        $query=$this->db->query("SELECT $mostrar FROM $tabla WHERE $where='$dato'");
        $row=$query->row();
        echo $row->$mostrar;
    }

    public function modificar(){
        $monto=$_POST['monto1'];
        $monto2=$_POST['monto2'];
        $ciestudiante=$_POST['ciestudiante'];
        $now=date("Y-m-d h:i:s");
        if ($monto2!="" || $monto2!="0")
        $this->db->query("UPDATE inscripcion SET monto=$monto,monto2='$monto2',fecha2='$now' WHERE ciestudiante='$ciestudiante'");
        try {
            $mi_archivo = 'foto';
            $config['upload_path'] = "fotos/";
            $config['file_name'] = $ciestudiante;
            $config['allowed_types'] = "*";
            $config['max_size'] = "50000";
            $config['max_width'] = "2000";
            $config['max_height'] = "2000";
            $config['overwrite']=true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($mi_archivo)) {
                //*** ocurrio un error
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();

            }

            $data['uploadSuccess'] = $this->upload->data();
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
        header("Location: ".base_url()."inscribir");
    }
    public  function consultamonto(){
        $mostrar=$_POST['mostrar'];
        $tabla=$_POST['tabla'];
        $where=$_POST['where'];
        $dato=$_POST['dato'];
        $query=$this->db->query("SELECT $mostrar FROM $tabla WHERE $where='$dato'");
        $row=$query->row();
        echo $row->$mostrar;
    }
    public function boleta($idinscripcion){
        if($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $query=$this->db->query("SELECT * FROM inscritos1 WHERE id='$idinscripcion'");
        $row=$query->row();
        $fecha=$row->fecha;
        $cedula=$row->cedula;
        $nombre=$row->nombres.' '.$row->apellidos;
        $monto=$row->monto;
        $codigoboleta=$idinscripcion;
        $personal=$this->User->consula('nombre','personal','ci',$_SESSION['ci']);

        require('fpdf.php');
        $pdf = new FPDF('P','mm',array(80,80));
        $pdf->AddPage();
        $pdf->Image('dist/ele.jpeg',2,2,12);
        $pdf->Image('dist/fni.jpeg',68,3,9);
        $pdf->SetFont('Arial','B',9);
        $pdf->Ln(1);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(10,0,utf8_decode(''));
        $pdf->Cell(15,0,utf8_decode('Nro:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode($idinscripcion));
        $pdf->Ln(5);
        $pdf->Cell(4,0,utf8_decode(''));
        $pdf->Cell(28,0,utf8_decode('UNIVERSIDAD TÉCNICA DE ORURO'));
        $pdf->Ln(3);
        $pdf->Cell(2,0,utf8_decode(''));
        $pdf->Cell(30,0,utf8_decode('FACULTAD NACIONAL DE INGENIERIA'));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Fecha y hora:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode(date("Y-m-d H:i:s")));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('CI:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode($row->cedula));

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(8,0,utf8_decode('Est.:'));
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(30,0,utf8_decode($nombre));

        if ($codigoboleta!="")
        $codigoboleta="N:".$codigoboleta;

//        $pdf->Ln(5);
//        $pdf->SetFont('Arial','B',9);
//        $pdf->Cell(25,0,utf8_decode('Aporte:'));
//        $pdf->SetFont('Arial','',9);
//        $pdf->Cell(10,0,utf8_decode($monto." Bs".$codigoboleta));
        /*
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Cuota 2:'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(10,0,utf8_decode($monto2." Bs"));
*/


        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(25,0,utf8_decode('Atendido :'));
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(30,0,utf8_decode($personal));

        $pdf->Ln(4);
        $pdf->SetFont('Arial','B',7);
        $pdf->MultiCell(0,4,utf8_decode('Por concepto II CONGRESO NACIONAL DE INGENIERÍA ELÉCTRICA E INGENIERÍA ELECTRÓNICA 2019 '));

        $pdf->Output();
    }

    function credencial($id){
        $row=$this->db->query("SELECT * FROM inscritos1 WHERE id='$id'")->row();
        require('fpdf.php');
        $pdf = new FPDF();
        $nombres=$row->nombres;
        $apellidos=$row->apellidos;
        $ci=$row->cedula;
        $qr=$row->qr;
        $pdf->AddPage();
        $pdf->Image('codigos/credencial.jpeg',5,5,198,0,'JPEG');

        //QRcode::png('hello',"hola.png",QR_ECLEVEL_L,10,2);
        $magicianObj = new imageLib('qr/'.$qr.'.bmp');
        $magicianObj -> saveImage('qr/1000.png');

        $pdf->Image('qr/1000.png',110,15,25,0);

        $pdf->Ln(3);
        $pdf->setTextColor(255, 61, 0);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,4,'',0);
        $pdf->Cell(80,4,utf8_decode('PARTICIPANTE'),0,0,'C');
        $pdf->setTextColor(0, 0, 0);
        $pdf->Ln(7);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,4,'',0);
        $pdf->Cell(80,4,utf8_decode($nombres),0,0,'C');
        $pdf->Ln(9);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,4,'',0);
        $pdf->Cell(80,4,utf8_decode($apellidos),0,0,'C');
        $pdf->Ln(9);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,4,'',0);
        $pdf->Cell(80,4,utf8_decode($ci),0,0,'C');

        $pdf->Ln(15);
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(101,4,'',0);
        $pdf->Cell(20,4,utf8_decode($qr),0,0,'C');


        $pdf->Output();
    }

}
