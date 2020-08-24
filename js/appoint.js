var lastClickedRow = 0;
var lastClickedColumn = 0;
var lastTableId = "dummyId";
var lastChoosedHour = 0;
var lastChoosedMinutes = 0;
var userHaveClickedOnce = false;
function setupAppointmentTableListener(tableId, daySlot, numOfHours){
  var numOfAppointmentPerHour = 4;
  for(var i = 0; i< daySlot; i++){
    for(var j = 0; j< numOfHours*numOfAppointmentPerHour; j++){
      // console.log(demoText);
      document.getElementById(tableId).rows[i+1].cells[j+1].addEventListener("click", function(event){
        if(event.target.classList.contains('cell_disabled')
        || event.target.classList.contains('cell_booked')){
          console.log("cell unavailable");
          return
        }

        if(userHaveClickedOnce){
          var smt = document.getElementById(lastTableId).rows[lastClickedRow].cells[lastClickedColumn];
          smt.classList.remove('cell_choosed');
        }

        lastClickedColumn = event.target.cellIndex;
        lastClickedRow = event.target.parentElement.rowIndex;
        lastTableId = event.target.parentElement.parentElement.parentElement.id;
        lastChoosedHour = event.target.dataset.hour;
        lastChoosedMinutes = event.target.dataset.minutes;
        console.log("hour: "+lastChoosedHour);
        console.log("minutes: "+lastChoosedMinutes);
        userHaveClickedOnce = true;

        console.log("column:"+lastClickedColumn);
        console.log("row:"+lastClickedRow);

        event.target.classList.add('cell_choosed');
      });
    }
  }
}
