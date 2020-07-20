<?php  if (count($errors) > 0) : ?>
  <div style="background-color:rgb(36, 36, 36);"class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>