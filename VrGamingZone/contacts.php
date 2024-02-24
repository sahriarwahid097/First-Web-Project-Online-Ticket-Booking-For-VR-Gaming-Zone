<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .background {
            width: 100vw;
            height: 100vh;
            background: url(./assets/img/bg.png);
            filter: brightness(100%);
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            text-align: center;
            font-family: 'Cursive', sans-serif;
        }

        .table-container {
            width: 800px;
            height: 500px;
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            animation: increaseSize 1s ease-in-out forwards;
            color: black;
            line-height: 2;
        }

        .close-button {
          position: absolute;
          top: 55px;
          right: 250px;
          cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="table-container">
            <div class="close-button" onclick="closeWindow()">X</div>
            
            <table border="1">
                <tr>
                    <th>Contact</th>
                    <th>Contact Information</th>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>crazevr@email.com</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>01485960781, 01472518950</td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        function closeWindow() {
          window.location.href = 'index.php';
        }
    </script>
</body>
</html>