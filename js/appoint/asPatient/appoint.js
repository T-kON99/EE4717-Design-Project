import {httpPost} from '../../utils.js'
class AppointmentAsPatient{
    constructor(){
        this.lastClickedRow = 0;
        this.lastClickedColumn = 0;
        this.lastTableId = "dummyId";
        this.lastChoosedHour = 0;
        this.lastChoosedMinutes = 0;
        this.lastChoosedSlotTimeString = 0;
        this.userHaveClickedOnce = false;
    }
    appointmentListener(event){
        var cell = event.target;
        var row = event.target.parentElement;
        var table = event.target.parentElement.parentElement.parentElement;

        if(cell.classList.contains('cell_disabled')
        || cell.classList.contains('cell_otherBooked')){
            console.log("cell unavailable");
            return
        }

        if(this.userHaveClickedOnce){
            var prevCell = document.getElementById(this.lastTableId).rows[this.lastClickedRow].cells[this.lastClickedColumn];
            if(prevCell.classList.contains('cell_clickedFreeSlot')){
                prevCell.classList.remove('cell_clickedFreeSlot');
                prevCell.classList.add('cell_freeSlot');
            }else if(prevCell.classList.contains('cell_clickedBookedSlot')){
                prevCell.classList.remove('cell_clickedBookedSlot');
                prevCell.classList.add('cell_bookedSlot');
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
        }
    }

    buttonListener(event){
        if(this.userHaveClickedOnce){
            var params = {slotTimeString: this.lastChoosedSlotTimeString};
            httpPost('../serverLogic/appointmentHandler.php', params);
        }
    }
}

var appointmentAsPatient = new AppointmentAsPatient();
export function setupAppointmentTableListener(tableId, daySlot, numOfHours){
    var numOfAppointmentPerHour = 4;
    for(var i = 0; i< daySlot; i++){
        for(var j = 0; j< numOfHours*numOfAppointmentPerHour; j++){
            document.getElementById(tableId).rows[i+1].cells[j+1].addEventListener("click", appointmentAsPatient.appointmentListener.bind(appointmentAsPatient));
        }
    }
}
function setupBookingButtonListener(){
    document.getElementById("bookingButton").addEventListener("click", appointmentAsPatient.buttonListener.bind(appointmentAsPatient));
}
function setupReloadListener(){
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

export function setupAsPatient(){
    setupAppointmentTableListener('firstShiftTable', 3, 5);
    setupAppointmentTableListener('secondShiftTable', 3, 5);
    setupBookingButtonListener();
    setupReloadListener();
}
