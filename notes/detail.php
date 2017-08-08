<?php 
    if (isset($_GET['notes_info_id'])) {
        $sql = "SELECT * FROM notes_info WHERE notes_info_id = ?";
        $notesInfo = $GLOBALS['db']->getRow($sql, $_GET['notes_info_id']);
    }
?>
<a class='btn btn-primary btn-lg active <?php echo $notesInfo['disabled'] ? 'disabled' : '';?>' href="<?php echo 'edit?notes_info_id=' . $notesInfo['notes_info_id']; ?>" >edit</a>
<input type="text" class="form-control" name="title" value="<?php echo isset($notesInfo) ? $notesInfo['title'] : ''; ?>" disabled>
<textarea name='content' id="text-input" rows="6" cols="60" style="display: none;"><?php echo isset($notesInfo) ? $notesInfo['content'] : ''; ?></textarea>
<div id="preview"> </div>
<script>
    function Editor(input, preview) {
        preview.innerHTML = markdown.toHTML(input.value);
    }
    new Editor($("#text-input").get(0), $("#preview").get(0));
</script>