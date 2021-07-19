<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Constancia de Vacunacion
                        <button type="button" @click="abrirModal('categoria','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    <!--<
                    button type="button" @click="cargarPdf()" class="btn btn-info">
                    <i class="icon-doc"></i>&nbsp;Reporte
                    </button>
                    -->
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre_paciente">Paciente</option>
                                      <option value="id">Numero de Constancia</option>
                                      <option value="id">Especialista / Especialidad</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarCategoria(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCategoria(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th width="15">Opciones</th>
                                    <th width="100">Codigo</th>
                                    <th width="100">Version</th>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <tr >
                                    <td>
                                        <button type="button"   @click="cargarPdf()"  class="btn btn-warning btn-sm">
                                          <i class="icon-printer"></i>
                                        </button> &nbsp;
                            
                               <!-- 
                                        -->
                            <!--            
                                        <template v-if="categoria.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarMarca(categoria.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarMarca(categoria.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                            -->           
                                    </td>
                                    <td v-text="'2019-001'"></td>
                                    <td v-text="'1.0'"></td>
                                    <td v-text="'CONSTANCIA DE VACUNACION'"></td>
                                    <td v-text="'22-09-2019'"></td>
                                    <td>
                                            <span class="badge badge-success">Activo</span>
                                    </td>
                                   <!-- <td v-text="'PD'+categoria.codigo"></td>
                                    <td v-text="categoria.nombre_usuario"></td>
                                    <td v-text="categoria.nombre_provedor+' / '+categoria.nombre_especialidad"></td>
                                    <td v-text="categoria.fecha_atencion"></td>
                                    <td v-text="categoria.fecha_atencion_validez"></td>
                                    <td>
                                        <div v-if="categoria.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                    -->
                                </tr>    
                                <tr>
                                    <td>
                                        <button type="button"  @click="ImprimirAtencionDirecta(categoria)"  class="btn btn-warning btn-sm">
                                          <i class="icon-printer"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td v-text="'2019-001'"></td>
                                    <td v-text="'1.0'"></td>
                                    <td v-text="'CONSTANCIA DE VACUNACION'"></td>
                                    <td v-text="'22-09-2019'"></td>
                                    <td>
                                    <span class="badge badge-success">Activo</span>
                                    </td> 
                                </tr> 
                                <tr>
                                    <td>
                                        <button type="button"  @click="ImprimirAtencionDirecta(categoria)"  class="btn btn-warning btn-sm">
                                          <i class="icon-printer"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td v-text="'2019-001'"></td>
                                    <td v-text="'1.0'"></td>
                                    <td v-text="'CONSTANCIA DE VACUNACION'"></td>
                                    <td v-text="'22-09-2019'"></td>
                                    <td>
                                    <span class="badge badge-success">Activo</span>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button"  @click="ImprimirAtencionDirecta(categoria)"  class="btn btn-warning btn-sm">
                                          <i class="icon-printer"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td v-text="'2019-001'"></td>
                                    <td v-text="'1.0'"></td>
                                    <td v-text="'CONSTANCIA DE VACUNACION'"></td>
                                    <td v-text="'22-09-2019'"></td>
                                    <td>
                                    <span class="badge badge-success">Activo</span>
                                    </td> 
                                </tr>                         
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Codigo</label>
                                <div class="col-md-9">
                                  <div>
                                     <div class="text-error">
                                     <div  v-text="codigo_nuevo">
                                     </div>
                                  </div>
                                </div>
                                        
                                    </div>
                                    <!--<div class="col-md-9">
                                        <input type="email" v-model="descripcion" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                    -->
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha(*)</label>
                                     <div class="col-md-9">
                                     <div >
                                     <div class="text-error">
                                     <div v-text="fecha_actual">
                                        
                                </div>
                                </div>
                                </div> 
                                </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Titular(*)</label>
                                    <div class="col-md-9">
                                    <div>
                                    <div class="text-error">
                                    <div v-text="nombre_titular">
                                    </div>
                                    </div>
                                    <div class="text-registro">
                                    <div v-text="registro_titular">
                                    </div>
                                    </div>
                                    <div class="text-edad">
                                    <div v-text="edad_titular">
                                    </div>
                                    </div>
                                    </div> 
                                    </div>
                                    </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Paciente(*)</label>
                                     <div class="col-md-9">
                                     <div >
                                     <div class="text-error">
                                     <div v-text="nombre_paciente">
                                </div>
                                </div>
                                <div class="text-registro">
                                     <div v-text="registro_paciente">
                                </div>
                                </div>
                                <div class="text-edad">
                                     <div v-text="edad_paciente">
                                </div>
                                </div>
                                </div> 
                                </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Especialista(*)<br>Especialidad</label>
                                     <div class="col-md-9">
                                     <div >
                                     <div class="text-error">
                                     <div v-text="especialista">
                                </div>
                                </div>
                                <div class="text-registro">
                                     <div v-text="especialidad">
                                </div>
                                </div>
                                
                                </div> 
                                </div>
                                </div>
                                
                                <div class="form-group row">
                                     <label class="col-md-3 form-control-label" for="text-input">Buscar</label>
                                <div class="col-md-9">



                                <div>
                                <v-select v-model="query" :options="arrayPaciente"  label="usuario_nombre" @input="escojer(query)"></v-select>
                                </div> 
                                </div>
                                </div>

                                <div class="form-group row">
                                     <label class="col-md-3 form-control-label" for="text-input">Buscar Especialidad</label>
                                <div class="col-md-9">



                                <div>
                                <v-select v-model="queryesp" :options="arrayEspecialidad"  label="busqueda" @input="escojeresp(queryesp)" ></v-select>
                                </div> 
                                </div>
                                </div>
                                <div v-show="errorMarca" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjMarca" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCartaGarantia()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarMarca()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {
        props : ['ruta'],
        data (){
            return {
                categoria_id: 0,
                descripcion : '',
                comentario : '',
                arrayCategoria : [],
                arrayUbicacion : [],
                modal : 0,
                mostrar: true,
                tituloModal : '',
                codigo_nuevo : '',
                tipoAccion : 0,
                errorMarca : 0,
                nombre_paciente : '',
                nombre_titular : '',
                edad_paciente : '',
                edad_titular : '',
                registro_titular : '',
                registro_paciente : '',
                codigo_titular : '',
                codigo_paciente : '',
                codigo_especialista : '',
                especialista : '',
                especialidad : '',
                codigo_paciente_imp : '',
                fecha : '',
                fecha_actual : '',
                errorMostrarMsjMarca : [],
                errorMostrarMsjTitular : [],
                errorMostrarMsjCodigo : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre_paciente',
                query: '',
                queryesp: '',
                results: [],
                resultsesp: [],
                arrayPaciente: [],
                arrayEspecialidad: [],
                buscar : ''
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarCategoria (page,buscar,criterio){
                
                let me=this;
                var url=this.ruta + '/cartagarantiaclinica?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCategoria = respuesta.categorias.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            cargarPdf(){
                window.open(this.ruta + '/varios/vacingles','_blank');
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarCategoria(page,buscar,criterio);
            },
            registrarCartaGarantia(){
               /* if (this.validarMarca()){
                    return;
                }
                */                
                let me = this;
                axios
                .post(this.ruta + '/cartagarantiaclinica/registrar',{
                    'codigo_paciente': this.codigo_paciente,
                    'fecha_at' : this.fecha_actual,
                    'codigo_especialista' : this.codigo_especialista,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCategoria(1,'','descripcion');

                }).catch(function (error) {
                    console.log(error);
                });
                var myWindow=window.open('','','');
                    myWindow.document.write("<br><br><br>");
                    myWindow.document.write("<table border='0'  width='700'>");
                    myWindow.document.write("<tr height='20'>");
                    myWindow.document.write("<td width = '20'>");
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td>");
                    myWindow.document.write(this.codigo_nuevo);                   
                    myWindow.document.write("</td>");
                    myWindow.document.write("</tr>");
                    myWindow.document.write("</table>");
                    myWindow.document.write("<br><br><br><br>");
                    myWindow.document.write("<table border='0'  width='700'>");
                    myWindow.document.write("<tr height='27'>");
                    myWindow.document.write("<td  width = '78'>");
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td width = '362'>");
                    myWindow.document.write(this.nombre_titular);
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td >");
                    myWindow.document.write('&nbsp;&nbsp;'+this.edad_titular_imp);
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td >");
                    myWindow.document.write('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+this.codigo_titular);
                    myWindow.document.write("</td>");
                    myWindow.document.write("</tr>");
                    myWindow.document.write("</table>");
                    myWindow.document.write("<table border='0'  width='700'>");
                    myWindow.document.write("<tr height='20'>");
                    myWindow.document.write("<td width = '90'>");
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td width = '350'>");
                    myWindow.document.write(this.nombre_paciente);
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td >");
                    myWindow.document.write('&nbsp;&nbsp;'+this.edad_paciente_imp);
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td >");
                    myWindow.document.write('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+this.registro_paciente_imp);
                    myWindow.document.write("</td>");
                    myWindow.document.write("</tr>"); 
                    myWindow.document.write("</table>");
                    myWindow.document.write("<table border='0'  width='700'>");
                    myWindow.document.write("<tr>");
                    myWindow.document.write("<td width = '125'>");
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td>");
                    myWindow.document.write(this.especialista +' / '+ this.especialidad);
                    myWindow.document.write("</td>");
                    myWindow.document.write("</tr>");                    
                    myWindow.document.write("</table>");
                    myWindow.document.write("<table border='0'  width='700'>");
                    myWindow.document.write("<tr>");
                    myWindow.document.write("<td width = '125'>");
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td width = '285'>");
                    myWindow.document.write(this.fecha_actual_imp);
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td >");
                     myWindow.document.write(this.fecha_actual_imp_validez);
                    myWindow.document.write("</td>");
                    myWindow.document.write("</tr>");                    
                    myWindow.document.write("</table>");
                    
                    myWindow.document.close();
                    myWindow.focus();
                    myWindow.print();
                    myWindow.close();

            },
            ImprimirAtencionDirecta(categoria){

                this.calcularEdad(categoria.USU_FECHANAC,'paciente');
                //var codigo_usuario =  pad(categoria.codigo_paciente,10) ;
                var codigo_usuario = String("0000000000" + categoria.codigo_paciente).slice(-10);
                 //str.padStart(categoria.codigo_paciente [10, 0]);
                

                //console.log(codigo_usuario);
                
                    axios
                    .get(this.ruta +'/buscartitular',{params: {query: codigo_usuario}})
                    .then(response => {
                    var titular = response.data;
                    var id_titular = titular[0].USU_ID. replace(/^0+/, '');
                    var id_titular= id_titular.substring(0,id_titular.length-2);
                    this.nombre_titular =titular[0].USU_APELLIDOS+ ' ' +titular[0].USU_NOMBRES;
                    this.registro_titular = ' Registro N°: ' + id_titular + '-' + titular[0].NIV_ID;
                    this.calcularEdad(titular[0].USU_FECHANAC,'titular');
                    this.codigo_titular =  id_titular +'-' +titular[0].NIV_ID;
                    var codigo_pac = String(categoria.codigo_paciente);
                     codigo_pac = codigo_pac.substring(0,codigo_pac.length-2);
                    this.codigo_paciente_imp =  codigo_pac;
                    

                    var fecha_atencion = String(categoria.fecha_atencion_imp);
                    this.fecha_atencion = fecha_atencion.split("-", 3);

                    var fecha_atencion_validez = String(categoria.fecha_atencion_validez_imp);
                    this.fecha_atencion_validez = fecha_atencion_validez.split("-", 3);
                    console.log(fecha_atencion_validez[0]);
                    //split(" ", 3);
                    //return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
                    //console.log(this.nombre_titular);
                    //this.edad_titular = edad;
                    })
                    .catch(function (error) {
                        console.log(error);
                                       });
                    

                    swal({
                title: 'Esta seguro de reimprimir este registro?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Imprimir!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    var myWindow=window.open('','','');
                    myWindow.document.write("<br><br><br>");
                    myWindow.document.write("<table border='0'  width='700'>");
                    myWindow.document.write("<tr height='20'>");
                    myWindow.document.write("<td width = '20'>");
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td>");
                    myWindow.document.write('PD'+categoria.codigo);                   
                    myWindow.document.write("</td>");
                    myWindow.document.write("</tr>");
                    myWindow.document.write("</table>");
                    myWindow.document.write("<br><br><br><br>");
                    myWindow.document.write("<table border='0'  width='700'>");
                    myWindow.document.write("<tr height='27'>");
                    myWindow.document.write("<td  width = '78'>");
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td width = '362'>");
                    myWindow.document.write(this.nombre_titular);
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td >");
                    myWindow.document.write('&nbsp;&nbsp;'+this.edad_titular_imp);
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td >");
                    myWindow.document.write('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+this.codigo_titular);
                    myWindow.document.write("</td>");
                    myWindow.document.write("</tr>");
                    myWindow.document.write("</table>");
                    myWindow.document.write("<table border='0'  width='700'>");
                    myWindow.document.write("<tr height='20'>");
                    myWindow.document.write("<td width = '90'>");
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td width = '350'>");
                    myWindow.document.write(categoria.USU_APELLIDOS+' '+ categoria.USU_NOMBRES);
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td >");
                    myWindow.document.write('&nbsp;&nbsp;'+this.edad_paciente_imp);
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td >");
                   myWindow.document.write('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+ this.codigo_paciente_imp+'-'+categoria.NIV_ID);
                    myWindow.document.write("</td>");
                    myWindow.document.write("</tr>"); 
                    myWindow.document.write("</table>");
                    myWindow.document.write("<table border='0'  width='700'>");
                    myWindow.document.write("<tr>");
                    myWindow.document.write("<td width = '125'>");
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td>");
                    myWindow.document.write(categoria.nombre_provedor +' / '+ categoria.nombre_especialidad);
                    myWindow.document.write("</td>");
                    myWindow.document.write("</tr>");                    
                    myWindow.document.write("</table>");
                    myWindow.document.write("<table border='0'  width='700'>");
                    myWindow.document.write("<tr>");
                    myWindow.document.write("<td width = '125'>");
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td width = '285'>");
                    myWindow.document.write(this.fecha_atencion[0] + '&nbsp;&nbsp;&nbsp;' + this.fecha_atencion[1] + '&nbsp;&nbsp;&nbsp;' + this.fecha_atencion[2]);
                    myWindow.document.write("</td>");
                    myWindow.document.write("<td >");
                    myWindow.document.write(this.fecha_atencion_validez[0] + '&nbsp;&nbsp;&nbsp;' + this.fecha_atencion_validez[1] + '&nbsp;&nbsp;&nbsp;' + this.fecha_atencion_validez[2]);
                    myWindow.document.write("</td>");
                    myWindow.document.write("</tr>");                    
                    myWindow.document.write("</table>");                   
                   
                    
                    myWindow.document.close();
                    myWindow.focus();
                    myWindow.print();
                    myWindow.close();
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
                
                
                    
                
                
            },
            desactivarMarca(id){
               swal({
                title: 'Esta seguro de desactivar esta marca?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put(this.ruta + '/marca/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCategoria(1,'','descripcion');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarMarca(id){
               swal({
                title: 'Esta seguro de activar esta marca?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put(this.ruta + '/marca/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCategoria(1,'','descripcion');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            validarMarca(){
                this.errorMarca=0;
                this.errorMostrarMsjMarca =[];

                if (!this.descripcion) this.errorMostrarMsjMarca.push("El nombre de la Marca no puede estar vacío.");

                if (this.errorMostrarMsjMarca.length) this.errorMarca = 1;

                return this.errorMarca;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';               
                this.descripcion='';
                this.comentario='';
            },
             autoComplete(){
                
                let me=this;
                axios
                .get(this.ruta +'/paciente/buscar')
                .then(response => {
                var respuesta= response.data;                
                me.arrayPaciente= respuesta.paciente;

                });
              
            },
            autoCompleteEspecialidad(){
                
                let me=this;
                axios
                .get(this.ruta +'/especialidadclinica/buscar')
                .then(response => {
                var respuesta= response.data;                
                me.arrayEspecialidad= respuesta.especialidad;
                });
              
            },
            escojer(nombre){
            
                //console.log(Math.max());

                
               // console.log(nombre.USU_ID);


                if (nombre.NIV_ID!='00'){
                    axios
                    .get(this.ruta +'/buscartitular',{params: {query: nombre.USU_ID}})
                    .then(response => {
                    var titular = response.data;
                    var id_titular = titular[0].USU_ID. replace(/^0+/, '');
                    var id_titular= id_titular.substring(0,id_titular.length-2);
                    this.nombre_titular =titular[0].USU_APELLIDOS+ ' ' +titular[0].USU_NOMBRES;
                    this.registro_titular = ' Registro N°: ' + id_titular + '-' + titular[0].NIV_ID;
                    this.codigo_titular = id_titular + '-' + titular[0].NIV_ID;
                    this.calcularEdad(titular[0].USU_FECHANAC,'titular');
                    

                    //this.edad_titular = edad;
                    });
                    var id_paciente = nombre.USU_ID. replace(/^0+/, '')
                    var id_paciente= id_paciente.substring(0,id_paciente.length-2);
                    this.nombre_paciente =nombre.USU_APELLIDOS + ' ' +nombre.USU_NOMBRES;
                    this.registro_paciente = ' Registro N°: ' + id_paciente + '-' + nombre.NIV_ID;
                    this.registro_paciente_imp =  id_paciente + '-' + nombre.NIV_ID;
                    this.calcularEdad(nombre.USU_FECHANAC,'paciente');
                    this.codigo_paciente =  id_paciente +  nombre.NIV_ID;
                }
                else 
                {
                    var id_titular = nombre.USU_ID. replace(/^0+/, '');
                    var id_titular = id_titular.substring(0,id_titular.length-2);
                    this.nombre_titular = nombre.USU_APELLIDOS + ' ' +nombre.USU_NOMBRES;
                    this.registro_titular = ' Registro N°: ' + id_titular + '-' + nombre.NIV_ID;
                    this.codigo_titular =  id_titular + '-' +  nombre.NIV_ID;
                    this.calcularEdad(nombre.USU_FECHANAC,'titular');

                    var id_paciente = nombre.USU_ID. replace(/^0+/, '')
                    var id_paciente = id_paciente.substring(0,id_paciente.length-2);
                    this.nombre_paciente = nombre.USU_APELLIDOS + ' ' +nombre.USU_NOMBRES;
                    this.registro_paciente = ' Registro N°: ' + id_paciente + '-' + nombre.NIV_ID;
                    this.registro_paciente_imp =  id_paciente + '-' + nombre.NIV_ID;
                    this.codigo_paciente =  id_paciente +  nombre.NIV_ID;
                    this.calcularEdad(nombre.USU_FECHANAC,'paciente');                   
                }
                

                //this.mostrarTitular=1;
                //this.nombre_paciente =nombre.USU_NOMBRES + ' ' +nombre.USU_APELLIDOS + '    '  + 'Registro N°: ' + nombre.USU_ID. replace(/^0+/, '') + '-' + nombre.NIV_ID;
        
            },

            escojeresp(nombre){
            
                //console.log(Math.max());

                    this.codigo_especialista = nombre.cod_esp;
                    this.especialista = nombre.especialista;
                    this.especialidad = nombre.especialidad;
                    
                //this.mostrarTitular=1;
                //this.nombre_paciente =nombre.USU_NOMBRES + ' ' +nombre.USU_APELLIDOS + '    '  + 'Registro N°: ' + nombre.USU_ID. replace(/^0+/, '') + '-' + nombre.NIV_ID;
        
            },

            BuscarDatosporId(nombre){
            
                //console.log(Math.max());

                this.query = '';
                var codigo_usuario = '00'+nombre.codigo_paciente;

                //console.log(codigo_usuario);
                
                    axios
                    .get(this.ruta +'/buscartitular',{params: {query: codigo_usuario}})
                    .then(response => {
                    var titular = response.data;
                    var id_titular = titular[0].USU_ID. replace(/^0+/, '');
                    var id_titular= id_titular.substring(0,id_titular.length-2);
                    this.nombre_titular =titular[0].USU_APELLIDOS+ ' ' +titular[0].USU_NOMBRES;
                    this.registro_titular = ' Registro N°: ' + id_titular + '-' + titular[0].NIV_ID;
                    this.calcularEdad(titular[0].USU_FECHANAC,'titular');
                    this.codigo_titular =  id_titular +  titular[0].NIV_ID;
                    console.log(this.nombre_titular);
                    //this.edad_titular = edad;
                    })
                    .catch(function (error) {
                        console.log(error);
                                       });
                    var id_paciente = codigo_usuario. replace(/^0+/, '')
                    var id_paciente = id_paciente.substring(0,id_paciente.length-2);
                    this.nombre_paciente        =nombre.USU_APELLIDOS + ' ' +nombre.USU_NOMBRES;
                    this.registro_paciente      = ' Registro N°: ' + id_paciente + '-' + nombre.NIV_ID;
                    this.registro_paciente_imp  =  id_paciente + '-' + nombre.NIV_ID;
                    this.calcularEdad(nombre.USU_FECHANAC,'paciente');
                    this.codigo_paciente        =  id_paciente +  nombre.NIV_ID;
                
                    
                    return true;
                //this.mostrarTitular=1;
                //this.nombre_paciente =nombre.USU_NOMBRES + ' ' +nombre.USU_APELLIDOS + '    '  + 'Registro N°: ' + nombre.USU_ID. replace(/^0+/, '') + '-' + nombre.NIV_ID;
        
            },
            SacarProximoCodigo(){

                 var url= this.ruta + '/sacarmaxcartagarantiaclinica';
                    axios
                    .get(url)
                    .then(response => (
                        this.codigo_nuevo = 'PD'+response.data.categorias
                                       ))
                    .catch(function (error) {
                        console.log(error);
                                       });
                 
            },
            calcularEdad(fecha,criterio) {
            var hoy = new Date();
            var cumpleanos = new Date(fecha);
            var edad = hoy.getFullYear() - cumpleanos.getFullYear();
            var m = hoy.getMonth() - cumpleanos.getMonth();

            if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
            }
            if( criterio != 'paciente'){
            this.edad_titular = 'Edad : ' + edad + ' años';
            this.edad_titular_imp =  edad + ' años';
            //console.log(criterio);
            }
            else {
            this.edad_paciente = 'Edad : ' + edad + ' años';
            this.edad_paciente_imp =  edad + ' años';
            //console.log(criterio);
            }
            },
             
            abrirModal(modelo, accion, data = []){
                
                switch(modelo){
                    case "categoria":
                    {
                        switch(accion){
                            case 'registrar':
                            {   
                                var today = new Date();
                                var dd = today.getDate();
                                var mm = today.getMonth()+1; 
                                var yyyy = today.getFullYear();
                                //new Date().getFullYear().toString().substr(-2)
                                var yy = today.getFullYear().toString().substr(-2);
                                if(dd<10) 
                                {
                                    dd='0'+dd;
                                } 
                                
                                if(mm<10) 
                                {
                                    mm='0'+mm;
                                } 
                                                                
                                today = yyyy + '-' + mm + '-'+dd;
                                this.fecha_actual = today;
                                this.fecha_actual_imp = dd  + '&nbsp;&nbsp' +'/'+ '&nbsp;&nbsp'+ mm + '&nbsp;&nbsp' +'/'+ '&nbsp;&nbsp'+ yyyy;


                                var today_validez = new Date();                                
                                var dd_validez = today_validez.getDate()+10;
                                var mm_validez = today_validez.getMonth()+1; 
                                var yyyy_validez = today_validez.getFullYear();
                                //new Date().getFullYear().toString().substr(-2)
                                var yy_validez = today_validez.getFullYear().toString().substr(-2);
                                if(dd_validez<10) 
                                {
                                    dd_validez='0'+dd_validez;
                                } 
                                
                                if(mm_validez<10) 
                                {
                                    mm_validez='0'+mm_validez;
                                } 
                                                                
                                today_validez = yyyy_validez + '-' + mm_validez + '-' + dd_validez;

                                this.fecha_actual_imp_validez = dd_validez  + '&nbsp;&nbsp' +'/'+ '&nbsp;&nbsp'+ mm_validez + '&nbsp;&nbsp' +'/'+ '&nbsp;&nbsp'+ yyyy_validez;
                                this.SacarProximoCodigo();
                                this.modal = 1;
                                this.tituloModal = 'Registrar Atencion Directa';                               
                                this.descripcion = '';
                                this.comentario = '';                                
                                this.tipoAccion = 1;
                                this.nombre_titular = '';
                                this.registro_titular = '';
                                this.edad_titular = '';
                                this.query = '';
                                this.queryesp = '';
                                this.especialista = '';
                                this.especialidad = '';
                                this.nombre_paciente = '';
                                this.registro_paciente = '';
                                this.edad_paciente = '';
                                //this.edad_titular = 'Edad :'+' 20 ' + ' años';
                                //this.edad_paciente = 'Edad :'+' 19 ' + ' años';
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar Marca';
                                this.tipoAccion=2;
                                this.categoria_id=data['id'];                               
                                this.descripcion= data['descripcion'];
                                this.comentario= data['comentario'];
                                break;
                            }
                        }
                    }
                }
            
                 this.autoComplete();
                 this.autoCompleteEspecialidad();
            }
        },
        mounted() {
            this.listarCategoria(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: blue !important;
        font-weight: bold;
    }
    .text-edad{
        color: green !important;
        font-weight: bold;
    }
    .text-registro{
        color: red !important;
        font-weight: bold;
    }
</style>
