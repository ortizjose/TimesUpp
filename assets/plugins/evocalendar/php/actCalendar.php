<script>

// initialize your calendar, once the page's DOM is ready
$(document).ready(function() {
		
	
	
	
	var eventos = [];

	<?php foreach ($e -> getEventos($IdUsu) as $evento ): 
		if ( empty ($evento['FechaFin'])):
	?>

	 eventos.push({ 
		id: "<?= $evento['IdEve'] ?>",
		name: "<?= $evento['Nombre'] ?>",
		description: "<?= $evento['Descripcion'] ?>",
		badge: "<?= $evento['Etiqueta'] ?>",
		date: "<?= $evento['Fecha'] ?>"  ,
		type: "birthday",

	} );

	<?php else: ?>

	 eventos.push({ 
		id: "<?= $evento['IdEve'] ?>",
		name: "<?= $evento['Nombre'] ?>",
		description: "<?= $evento['Descripcion'] ?>",
		badge: "<?= $evento['Etiqueta'] ?>",
		date: ["<?= $evento['Fecha'] ?>" ,"<?= $evento['FechaFin'] ?> " ] ,
		type: "event",

	} );

	<?php endif;
		 endforeach; ?>

	//debugger;
	//console.log(eventos);
	$('#calendar').evoCalendar({
		theme: 'Midnight Blue',
		language: 'es',
		eventHeaderFormat: 'd MM yyyy',
		todayHighlight: true,
		firstDayOfWeek: 1,
		calendarEvents: eventos
	});
	

	//$('#calendar').evoCalendar('addCalendarEvent',eventos);

	//Boton "Añadir a" habilita la opción de "Evento Grupal" cuando se selecciona una Actividad.
	document.getElementById("eventoActividad").onchange = function(){

		if ( Number( document.getElementById("eventoActividad").value ) )
			document.getElementById('eventoGrupal').disabled = false;
		else 
			document.getElementById('eventoGrupal').disabled = true;

	};


	
})
		
</script>

<?php 



?>