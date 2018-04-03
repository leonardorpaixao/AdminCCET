		<form action="" method="GET">
			<?php 
				if(isset($busca)):
			?>
			<input type="hidden" name="busca" id="busca" value="<?php echo $busca ?>"/>
			<?php
			endif;
			?>
         <select name="filtro" class="form-control pull-right" onchange="this.form.submit()" style="width: 200px;" >
          <option value="Todos" <?php if($filtro == "Todos") echo "selected='true'" ?>>Todos</option>
          <option value="Pendente" <?php if($filtro == "Pendente") echo "selected='true'" ?>>Pendentes</option>
          <option value="Aprovado" <?php if($filtro == "Aprovado") echo "selected='true'" ?>>Aprovados</option>
          <option value="Recebido" <?php if($filtro == "Recebido") echo "selected='true'" ?>>Recebidos</option>
          <option value="Entregue" <?php if($filtro == "Entrege") echo "selected='true'" ?>>Entregues</option>
          <option value="Cancelado" <?php if($filtro == "Cancelado") echo "selected='true'" ?>>Cancelados</option>
          <option value="Negado" <?php if($filtro == "Negado") echo "selected='true'" ?>>Negados</option>
          <option value="Expirado" <?php if($filtro == "Expirado") echo "selected='true'" ?>>Expirados</option>
         </select>
    </form>
    <label class="pull-right" style="width: 100px">Filtrar por:</label>
