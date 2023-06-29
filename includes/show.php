<!-- Button trigger modal --> <!--notice data-bs-target, aria-labelledby and id below for each loops-->
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $data['id']; ?>">
  Show
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $data['id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel<?= $data['id']; ?>">Student Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <center>
            <?php if ($data["image_file"]): ?>
                <img src="http://localhost/students_management-app/uploads/<?= $data["image_file"]; ?>" alt="">
            <?php endif; ?>
        </center>

        <h2 style="color: black;"><?= htmlspecialchars($data["student_name"]); ?></h2> 
        <p style="color: black;"><b>ID:</b> <?= htmlspecialchars($data["id"]); ?></p>
        <p style="color: black;">Email: <?= htmlspecialchars($data["email"]); ?>@lexischool.com</p>
        <p style="color: black;">Username: <?= htmlspecialchars($data["username"]);?></p>
        <p style="color: black;">Grade: <?= $data["grade"];?></p>
        <p style="color: black;">Class: <?= $data["class"];?></p>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- You can replace this comment itself with form tag and download button, if need be -->
      </div>
    </div>
  </div>
</div>