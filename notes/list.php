<?php
    $sql = "SELECT count(notes_info_id) FROM notes_info";
    $notesCount = $db->getOne($sql);
    if ($notesCount) {
        $pageSize = 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $pageStart = ($page - 1) * $pageSize;
        $sql = "SELECT * FROM notes_info ORDER BY add_time DESC LIMIT " . $pageStart . "," . $pageSize;
        $notesList = $db->getAll($sql);
        $pageHtml = "<ul class=\"pager\">";
        $pageHtml .= $page > 1 ? "<li><a href=\"/list?page=($page-1)\">Previous</a></li>" : "";
        for ($i = 1, $endNumber = ceil($notesCount / $pageSize);$i<=$endNumber;$i++) {
            if ($i == $page) {
                $pageHtml .= "<li>$i</li>";
            } else {
                $pageHtml .= "<li><a href=\"/list?page=$i\">$i</a></li>";
            }
        }
        $pageHtml .= $page < $endNumber ? "<li><a href=\"/list?page=($page+1)\">Next</a></li>" : "";
        $pageHtml .= "</ul>";
    }
?>
<a class='btn btn-primary btn-lg active' href='/edit?notes_info_id=0'>add</a>
<div class="list-group">
    <?php foreach ($notesList as $notes) :?>
        <a href="<?php echo 'detail?notes_info_id=' . $notes['notes_info_id']?>" class="list-group-item     list-group-item-action flex-column align-items-start ">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?php echo $notes['title']?></h5>
                <small>发布时间：<?php echo $notes['add_time'];?></small>
                <small>更新时间：<?php echo $notes['update_time'];?></small>
            </div>
        </a>
    <?php endforeach;?>
    <?php echo isset($pageHtml) ? $pageHtml : '';?>
</div>