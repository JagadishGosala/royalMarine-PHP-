<?php
include 'SimpleXLSX.php';
if(isset($_POST['filepick']))
	{
		if($_POST['filepick'] == "Receipts")
			{
				include 'receiptsUpload.php';
			}
		elseif($_POST['filepick'] == "Sales")
			{
				include 'salesUpload.php';
			}
		elseif($_POST['filepick'] == "Transport"){
			include 'transportUpload.php';
		}
		elseif($_POST['filepick'] == "Tcs"){
			include 'tcsUpload.php';
		}
		elseif($_POST['filepick'] == "Sale Return"){
			include 'saleReturnUpload.php';
		}
	}
?>