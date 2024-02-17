<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telegram Bot Status</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Button trigger modal -->
    <div class="text-center">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create new
    </button>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Answer Question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/index.php?page=answer_store" method="post">
        <div class="mb-3">
            <label for="answerInput" class="form-label">Your Answer</label>
            <input type="text" class="form-control" id="answerInput" name="answer" required>
        </div>
        <div class="mb-3">
            <label for="questionInput" class="form-label">Your Question</label>
            <input type="text" class="form-control" id="questionInput" name="question" required>
        </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Save</button>

      </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  <div class="container">
    <table class="table user-list">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Answer</th>
          <th scope="col">Question</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if(count($datas)): ?>
            <?php foreach($datas as $data): ?>
                <tr>
                <td> <?=$data['id']?> </td>
                <td> <?=$data['answer']?> </td>
                <td> <?=$data['question']?> </td>
                <td>
                    <div class="d-flex">
                        <form action="/index.php?page=answer_delete" method="POST">
                            <input type="hidden" name="answer_id" value="<?=$data['id']?>">
                            <button class="btn btn-danger">Delete</button>
                        </form>
                        <button type="button" class="btn btn-primary" onclick="openModal('<?=$data['id']?>', '<?=$data['answer']?>', '<?=$data['question']?>')">Update</button>

                    </div>
                </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
      </tbody>
    </table>
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/index.php?page=answer_update" method="post">
        <div class="mb-3">
            <label for="questInp" class="form-label">New Question</label>
            <input type="text" class="form-control" id="questInp" name="new_question_name" required>
        </div>
            <input type="text" id="answerId" name="answer_id" hidden>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Update</button>
        </form>

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
            function openModal(id, answer, question) {
            document.getElementById('updateModalLabel').innerText = `Update '${answer}', set new question `;
            document.getElementById('questInp').value = question;
            document.getElementById('answerId').value = id;
            var myModal = new bootstrap.Modal(document.getElementById('updateModal'));
            myModal.show();
        }
    </script>
</body>
</html>
