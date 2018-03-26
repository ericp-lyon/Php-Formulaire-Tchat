
 <div class="form-group">
      <label for="email">Email:</label>
      <input type="" class="form-control" placeholder="Enter email" 
      name="<?= \App\Form\Form::EMAIL_NAME?>"
      value="<?= (string) filter_var($user->email ,FILTER_SANITIZE_FULL_SPECIAL_CHARS)?>">
    </div>
    
    
    