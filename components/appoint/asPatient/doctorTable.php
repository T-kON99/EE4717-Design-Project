<table id="doctorChooseTable" style="height:150px; width:90%; margin-left:20px; text-align:center;">
    <tr>
        <th class="doctorChooseHeader" style="width:30px;"> <div class="doctorChooseHeaderDiv"> # </div></th>
        <th id="doctorSort" class="doctorChooseHeader" style="width:100px;"> <div class="doctorChooseHeaderDiv">Doctor </div></th>
        <th id="ratingSort" class="doctorChooseHeader" style="width:100px;"> <div class="doctorChooseHeaderDiv"> Specialization </div></th>
        <th id="ratingSort" class="doctorChooseHeader" style="width:100px;"> <div class="doctorChooseHeaderDiv"> Address </div></th>
        <th id="ratingSort" class="doctorChooseHeader" style="width:100px;"> <div class="doctorChooseHeaderDiv"> Rating </div></th>
    </tr>
    <?php
    include_once realpath(dirname(__FILE__) . '/../../../serverLogic/sqlHandler.php');

    $conn = connectDatabase();

    $queryDoctor = "SELECT * FROM doctorTable ";
    if(isset($_SESSION['specialization'])){
        $queryDoctor = $queryDoctor. " WHERE specialization = ?";
    }else{
        $queryDoctor = "SELECT * FROM doctorTable ";
    }

    if (isset($_SESSION['orderBy']) && !empty($_SESSION[''])) {
        if($_SESSION['orderBy']=="rating")
            $queryDoctor = $queryDoctor." ORDER BY rating DESC";
        else if($_SESSION['orderBy']=="doctorAsc")
            $queryDoctor = $queryDoctor." ORDER BY doctor ASC";
        else if($_SESSION['orderBy']=="doctorDesc")
            $queryDoctor = $queryDoctor." ORDER BY doctor DESC";
    }

    $prepareDoctorTable = $conn->prepare($queryDoctor);

    if(isset($_SESSION['specialization'])){
        $prepareDoctorTable->bind_param("s", $_SESSION['specialization']);
        $prepareDoctorTable->execute();
    }else{
        $prepareDoctorTable->execute();
    }

    $queryAns = $prepareDoctorTable->get_result();

    $prepareDoctorTable->close();
        $rowCounter = 0;
        while($row = mysqli_fetch_assoc($queryAns)) {
            // echo ($_SESSION['doctorChoose'] == $row["doctor"]) ? ' rowClicked' : '';
            echo '<tr class="doctorTr';
            if(isset($_SESSION['doctorChoose'])){
                echo ($_SESSION['doctorChoose'] == $row["doctor"]) ? ' rowClicked rowChoosed' : '';
            }
            echo '">';
                $rowCounter = $rowCounter+1;
                echo '<td>' . $rowCounter.' </td>';
                echo '<td>' . $row["doctor"].' </td>';
                echo '<td>' . $row["specialization"].' </td>';
                echo '<td>' . $row["address"].' </td>';
                echo '<td>' . $row["rating"].' </td>';
            echo '</tr>';
        }
     ?>
</table>
<script src="../js/selectDoctor.js"></script>
<script> setupRowDoctorTableClickListener("doctorChooseTable", <?php echo $rowCounter ?>);</script>
