var lastClickedRowTableDoctor;
var lastTableIdTableDoctor;
var lastChoosedDoctor;
var userHaveClickedDoctorTable;
function setupRowDoctorTableClickListener(tableId, numOfDoctors){
    userHaveClickedDoctorTable = false;
    lastTableIdTableDoctor = "dummyId"
    lastChoosedDoctor = "";
    lastClickedRowTableDoctor = 0;
    var doctorTable = document.getElementById(tableId);
    for(var i = 0; i< numOfDoctors; i++){
        if(doctorTable.rows[i+1].classList.contains('rowClicked')){
            lastClickedRowTableDoctor = doctorTable.rows[i+1].rowIndex;
            console.log(lastClickedRowTableDoctor);
            lastTableIdTableDoctor = tableId;
            console.log(lastTableIdTableDoctor);
            lastChoosedDoctor = doctorTable.rows[i+1].cells[1].innerText;
            userHaveClickedDoctorTable = true;
            console.log(userHaveClickedDoctorTable);
        }
    }

    /** Setup Listener for 'doctor table' choosing
    * If row is clicked previous row which is saved will be changed back
    */
    for(var i = 0; i< numOfDoctors; i++){
        document.getElementById(tableId).rows[i+1].classList.add('rowChoice');
        document.getElementById(tableId).rows[i+1].addEventListener("click", function(event){
                console.log(userHaveClickedDoctorTable);
                if(userHaveClickedDoctorTable){
                    console.log(lastTableIdTableDoctor);
                    console.log('\n');
                    var prevRow = document.getElementById(lastTableIdTableDoctor).rows[lastClickedRowTableDoctor];
                    console.log(lastClickedRowTableDoctor);
                    if(prevRow.classList.contains('rowClicked')){
                        prevRow.classList.remove('rowClicked');
                        prevRow.classList.add('rowChoice');
                    }
                }

                lastClickedRowTableDoctor = event.target.parentElement.rowIndex;
                lastTableIdTableDoctor = event.target.parentElement.parentElement.parentElement.id;
                lastChoosedDoctor = event.target.parentElement.cells[1].innerText;
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
            var dateInputString = document.getElementById("inputDate").value;
            if(dateInputString!=""){
                var today = new Date();
                var dateInput = new Date(dateInputString);
                console.log(dateInput);
                if(dateInput<today){
                    window.alert('Minimum booking date is today, please change the date');
                }
                var params = {doctorChoose: lastChoosedDoctor, dateChoose:dateInputString};
                post('../pages/appoint.php', params);
            }else{
                window.alert('Please choose a date');
            }
        }else{
            window.alert('Please choose a doctor');
        }
    });
}
