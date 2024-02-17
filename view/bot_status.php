<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telegram Bot Status</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('a7fc388a9240b2397b49', {
      cluster: 'us2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      const tbody_messages_data = document.getElementById('tbody_messages_data');
      tbody_messages_data.insertAdjacentHTML("afterbegin", `<tr>
                <td> ${data.id} </td>
                <td> ${data.username} </td>
                <td> ${data.chat_id} </td>
                <td> ${data.text} </td>
                <td>
                    <div>
                    <a href="index.php?page=message_to_telegram_user&amp;message_id=${data.id}" class="btn btn-success">Send Message To User</a>
                    </div>
                </td>
                </tr>`);
    });
  </script>
<body>
    <div class="container">
        <h1>Telegram Bot Status <?= $status ? 'запущен' : 'не запущен'  ?> </h1>
        <a href="index.php?page=answer" class="btn btn-primary">Edit Answer Questions</a>

  <div class="container">
    <table class="table user-list">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Username</th>
          <th scope="col">Telegram ID</th>
          <th scope="col">Text</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody id="tbody_messages_data">
        <?php if(count($messages)): ?>
            <?php foreach($messages as $message): ?>
                <tr>
                <td> <?=$message['id']?> </td>
                <td> <?=$message['username']?> </td>
                <td> <?=$message['chat_id']?> </td>
                <td> <?=$message['text']?> </td>
                <td>
                    <div>
                    <a href="index.php?page=message_to_telegram_user&message_id=<?=$message['id']?>" class="btn btn-success">Send Message To User</a>
                    </div>
                </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
</body>
</html>
