<?php
    $sql = "SELECT * FROM notes_info";
    $notesList = $GLOBALS['db']->getAll($sql);
?>
<!DOCTYPE html>
<html>
<head>
<link href="src/css/bootstrap.min.css" rel="stylesheet">
<script src="src/js/markdown.min.js"></script>
</head>
    <body style="padding:30px">
        <a class='btn btn-primary btn-lg active' href='/edit?id=0'>add</a>
        <div class="list-group">
            <?php foreach ($notesList as $notes) :?>
                <a href="<?php echo 'detail?id=' . $notes['id']?>" class="list-group-item     list-group-item-action flex-column align-items-start ">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo $notes['title']?></h5>
                        <small><?php echo $notes['add_time'];?></small>
                    </div>
                </a>
            <?php endforeach;?>
        </div>
    </body>
</html>