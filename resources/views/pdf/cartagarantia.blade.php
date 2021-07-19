<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Artículos</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.87rem;
            font-weight: normal;
            line-height: 1.3;
            color: #151b1e;
            border: 0px solid #214696;
            border-color:#214696;
            
        }
        .cuerpo_carta_paciente{
            width: 695px;
            height: 130px;
            border: 1.8px solid #214696;
            border-color:#214696;
            margin-top: 3px;
            padding-top:5px;
            padding-left:15px;
            font-size:11;
        }
        .cuerpo_carta_paciente_nombres{
            width: 340px;
            height: 15px;
            display: inline-block;
        }
        .cuerpo_carta_paciente_edad{
            width: 120px;
            height: 15px;                      
            display: inline-block;
        }
        .cuerpo_carta_paciente_nro_registro{
            width: 210px;
            height: 15px;                  
            display: inline-block;
        }
        .cuerpo_carta_paciente_especialidad{
            width: 650px;
            height: 15px;           
            display: inline-block;          
            
        }
        .cuerpo_carta_paciente_firma{
            width: 650px;
            height: 15px;
            margin-top: 5px;           
            display: inline-block;          
            
        }
        .cuerpo_carta_paciente_fecha_emision{
            width: 340px;
            height: 15px;
                    
            display: inline-block;
        }
        .cuerpo_carta_paciente_validez{
            width: 400px;
            height: 15px;           
            display: inline-block;          
            
        }
        .cuerpo_carta_hc{
            width: 680px;
            height: 400px;
            border: 1.8px solid #214696;
            border-color:#214696;
            margin-top: 6px;
            padding-top:15px;
            padding-left:15px;
            padding-right:15px;
            font-size:12;
        }
        .cuerpo_carta_ffu{
            width: 688px;
            height: 100px;
            border: 1.8px solid #214696;
            border-color:#214696;
            margin-top: 6px;
            padding-top:10px;
            padding-left:12.5px;
            padding-right:10px;
            font-size:10;
        }
        .cuerpo_carta_ufam{
            width: 688px;
            height: 100px;
            border: 1.8px solid #214696;
            border-color:#214696;
            margin-top: 6px;
            padding-top:2px;
            padding-left:12.5px;
            padding-right:10px;
            font-size:9;
        }
        .cuerpo_carta_ufam_center{
            text-align:center;
        }
        .cuerpo_carta_lcl{
            width: 688px;
            height: 52px;
            border: 1.8px solid #214696;
            border-color:#214696;
            margin-top: 6px;
            font-size:9;
            padding-left:12.5px;
            padding-right:10;
            padding-top:3px;
        }
        .cuerpo_carta_hc_nombre{
            width: 220px;
            height: 25px;
            font-size:12;
            display: inline-block;   
        }
        .cuerpo_carta_inline{
            margin-top:10px;
            width: 455px;
            height: 25px;            
            display: inline-block;   
        }
        .cuerpo_carta_hc_diagnosticos{
            width: 110px;
            height: 25px;
            
            font-size:12;
            display: inline-block;
            text-align:left;             
        }
        .cuerpo_carta_diagnosticos_inline{
            margin-top:10px;
            width: 565px;
            height: 25px;            
            display: inline-block;
            
        }
        .cuerpo_carta_subrayado{
            height: 8px;
         
                        
             
        }
        .cuerpo_carta_firma{
            width: 695px;
            height: 100px;
            border: 1.8px solid #214696;
            border-color:#214696;
            margin-top: 6px;
            padding-top:5px;
            padding-left:5px;
            font-size:12;
        }
        .sello_firma{
            float:right;
            width: 320px;
            height: 25px;
            padding-left:5px;
            font-size:10;
            display: inline-block;
            border-top: 1px solid;
            
            text-align: center;
        }
        
        .table {
            display: table;
            width: 680px;
            max-width: 100%;
            max-height: 10px;
            border: 1.5px solid #214696;
            margin-top: 1rem;
            background-color: transparent;
            border-collapse: collapse;
            border-color:#214696;
            font-size: 1.08rem;
        }
        .table-bordered {
            border: 1.5px solid #214696;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            background-color: #214696; 
            border-color: inherit;
            color: #ffffff;
        }
        tr {
            border: 1.5px solid #214696;
            display: table-row;
            vertical-align: inherit;
           
        }
        .table th, .table td {
            padding: 0.53rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
            border: 1.5px solid #214696;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .izquierda{
            float:left;
        }
       
        .titulo{
            padding-top: 15px;
             text-align: center; 
             color: #214696; 
             font-weight: bold;
             
        }
        .datos{
            width:220px;
            margin-top:-15px;
            margin-bottom:10px;
            
        }
        .encabezado_datos{
            
            
        }
        .numero_carta{
            width:150px;
            color: #214696;        
             font-size : 15;
             font-weight: bold; 
                             
        }
        .cabecera{
            position:fixed;
            top:-20px;
            text-align: right; 
        }
        .cie10{
            position:fixed;
            top: 560px;
            text-align: right; 
        }
        .cuerpo{
            padding-top: -35px;
            text-align: left; 
            font-size: 1.15rem;
            
           
             
        }
        .cuerpo2{
            
             text-align: left; 
             font-size: 1.15rem;
            
            
                         
        }
        .cuerpo3{
            padding-top: 15px;
             
            font-size: 1.15rem;
             text-align: justify ;
             line-height: 1.8;
            
                         
        }
        .cuerpo4{
            padding-top: 15px;
            font-size: 1.15rem;
             
             text-align: justify ;
             line-height: 1;
            
                         
        }
        .cuadrado{
        float:right;
        width: 12px; 
        height: 12px; 
        border: 2px solid #214696;
        
        }
        
        h3{
            font-size: 14;
        }
        hr{
            height: 1px;
    border: 0;
    background-color: black;
        }
        .version{
            padding-top: 4px;
             text-align: left; 
             font-size: 0.8rem;
             
            
                         
        }
    </style>
</head>
<body>
<div class="cabecera">
    <span ><IMG SRC="img/logo_pdf.png" style="width:33mm"></span>
    </div>
    <div class="titulo">
    <h3 >CARTA DE GARANTIA </h3>
    </div>
    <div class="datos">
    <div class="numero_carta">
    N° {{ $codigo }}
    </div>
   
    ATENCIÓN AMBULATORIA 
    
    <div class="cuadrado"></div>
   
    INTERNAMIENTO
    <div class="cuadrado"></div> 
    </div>
    <div class="cuerpo_carta_paciente">
    <div class="cuerpo_carta_paciente_nombres">
    Titular: {{ $nombre_titular }}
    </div>
    <div class="cuerpo_carta_paciente_edad">
    Edad: {{ $edad_titular }}
    </div>
    <div class="cuerpo_carta_paciente_nro_registro">
    Registro N°:  {{ $codigo_titular }}
    </div>
    <br>
    <div class="cuerpo_carta_paciente_nombres">
    Usuario: {{ $nombre_paciente }}
    </div>
    <div class="cuerpo_carta_paciente_edad">
    Edad: {{ $edad_paciente }}
    </div>
    <div class="cuerpo_carta_paciente_nro_registro">
    Registro N°: {{ $codigo_paciente }}
    </div>
    <br>
    <div class="cuerpo_carta_paciente_especialidad">
    Especialidad/Clínica: {{ $especialidad }}
    </div>
    <br>
    <div class="cuerpo_carta_paciente_fecha_emision">
    Fecha de Emisión: {{ $fecha_atencion }}
    </div>
    <div class="cuerpo_carta_paciente_validez">
    Validéz:  {{ $fecha_validez }} (para atención ambulatoria). 
    </div>
    <br>
    <div class="cuerpo_carta_paciente_firma">
    Firma del Usuario: _____________________
    </div>
    <br>    
    </div>
    <div class="cuerpo_carta_hc">
    <div class="cuerpo_carta_hc_nombre">
    
    Resumen de Historia Clínica :
    
    </div>
    <div class="cuerpo_carta_inline">
    <hr>
    </div>    
    <div class="cuerpo_carta_subrayado">
    <hr>
    </div>
    <div class="cuerpo_carta_subrayado">
    <hr>
    </div>
    <div class="cuerpo_carta_subrayado">
    <hr>
    </div>
    <div class="cuerpo_carta_subrayado">
    <hr>
    </div>
    <div class="cuerpo_carta_subrayado">
    <hr>
    </div>
    <div class="cuerpo_carta_subrayado">
    <hr>
    </div>
    <div class="cuerpo_carta_subrayado">
    <hr>
    </div>
    <div class="cuerpo_carta_hc_diagnosticos">    
    Diagnóstico(s):     
    </div>
    <div class="cuerpo_carta_diagnosticos_inline">
    <hr>
    </div>
    <div class="cuerpo_carta_subrayado">
    <hr>
    </div>
    <div class="cuerpo_carta_subrayado">
    <hr>
    </div>
    <div class="cuerpo_carta_subrayado">
    <hr>
    </div>
    <div class="cuerpo_carta_hc_diagnosticos">    
    Observaciones:  
    </div>
    <div class="cuerpo_carta_diagnosticos_inline">
    <hr>
    </div>
    <div class="cuerpo_carta_subrayado">
    <hr>
    </div>
    <div class="cuerpo_carta_subrayado">
    <hr>
    
    </div>
    <div class="cie10">
    <span ><IMG SRC="img/cie10.png" ></span>
    </div>
    </div>
    <div class="cuerpo_carta_ffu">
    FECHA DE CONSULTA - FIRMA USUARIO<br><br>
    ______/______/______ &nbsp;&nbsp;________________
    <br><br>
    <div class="sello_firma">
    SELLO Y FIRMA MÉDICO TRATANTE
    </div>
    </div>
    <div class="cuerpo_carta_ufam">
    <div class="cuerpo_carta_ufam_center">
   USUARIOS FREEPORT MCMORAN
   </div>
    
FACTURAR A NOMBRE DE SERVICIOS MÉDICOS INTEGRADOS S.A.C.
<br>
-Consignar CIE - 10
<br>
-Devolver la carta de garantía con el comprobante de pago emitido máximo 7 días después de la atención realizada.
<br>
-La fecha de pago se inicia desde la recepción del comprobante de pago.
<br>
-La documentación médica correspondiente debe ir junta a la carta de garantía y comprobante de pago.
    </div>
    <div class="cuerpo_carta_lcl">
    FAVOR CONSIGNAR LA INFORMACIÓN CON LETRA CLARA Y LEGIBLE
    <br>
    ACOMPAÑAR COPIAS DE RECETAS Y ÓRDENES DE EXÁMES AUXILIARES.
    <br>
    Servicios Médicos Integrados S.A.C - Versión 1.0 - RUC: 20225684694 - Dirección: Av. Parra 324-326 Arequipa - Peru.
    </div>
  
</body>
</html>