var lastClickedRow = 0;
var lastTableId = "dummyId";
var lastChoosedDoctor = "";
var userHaveClickedDoctorTable = false;
function setupRowDoctorTableClickListener(tableId, numOfDoctors){
    for(var i = 0; i< numOfDoctors; i++){
        document.getElementById(tableId).rows[i+1].classList.add('rowChoice');
        document.getElementById(tableId).rows[i+1].addEventListener("click", function(event){

                if(userHaveClickedDoctorTable){
                    var prevRow = document.getElementById(lastTableId).rows[lastClickedRow];
                    if(prevRow.classList.contains('rowClicked')){
                        prevRow.classList.remove('rowClicked');
                        prevRow.classList.add('rowChoice');
                    }
                }

                lastClickedRow = event.target.parentElement.rowIndex;
                lastTableId = event.target.parentElement.parentElement.parentElement.id;
                lastChoosedDoctor = event.target.parentElement.cells[1];
                userHaveClickedDoctorTable = true;

                if(event.target.parentElement.classList.contains('rowChoice')){
                    event.target.parentElement.classList.remove('rowChoice');
                    event.target.parentElement.classList.add('rowClicked');
                }
                console.log(event.target.parentElement);
        });
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
function setupChooseDoctorAndTimeButton(buttonId){
    document.getElementById(buttonId).addEventListener("click", function(event){
        if(userHaveClickedDoctorTable){
            var dateInput = document.getElementById("inputDate").value;
            console.log(dateInput);
            if(dateInput!=""){
                var params = {doctor: lastChoosedDoctor, date:dateInput};
                post('../pages/appoint.php', params);
            }
        }
    });
}
