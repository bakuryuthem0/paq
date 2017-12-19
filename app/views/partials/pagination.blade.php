<nav aria-label="navigation" class="text-center">
    <?php  $presenter = new Illuminate\Pagination\BootstrapPresenter($collection); ?>
  	<ul class="pagination">
	    @if ($collection->getLastPage() > 1)
			<?php
			$beforeAndAfter = 3;

			//Página actual
			$currentPage = $collection->getCurrentPage();

			//Última página
			$lastPage = $collection->getLastPage();

			//Comprobamos si las páginas anteriores y siguientes de la actual existen
			$start = $currentPage - $beforeAndAfter;
				
			  //Comprueba si la primera página en la paginación está por debajo de 1
			  //para saber como colocar los enlaces
			if($start < 1)
			{
				$pos = $start - 1;
				$start = $currentPage - ($beforeAndAfter + $pos);
			}
			//Último enlace a mostrar
			$end = $currentPage + $beforeAndAfter;

			if($end > $lastPage)
			{
				$pos = $end - $lastPage;
				$end = $end - $pos;
			}

			//Si es la primera página mostramos el enlace desactivado
			if ($currentPage <= 1)
			{
				echo ' <li class="disabled"><a href="#" aria-label="Primera"><span aria-hidden="true">&laquo;</span></a></li>';
				//en otro caso obtenemos la url y mostramos en forma de link
			}
			else
			{
				$url = $collection->getUrl(1);
				echo '<li><a href="'.$url.'&busq='.$busq.'" aria-label="Primera"><span aria-hidden="true">&laquo;</span></a></li>';

			}
			//Para ir a la anterior
			if (($currentPage-1) < $start) {
		    	echo '<li class="disabled"><a href="#" aria-label="Anterior"><span aria-hidden="true">&lt; Atras</span></a></li>' ;	
		    }else
		    {
		  		echo '<li><a href="'.$collection->getUrl($currentPage-1).'&busq='.$busq.'">&lt; Atras</a></li>';
		    }
		   
			//Rango de enlaces desde el principio al final, 3 delante y 3 detrás
			for($i = $start; $i<=$end;$i++)
			{
				if ($currentPage == $i) {
					echo '<li class="active"><a href="#">'.$i.' <span class="sr-only">(current)</span></a></li>';
				}else
				{
					echo '<li><a href="'.$collection->getUrl($i).'&busq='.$busq.'">'.$i.'</a></li>';
				}
			}
		       
			//Para ir a la siguiente
			if (($currentPage+1) > $end) {
				echo '<li class="disabled"><a href="#" aria-label="Siguiente"><span aria-hidden="true">Adelante &gt;</span></a></li>' ;
			}else
			{
				echo '<li><a href="'.$collection->getUrl($currentPage+1).'&busq='.$busq.'">Adelante &gt;</a></li>';
			}

			////Si es la última página mostramos desactivado
			if ($currentPage >= $lastPage)
			{
			echo '<li class="disabled"><a href="#" aria-label="Siguiente"><span aria-hidden="true">&raquo; </span></a></li>';
				//en otro caso obtenemos la url y mostramos en forma de link
			}
			else
			{
				$url = $collection->getUrl($lastPage);
				echo '<li><a href="'.$url.'&busq='.$busq.'">&raquo;</a></li>';
			}
			?>
		@endif
  	</ul>
</nav>
