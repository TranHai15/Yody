<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo mua hàng thành công</title>
    <style>
        .success-container {
            margin-top: 100px;
            text-align: center;
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 100%;
            height: 300px;
        }

        .success-icon {
            font-size: 50px;
            color: #28a745;
        }

        .success-message {
            font-size: 20px;
            font-weight: bold;
            margin: 15px 0;
            color: #333333;
        }

        .success-description {
            font-size: 16px;
            color: #666666;
            margin-bottom: 20px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
            flex: 1;
        }

        .button.history {
            background-color: #007bff;
        }

        .button.history:hover {
            background-color: #0056b3;
        }

        .button.continue {
            background-color: #28a745;
        }

        .button.continue:hover {
            background-color: #1e7e34;
        }

        .containerssss {
            height: 70vh;
            display: flex;
            justify-content: center;

        }
    </style>
</head>

<body>
    <?php require_once(HF . "header.php")  ?>
    <div class="containerssss">
        <div class="success-container">
            <div class="success-icon">✔️</div>
            <p class="success-message">Mua hàng thành công!</p>
            <p class="success-description">Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.</p>
            <div class="button-group">
                <a href="<?= P ?>/history" class="button history">Xem lịch sử mua</a>
                <a href="<?= P ?>/" class="button continue">Mua hàng tiếp</a>
                <input type="hidden" name="" id="soluong" value="<?= $sl ?>">
            </div>
        </div>
    </div>
    <?php require_once(HF . "footer.php") ?>

</body>
<script src="Frontend/Js/message.js"></script>

</html>