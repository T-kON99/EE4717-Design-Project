<?php
define('__ROOT__', dirname(dirname(__FILE__)));
if(!function_exists('createTableBody')){
    function createTableBody(){
        include_once realpath(dirname(__FILE__) . '/../../../serverLogic/sqlHandler.php');
        include_once realpath(dirname(__FILE__) . '/../../../php/config.php');


        $conn = connect_db();
        $orderBy = NULL;
        $category_id = NULL;
        $doctorId = NULL;

        if(isset($_SESSION['category_id']))
            $category_id = $_SESSION['category_id'];
        if(isset($_SESSION['orderBy']))
            $orderBy = $_SESSION['orderBy'];
        if(isset($_SESSION['doctorId']))
            $doctorId = $_SESSION['doctorId'];

        $queryAns = queryFilterDoctor($conn, $category_id, $orderBy);
        $rowCounter = 0;
        while($row = mysqli_fetch_assoc($queryAns)) {
            echo '<tr class="doctorTr';
            if(!is_null($doctorId)){
                echo ($doctorId == $row["doctor_id"]) ? ' rowClicked rowChoosed' : '';
            }
            echo '" data-doctorid="'.$row['doctor_id'].'"';
            echo '>';
            $rowCounter = $rowCounter+1;
            echo '<td>' . $rowCounter.' </td>';
            echo '<td>' . $row["doctor_name"].' </td>';
            echo '<td>' . $row["category_name"].' </td>';
            echo '<td>' . $row["address"].' </td>';
            echo '<td>' . $row["rating"].' </td>';
            echo '</tr>';
        }
        return $rowCounter;
    }
}
?>

<table id="doctorChooseTable" style="height:150px; width:90%; margin-left:20px; text-align:center;">
    <tr>
        <th class="doctorChooseHeader" style="width:30px;"> <div class="doctorChooseHeaderDiv"> # </div></th>
        <th id="doctorSort" class="doctorChooseHeader" style="width:100px;"> <div class="doctorChooseHeaderDiv">Doctor </div></th>
        <th id="ratingSort" class="doctorChooseHeader" style="width:100px;"> <div class="doctorChooseHeaderDiv"> Specialization </div></th>
        <th id="ratingSort" class="doctorChooseHeader" style="width:100px;"> <div class="doctorChooseHeaderDiv"> Address </div></th>
        <th id="ratingSort" class="doctorChooseHeader" style="width:100px;"> <div class="doctorChooseHeaderDiv"> Rating </div></th>
    </tr>
    <?php
    $rowCounter = createTableBody();
    ?>
</table>
<script type="module">
    import { setupSelectDoctorTable } from '../js/appoint/asPatient/selectDoctor.js';
    setupSelectDoctorTable("doctorChooseTable", <?php echo $rowCounter ?>);
</script>
