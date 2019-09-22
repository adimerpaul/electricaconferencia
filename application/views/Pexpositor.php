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
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                Realizar Registro
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Realizar Registro</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url()?>Expositor/insert" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="cedula" class="col-sm-2 col-form-label">cedula</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="cedula" placeholder="cedula" required name="cedula">
                                            <option value="">Seleccionar..</option>
                                            <?php
                                            $query=$this->db->query("SELECT * FROM inscritos1 ORDER BY nombres");
                                            foreach ($query->result() as $row){
                                                echo "<option value='$row->cedula'>$row->nombres $row->apellidos</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tutorial" class="col-sm-2 col-form-label">tutorial</label>

                                    <div class="col-sm-10">
                                        <select class="form-control" id="tutorial" placeholder="tutorial" required name="tutorial">
                                            <option value="">Seleccionar..</option>
                                            <option value="MICRO Y NANO TECNOLOGIA DESARROLLO DE DISPOSITIVOS ELECTRONICOS">MICRO Y NANO TECNOLOGIA DESARROLLO DE DISPOSITIVOS ELECTRONICOS
                                            </option>
                                            <option value="EFICIENCIA ENERGETICA EN INSTALACIONES INDUSTRIALES">EFICIENCIA ENERGETICA EN INSTALACIONES INDUSTRIALES
                                            </option>
                                            <option value="RUMBO A LA SMART GRID">RUMBO A LA SMART GRID
                                            </option>
                                            <option value="MODELAMIENTO DE SISTEMAS DINAMICOS BOND GRAPH">MODELAMIENTO DE SISTEMAS DINAMICOS BOND GRAPH
                                            </option>
                                            <option value="OPERACIÓN SATELITAL">OPERACIÓN SATELITAL
                                            </option>
                                            <option value="INSTALACION, MANTENIMIENTO, PROGRAMACION Y PARAMETRIZACION">INSTALACION, MANTENIMIENTO, PROGRAMACION Y PARAMETRIZACION …
                                            </option>
                                            <option value="ELECTRONICA DIGITAL CON FPGAs">ELECTRONICA DIGITAL CON FPGAs</option>
                                            <option value="ETAP, USO DE SOFTWARE PARA EL DIMENSIONAMIENTO Y VERIFICACION">ETAP, USO DE SOFTWARE PARA EL DIMENSIONAMIENTO Y VERIFICACION …
                                            </option>
                                            <option value="IDENTIFICACION DE SISTEMAS, PROCESOS INDUSTRIALES SISO Y MIMO">IDENTIFICACION DE SISTEMAS, PROCESOS INDUSTRIALES SISO Y MIMO
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Registrar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th>nombres</th>
                    <th>CI</th>
                    <th>celular</th>
                    <th>Tutorial</th>
                    <th>Inscrito?</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query=$this->db->query("SELECT * FROM tutoriales  ");
                foreach ($query->result() as $row){
                    $query2=$this->db->query("SELECT * FROM inscritos1 WHERE cedula='$row->cedula'");
                    if ($query2->num_rows()==1){
                        $t="<div class='alert alert-success'>SIinscrito</div> ";
                        $row2=$query2->row();
                        $nom=$row2->nombres.' '.$row2->apellidos;
                    }else{
                        $t="<div class='alert alert-warning'>NOinscrito</div>";
                        $nom=$row->nombres;
                    }
                    echo "<tr class='gradeX'>
                                <td>$nom</td>
                                <td>$row->cedula </td>
                                <td>$row->celular </td>
                                <td>$row->tutorial</td>
                                <td>$t</td>
                                <td>
                                    <a href='".base_url()."Organizador/certificado/".$row->idtutoriales."' ><li class='btn btn-sm btn-warning fa fa-file-o'></li></a>
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
<div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Realizar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url()?>inscribir/modificar" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label for="Nombre" class="col-sm-2 col-form-label">Nombre</label>
                        
                        <div class="col-sm-10">
                            <input type="text" min="0" max="250" class="form-control" id="Nombre" placeholder="Nombre" required name="nombre">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ci" class="col-sm-2 col-form-label">ci</label>
                        
                        <div class="col-sm-10">
                            <input type="text" min="0" max="250" class="form-control" id="ci" placeholder="ci" required name="ci">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Pais" class="col-sm-2 col-form-label">Pais</label>
                       
                        <div class="col-sm-10">
                            <input type="text" min="0" max="250" class="form-control" id="Pais" placeholder="Pais" required name="Pais">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <a href="fotos/user.jpg" id="contenedorfotom"><img  src="fotos/id_ex.jpg" id="fotom"  alt="foto" width="200"></a>
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label for="codigoboleta" class="col-sm-2 col-form-label">Fotografia</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control"  name="foto">
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
