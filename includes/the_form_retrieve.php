<div class="col-12 mb-3">
    <label for="title" class="form-label" style="color: white">Full Name:</label>
    <input class="form-control" type="text" name="student_name" id="name" placeholder="Input your full name here" value="<?= htmlspecialchars($student_name); ?>">
    
</div>

<div class="col-12">
    <label for="exampleFormControlInput1" class="form-label" style="color: white">Username:</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">@</span>
        <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="<?= htmlspecialchars($username); ?>">
    </div>
</div>

<div class="col-12">
    <label for="exampleFormControlInput1" class="form-label" style="color: white">Email address:</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="email" id="email" placeholder="Student's username" aria-label="Student's username" aria-describedby="basic-addon1" value="<?= htmlspecialchars($email); ?>">
        <span class="input-group-text">@lexischool.com</span>
        <!--<input type="hidden">-->
    </div>
</div>

<div class="col-md-6">
    <label for="customRange1" class="form-label" style="color: white">Your Grade:</label>
    <select class="form-select" name="grade" id="grade" aria-label="Default select example">
    <?php
    $allGrades = ["A+", "A", "B", "C", "D", "E", "F"];

    foreach ($allGrades as $student_grade) {
        $selected = ($student_grade === $grade) ? "selected" : "";
        echo "<option value='$student_grade' $selected>$student_grade</option>";
    }
    ?>
    </select>
</div>



<div class="col-md-6">
    <label for="customRange2" class="form-label" style="color: white">Name of Class:</label>
    <select class="form-select" name="class" id="class" aria-label="Default select example">
    <?php

    $query = "SELECT * FROM classrooms";
    $result = mysqli_query($conn, $query);

    $allClasses = array(); // Initialize an empty array

    while ($row = mysqli_fetch_assoc($result)) {
        $allClasses[] = $row['student_class'];
    }
    
    foreach ($allClasses as $student_class) {
        $selected = ($student_class === $class) ? "selected" : "";
        echo "<option value='$student_class' $selected>$student_class</option>";
    }
    ?>
    </select>
</div>



<div>
  <label for="file" style="color: white">Upload Image:</label>
  <!--if "multiple" attribute is added below, it will allow for multiple uploads -->
  <input type="file" name="file" id="file" accept="image/*" onchange="checkImageResolution(event)">
  <!--always use the name key above as "file" in order to tally with display_upload.php -->
</div>
<div id="error-message" style="color: red"></div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-success" style="margin-top: 30;" data-bs-toggle="modal" data-bs-target="#exampleModal">
UPDATE
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        Are you sure you want to update?
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary" name="save">Yes</button>
    </div>
    </div>
</div>
</div>