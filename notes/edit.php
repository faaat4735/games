<?php 
    if (isset($_GET['id']) && $_GET['id']) {
      $sql = "SELECT * FROM notes_info WHERE id = ?";
      $notesInfo = $GLOBALS['db']->getRow($sql, $_GET['id']);
      if ($notesInfo['disabled']) {
          echo 'you can\'t edit it!';
          exit;
      }
    }
    if (isset($_POST['action'])) {
        if ($_POST['id']) {
          $sql = "UPDATE notes_info SET
                title = :title,
                content =:content
                WHERE id = :id";
        } else {
            $sql = "INSERT INTO notes_info SET
                title = :title,
                content =:content";
            unset($_POST['id']);
        }
        unset($_POST['action']);
        if ($GLOBALS['db']->exec($sql, $_POST)) {
            $url = 'detail?id='. (isset($_POST['id']) ? $_POST['id'] : $GLOBALS['db']->lastInsertId());
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
<!DOCTYPE html>
<html>
<head>
<link href="src/css/bootstrap.min.css" rel="stylesheet">
<script src="src/js/markdown.min.js"></script>
</head>
    <body style="padding:30px">
      <form action='edit' method="post">
          <input type='hidden' name='action'>
          <input type='hidden' name='id' value='<?php echo $_GET["id"]?>'>
          <button type="submit" class="btn btn-primary">Save</button>
          <input type="text" class="form-control" name="title" value="<?php echo isset($notesInfo) ? $notesInfo['title'] : ''; ?>">
          <textarea class="form-control" name='content' id="text-input" oninput="this.editor.update()"
                    rows="6" cols="60"><?php echo isset($notesInfo) ? $notesInfo['content'] : ' Type **Markdown** here.'; ?></textarea>
          <div id="preview"> </div>
      </form>
      <script>
          function Editor(input, preview) {
              this.update = function () {
                preview.innerHTML = markdown.toHTML(input.value);
              };
              input.editor = this;
              this.update();
          }
          var $ = function (id) { return document.getElementById(id); };
          new Editor($("text-input"), $("preview"));
      </script>
    </body>
</html>