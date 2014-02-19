<?php $contador=count($model); if ($model !== null):?>
<html>
<head>
<style>
 body {font-family: sans-serif;
     font-size: 10pt;
 }
 p {    margin: 0pt;
 }
 td { vertical-align: top; }
 .items td {
     border-left: 0.1mm solid #000000;
     border-right: 0.1mm solid #000000;
 }
 table thead td { background-color: #EEEEEE;
     text-align: center;
     border: 0.1mm solid #000000;
 }
 .items td.blanktotal {
     background-color: #FFFFFF;
     border: 0mm none #000000;
     border-top: 0.1mm solid #000000;
 }
 .items td.totals {
     text-align: right;
     border: 0.1mm solid #000000;
 }
</style>
</head>
<body>

 <!--mpdf
 <htmlpageheader name="myheader">
 <table width="100%"><tr>
 <td width="50%" style="color:#0000BB;"><span style="font-weight: bold; font-size: 14pt;">Juzgado de Paz de Hohenau</span><br />República del Paraguay<br /><span style="font-size: 15pt;">&#9742;</span> 0775-232355</td>
 <td width="50%" style="text-align: right;"><b>Listado de Proveedores</b></td>
 </tr></table>
 </htmlpageheader>

 <htmlpagefooter name="myfooter">
 <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
 Página {PAGENO} de {nb}
 </div>
 </htmlpagefooter>

 <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
 <sethtmlpagefooter name="myfooter" value="on" />
 mpdf-->


<div style="text-align: right"><b>Fecha: </b><?php  echo date("d/m/Y"); ?>  </div>
<b>Total Resultados:</b> <?php echo $contador; ?>
 <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="5">
 <thead>
 <tr>
  <td width="10%">Id</td>
   <td width="10%">País</td>
   <td width="10%">Departamento</td>
   <td width="10%">Ciudad</td>
   <td width="10%">Nombre</td>
   <td width="10%">Dirección</td>
   <td width="10%">Teléfono</td>
   <td width="10%">Celular</td>
   <td width="10%">Ruc</td>
   <td width="10%">Email</td>
  </tr>
 </thead>
 <tbody>
 <!-- ITEMS -->
	<?php foreach($model as $row): ?>
	<tr>
         <td align="center">
 <?php 
 //Para imprimir el número de veces que un proveedor se repite en la tabla ofertas usar echo $row->nprov
 //Para eso deben de agregar el atributo $nprov al modelo
 echo $row->id_proveedor; ?>
 </td>
         <td align="center">
 <?php echo $row->paises->desc_pais; ?>
 </td>
         <td align="center">
 <?php echo $row->departamentos->desc_departamento; ?>
 </td>
        <td align="center">
 <?php echo $row->ciudades->desc_ciudad; ?>
 </td>
        <td align="center">
 <?php echo $row->nombre_proveedor; ?>
 </td>
        <td align="center">
 <?php echo $row->direccion_proveedor; ?>
 </td>
        <td align="center">
 <?php echo $row->telefono_proveedor; ?>
 </td>
        <td align="center">
 <?php echo $row->cell_proveedor; ?>
 </td>
        <td align="center">
 <?php echo $row->ruc_proveedor; ?>
 </td>
        <td align="center">
 <?php echo $row->email_proveedor; ?>
 </td>
       	
  </tr>
     <?php endforeach; ?>
 <!-- FIN ITEMS -->	 
 <tr>
 <td class="blanktotal" colspan="10" rowspan="10"></td>
 </tr>
 </tbody>
 </table>
 </body>
 </html>
<?php endif; ?>
