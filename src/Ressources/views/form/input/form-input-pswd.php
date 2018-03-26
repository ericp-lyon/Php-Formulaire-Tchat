
 <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" placeholder="Enter password" 
      name="<?= \App\Form\Form::PSWD_NAME?>"
       value="<?= (string) filter_var($user->pswd ,FILTER_SANITIZE_FULL_SPECIAL_CHARS)?>">
    </div>