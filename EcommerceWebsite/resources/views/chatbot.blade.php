<!DOCTYPE html>
<html>
<head>
    <title>Chatbot</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Chatbot</h2>
    <input type="text" id="userMessage" placeholder="Type your message" />
    <button onclick="sendMessage()">Send</button>

    <div id="chatBox" style="margin-top:20px;"></div>

    <script>
        function sendMessage() {
            var userMessage = $('#userMessage').val();
            if (!userMessage) return alert("Please type a message.");

            $.ajax({
                url: 'http://127.0.0.1:5000/chat',  // Flask backend
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ message: userMessage }),
                success: function(response) {
                    $('#chatBox').append('<div><b>You:</b> ' + userMessage + '</div>');
                    $('#chatBox').append('<div><b>Bot:</b> ' + response.reply + '</div>');
                    $('#userMessage').val('');
                },
                error: function(xhr, status, error) {
                    console.error("Error:", xhr.responseText);
                }
            });
        }
    </script>
</body>
</html>
