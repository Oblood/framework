<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->title?></title>
</head>
<style>
    html, body {
        height: 100%;
    }

    body {
        margin: 0;
        padding: 0;
        width: 100%;
        display: table;
        font-weight: 100;
    }

    .container {
        text-align: center;
        display: table-cell;
        vertical-align: middle;
    }

    .content {
        text-align: center;
        display: inline-block;
    }

    .title {
        color:#f4645f;
        font-size: 96px;
    }
</style>
<body>
<div class="container">
    <div class="content">
        <div class="title"><?= $this->title ?></div>
        <p><?= $this->body ?></p>
    </div>
</div>



</body>
</html>