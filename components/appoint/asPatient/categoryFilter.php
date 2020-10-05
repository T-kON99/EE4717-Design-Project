<form action="../pages/appoint.php" method="get" style="display: inline-block;">
   <fieldset style="width:500px">
      <legend>Step 1 Select Specialization</legend>
      <p>
         <!-- <label>Select Specialization</label> -->
         <select id="specializationList" name="category_id">
            <?php
                function createOption($category_id, $categoryIdChoosed, $category_name){
                    print '<option value="'.$category_id.'" ';
                    print ($category_id == $categoryIdChoosed) ? ' selected="selected">' : ' >';
                    print $category_name.'</option>';
                };
                {
                    include_once dirname(__FILE__) . '/../../../serverLogic/sqlHandler.php';
                    include_once realpath(dirname(__FILE__) . '/../../../php/config.php');

                    $conn = connect_db();
                    $queryAns = queryCategories($conn);

                    $categoryIdChoosed = '';
                    if ( isset( $_SESSION['category_id'] ) ) {
                        $categoryIdChoosed = $_SESSION['category_id'];
                    }

                    createOption(-1, $categoryIdChoosed, 'All');
                    while($row = mysqli_fetch_assoc($queryAns)) {
                        createOption($row['id'], $categoryIdChoosed, $row['name']);
                    }
                }
            ?>
        </select>
        <br>
        <input type="submit" value="Select" class="custom-button">
</p>
</fieldset>
</form>
