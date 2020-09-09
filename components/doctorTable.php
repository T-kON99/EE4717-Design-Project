<table id="doctorChooseTable" style="height:150px; width:100%;">
    <tr>
        <th class="doctorChooseHeader" style="width:30px;"> <div class="doctorChooseHeaderDiv"> # </div></th>
        <th id="doctorSort" class="doctorChooseHeader" style="width:100px;"> <div class="doctorChooseHeaderDiv">Doctor </div></th>
        <th id="ratingSort" class="doctorChooseHeader" style="width:100px;"> <div class="doctorChooseHeaderDiv"> Specialization </div></th>
        <th id="ratingSort" class="doctorChooseHeader" style="width:100px;"> <div class="doctorChooseHeaderDiv"> Address </div></th>
        <th id="ratingSort" class="doctorChooseHeader" style="width:100px;"> <div class="doctorChooseHeaderDiv"> Rating </div></th>
    </tr>
    <?php
    include_once realpath(dirname(__FILE__) . '/../serverLogic/sqlHandler.php');

    // $dateSql = date('Y-m-d H:i:s');

    $conn = connectDatabase();

    $queryDoctor = "SELECT specialization FROM doctorTable ";
    if(isset($_POST['specialization']) && !empty($_POST[''])){
        $queryDoctor = $queryDoctor. " WHERE specialization = ?";
    }else{
        $queryDoctor = "SELECT * FROM doctorTable ";
    }

    if (isset($_POST['orderBy']) && !empty($_POST[''])) {
        if($_POST['orderBy']=="rating")
            $queryDoctor = $queryDoctor." ORDER BY rating DESC";
        else if($_POST['orderBy']=="doctorAsc")
            $queryDoctor = $queryDoctor." ORDER BY doctor ASC";
        else if($_POST['orderBy']=="doctorDesc")
            $queryDoctor = $queryDoctor." ORDER BY doctor DESC";
    }

    $prepareDoctorTable = $conn->prepare($queryDoctor);

    if(isset($_POST['specialization']) && !empty($_POST[''])){
        $prepareDoctorTable->bind_param("s", $_POST['specialization']);
        $prepareDoctorTable->execute();
    }else{
        $prepareDoctorTable->execute();
    }

    $queryAns = $prepareDoctorTable->get_result();
    // if($queryAns->num_rows);

    $prepareDoctorTable->close();
        $rowCounter = 0;
        while($row = mysqli_fetch_assoc($queryAns)) {
            echo '<tr class="doctorTr">';
                $rowCounter = $rowCounter+1;
                echo '<td>' . $rowCounter.' </td>';
                echo '<td class="clickableDoctor">' . $row["doctor"].' </td>';
                echo '<td class="clickableDoctor">' . $row["specialization"].' </td>';
                echo '<td class="clickableDoctor">' . $row["address"].' </td>';
                echo '<td class="clickableDoctor">' . $row["rating"].' </td>';
            echo '</tr>';
        }
     ?>
</table>
<script src="../js/selectDoctor.js"></script>
<script> setupRowDoctorTableClickListener("doctorChooseTable", <?php echo $rowCounter ?>);</script>
