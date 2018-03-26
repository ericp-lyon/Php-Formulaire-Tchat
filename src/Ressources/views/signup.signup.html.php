<?php include  __DIR__ . "/header/header.html.php"; ?>

<div class="container col-4 offset-2" >
  <h2>Signup</h2>
  <br>
  
  
  <!-- Form alert Bootstrap -->
 <?php if($error || $success): include __DIR__ . "/form/alert/form-alert-bootstrap.php"; ?> 
         <?php  endif; ?>
 
  <?php if(!$success): ?> 
  
  <form method="POST" id="signup" action=""  >
  
  <!-- Form input email -->
 <?php include __DIR__ . "/form/input/form-input-email.php"; ?>
 
  <!-- Form input pswd -->
 <?php include __DIR__ . "/form/input/form-input-pswd.php"; ?>
 
 
  
   
   
     <div class="form-group">
      <label for="pwd">Confirmed Password:</label>
      <input type="password" class="form-control" placeholder="confirm" 
      name="<?= \App\Form\Form::PSWD_CONFIRM_NAME?>"
      value="<?= (string) filter_input(INPUT_POST, \App\Form\Form::PSWD_CONFIRM_NAME,FILTER_SANITIZE_FULL_SPECIAL_CHARS)?>">
    </div>
    
    <input type="hidden" name="token" value="<?= $token ?>">
    
    <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
      </form>

    <?php else: ?> 
    <div class="col-xs-8 col-xs-offset-2 text-right">
<a href="/formation-php/web/signin" >Sign in</a>
</div>
  
        <?php  endif; ?>


</div>
<?php include  __DIR__ . "/nav/nav.html.php"; ?>
<?php include  __DIR__ . "/footer/footer.html.php"; ?>




