<div style="display:block; text-align:center">
    <form action="../pages/appoint.php" method="get" style="display: inline-block;">
        <fieldset style="width:500px; display:inline-block;">
            <legend>Select Date for Managing Appointments</legend>
            <p>
                <input type="date" id="inputDate" value=
                <?php echo isset($_SESSION['dateChoose']) ? '"'.$_SESSION['dateChoose'].'"' : '""'; ?>
                name="dateChoose">
            </p>
            <br>
            <input type="submit" value="Select Date" class="custom-button" style="margin-left:20px;"></input>
        </fieldset>
    </form>
</div>
