<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::get('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware'=>['auth']],function(){
    
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/dashboard', 'DashboardController');
    //Notificaciones 
    Route::post('/notification/get', 'NotificationController@get'); 
    
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Almacenero']], function () {
        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
        Route::get('/categoria/listarPdf','CategoriaController@listarPdf')->name('categorias_pdf');

        Route::get('/articulo', 'ArticuloController@index');
        Route::post('/articulo/registrar', 'ArticuloController@store');
        Route::put('/articulo/actualizar', 'ArticuloController@update');
        Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
        Route::put('/articulo/activar', 'ArticuloController@activar');
        Route::get('/articulo/buscarArticulo', 'ArticuloController@buscarArticulo');
        Route::get('/articulo/listarArticulo', 'ArticuloController@listarArticulo');
        Route::get('/articulo/listarPdf','ArticuloController@listarPdf')->name('articulos_pdf');
        

        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');
        Route::get('/proveedor/listarPdf','ProveedorController@listarPdf')->name('proveedores_pdf');

        Route::get('/ingreso', 'IngresoController@index');
        Route::post('/ingreso/registrar', 'IngresoController@store');
        Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        Route::get('/ingreso/obtenerCabecera', 'IngresoController@obtenerCabecera');
        Route::get('/ingreso/obtenerDetalles', 'IngresoController@obtenerDetalles');
        Route::get('/ingreso/pdf/{id}','IngresoController@pdf')->name('ingreso_pdf');
        Route::get('/ingreso/listarPdf','IngresoController@listarPdf')->name('ingresos_pdf');
    });

    Route::group(['middleware' => ['Vendedor']], function () {
        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');
        Route::get('/cliente/listarPdf','ClienteController@listarPdf')->name('clientes_pdf');
 
        Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
        Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta');

        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'VentaController@store');
        Route::put('/venta/desactivar', 'VentaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');
        Route::get('/venta/pdf/{id}','VentaController@pdf')->name('venta_pdf');
        Route::get('/venta/pdfTicket/{id}','VentaController@pdfTicket')->name('ventaticket_pdf');
        Route::get('/venta/listarPdf','VentaController@listarPdf')->name('ventas_pdf');
    });

    Route::group(['middleware' => ['Administrador']], function () {

        Route::get('/persona/BuscarDNI/{dni}', 'PacienteController@BuscarDNI');        
        Route::get('/categoria', 'CategoriaController@index');
        Route::get('/asis', 'PacienteController@prueba');
        Route::put('paciente/edit', 'PacienteController@editar');
        Route::get('/paciente', 'PacienteController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
        Route::get('/categoria/listarPdf','CategoriaController@listarPdf')->name('categorias_pdf');
        Route::get('/varios/vacingles','VariosController@vacinglespdf');



        Route::get('/atenciondirecta', 'AtencionDirectaController@index');
        Route::get('/paciente/buscar', 'AtencionDirectaController@autocompletar');
        Route::get('/sacarmax', 'AtencionDirectaController@sacarMaximo');
        Route::get('/sacarmaxcartagarantiaclinica', 'CartaGarantiaClinicaController@sacarMaximo');
        Route::get('/sacarmaxcartagarantia', 'CartaGarantiaController@sacarMaximo');
        Route::get('/buscartitular', 'AtencionDirectaController@BuscarTitular');
        Route::post('/atenciondirecta/registrar', 'AtencionDirectaController@store');

        Route::get('/cartagarantia', 'CartaGarantiaController@index');
        Route::post('/cartagarantia/registrar', 'CartaGarantiaController@store');
        Route::get('/descargarPDF', 'CartaGarantiaController@DescargarPDF');
        Route::get('/descargarPDF_ad', 'AtencionDirectaController@DescargarPDF');


        Route::get('/cartagarantiaclinica', 'CartaGarantiaClinicaController@index');
        Route::post('/cartagarantiaclinica/registrar', 'CartaGarantiaClinicaController@store');
        Route::get('/especialidadclinica/buscar', 'CartaGarantiaClinicaController@autocompletarEspecialidad');  
        Route::get('/especialidad/buscar', 'CartaGarantiaController@autocompletarEspecialidad');        


        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
        Route::get('/categoria/listarPdf','CategoriaController@listarPdf')->name('categorias_pdf');



        Route::get('/articulo', 'ArticuloController@index');
        Route::post('/articulo/registrar', 'ArticuloController@store');
        Route::put('/articulo/actualizar', 'ArticuloController@update');
        Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
        Route::put('/articulo/activar', 'ArticuloController@activar');
        Route::get('/articulo/buscarArticulo', 'ArticuloController@buscarArticulo');
        Route::get('/articulo/listarArticulo', 'ArticuloController@listarArticulo');
        Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
        Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta');
        Route::get('/articulo/listarPdf','ArticuloController@listarPdf')->name('articulos_pdf');

        Route::get('/ubicacion', 'UbicacionController@index');
        Route::post('/ubicacion/registrar', 'UbicacionController@store');
        Route::get('/ubicacion/selectUbicacion', 'UbicacionController@selectUbicacion');
        /*
        Route::put('/ubicacion/actualizar', 'Ubicacion@update');
        Route::put('/ubicacion/desactivar', 'Ubicacion@desactivar');
        Route::put('/ubicacion/activar', 'Ubicacion@activar');
        Route::get('/ubicacion/buscarArticulo', 'Ubicacion@buscarArticulo');
        Route::get('/ubicacion/listarArticulo', 'Ubicacion@listarArticulo');
        Route::get('/ubicacion/buscarArticuloVenta', 'Ubicacion@buscarArticuloVenta');
        Route::get('/ubicacion/listarArticuloVenta', 'UbicacionlistarArticuloVenta');
        Route::get('/ubicacion/listarPdf','Ubicacion@listarPdf')->name('ubicacion_pdf');
        */

        Route::get('/marca', 'MarcaController@index');
        Route::post('/marca/registrar', 'MarcaController@store');
        Route::get('/ubicacion/selectUbicacion', 'UbicacionController@selectUbicacion');
        Route::put('/marca/actualizar', 'MarcaController@update');
        Route::put('/marca/desactivar', 'MarcaController@desactivar');
        Route::put('/marca/activar', 'MarcaController@activar');
        Route::get('/marca/selectMarca', 'MarcaController@selectMarca');



        Route::get('/modelo', 'ModeloController@index');
        Route::post('/marca/registrar', 'MarcaController@store');
        Route::get('/ubicacion/selectUbicacion', 'UbicacionController@selectUbicacion');
        Route::put('/marca/actualizar', 'MarcaController@update');
        Route::put('/marca/desactivar', 'MarcaController@desactivar');
        Route::put('/marca/activar', 'MarcaController@activar');
        /*
       
       
        Route::get('/ubicacion/buscarArticulo', 'Ubicacion@buscarArticulo');
        Route::get('/ubicacion/listarArticulo', 'Ubicacion@listarArticulo');
        Route::get('/ubicacion/buscarArticuloVenta', 'Ubicacion@buscarArticuloVenta');
        Route::get('/ubicacion/listarArticuloVenta', 'UbicacionlistarArticuloVenta');
        Route::get('/ubicacion/listarPdf','Ubicacion@listarPdf')->name('ubicacion_pdf');
        */

        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');
        Route::get('/proveedor/listarPdf','ProveedorController@listarPdf')->name('proveedores_pdf');

        Route::get('/ingreso', 'IngresoController@index');
        Route::post('/ingreso/registrar', 'IngresoController@store');
        Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        Route::get('/ingreso/obtenerCabecera', 'IngresoController@obtenerCabecera');
        Route::get('/ingreso/obtenerDetalles', 'IngresoController@obtenerDetalles');
        Route::get('/ingreso/pdf/{id}','IngresoController@pdf')->name('ingreso_pdf');
        Route::get('/ingreso/listarPdf','IngresoController@listarPdf')->name('ingresos_pdf');
        
        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');
        Route::get('/cliente/listarPdf','ClienteController@listarPdf')->name('clientes_pdf');

        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'VentaController@store');
        Route::put('/venta/desactivar', 'VentaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');
        Route::get('/venta/pdf/{id}','VentaController@pdf')->name('venta_pdf');
        Route::get('/venta/pdfTicket/{id}','VentaController@pdfTicket')->name('ventaticket_pdf');
        Route::get('/venta/listarPdf','VentaController@listarPdf')->name('ventas_pdf');

        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');
        
        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');
        Route::get('/user/listarPdf','UserController@listarPdf')->name('usuarios_pdf');
    });

});

//Route::get('/home', 'HomeController@index')->name('home');
