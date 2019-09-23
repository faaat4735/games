<?php
    if (isset($_GET['notes_info_id']) && $_GET['notes_info_id']) {
        $sql = "DELETE FROM notes_info WHERE notes_info_id = ?";
        $db->exec($sql, $_GET['notes_info_id']);
    }
    $sql = "SELECT count(notes_info_id) FROM notes_info";
    if (isset($_GET['search']) && $_GET['search']) {
        $sql .= " WHERE title like '%" . $_GET['search'] . "%'";
    }
    $notesCount = $db->getOne($sql);
    if ($notesCount) {
        $pageSize = 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $pageStart = ($page - 1) * $pageSize;
        $sql = "SELECT * FROM notes_info";
        if (isset($_GET['search']) && $_GET['search']) {
            $sql .= " WHERE title like '%" . $_GET['search'] . "%'";
        }
        $sql .= " ORDER BY add_time DESC LIMIT " . $pageStart . "," . $pageSize;
        $notesList = $db->getAll($sql);
        $endNumber = ceil($notesCount / $pageSize);
        if ($endNumber > 1) {
            $pageHtml = "<ul class=\"pager\">";
            $pageHtml .= $page > 1 ? "<li><a href=\"/list?page=" . ($page - 1) . "\">Previous</a></li>" : "";
            for ($i = 1;$i<=$endNumber;$i++) {
                if ($i == $page) {
                    $pageHtml .= "<li>$i</li>";
                } else {
                    $pageHtml .= "<li><a href=\"/list?page=$i\">$i</a></li>";
                }
            }
            $pageHtml .= $page < $endNumber ? "<li><a href=\"/list?page=" . ($page+1) . "\">Next</a></li>" : "";
            $pageHtml .= "</ul>";
        }
    }
?>
<a class='btn btn-primary btn-lg active' href='/edit?notes_info_id=0'>add</a>
<div class="list-group">
<?php if (isset($notesList)) :?>
    <?php foreach ($notesList as $notes) :?>
        <div class="d-flex w-100 justify-content-between list-group-item list-group-item-action flex-column align-items-start ">
            <a href="<?php echo 'detail?notes_info_id=' . $notes['notes_info_id']?>" class="">
                <h5 class="mb-1"><?php echo $notes['title']?></h5>
            </a>
            <small>发布时间：<?php echo $notes['add_time'];?></small>
            <small>更新时间：<?php echo $notes['update_time'];?></small>
            <a href="<?php echo 'detail?notes_info_id=' . $notes['notes_info_id']?>" class="">
                <button ><a class='btn btn-primary btn-lg active' href="<?php echo 'list?notes_info_id=' . $notes['notes_info_id']?>">delete</a></button>
            </a>
        </div>
    <?php endforeach;?>
<?php else:?>
    not found
<?php endif;?>
    <?php echo isset($pageHtml) ? $pageHtml : '';?>
</div>  