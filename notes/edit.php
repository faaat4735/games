<?php 
    if (isset($_GET['notes_info_id']) && $_GET['notes_info_id']) {
      $sql = "SELECT * FROM notes_info WHERE notes_info_id = ?";
      $notesInfo = $GLOBALS['db']->getRow($sql, $_GET['notes_info_id']);
    }
    if (isset($_POST['action'])) {
        if ($_POST['notes_info_id']) {
          $sql = "UPDATE notes_info SET
                title = :title,
                content =:content
                WHERE notes_info_id = :notes_info_id";
        } else {
            $sql = "INSERT INTO notes_info SET
                title = :title,
                content =:content";
            unset($_POST['notes_info_id']);
        }
        unset($_POST['action']);
        if ($GLOBALS['db']->exec($sql, $_POST)) {
            $url = 'detail?notes_info_id='. (isset($_POST['notes_info_id']) ? $_POST['notes_info_id'] : $GLOBALS['db']->lastInsertId());
        } else {
            $url = 'list';
        }
        if (headers_sent()) {
            printf('<script>window.location="%s";</script>', $url);
            exit;
        }
        header('Location: ' . $url);
        exit;
    }
?>
<style type="text/css">
#preview {height:400px; overflow:auto}
</style>
<form action='edit' method="post">
    <input type='hidden' name='action'>
    <input type='hidden' name='notes_info_id' value='<?php echo $_GET["notes_info_id"]?>'>
    <button type="submit" class="btn btn-primary">Save</button>
    <input type="text" class="form-control" name="title" value="<?php echo isset($notesInfo) ? $notesInfo['title'] : ''; ?>">
    <textarea class="form-control" name='content' id="text-input" oninput="this.editor.update()"
              rows="6" cols="60"><?php echo isset($notesInfo) ? $notesInfo['content'] : ' Type **Markdown** here.'; ?></textarea>
    <div id="preview"> </div>
</form>
<script>
    function Editor(input, preview) {
        this.update = function () {
            // preview.innerHTML = markdown.toHTML(input.value);
            preview.innerHTML = marked(input.value);
        };
        input.editor = this;
        this.update();
    }
    new Editor($("#text-input").get(0), $("#preview").get(0));
</script>