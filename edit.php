<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8" />
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		<script src="js/jscolor.js"></script>

		<style>
			.select-editable { /*Componente gráfica do Combobox editável*/
	    		position:relative;
	    		background-color:white;
	    		border:solid grey 1px;
	    		width:40px;
	    		height:18px;
	 		}

	 		.select-editable select { /*Componente gráfica do Combobox editável*/
	    		position:absolute;
	    		top:0px;
	    		left:0px;
	    		font-size:14px;
	    		border:none;
	    		width:40px;
	    		margin:0;
	 		}

			.select-editable input { /*Componente gráfica do Combobox editável*/
	    		position:absolute;
	    		top:0px;
	    		left:0px;
	    		width:20px;
	    		padding:1px;
	    		font-size:12px;
	    		border:none;
	 		}

			.select-editable select:focus, .select-editable input:focus { /*Componente gráfica do Combobox editável*/
	    		outline:none;
			}

			#tableRestore td { /*Componente gráfica da tabela de restauro seleccionável*/
				border: 1px #DDD solid; padding: 5px; cursor: pointer;
			}

			#tableDelete td { /*Componente gráfica da tabela de restauro seleccionável*/
				border: 1px #DDD solid; padding: 5px; cursor: pointer;
			}

			.selected { /*Componente gráfica da tabela de restauro seleccionável*/
			    background-color: darkorange;
			    color: #FFF;
			}

			.selectedd { /*Componente gráfica da tabela de restauro seleccionável*/
			    background-color: #DD0000;
			    color: #FFF;
			}
		</style>

		<script>
			var myFont; //variável que permite prever do estilo da font
			var myFontSize; //variável que permite prever o tamanho da font
			var IDRestore;
			var IDDelete;
			var nomeActual;
			var descActual;

			$(document).ready(function(){ //carrega o formulário
        		$("#import").load("index.php");
			});

			$(function() { //função que abre o dialog para guardar o form
  				$("#saveDialogButton").on("click", function() {
    				$("#saveDialog").dialog({
    					modal : true,
    					width: 'auto'
    				});
      				$("#saveDialog").dialog("open");
  				});
			});

			$(function() { //função que abre o dialog para criar um novo cliente
  				$("#newClientButton").on("click", function() {
    				$("#newClientDialog").dialog({
    					modal : true,
    					width: 'auto'
    				});
      				$("#newClientDialog").dialog("open");
  				});
			});

			$(function() {
  				$("#theRestore").on("click", function() {

    				$("#RestoreForm").dialog({
    					modal : true,
    					width: 1200
    				});
    				$( "#tableRestore" ).empty();
      				$("#RestoreForm").dialog("open");
      				var hClienteID = document.getElementById('IDClienteRestaurar').value;
	  				$.ajax({
						type: "POST",
						url: "dataTable.php",
						data: {ClientID:hClienteID},
						success: function(data){ 
							$("#tableRestore").append(data);
							$("#tableRestore tr").click(function(){
				   				$(this).addClass('selected').siblings().removeClass('selected');    
				   				IDRestore=$(this).find('td:first').html();
				   				descActual =$(this).find('td:nth-child(2)').html();
							});
						}
					});		
				});
			});

			$(function(){
				$("#deleteButton").on("click", function(){
					$("#deleteMenu").dialog({
						modal: true,
						width: 1200
					});
					$( "#tableDelete" ).empty();
					$("#deleteMenu").dialog("open");
					var hClienteID = document.getElementById('IDClienteApagar').value;
					$.ajax({
						type: "POST",
						url: "dataTable.php",
						data: {ClientID:hClienteID},
						success: function(data){ 
							$("#tableDelete").append(data);
							$("#tableDelete tr").click(function(){
								$(this).addClass('selectedd').siblings().removeClass('selectedd');    
								IDDelete=$(this).find('td:first').html();  
							});
						}
					});
				});
				
			});

			function updateTable(){
				IDRestore=null;
				$( "#tableRestore" ).empty();
				var hClienteID = document.getElementById('IDClienteRestaurar').value;
				$.ajax({
					type: "POST",
					url: "dataTable.php",
					data: {ClientID:hClienteID},
					success: function(data){ 
						$("#tableRestore").append(data);
						$("#tableRestore tr").click(function(){
							$(this).addClass('selected').siblings().removeClass('selected');    
		   					IDRestore=$(this).find('td:first').html();
		   					descActual =$(this).find('td:nth-child(2)').html();   
						});
					}
				});
			}

			function updateTableDelete(){
				IDDelete=null;
				$( "#tableDelete" ).empty();
				var hClienteID = document.getElementById('IDClienteApagar').value;
  				$.ajax({
					type: "POST",
					url: "dataTable.php",
					data: {ClientID:hClienteID},
					success: function(data){ 
						$("#tableDelete").append(data);
						$("#tableDelete tr").click(function(){
		   					$(this).addClass('selectedd').siblings().removeClass('selectedd');    
		   					IDDelete=$(this).find('td:first').html();     
						});
					}
				});
			}

			function deleteClient(){
				var deleteClientID = document.getElementById('IDClienteApagar').value;
				$.ajax({
					type: "POST",
					url: "deleteClient.php",
					data: {varClientID:deleteClientID},
					success: function(data){
						alert("Cliente apagado com sucesso");
						$("#IDCliente").empty();
						$("#IDCliente").append(data);
						$("#IDClienteRestaurar").empty();
						$("#IDClienteRestaurar").append(data);
						$("#IDClienteApagar").empty();
						$("#IDClienteApagar").append(data);
						$( "#tableDelete" ).empty();
						var hClienteID = document.getElementById('IDClienteApagar').value;
		  				$.ajax({
							type: "POST",
							url: "dataTable.php",
							data: {ClientID:hClienteID},
							success: function(data){ 
								$("#tableDelete").append(data);
								$("#tableDelete tr").click(function(){
				   					$(this).addClass('selectedd').siblings().removeClass('selectedd');    
				   					IDDelete=$(this).find('td:first').html();    
								});
							}
						});
					}
				})
			}

			function deleteForm(){
				if (IDDelete==null) {
					alert("Escolha uma linha da tabela");
				}else{
					$.ajax({
						type: "POST",
						url: "deleteForm.php",
						data: {elIDDelete:IDDelete},
						success: function(){
							alert("Form apagado com sucesso");
							$( "#tableDelete" ).empty();
							var hClienteID = document.getElementById('IDClienteApagar').value;
			  				$.ajax({
								type: "POST",
								url: "dataTable.php",
								data: {ClientID:hClienteID},
								success: function(data){ 
									$("#tableDelete").append(data);
									$("#tableDelete tr").click(function(){
					   					$(this).addClass('selectedd').siblings().removeClass('selectedd');    
					   					IDDelete=$(this).find('td:first').html();    
									});
								}
							});
						}
					})
					IDDelete=null;
				}
			}

			$(document).on("click","#saveNewClient",function(){
				if ((nomeCliente.value).trim()=='') {
					alert("Campo vazio. Insira um nome");
				}else{
					$.ajax({
					type: "POST",
					url: "newClient.php",
					data: {name:nomeCliente.value},
					success: function(data){
						$("#IDCliente").empty();
						$("#IDCliente").append(data);
						$("#IDClienteRestaurar").empty();
						$("#IDClienteRestaurar").append(data);
						$("#IDClienteApagar").empty();
						$("#IDClienteApagar").append(data);
					}
				});
				$(this).closest('.ui-dialog-content').dialog('close');
          		$('#saveDialog').dialog('open');
				}
			});

			$(document).on("click","#save",function() {//Acções quando se clica em guardar o form

				var vFlexFlow;
				var vHeight;
				var vWidth;
				var vFontFamily;
				var vFontSize;
				var vColor;
				var vBorder;
				var vBorderRadius;
				var vFontWeight;
				var vBackground;
				var vClienteID = document.getElementById('IDCliente').value;
				var vDescricaoClient = document.getElementById('descricaoClient').value;
				nomeActual = ($('#IDCliente :selected').text());
				descActual = document.getElementById('descricaoClient').value;

				$('#myForm').each(function(index) {
					var stylestemp = $(this).attr('style').split(';');
					var styles = {};
	   				var c = '';
	   				for (var x = 0, l = stylestemp.length; x < l; x++) { //Lê os valores de CSS do form
	     				c = stylestemp[x].split(':');
	     				styles[$.trim(c[0])] = $.trim(c[1]);
	   				}
	   				vFlexFlow = (styles['flex-flow']);
	   				vHeight = (styles.height);
	   				vWidth = (styles.width);
	   				vFontFamily = (styles['font-family']);
	   				vFontSize = (styles['font-size']);
	   				vColor = (styles.color);
	   				vBorder = (styles.border);
	   				vBorderRadius = (styles['border-radius']);
	   				vFontWeight = (styles['font-weight']);
	   				vBackground = (styles.background);
	   				
				});
				$.ajax({ //Guarda os valores de CSS do form na base de dados
					type:"POST",
					url: "style.php",
					data: {flexFlow:vFlexFlow, height:vHeight, width:vWidth, fontFamily:vFontFamily, fontSize:vFontSize, color:vColor, border:vBorder, borderRadius:vBorderRadius, fontWeight:vFontWeight, background:vBackground, IDClient:vClienteID, descricao:vDescricaoClient},
					success: function(data){
						alert("Valores guardados com sucesso"); }
				});

				$(this).closest('.ui-dialog-content').dialog('close');
				actualizar();
			});

			$(document).on("click","#ok",function(){
				if (IDRestore==null) {
					alert("Escolha uma coluna da tabela.")
				} else {
					$.ajax({
					type: "POST",
					url: "restore.php",
					data: {elIDRestore:IDRestore},
					success: function(data){
						var jData = JSON.parse(data);

						document.getElementById('myForm').style.flexFlow = jData["flexFlow"];
						document.getElementById('myForm').style.height = jData["height"];
						document.getElementById('myForm').style.width = jData["width"];
						document.getElementById('myForm').style.fontFamily = jData["fontFamily"];
						document.getElementById('myForm').style.fontSize = jData["fontSize"];
						document.getElementById('myForm').style.color = jData["color"];
						document.getElementById("myForm").style.border = jData["border"];
						document.getElementById("myForm").style.borderRadius = jData["borderRadius"];
						document.getElementById("myForm").style.fontWeight = jData["fontWeight"];
						document.getElementById('myForm').style.background = jData['background'];

						nomeActual = ($('#IDClienteRestaurar :selected').text());
						actualizar();
					}
				});
				}				
			});

			function actualizar() {
			    document.getElementById("actual").innerHTML = "<td colspan='2'>Cliente: "+nomeActual+"</td><td>Descrição: "+descActual+"</td>";
			}

			function updateBackground(data){
				document.getElementById('myForm').style.background = data;
			}

			function updateMainBack(jscolor) { //muda a cor principal de fundo
				var colorTwo = document.getElementById("colorTwo").value;
				if(document.getElementById('colorTwo').style.display == 'none'){
					document.getElementById('myForm').style.background = '#' + jscolor;
				} else {
					document.getElementById('myForm').style.background = 'linear-gradient(#' + jscolor + ',#' + colorTwo + ')'
				}
			}

			function updateSecBack(jscolor) { //muda a cor secundária de fundo
				var colorOne = document.getElementById("colorOne").value;
				document.getElementById('myForm').style.background = 'linear-gradient(#' + colorOne + ',#' + jscolor + ')'
			}

			function changeGrad(checkboxElem) { //altera para gradiente/não gradiente conforme a checkbox
				var colorOne = document.getElementById("colorOne").value;
				var colorTwo = document.getElementById("colorTwo").value;
	    		if (checkboxElem.checked) {
					document.getElementById('myForm').style.background = 'linear-gradient(#' + colorOne + ',#' + colorTwo + ')'
	      		} else {
	      			document.getElementById('myForm').style.background = '#' + colorOne;
	      		}
	    	}

			function updateFontColor(jscolor){ //muda a cor da letra
				document.getElementById('myForm').style.color = '#' + jscolor
			}

			function changeFont(option) { //muda o tipo de letra
	    		document.getElementById("myForm").style.fontFamily = option;
	    		myFont = document.getElementById("myForm").style.fontFamily;
			}

			function bold(checkboxElem) { //altera para negrito/não negrito conforme a checkbox
	    		if (checkboxElem.checked) {
					document.getElementById("myForm").style.fontWeight = "bold";
	      		} else {
					document.getElementById("myForm").style.fontWeight = "normal";
	      		}
	    	}

			function changeFontSize(option) { //muda o tamanho de letra
	    			document.getElementById("myForm").style.fontSize = option + 'px';
	    			myFontSize = document.getElementById("myForm").style.fontSize;
			}

			function changeHeight(option) { //muda a altura do formulário
	    		document.getElementById("myForm").style.height = option + 'px';
			}

			function changeWidth(option) { //muda o comprimento do formulário
	    		document.getElementById("myForm").style.width = option + 'px';
			}

			function changeRadius(option) { //muda o tamanho das curvas na borda
	    		document.getElementById("myForm").style.borderRadius = option + 'px';
			}

			function changeThick(option) { //muda a grossura da borda
	    		document.getElementById("myForm").style.borderWidth = option + 'px';
			}

			function updateBorderColor(jscolor){ //muda a cor das bordas
				document.getElementById('myForm').style.borderColor = '#' + jscolor;
			}

			function changeImage(option) { //insere uma imagem de fundo
	    		var file = document.getElementById("myFile").value;
	    		var fileName = file.match(/[^\/\\]+$/);
	    		document.getElementById("myForm").style.backgroundImage = "url('img/"+fileName+"')";
			}

			function changeToHorizontal(){ //muda a orientação para horizontal
				document.getElementById("myForm").style.flexFlow = "row wrap";
			}

			function changeToVertical(){ //muda a orientação para vertical
				document.getElementById("myForm").style.flexFlow = "column wrap";
			}

			function fontOver(option) { //permite um preview do estilo de font sem ter que o seleccionar
				myFont = document.getElementById("myForm").style.fontFamily;
	    		document.getElementById("myForm").style.fontFamily = option;
			}

			function fontOut() { //permite um preview do estilo de font sem ter que o seleccionar
	   	 		document.getElementById("myForm").style.fontFamily = myFont;
			}

			function sizeOver(option) { //permite um preview da cor do font sem ter que o seleccionar
				myFontSize = document.getElementById("myForm").style.fontSize;
    			document.getElementById("myForm").style.fontSize = option + 'px';
			}

			function sizeOut() { //permite um preview da cor do font sem ter que o seleccionar
	    		document.getElementById("myForm").style.fontSize = myFontSize;
			}
		</script>
	</head>
	<body style="margin:0px; padding:0px; overflow:hidden; font-family: 'Trebuchet MS', Helvetica, sans-serif;">

		<div align="left" style="float: left; position: relative; overflow: hidden; width: 480px; border-right: thick double #000000; border-bottom: thick double #000000;">
			<form>
				<table style="padding: 5px; margin: 10px; background: transparent linear-gradient(#FFBE00,#FF9C01) repeat scroll 0% 0%; border-radius: 10px; width: 95%; ">
					<tr id="actual" style="font-weight:bold">					
							<td colspan="2">Cliente:-</td>
							<td>Descrição:-</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>Forma:</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="radio" name="order" value="horizontal" onchange="changeToHorizontal()"> Horizontal</td>
						<td><input type="radio" name="order" value="vertical" onchange="changeToVertical()"> Vertical</td>
					</tr>
					<tr>
						<td></td>
						<td>Altura:</td>
						<td><input oninput="changeHeight(value);this.form.heightInput.value=this.value" name="heightRange" type="range"  min="30" max="800" />
							<input type="text" id="heightInput" value="" maxlength="4" oninput="changeHeight(value);this.form.heightRange.value=this.value" style="width: 30px;"> px</td>
					</tr>
					<tr></tr>
					<tr>
						<td></td>
						<td>Comprimento:</td>
						<td><input oninput="changeWidth(value);this.form.widthInput.value=this.value" name="widthRange" type="range"  min="120" max="1200" />
							<input type="text" id="widthInput" value="" maxlength="4" oninput="changeWidth(value);this.form.widthRange.value=this.value" style="width: 30px;"> px</td>
					</tr>
					<tr>
						<td></td>
						<td rowspan="3">Cor:</td>
						<td><input id="colorOne" class="jscolor {onFineChange:'updateMainBack(this)'}"></td>
					</tr>
					<tr>
						<td></td>
						<td><input style="display: none;" id="colorTwo" class="jscolor {onFineChange:'updateSecBack(this)'}"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="checkbox" id="checkbox" class="expandContent" onchange="changeGrad(this)">Gradiente</td>
					</tr>
					<tr>
						<td></td>
						<td>Imagem:</td>
						<td><input type="file" id="myFile" accept="image/*" onchange="changeImage(this)"></td>
					</tr>

					<tr>
						<td>&nbsp;</td>
					</tr>

					<tr>
						<td>Letra:</td>
					</tr>
					<tr>
						<td></td>
						<td>Estilo:</td>
						<td>
							<select onclick="changeFont(value)">
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: Arial" value="Arial">Arial</option>
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: 'Arial Black'" value="'Arial Black'">Arial Black</option>
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: 'Comic Sans'" value="'Comic Sans'">Comic Sans</option>
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: 'Courier New'" value="'Courier New'">Courier New</option>
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: Georgia" value="Georgia">Georgia</option>
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: Impact" value="Impact">Impact</option>
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: 'Lucida Console'" value="'Lucida Console'">Lucida Console</option>
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: 'Lucida Sans Unicode'" value="'Lucida Sans Unicode'">Lucida Sans Unicode</option>
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: 'Palatino Linotype'" value="'Palatino Linotype'">Palatino Linotype</option>
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: Tahoma" value="Tahoma">Tahoma</option>
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: 'Times New Roman'" value="'Times New Roman'">Times New Roman</option>
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: 'Trebuchet MS'" value="'Trebuchet MS'">Trebuchet MS</option>
  								<option onmouseover="fontOver(value)" onmouseout="fontOut()" style="font-family: Verdana" value="Verdana">Verdana</option>
							</select>
							<input type="checkbox" onchange="bold(this)"><b>a negrito</b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>Tamanho:</td>
						<td>
							<div class="select-editable">
								<select onclick="changeFontSize(value)" onchange="this.nextElementSibling.value=this.value">
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="8">8</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="9">9</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="10">10</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="11">11</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="12">12</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="14">14</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="16">16</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="18">18</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="20">20</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="22">22</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="24">24</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="26">26</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="28">28</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="36">36</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="48">48</option>
  									<option onmouseover="sizeOver(value)" onmouseout="sizeOut()" value="72">72</option>
								</select>
								<input type="text" name="format" value="" maxlength="2" oninput="changeFontSize(value)"/>
							</div>		
						</td>
					</tr>

					<tr>
						<td></td>
						<td>Cor:</td>
						<td><input class="jscolor {onFineChange:'updateFontColor(this)'}"></td>
					</tr>

					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>

					<tr>
						<td>Borda:</td>
					</tr>
					<tr>
						<td></td>
						<td>Raio:</td>
						<td><input oninput="changeRadius(value);this.form.radiusInput.value=this.value" name="radiusRange" type="range"  min="0" max="50" />
							<input type="text" id="radiusInput" value="" maxlength="2" oninput="changeRadius(value);this.form.radiusRange.value=this.value" style="width: 20px;"> px</td>
					</tr>
					<tr>
						<td></td>
						<td>Grossura:</td>
						<td><input oninput="changeThick(value);this.form.thickInput.value=this.value" name="thickRange" type="range"  min="0" max="10" />
							<input type="text" id="thickInput" value="" maxlength="2" oninput="changeThick(value);this.form.thickRange.value=this.value" style="width: 20px;"> px</td></td>
					</tr>
					<tr>
						<td></td>
						<td>Cor:</td>
						<td><input class="jscolor {onFineChange:'updateBorderColor(this)'}"></td>
					</tr>

					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>

					<tr>
						<td>
							<input type="button" value="Guardar" id="saveDialogButton">
						</td>
						<td><input type="button" id="theRestore" value="Restaurar"></td>
						<td>
							<input type="button" id="sourceCodeButton" value="Código do Form" onclick="var sourceCode = document.getElementById('import').innerHTML; alert(sourceCode);"><a href="#" id="deleteButton" style="color:red; padding-left:4em; font-size: 80%; font-weight: bold">Apagar Dados</a></td>
						</td>
					</tr>

				</table>
			</form>
		</div>

		<div id="saveDialog" title="Guardar" style="display: none;">
			<table>
			    <tr>
			        <td>Cliente:</td>
			        <td><select id="IDCliente">
			        	<?php
							//Connecting to sql db.
							$connect = mysqli_connect("localhost","root","") or die ("Não foi possivel ligar ao servidor");

							mysqli_select_db($connect,"style") or die ("Não foi possivel ligar ao servidor");

						    $query = "SELECT * FROM client ORDER BY nome ASC";
						    $result=mysqli_query($connect,$query);
						    while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){                                                 
						       echo "<option value='".$row['ID']."'>".$row['nome']."</option>";
						    };
						?>
			        </select> <a href="#" id="newClientButton" style="color:blue">Novo Cliente</a></td>
			    </tr>
			    <tr>
			        <td>Descrição:</td>
			        <td><textarea id="descricaoClient" rows="4"></textarea></td>
			    </tr>
			</table>
			<input type="button" value="Guardar" id="save" style="margin:0 auto; display:block;">
		</div>

		<div id="newClientDialog" title="Novo Cliente" style="display: none;">
			<form>
				Nome: <input type="text" id="nomeCliente" ><br/>

				<input type="button" value="Confirmar" id="saveNewClient" style="margin: 0 auto; display: block">
			</form>
		</div>

		<div id="RestoreForm" title="Restaurar" style="display: none;">
			<table>
			    <tr>
			        <td>Cliente:</td>
			        <td><select id="IDClienteRestaurar" onchange="updateTable()">
			        	<?php
							//Connecting to sql db.
							$connect = mysqli_connect("localhost","root","") or die ("Não foi possivel ligar ao servidor");

							mysqli_select_db($connect,'style') or die ("Não foi possivel ligar ao servidor");

						    $query = "SELECT * FROM client ORDER BY nome ASC";
						    $result=mysqli_query($connect,$query);
						    while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){                                                 
						       echo "<option value='".$row['ID']."'>".$row['nome']."</option>";
						    };
						?>
			        </select>
			    </tr>
			    <tr>
			        <table id='tableRestore'></table>
			    </tr>
			</table>
			<input type="button" value="Restaurar" id="ok" style="margin:0 auto; display:block;">
		</div>

		<div id="deleteMenu" title="Apagar Dados" style="display:none">
			<table>
				<tr>
					<td>Cliente:</td>
			        <td><select id="IDClienteApagar" onchange="updateTableDelete()">
			        	<?php
							//Connecting to sql db.
							$connect = mysqli_connect("localhost","root","") or die ("Não foi possivel ligar ao servidor");

							mysqli_select_db($connect,'style') or die ("Não foi possivel ligar ao servidor");

						    $query = "SELECT * FROM client ORDER BY nome ASC";
						    $result=mysqli_query($connect,$query);
						    while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){                                                 
						       echo "<option value='".$row['ID']."'>".$row['nome']."</option>";
						    };
						?>
			        </select> <input type="button" value="Apagar Cliente" id="deleteClientButton" onclick="if(confirm('O Cliente seleccionado será apagado e não recuperável!\nTodos os Forms associados ao Cliente serão também apagados!\n\nTem a certeza que quer continuar?'))deleteClient();else close();" style="background-color:#EE0000; color:#FFFFFF; border-radius:10px;"></td>
				</tr>
				<tr>
					<table id='tableDelete'></table>
				</tr>
			</table>
			<input type="button" value="Apagar Form" id="deleteFormButton" onclick="if(confirm('O Form seleccionado será apagado e não recuperável!\n\nTem a certeza que quer continuar?'))deleteForm();else close();" style="background-color:#EE0000; color:#FFFFFF; border-radius:10px; margin:0 auto; display:block">
		</div>

		<div id="import" style="pointer-events:none; float:right; margin: 10px;">
			<iframe frameborder="1" align="right" style="position: absolute;"></iframe>
		</div>
	</body>

	<script>
		$('.expandContent').click(function() {
    		if( $(this).is(':checked')) {
        		$("#colorTwo").show();
    		} else {
        		$("#colorTwo").hide();
    		}
    	});
	</script>
</html>