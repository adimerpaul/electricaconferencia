<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$title?></h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Main</span></li>
                <li><span><?=$title?></span></li>
            </ol>
            <a class="sidebar-right-toggle" ><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>
            <h2 class="panel-title"><?=$title?></h2>
        </header>
        <div class="panel-body">
            <!-- Modal -->

            <table class="table table-bordered table-striped mb-none" id="datatable">
                <thead>
                <tr>
                    
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>CI</th>
                    <th>Codigo</th>
                    <th>Opciones</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $con=0;
                $query=$this->db->query("SELECT * FROM inscritos1  ");
                foreach ($query->result() as $row){
                    $con=$con+1;
                    echo "<tr class='gradeX'>

                                <td>$row->nombres $row->apellidos</td>
                                <td>$row->fecha</td>
                                <td>".$row->cedula." </td>
                                
                                <td>$row->qr</td>
                                <td>
                                    <a href='".base_url()."inscribir/credencial/".$row->id."' ><li class='btn btn-sm btn-success fa fa-file'>Credencial</li></a>
                                    <a href='".base_url()."Organizador/certificado/$row->id ' ><li class='btn btn-sm btn-warning fa fa-file-o'> Certificado</li> </a>
                                    <button  class='btn btn-info' style='padding: 3px' data-toggle='modal' data-target='#exampleModal' data-codigo='$row->id'><i class='fa fa-pencil'></i> Editar</button>
                                 </td>
                            </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- end: page -->
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Realizar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url()?>Credencial/modificar" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="nombres" class="col-sm-2 col-form-label">nombres</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombres" placeholder="nombres" required name="nombres">
                            <input type="text" name="codigo" id="codigo" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="apellidos" class="col-sm-2 col-form-label">apellidos</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="apellidos" placeholder="apellidos" required name="apellidos">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ci" class="col-sm-1 col-form-label">ci</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="ci" placeholder="ci" required name="ci">
                        </div>
                        <label for="celular" class="col-sm-1 col-form-label">celular</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="celular" placeholder="celular" required name="celular">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="correo" class="col-sm-1 col-form-label">correo</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="correo" placeholder="correo" required name="correo">
                        </div>
                        <label for="cargo" class="col-sm-1 col-form-label">cargo</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="cargo" placeholder="cargo"  name="cargo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ocupacion" class="col-sm-1 col-form-label">ocupacion</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="ocupacion" placeholder="ocupacion"  name="ocupacion">
                        </div>
                        <label for="ciudad" class="col-sm-1 col-form-label">ciudad</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="ciudad" placeholder="ciudad"  name="ciudad">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="facultad" class="col-sm-1 col-form-label">facultad</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="facultad" placeholder="facultad"  name="facultad">
                        </div>
                        <label for="carrera" class="col-sm-1 col-form-label hidden">carrera</label>
                        <div class="col-sm-5 hidden">
                            <input type="text" class="form-control" id="carrera" placeholder="carrera" name="carrera">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mension" class="col-sm-1 col-form-label">mension</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="mension" placeholder="mension" name="mension">
                        </div>
                        <label for="fechanac" class="col-sm-1 col-form-label">fechanac</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="fechanac" required value="<?=date('Y-m-d')?>" placeholder="fechanac" name="fechanac">
                        </div>
                    </div>
                    <div class="form-group row">
<!--                        <label for="monto" class="col-sm-1 col-form-label">monto</label>-->
<!--                        <div class="col-sm-5">-->
<!--                            <select  class="form-control" id="monto" placeholder="monto" name="monto">-->
<!--                                <option value="">Seleccionar..</option>-->
<!--                                <option value="250">250</option>-->
<!--                                <option value="300">300</option>-->
<!--                                <option value="400">400</option>-->
<!--                                <option value="450">450</option>-->
<!--                            </select>-->
<!--                        </div>-->
                        <label for="recibo" class="col-sm-1 col-form-label">recibo</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="recibo" required placeholder="recibo" value="0"  name="recibo">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Modificar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    window.onload=function (e) {

            $('#datatable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var codigo = button.data('codigo');
            console.log(codigo);
            $.ajax({
                url:'Credencial/consulta/'+codigo,
                success:function (e) {
                    console.log(e);
                    var dato=JSON.parse(e)[0];
                    $('#nombres').val(dato.nombres);
                    $('#codigo').val(dato.id);
                    $('#apellidos').val(dato.apellidos);
                    $('#ci').val(dato.cedula);
                    $('#celular').val(dato.celular);
                    $('#correo').val(dato.correo);
                    $('#cargo').val(dato.cargo);
                    $('#ocupacion').val(dato.ocupacion);
                    $('#ciudad').val(dato.ciudad);
                    $('#facultad').val(dato.facultad);
                    $('#carrera').val(dato.carre);
                    $('#mension').val(dato.mension);
                    $('#fechanac').val(dato.fechanac);
                    $('#monto').val(dato.monto);
                    $('#recibo').val(dato.recibo);
                }
            });
        })

            // $('.moaadificar').click(function (e) {
                /*$.ajax({
                    url:'Credencial/consulta/'+$(this).attr('data-id'),
                    success:function (e) {
                        console.log(e);
                        var dato=JSON.parse(e)[0];
                        $('#nombres').val(dato.nombres);
                        $('#apellidos').val(dato.apellidos);
                        $('#ci').val(dato.ci);
                        $('#celular').val(dato.celular);
                        $('#correo').val(dato.correo);
                        $('#cargo').val(dato.cargo);
                        $('#ocupacion').val(dato.ocupacion);
                        $('#ciudad').val(dato.ciudad);
                        $('#facultad').val(dato.facultad);
                        $('#carrera').val(dato.carrera);
                        $('#mencion').val(dato.mencion);
                        $('#fechanac').val(dato.fechanac);
                        $('#monto').val(dato.monto);
                        $('#recibo').val(dato.recibo);

                    }
                })
                e.preventDefault();*/
            // });
    }
</script>
