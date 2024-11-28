<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>

<body>

    <h1><?= getsession('order') ?></h1>
</body>

</html>