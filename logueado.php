            <div class="form-group">
            	<div class="alert alert-primary" role="alert">
            		Estás logueado con el usuario:
            		<?php
            		
            		echo $_SESSION['usuario_email'];

            		?>
            	</div>            	
            </div>
            <div class="form-group form-check">

            </div>
            <button type="submit" class="btn btn-primary btn-block" name="deslogurarse" >Desloguearse</button>            

            <?php

            if(isset($_POST['deslogurarse']))
            {
   				$_SESSION['logueado']=false;
   				header('Location: login.php');
			}

            ?>