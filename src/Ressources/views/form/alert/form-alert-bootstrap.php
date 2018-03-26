
<div class="col-xs-8 col-xs-offset-2">
 <div class="alert alert-<?= $error ? "danger" : "success"?>">
 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong><?= $error ? $error->getMessage(): $success?></strong>
</div>
</div>