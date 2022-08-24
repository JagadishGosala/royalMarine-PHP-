<?php
function updating_to_sales($selected_name,$selected_sheet,$conn)
	{
		$flg = false;
		$required = array_fill(0, 6, 'empty');
		$fieldCount = 0;
		$sqlCheckCustomers = "SELECT customerName FROM customer";
		$resCheckCustomers = mysqli_query($conn,$sqlCheckCustomers);
		$customerNames = array();
		$defDiscounts = array();
		while($rows = mysqli_fetch_assoc($resCheckCustomers)){
			$customerNames.push($rows['customerName']);
			$defDiscounts.push($rows['defaultDiscount']);
		}
		while($fields = implode(',', array_shift($selected_sheet))){
			$fieldsArray = explode(",", $fields);
			// print_r($fieldsArray);
			foreach($fieldsArray as $field){
				switch($field){
					case 'Date':
						$fieldCount++;
						$required[0] = $field;
						break;
					case 'Particulars':
						$fieldCount++;
						$required[1] = $field;
						break;
					case 'Voucher No.':
						$fieldCount++;
						$required[2] = $field;
						break;
					case 'MRP Value':
						$fieldCount++;
						$required[3] = $field;
						break;
					case 'Invoice value':
						$fieldCount++;
						$required[4] = $field;
						break;
					case 'Sale of Others':
						$fieldCount++;
						$required[5] = $field;
						break;
				}
				if($fieldCount == 6){
					break;
				}
			}
		}
		if($fieldCount == 6){
			$e=0;
			foreach($selected_sheet as $rowValues)
				{
					$arr = array();
					foreach($rowValues as $key => $rowValue){
						$va = mysqli_real_escape_string($conn, $rowValue);
						array_push($arr, "'".$va."'");
					}
					if($arr[0]!="''"){							
						$datearray = explode(" ", $arr[0]);
						$datearray[0] = str_replace("'","",$datearray[0]);
						$d = strtotime($datearray[0]);
						$arr[0] =  date('Y-m-d', $d);
						$arr[0] = "'".$arr[0]."'";
						$i = 0;
						$def = 0;
						$flg = false;
						foreach($customerNames as $customerName){
							if($arr[$required[1]] == $customerName){
								$def = $defDiscounts[i];
								$i++;
								$flg = true;
								break;
							}
						}
						$sale = 0;
						if($arr[$required[5]] != ''){
							$sale = 1;
						}
						if($flg){
							$query = "INSERT INTO salesdata (date, customerName, VoucherNumber, mrp, invoiceValue, otherSale, status) VALUES (". $arr[$required[0]] .", ". $arr[$required[1]] .",". $arr[$required[2]] .",". $arr[$required[3]] .",". $arr[$required[4]] .",".$sale.", 'unPaid')";
							$res = mysqli_query($conn,$query);
							if(!$res){
								$e++;
							}
						}
					}
				}
				echo '<script type="text/javascript">
					alert("Sales Data Uploaded Successfully...");
				</script>';
				if($e>0){
					echo "<p style='color:red;text-align:center;margin-top:5%;' class='blink_me'>$e Records have not updated in the database. This could be because of duplicate records or error in the system.</p>";
					echo "<p style='color:red;text-align:center;' class='blink_me'>Please report to System Administrator for issue clearance</p>";
				}
				
			}
			else{
				echo "Some Required columns are missing in the file. Please include them and reupload file";
				echo "The Required columns are : 'Date', 'Particulars', 'Voucher_Ref_No.', 'Quantity', 'Rate', 'Value', 'Gross Total'";
			}
	}
?>