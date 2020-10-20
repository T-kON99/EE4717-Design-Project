import {httpPost} from '../../utils.js'
class WeeklyTable{
    constructor(){
        this.lastClickedRow = 0;
        this.lastClickedColumn = 0;
        this.lastTableId = "dummyId";
        this.lastChoosedHour = 0;
        this.lastChoosedMinutes = 0;
        this.lastChoosedSlotTimeString = 0;
        this.userHaveClickedOnce = false;
        this.weekTimeSet = new Set();
    }
    static packWeekTimeSet(weekTimeSet){
        var packedString = "";
        var weekTimeArr = Array.from(weekTimeSet);
        for(var i = 0; i< weekTimeArr.length-1; i++){
            packedString += weekTimeArr[i];
            packedString += ';';
        }
        packedString += weekTimeArr[weekTimeArr.length - 1];
        return packedString;
    }
    tableListener(event){
        var cell = event.target;
        var row = event.target.parentElement;
        var table = event.target.parentElement.parentElement.parentElement;
        this.lastClickedColumn = cell.cellIndex;
        this.lastClickedRow = row.rowIndex;
        this.lastTableId = table.id;
        this.lastChoosedSlotTimeString = event.target.id;
        /**
        * cell_disabled <=> cell_clickedBookedSlot
        * cell_freeSlot <=> cell_clickedFreeSlot
        */
        if(cell.classList.contains('cell_disabled')){
            cell.classList.remove('cell_disabled');
            cell.classList.add('cell_clickedBookedSlot');
            this.weekTimeSet.add(cell.id);
        }else if(cell.classList.contains('cell_clickedBookedSlot')){
            cell.classList.remove('cell_clickedBookedSlot');
            cell.classList.add('cell_disabled');
            this.weekTimeSet.delete(cell.id);
        }
        else if(cell.classList.contains('cell_freeSlot')){
            cell.classList.remove('cell_freeSlot');
            cell.classList.add('cell_clickedFreeSlot');
            this.weekTimeSet.add(cell.id);
        }else if(cell.classList.contains('cell_clickedFreeSlot')){
            cell.classList.remove('cell_clickedFreeSlot');
            cell.classList.add('cell_freeSlot');
            this.weekTimeSet.delete(cell.id);
        }
        console.log(this.weekTimeSet);
    }

    buttonListener(event){
        var weekTimePacked = this.constructor.packWeekTimeSet(this.weekTimeSet);
        var params = {weekTimePacked: weekTimePacked};
        console.log(weekTimePacked);
        httpPost('../serverLogic/asDoctor/weeklyHandler.php', params);
    }
}

var weeklyTable = new WeeklyTable()
export function setupWeeklyTableListener(tableId, numOfHours){
    var numOfAppointmentPerHour = 4;
    for(var i = 0; i< 7; i++){
        for(var j = 0; j< numOfHours*numOfAppointmentPerHour; j++){
            document.getElementById(tableId).rows[i+1].cells[j+1].addEventListener("mousedown", weeklyTable.tableListener.bind(weeklyTable));
            document.getElementById(tableId).rows[i+1].cells[j+1].addEventListener("mouseover", function listener(event){
                if(event.buttons == 1 || event.buttons == 3){
                    console.log('test');
                    // var d = new Date();
                    var currentMillis = Date.now();
                    if( typeof listener.lastMillis == 'undefined' ) {
                        listener.lastMillis = 0;
                    }


                    if(currentMillis>listener.lastMillis+1000){
                        weeklyTable.tableListener.bind(weeklyTable)(event);
                        listener.lastMillis = currentMillis;

                    }
                    console.log(currentMillis);
                    // console.log(listener.lastMillis);
                }
            });
        }
    }
}
export function setupWeeklyButtonListener(buttonId){
    document.getElementById(buttonId).addEventListener("click", weeklyTable.buttonListener.bind(weeklyTable));
}
