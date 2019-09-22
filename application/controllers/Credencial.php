<?php
/**
 * Created by PhpStorm.
 * User: Data
 * Date: 09/11/2018
 * Time: 11:46
 */
include 'barcode.php';
class Credencial extends CI_Controller{
    public function index(){
    if($_SESSION['tipo']==""){
        header("Location: ".base_url());
    }
    $data['css']="
        		<!-- Specific Page Vendor CSS -->
                <link rel='stylesheet' href='".base_url()."assets/vendor/select2/select2.css' />
                <link rel='stylesheet' href='".base_url()."assets/vendor/jquery-datatables-bs3/assets/css/datatables.css' />        
                ";
    $data['title']="Credencial";
    $this->load->View("templates/header",$data);
    $this->load->View("credencial",$data);
    $data['js']="
                <!-- Specific Page Vendor -->

                
                
                <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js' ></script>                
                <script src='https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js' ></script>
                <script src='https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js' ></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js' ></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js' ></script>
                <script src='https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js' ></script>
                <script src='https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js' ></script>

            ";
    $this->load->View("templates/footer",$data);
}
public function boleta($ci){
    if($_SESSION['tipo']==""){
        header("Location: ".base_url());
    }

    require('fpdf.php');
    $query=$this->db->query("SELECT * FROM estudiante WHERE ciestudiante='$ci'");
    $row=$query->row();
    $nombre=$row->nombre;
    $delegacion=$row->carrera;
    $pdf = new FPDF('P','mm',array(100,150));
    $pdf->AddPage();
    if(file_exists('fotos/'.$ci.'.jpg')){
        $pdf->Image('fotos/'.$ci.'.jpg',61,47,22);
    }else{
        $pdf->Image('fotos/user.jpg',61,47,22);
    }
    $pdf->Ln(65);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(71,0,utf8_decode($nombre),0,0,'C');
    $pdf->Ln(19);
    $pdf->Cell(71,0,utf8_decode($delegacion),0,0,'C');

    barcode('codigos/'.$ci.'.png', $ci, 20, 'horizontal', 'code128', true);
    $pdf->Image('codigos/'.$ci.'.png',20,104,48,0,'PNG');
    $pdf->Output();
}
function consulta($id){
        $query=$this->db->query("SELECT * FROM inscritos1 WHERE id='$id'");
        echo json_encode($query->result_array());
}
    public function modificar(){
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
        $codigo=$_POST['codigo'];
        $sobrenombre=$nombres.' '.$apellidos;
//        $monto=$_POST['monto'];
        $recibo=$_POST['recibo'];
        $cargo=$_POST['cargo'];
        $this->db->query("UPDATE inscritos1 SET 
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
        mension='$mension',
        recibo='$recibo',
        cargo='$cargo',
        carre='$carrera',
        fechanac='$fechanac'
        WHERE id='$codigo'
        ");


        header("Location: ".base_url()."Credencial");
    }
}
