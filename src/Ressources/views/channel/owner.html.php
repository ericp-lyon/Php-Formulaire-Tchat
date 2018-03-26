<?php include  __DIR__ . "/../header/header.html.php"; ?>

<br><br>
<div class="container col-4">
<h3>Liste des Channels</h3>
<br>



<br><br>
</div>

<div class="container col-6">
	<div class="tabbable">
		<!-- Only required for left/right tabs -->
		
		 <!-- Form alert Bootstrap -->
 
         
         
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab">My channel</a></li>
			
			<li><a href="#tab2" data-toggle="tab">Channels</a></li>
		</ul>
	
		
		
			<br>
			
	 <span style="margin-right: 1em">Name</span>
	  <span >Description</span>
	   <span style="float: right" >Capacity</span>
	  
			
			<div class="list-group">
<?php foreach($channels as $value): ?> 
<div style="position:relative;">
  <a href="channel?id=<?=$value->getChannelId()?>" class="list-group-item list-group-item-action">
  <span style="font-size: 1.2em; margin-right: 1em">
  <?= $value->getChannelName() ?> 
  </span>
  <em>
  <?= $value->getChannelDescr() ?> 
  </em>
  <b style="float: right">
  <?= $value->getChannelCapacity() ?> 
  </b>
   </a>
   
   
  <a href="?channel=<?=$value->getChannelId()?>&action=delete" 
  style="position:absolute; right:-4em; top: 1em;">X</a>
 </div> 
  
  <?php  endforeach; ?>
 
</div>
<br><br>

<?php if($error || $success): include __DIR__ . "/../form/alert/form-alert-bootstrap.php"; ?> 
         <?php  endif; ?>	
	<form method="POST"  action=""  >	
	<div class="tab-content">

			<div class="tab-pane active" id="tab1">
			
				<div class="form-group">
					<label for="text">Name channel</label> <input class="form-control"
						placeholder="Enter name" 
						value="<?=filter_input(INPUT_POST, \App\Form\Form::CHANNEL_NAME,FILTER_SANITIZE_SPECIAL_CHARS)?>"
						 name="<?= \App\Form\Form::CHANNEL_NAME ?>">
				</div>
				
				<div class="form-group">
					<label for="text">Description</label> <input class="form-control"
						placeholder="Enter description" 
						value="<?=filter_input(INPUT_POST, \App\Form\Form::CHANNEL_DESCRIPTION_NAME,FILTER_SANITIZE_SPECIAL_CHARS)?>"
						 name="<?= \App\Form\Form::CHANNEL_DESCRIPTION_NAME?>">
				</div>
				
				<div class="form-group">
					<label for="text">capacity</label> <input type="number" min="1"
						max="10" value="<?= (int) filter_input(INPUT_POST, \App\Form\Form::CHANNEL_CAPACITY,FILTER_SANITIZE_SPECIAL_CHARS)?>"
						name="<?= \App\Form\Form::CHANNEL_CAPACITY?>">
				</div>
				
				<button type="submit" class="btn btn-default">Create</button>
				
			<input type="hidden" name="token" value="<?= $user -> token ?>">
			
			
			</div>
			
			
			<div class="tab-pane" id="tab2">
				<p>Channels</p>
			</div>
		</div>
		</form>
	</div>
</div>
<?php include  __DIR__ . "/../nav/nav.html.php"; ?>

<?php include  __DIR__ . "/../footer/footer.html.php"; ?>