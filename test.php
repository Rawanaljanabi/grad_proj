<!DOCTYPE html>
<html>
<head>
    <title>Shift Schedule Form</title>
</head>
<body>
    <h1>Shift Schedule Form</h1>
    <form action="process.php" method="post">
        <label for="department">Select Department:</label>
        <select id="department" name="department">
            <option value="1">Department 1</option>
            <option value="2">Department 2</option>
            <!-- Add more options as needed -->
        </select>
        <br><br>
        <label for="employee_name">Employee Name:</label>
        <input type="text" id="employee_name" name="employee_name" required>
        <br><br>
        <label for="shift_date">Shift Date:</label>
        <input type="date" id="shift_date" name="shift_date" required>
        <br><br>
        <label for="shift_start_time">Shift Start Time:</label>
        <input type="time" id="shift_start_time" name="shift_start_time" required>
        <br><br>
        <label for="shift_end_time">Shift End Time:</label>
        <input type="time" id="shift_end_time" name="shift_end_time" required>
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
