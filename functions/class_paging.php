<?php
// buat class paging
class PagingGoogle{
	
	// cek batas halaman dan posisi data
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page']=1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// hitung total halaman
	function totalPage($amountData, $limit){
		$totalPage = ceil($amountData/$limit);
		return $totalPage;
	}
		
	// buat link halaman 
	function navPage($activePage, $totalPage){
		$pageLink = ""; 
		
		// buat prev dan first page
		if($activePage > 1){
			$prev = $activePage - 1;
			$pageLink .= "<a href='product.php?page=1'><< First </a>
		                    | <a href='product.php?page=$prev'>< Prev </a> ";
		}
		else{ 
			$pageLink .= "<< First < Prev";
		}
		
		// buat link 1,2,3, ...
		$numeric = ($activePage > 3 ? " ... " : " "); 
		for ($i = $activePage-2; $i<$activePage; $i++){
			if ($i < 1)
				continue;
				$numeric .= " | <a href='product.php?page=$i'>$i</a> | ";
		}
		$numeric .= " $activePage ";
			
		for($i = $activePage+1; $i<($activePage+3); $i++){
			if($i > $totalPage)
				break;
				$numeric .= " | <a href='product.php?page=$i'>$i</a> | ";
		}
		$numeric .= ($activePage+2<$totalPage ? " ... <a href='product.php?page=$totalPage'>$totalPage</a> " : " ");
		$pageLink .= "$numeric";
				
		// buat next page dan last page
		if($activePage < $totalPage){
			$next = $activePage+1;
			$pageLink .= " | <a href='product.php?page=$next'>Next ></a>
						| <a href='product.php?page=$totalPage'>Last >></a> ";
		}
		else{
			$pageLink .= "Next > Last >>";
		}
		return $pageLink;
	}
}
?>