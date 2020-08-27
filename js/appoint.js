var lastClickedRow = 0;
var lastClickedColumn = 0;
var lastTableId = "dummyId";
var lastChoosedHour = 0;
var lastChoosedMinutes = 0;
var lastChoosedSlotTimeString = 0;
var userHaveClickedOnce = false;
function setupAppointmentTableListener(tableId, daySlot, numOfHours){
    var numOfAppointmentPerHour = 4;
    for(var i = 0; i< daySlot; i++){
        for(var j = 0; j< numOfHours*numOfAppointmentPerHour; j++){
            document.getElementById(tableId).rows[i+1].cells[j+1].addEventListener("click", function(event){
                if(event.target.classList.contains('cell_disabled')
                || event.target.classList.contains('cell_booked')){
                    console.log("cell unavailable");
                    return
                }

                if(userHaveClickedOnce){
                    var prevCell = document.getElementById(lastTableId).rows[lastClickedRow].cells[lastClickedColumn];
                    if(prevCell.classList.contains('cell_clickedFreeSlot')){
                        prevCell.classList.remove('cell_clickedFreeSlot');
                    }else if(prevCell.classList.contains('cell_clickedBookedSlot')){
                        prevCell.classList.remove('cell_clickedBookedSlot');
                        prevCell.classList.add('cell_bookedSlot');
                    }
                }

                lastClickedColumn = event.target.cellIndex;
                lastClickedRow = event.target.parentElement.rowIndex;
                lastTableId = event.target.parentElement.parentElement.parentElement.id;
                lastChoosedSlotTimeString = event.target.id;
                console.log("hour: "+lastChoosedHour);
                console.log("minutes: "+lastChoosedMinutes);
                userHaveClickedOnce = true;

                console.log("column:"+lastClickedColumn);
                console.log("row:"+lastClickedRow);
                if(event.target.classList.contains('cell_bookedSlot')){
                    event.target.classList.remove('cell_bookedSlot');
                    event.target.classList.add('cell_clickedBookedSlot');
                }else{
                    event.target.classList.add('cell_clickedFreeSlot');
                }
            });
        }
    }
}
function post(path, params, method='post') {
  // The rest of this code assumes you are not using a library.
  // It can be made less wordy if you use one.
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = key;
      hiddenField.value = params[key];

      form.appendChild(hiddenField);
    }
  }

  document.body.appendChild(form);
  form.submit();
}
function setupBookingButtonListener(){
    document.getElementById("bookingButton").addEventListener("click", function(event){
        if(userHaveClickedOnce){
            var params = {username: 'Jonisins', doctor: 'Edo', slotTimeString: lastChoosedSlotTimeString};
            post('../serverLogic/postRetriever.php', params);
        }
    });
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
