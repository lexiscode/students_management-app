<div class="col-12 mb-3">
    <label for="title" class="form-label" style="color: white">Full Name:</label>
    <input class="form-control" type="text" name="student_name" id="name" placeholder="Input your full name here" required>
    
</div>

<div class="col-12">
    <label for="exampleFormControlInput1" class="form-label" style="color: white">Username:</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">@</span>
        <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>
</div>

<div class="col-12">
    <label for="exampleFormControlInput1" class="form-label" style="color: white">Email address:</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="email" id="email" placeholder="Student's username" required aria-label="Student's username" aria-describedby="basic-addon1">
        <span class="input-group-text">@lexischool.com</span>
        <!--<input type="hidden">-->
    </div>
</div>

<center>
<div class="col-md-6">
    <label for="customRange1" class="form-label" style="color: white">Your Grade:</label>
    <select class="form-select" name="grade" id="grade" aria-label="Default select example" required>
        <option value="F">0 - 39</option>
        <option value="E">40 - 45</option>
        <option value="D">45 - 50</option>
        <option value="C">50 - 59</option>
        <option value="B">60 - 69</option>
        <option value="A">70 - 79</option>
        <option value="A+" selected>80 - 100</option>
    </select>
</div>
</center>

<center>
<div class="col-md-6">
    <label for="customRange2" class="form-label" style="color: white">Name of Class:</label>
    <select class="form-select" name="class" id="class" aria-label="Default select example">
        <?php foreach ($all_classes as $class): ?>
            <option value="<?= $class['student_class'] ?>"><?= $class['student_class'] ?></option>
        <?php endforeach; ?>
    </select>
</div>
</center>
<br>

<div>
  <label for="file" style="color: white">Upload Image:</label>
  <!--if "multiple" attribute is added below, it will allow for multiple uploads -->
  <input type="file" name="file" id="file" accept="image/*" onchange="checkImageResolution(event)">
  <!--always use the name key above as "file" in order to tally with display_upload.php -->
</div>
<div id="error-message" style="color: red"></div>
