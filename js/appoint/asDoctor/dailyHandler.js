import {httpPost} from '../../utils.js'
class DailyTable{
    constructor(){
        this.lastClickedRow = 0;
        this.lastClickedColumn = 0;
        this.lastTableId = "dummyId";
        this.lastChoosedHour = 0;
        this.lastChoosedMinutes = 0;
        this.lastChoosedSlotTimeString = 0;
        this.userHaveClickedOnce = false;
    }
    tableListener(event){
        var cell = event.target;
        var row = event.target.parentElement;
        var table = event.target.parentElement.parentElement.parentElement;

        if(cell.classList.contains('cell_disabled')){
            console.log("cell unavailable");
            return
        }

        if(this.userHaveClickedOnce){
            var prevCell = document.getElementById(this.lastTableId).rows[this.lastClickedRow].cells[this.lastClickedColumn];
            console.log(cell);
            if(prevCell.classList.contains('cell_clickedFreeSlot')){
                prevCell.classList.remove('cell_clickedFreeSlot');
                prevCell.classList.add('cell_freeSlot');
            }else if(prevCell.classList.contains('cell_clickedBookedSlot')){
                prevCell.classList.remove('cell_clickedBookedSlot');
                prevCell.classList.add('cell_bookedSlot');
            }else if(prevCell.classList.contains('cell_clickedOtherBooked')){
                prevCell.classList.remove('cell_clickedOtherBooked')
                prevCell.classList.add('cell_otherBooked');
            }
        }


        this.lastClickedColumn = cell.cellIndex;
        this.lastClickedRow = row.rowIndex;
        this.lastTableId = table.id;
        this.lastChoosedSlotTimeString = cell.id;
        this.userHaveClickedOnce = true;
        if(cell.classList.contains('cell_bookedSlot')){
            cell.classList.remove('cell_bookedSlot');
            cell.classList.add('cell_clickedBookedSlot');
        }else if(cell.classList.contains('cell_freeSlot')){
            cell.classList.remove('cell_freeSlot');
            cell.classList.add('cell_clickedFreeSlot');
        }else if(cell.classList.contains('cell_otherBooked')){
            cell.classList.remove('cell_otherBooked')
            cell.classList.add('cell_clickedOtherBooked');
        }
        console.log(cell);
    }

    buttonListener(event){
        if(this.userHaveClickedOnce){
            var params = {slotTimeString: this.lastChoosedSlotTimeString};
            httpPost('../serverLogic/asDoctor/dailyHandler.php', params);
        }
    }
}

var dailyTable = new DailyTable();
export function setupDailyTableListener(tableId, daySlot, numOfHours){
    var numOfAppointmentPerHour = 4;
    for(var i = 0; i< daySlot; i++){
        for(var j = 0; j< numOfHours*numOfAppointmentPerHour; j++){
            document.getElementById(tableId).rows[i+1].cells[j+1].addEventListener("click", dailyTable.tableListener.bind(dailyTable));
        }
    }
}
export function setupDailyTableButton(buttonId){
    document.getElementById(buttonId).addEventListener("click", dailyTable.buttonListener.bind(dailyTable));
}

export function setupReloadListener(){
    window.addEventListener( "pageshow", function ( event ) {
        var historyTraversal = event.persisted ||
                             ( typeof window.performance != "undefined" &&
                                  window.performance.navigation.type === 2 );
        if ( historyTraversal ) {
        // Handle page restore.
            window.location.reload();
        }
    });
}
