<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Conference</title>

    <style>
        html, body {
            height: 100%; width: 100%;
        }
    </style>
</head>
<body>
    <iframe
    allow="camera; microphone; fullscreen; display-capture; autoplay"
    src="https://sfu.mirotalk.com/join/{{$id}}"
    style="height: 100%; width: 100%; border: 0px;"
></iframe>
</body>
</html>
