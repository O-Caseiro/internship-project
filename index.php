<meta charset="utf-8">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script>
	$(function(){	//script para os datepickers
		$( "#datepickerIn" ).datepicker({
			dateFormat: 'dd-mm-yy',
			minDate: new Date(),
			dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
			dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
			nextText: 'Próximo',
			prevText: 'Anterior',    			
			onSelect: function(dateText, inst) {
  				if($('#datepickerOut').val() == '' ) {
    				var current_date = $.datepicker.parseDate('dd/mm/yy', dateText);
    				current_date.setDate(current_date.getDate()+1);
    				$('#datepickerOut').datepicker('setDate', current_date);
  				}
			},
			onClose: function(selectedDate, test) {
    			if(selectedDate != ""){
     				var $date = new Date($( "#datepickerIn" ).datepicker( "getDate" ));
    				$date.setDate($date.getDate()+1);
    				$( "#datepickerOut" ).datepicker( "option", "minDate", $date );
					if($("#datepickerOut").datepicker("getDate") < $date){
						$( "#datepickerOut" ).datepicker('setDate', $date);
					}
    			}
			}
		}).datepicker("setDate", new Date());
		$( "#datepickerOut" ).datepicker({
			dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
			dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
			nextText: 'Próximo',
			prevText: 'Anterior',
    		dateFormat: 'dd-mm-yy',
    		minDate: 1,
		}).datepicker("setDate", 1);
	});
</script>

	<form style="display: inline-flex; flex-flow: row wrap; padding: 10px; align-content: space-between; align-items: center; justify-content: space-between; height: 30px; width: 719px; font-family: Arial; font-size: 16px; color: rgb(0, 0, 0); border: 2px solid rgb(0, 0, 0); border-radius: 10px; font-weight: normal; background: rgb(255, 255, 255) none repeat scroll 0% 0%;" id="myForm" action="destination.html" method="get">
		<div>
			Adultos:
				<select class="input_box" name="adultos">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
				</select>
		</div>
		<div>
			Crianças:
				<select class="input_box" name="criancas">
					<option value="0">-</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
				</select>
		</div>
		
		<div>Check-in: <input class="" name="checkin" readonly="readonly" id="datepickerIn" style="width: 110px;" type="text"></div>

		<div>Check-out: <input class="" name="checkout" readonly="readonly" id="datepickerOut" style="width: 110px;" type="text"></div>
		<div align="center"><input value="OK" type="submit"></div>
	</form>

<script>
	$(function(){
		$("#datepickerIn").removeClass("hasDatepicker");
		$("#datepickerOut").removeClass("hasDatepicker");
	});
</script>