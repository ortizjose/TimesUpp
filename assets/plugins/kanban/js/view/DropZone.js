import KanbanAPI from "../api/KanbanAPI.js";

export default class DropZone {
	static createDropZone() {
		const range = document.createRange();

		range.selectNode(document.body);

		const dropZone = range.createContextualFragment(`
			<div class="kanban__dropzone"></div>
		`).children[0];

		dropZone.addEventListener("dragover", e => {
			e.preventDefault();
			dropZone.classList.add("kanban__dropzone--active");
		});

/*
		dropZone.addEventListener("touchmove", e => {
			e.preventDefault();
			dropZone.classList.add("kanban__dropzone--active");
		});*/		

		dropZone.addEventListener("dragleave", () => {
			dropZone.classList.remove("kanban__dropzone--active");
		});

		dropZone.addEventListener("drop", e => {
			e.preventDefault();
			//debugger;
			dropZone.classList.remove("kanban__dropzone--active");

			const columnElement = dropZone.closest(".kanban__column");
			const columnId = Number(columnElement.dataset.id);
			const dropZonesInColumn = Array.from(columnElement.querySelectorAll(".kanban__dropzone"));
			const droppedIndex = dropZonesInColumn.indexOf(dropZone);
			const itemId = Number(e.dataTransfer.getData("text/plain"));
			const droppedItemElement = document.querySelector(`[data-id="${itemId}"]`);
			const insertAfter = dropZone.parentElement.classList.contains("kanban__item") ? dropZone.parentElement : dropZone;
			
			//debugger;
			
			//console.log(droppedItemElement);
			
			//En el caso de que se arrastre al dropZone de abajo suya
			if (droppedItemElement.contains(dropZone)  ) {
				return;
			}	
			
			
			// Creacion de Array de posiciones 
			const itemColumn = Array.from(columnElement.querySelectorAll(".kanban__item"));
			const idOrder = [ ];
			var mismaColumna =  0;
			
			let j = 0;
			for(let i = 0; i< itemColumn.length; i++) { 
				//debugger;
				
				if ( itemId != Number(itemColumn[i].dataset.id) ) {
					
					idOrder[j] = Number(itemColumn[i].dataset.id);
					j++;
				}
				else{
					mismaColumna = 1;
				}
					

			}
					
			// Añadimos el nuevo Item en su posicion 
			if (mismaColumna && droppedIndex > 1) {
				
				idOrder.splice(droppedIndex-1 ,0,itemId);
			}else{
				
				idOrder.splice(droppedIndex,0,itemId);
			}


			insertAfter.after(droppedItemElement);
			KanbanAPI.updateItem(itemId, {
				columnId,
				position: droppedIndex,
			}, idOrder);
		});

		return dropZone;
	}




}
