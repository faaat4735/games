<?php 
    if (isset($_GET['id'])) {
        $sql = "SELECT * FROM notes_info WHERE id = ?";
        $notesInfo = $GLOBALS['db']->getRow($sql, $_GET['id']);
    }
?>
<!DOCTYPE html>
<html>
<head>
<link href="src/css/bootstrap.min.css" rel="stylesheet">
<script src="src/js/markdown.min.js"></script>
</head>
    <body style="padding:30px">
      <a class='btn btn-primary btn-lg active <?php echo $notesInfo['disabled'] ? 'disabled' : '';?>' href="<?php echo 'edit?id=' . $notesInfo['id']; ?>" >edit</a>
      <input type="text" class="form-control" name="title" value="<?php echo isset($notesInfo) ? $notesInfo['title'] : ''; ?>" disabled>
      <textarea name='content' id="text-input" rows="6" cols="60" style="display: none;"><?php echo isset($notesInfo) ? $notesInfo['content'] : ''; ?></textarea>
      <div id="preview"> </div>
      <script>
          function Editor(input, preview) {
              preview.innerHTML = markdown.toHTML(input.value);
          }
          var $ = function (id) { return document.getElementById(id); };
          new Editor($("text-input"), $("preview"));
      </script>
    </body>
</html>