import {httpGet} from '../../utils.js'
class SelectDoctorClass{
    constructor(){
        this.lastClickedRow;
        this.lastTableId;
        this.lastChoosedDoctorId;
        this.userHaveClickedDoctorTable = false;
    }
    setupData(doctorTable, index){
        if(doctorTable.rows[index].classList.contains('rowClicked')){
            this.lastClickedRow = doctorTable.rows[index].rowIndex;
            console.log(this.lastClickedRow);
            this.lastChoosedDoctorId = doctorTable.rows[index].dataset.doctorid;
            this.userHaveClickedDoctorTable = true;
        }
    }

    tableListener(event){
        var cell = event.target;
        var row = event.target.parentElement;
        var table = event.target.parentElement.parentElement.parentElement;

        if(this.userHaveClickedDoctorTable){
            var prevRow = table.rows[this.lastClickedRow];
            console.log(this.lastClickedRow);
            if(prevRow.classList.contains('rowClicked')){
                prevRow.classList.remove('rowClicked');
                prevRow.classList.add('rowChoice');
            }
        }

        this.lastClickedRow = row.rowIndex;
        this.lastChoosedDoctorId = row.dataset.doctorid;
        this.userHaveClickedDoctorTable = true;

        if(row.classList.contains('rowChoice')){
            row.classList.remove('rowChoice');
            row.classList.add('rowClicked');
        }
        console.log(row);
    }

    buttonListener(event){
        if(this.lastChoosedDoctorId!=""){
            var dateInputString = document.getElementById("inputDate").value;
            if(dateInputString!=""){
                var today = new Date();
                var dateInput = new Date(dateInputString);
                console.log(dateInput);
                if(dateInput<today){
                    window.alert('Minimum booking date is today, please change the date');
                }
                var params = {doctorId: this.lastChoosedDoctorId, dateChoose: dateInputString};
                httpGet('../pages/appoint.php', params);
            }else{
                window.alert('Please choose a date');
            }
        }else{
            window.alert('Please choose a doctor');
        }
    }
}
var selectDoctorObject = new SelectDoctorClass();


export function setupSelectDoctorTable(tableId, numOfDoctors){
    var doctorTable = document.getElementById(tableId);
    for(var i = 0; i< numOfDoctors; i++){
        selectDoctorObject.setupData(doctorTable, i+1);
    }

    /** Setup Listener for 'doctor table' choosing
    * If row is clicked previous row which is saved will be changed back
    */
    for(var i = 0; i< numOfDoctors; i++){
        document.getElementById(tableId).rows[i+1].classList.add('rowChoice');
        document.getElementById(tableId).rows[i+1].addEventListener("click", selectDoctorObject.tableListener.bind(selectDoctorObject));
    }
}


export function setupChooseDoctorButton(buttonId){
    document.getElementById(buttonId).addEventListener("click", selectDoctorObject.buttonListener.bind(selectDoctorObject));
}
