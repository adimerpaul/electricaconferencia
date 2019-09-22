<?php
$query=$this->db->query("SELECT * FROM inscritos1");
echo "<table border='1'> <tr>
<td>ci</td>
    <td>nombre ins</td>
    <td>Nombre ori</td>
    <td>tengo dato?</td>
    <td>Es igual</td>
</tr>";
$con=0;
foreach ($query->result() as $row){
    $quer2=$this->db->query("SELECT * FROM ele WHERE cedula='$row->cedula'");
    $row2=$quer2->row();
    if ($quer2->num_rows()==1){
        $t="SI";
        $nom=$row2->nombres;
        if ($nom=="$row->nombres $row->apellidos"){
            $es="SI";
            $con++;
        }else{
            $es="NO";
        }
    }else{
        $t="NO";
        $nom="";
    }

    echo "<tr>
<td>$row->cedula</td>
    <td>$row->nombres $row->apellidos</td>
    <td>$nom</td>
    <td>$t</td>
    <td>$es</td>
</tr>";
}
echo " </table>
 <p>Total errores $con</p>";
