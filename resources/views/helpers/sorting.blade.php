<div>			@php
				if(isset($_GET['sort'])){
					$sort = $_GET['sort'];
				}
				else $sort = null;
				if(isset($_GET['order'])){
					$order = $_GET['order'];
				}
				else $order = null;
			@endphp
</div>