
export default class KanbanAPI {
	
	static getItems(columnId) {	

		//debugger;
		
		const column = read().find(column => column.id == columnId);

		if (!column) {
			return [];
		}

		return column.items;
		
	}
	



	static insertItem(columnId, content) {
		const data = read();
		const column = data.find(column => column.id == columnId);	
	
		const idTarea = Number(saveNew(data, column.id));

		const item = {
			id: idTarea,
			content,
			priority: 0
		};

		if (!column) {
			throw new Error("Column does not exist.");
		}

		column.items.push(item);

		return item;
	}

	static updateItem(itemId, newProps, newPriority) {	
		const data = read();

		const [item, currentColumn] = (() => {
			for (const column of data) {
				const item = column.items.find(item => item.id == itemId);

				if (item) {
					return [item, column];
				}
			}
		})();


		if (!item) {
			throw new Error("Item not found.");
		}

		item.content = newProps.content === undefined ? item.content : newProps.content;
		
		if (!Array.isArray(newPriority) ){
			item.priority = newPriority.priority;
			
			// Update Content and Priority on BBDD		
			update(itemId, newProps.content, newPriority.priority);
		}

		// Update column and position
		if (
			newProps.columnId !== undefined
			&& newProps.position !== undefined
		) {
			const targetColumn = data.find(column => column.id == newProps.columnId);

			if (!targetColumn) {
				throw new Error("Target column not found.");
			}

			// Delete the item from it's current column
			currentColumn.items.splice(currentColumn.items.indexOf(item), 1);

			// Move item into it's new column and position
			targetColumn.items.splice(newProps.position, 0, item);
			
			// Update Position and Column on BBDD
			update(itemId, newProps.columnId, newPriority);
		}

	}

	static deleteItem(itemId) {
		const data = read();

		for (const column of data) {
			const item = column.items.find(item => item.id == itemId);

			if (item) {
				column.items.splice(column.items.indexOf(item), 1);
			}
		}

		ajaxCall2("../assets/plugins/kanban/js/api/deleteTarea.php", itemId, "");
	}

	static getNumItemsCol(itemId, colId) {
		const data = read();

		for (const column of data) {
			if (column.id === colId)
				return column.items.length;
		}

	}

	static cambioColor(priorityButtons) {

	  for ( let i of priorityButtons){

	  //AL CARGAR LA PAG
	  switch(i.value){
	    case '-1':
	      i.style.background = "linear-gradient(to right, #393e46 50%, #67696B )";
	       break;
	    case '0':
	      i.style.background = "linear-gradient(to right, #2563eb 60%, #60a5fa )";    
	       break;
	    case '1':
	      i.style.background = "linear-gradient(to right, #059669 50%, #34d399 )";    
	       break;
	    case '2':
	      i.style.background = "linear-gradient(to right, #D9433F 50%, #FA7A76 )";    
	       break;            
	  }

	  i.addEventListener('change', (event) =>{  

	    switch(i.value){
	      case '-1':
	        i.style.background = "linear-gradient(to right, #393e46 50%, #67696B )";
	         break;
	      case '0':
	        i.style.background = "linear-gradient(to right, #2563eb 60%, #60a5fa )";    
	         break;
	      case '1':
	        i.style.background = "linear-gradient(to right, #059669 50%, #34d399 )";    
	         break;
	      case '2':
	        i.style.background = "linear-gradient(to right, #D9433F 50%, #FA7A76 )";    
	         break;            
	    }

	    });
	  }
	}


}


function saveNew(data, columnId){
	
	var url = "../assets/plugins/kanban/js/api/newTarea.php";
	var colPos = KanbanAPI.getNumItemsCol(1,columnId);

	let res = ajaxCall2(url, columnId, colPos);
	
	return res;
	
}


function update(idTarea, arg1, arg2) {

	var url = "../assets/plugins/kanban/js/api/updateTarea.php";
	
	//Update de la Columna y Posicion	
	if (Array.isArray(arg2)) {
		
		for ( let i = 0; i < arg2.length; i++) {

			ajaxCall3(url, arg2[i], arg1, i);	
		}	
		
	//Update del Contenido y la Prioridad		
	}else { 
	
		ajaxCall3(url, idTarea, arg1, arg2);
	}		
}


function read() {
 
	var url = "../assets/plugins/kanban/js/api/getTareas.php";
	let res = ajaxCall1(url);
	
	return JSON.parse(res);
	
}


function ajaxCall1(url){

	var http = new XMLHttpRequest();

	//El "act" se lo pasamos en las declaraciones de codigo de php
	http.open("GET", url+"?"+"idAct="+act, false);
	http.send(null); 	  

	if(http.status == 200) {
		
		return http.responseText;
	}

	return false;
	  
}


function ajaxCall2(url, arg2, arg3){
	
	var http = new XMLHttpRequest();

	//El "act" se lo pasamos en las declaraciones de codigo de php
	http.open("GET", url+"?"+"idAct="+act+"&arg2="+arg2+"&arg3="+arg3, false);
	http.send(null); 	  

	if(http.status == 200) {
		
		return http.responseText;
	}

	return false;
	  
}


function ajaxCall3(url, idTarea, arg1, arg2){

	var http = new XMLHttpRequest();

	//El "act" se lo pasamos en las declaraciones de codigo de php
	http.open("GET", url+"?"+"idTarea="+idTarea+"&arg1="+arg1+"&arg2="+arg2, false);
	http.send(null); 	  

	if(http.status == 200) {
		
		return http.responseText;
	}

	return false;
	  
}










