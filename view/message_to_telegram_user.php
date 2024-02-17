<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Message Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Message Form</h1>
    <form  action="/index.php?page=message_to_telegram_user_store" method="post">
      <div class="mb-3">
        <p>Username: <?=$message['username']?></p>
        <p>Telegram Id: <?=$message['from_id']?></p>
      </div>   
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
      </div>
      <input type="text" hidden name="chat_id" value="<?=$message['chat_id']?>">
      <input type="text" hidden name="username" value="<?=$message['username']?>">
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>

  <!-- Bootstrap JS Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
