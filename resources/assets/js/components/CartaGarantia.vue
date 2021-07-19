<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Corregir Nombre de Paciente
                       
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
                                      <option value="nombres">Nombre</option>
                                      <option value="apellido_paterno">Apellido Paterno</option>
                                      <option value="apellido_materno">Apellido Materno</option>
                                      <option value="dni">DNI/PASAPORTE</option>
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
                                    <th width="20">DNI</th>
                                    <th width="20">Nombres</th>
                                    <th width="400">Apellido Paterno</th>
                                    <th width="400">Apellido Materno</th>
                                    <th width="400">Dirección</th>
                                    <th width="400">Telefono</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                                    <td>
                                         
                                        <button type="button" @click="abrirModal('categoria','actualizar',categoria)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
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
                                    <td v-text="categoria.dni"></td>
                                    <td v-text="categoria.nombre"></td>
                                    <td v-text="categoria.a_paterno"></td>
                                    <td v-text="categoria.a_materno"></td>
                                    <td v-text="categoria.direccion"></td>
                                    <td v-text="categoria.telefono"></td>
                                   
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
                                    <label class="col-md-3 form-control-label" for="email-input">DNI</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="dni"  placeholder="Buscar RENIEC">
                                        <button type="button" @click="BuscarDNI()" class="btn btn-primary"><i class="fa fa-search"></i> Buscar RENIEC</button>
                                   

                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">NOMBRE</label>
                                <div class="col-md-9">
                                  <div>
                                     <div class="text-error">
                                    <input type="text" v-model="nombre" class="form-control"  style="text-transform: uppercase" placeholder="Ingrese descripción">
                                  </div>
                                </div>                                        
                                    </div>
                                    <!--<div class="col-md-9">
                                        <input type="email" v-model="descripcion" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                    -->
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">APELLIDO PATERNO</label>
                                <div class="col-md-9">
                                  <div>
                                     <div class="text-error">
                                    <input type="text" v-model="ap_paterno" class="form-control" style="text-transform: uppercase"  placeholder="Ingrese descripción">
                                  </div>
                                </div>                                        
                                    </div>
                                    <!--<div class="col-md-9">
                                        <input type="email" v-model="descripcion" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                    -->
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">APELLIDO MATERNO</label>
                                <div class="col-md-9">
                                  <div>
                                     <div class="text-error">
                                    <input type="text" v-model="ap_materno" class="form-control"  style="text-transform: uppercase" placeholder="Ingrese descripción">
                                  </div>
                                </div>                                        
                                    </div>
                                    <!--<div class="col-md-9">
                                        <input type="email" v-model="descripcion" class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                    -->
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
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="EditarPaciente()">Actualizar</button>
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
                dni:'',
                ap_paterno : '',
                ap_materno:'',
                nombre : '',
                id : '',
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
                criterio : 'nombres',
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
                var url=this.ruta + '/paciente?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCategoria = respuesta.categorias.data;
                    me.pagination= respuesta.pagination;
                     console.log(me.arrayCategoria);
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            cargarPdf(){
                window.open(this.ruta + '/categoria/listarPdf','_blank');
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
                .post(this.ruta + '/cartagarantia/registrar',{
                    'codigo_paciente': this.codigo_paciente,
                    'fecha_at' : this.fecha_actual,
                    'codigo_especialista' : this.codigo_especialista,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCategoria(1,'','descripcion');

                }).catch(function (error) {
                    console.log(error);
                });
                /*
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
                    */

            },

            EditarPaciente(){


                swal({
                title: 'Esta seguro de editar este paciente?',
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

 //console.log(this.ap_paterno+this.ap_materno+this.nombre);
                    axios.put(this.ruta + '/paciente/edit',{
                        'id': this.id,
                        'nombre': this.nombre,
                        'dni': this.dni,
                        'ap_paterno' : this.ap_paterno,
                        'ap_materno' : this.ap_materno

                    }).then(function (response) {
                       //console.log(me.buscar+me.criterio);
                       me.cerrarModal();
                       
                        swal(
                        'Completado!',
                        'Los datos del paciente han sido modificados con éxito.',
                        'success'
                        )
                         me.listarCategoria(me.page,me.buscar,me.criterio)
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


    BuscarDNI(){
                let me=this;
                var dni = this.dni;
                
                var url= this.ruta + '/persona/BuscarDNI/'+dni;
                axios.get(url).then(response => {
                var respuesta= response.data;                    
                    me.arrayReniec =respuesta.reniec;
                    swal({
                title: 'Los datos encontrados son:',
                html: 'Nombre :'+ this.arrayReniec[1]+'<br />Ap.Paterno :'+this.arrayReniec[2]+'<br />Ap.Materno :'+this.arrayReniec[3],
               
                
                
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ingresar Datos',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {

                    
                    this.nombre = this.arrayReniec[1];
                    this.ap_paterno = this.arrayReniec[2];
                    this.ap_materno = this.arrayReniec[3];


                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 




                    
                })






                .catch(function (error) {
                    console.log(error);
                });
                
                
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
                        'id': idpaciente
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
                .get(this.ruta +'/especialidad/buscar')
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

                 var url= this.ruta + '/sacarmaxcartagarantia';
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
            DescargarPDF(){
        

            window.open('DescargarPDF/');
            
            },
             
            abrirModal(modelo, accion, data = []){
                
                switch(modelo){
                    case "categoria":
                    {
                        switch(accion){
                            
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Editar Paciente';
                                this.tipoAccion=2;
                                this.id=data['idpaciente'];
                                this.nombre=data['nombre'];                               
                                this.ap_paterno= data['a_paterno'];
                                this.ap_materno= data['a_materno'];
                                this.direccion=data['direccion'];                               
                                this.telefono= data['telefono'];
                                this.dni= data['dni'];
                               
                                break;
                            }
                        }
                    }
                }
            
                 
            }
        },
        
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
