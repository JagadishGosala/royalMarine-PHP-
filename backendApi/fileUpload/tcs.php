<?php
    function updating_to_tcs($selected_name,$selected_sheet,$conn)
    {
		$flg = false;
		while($fields = implode(',', array_shift($selected_sheet))){
			$fieldsArray = explode(",", $fields);
			// print_r($fieldsArray);
            $sqlCheckCustomers = "SELECT customerName FROM customer";
            $resCheckCustomers = mysqli_query($conn,$sqlCheckCustomers);
            $customerNames = array();
            while($rows = mysqli_fetch_assoc($resCheckCustomers)){
                $customerNames.push($rows['customerName']);
                $defDiscounts.push($rows['defaultDiscount']);
            }
            $required = array_fill(0, 4, 'empty');
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
					case 'Vch No.':
						$fieldCount++;
						$required[2] = $field;
						break;
					case 'Credit':
						$fieldCount++;
						$required[3] = $field;
						break;
				}
                if($fieldCount == 4){
                    break;
                }
			}
		}
		if($fieldCount == 4){
            $e = 0;
            foreach($selected_sheet as $rowValues){
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
						$flg = false;
						foreach($customerNames as $customerName){
							if($arr[$required[1]] == $customerName){
								$flg = true;
								break;
							}
						}
                        if($flg){
                            $query = "INSERT INTO transport (date, customerName, voucherType, voucherNumber, amount, validated) 
                                VALUES (".$arr[$required[0]].", ".$arr[$required[1]].", 'tcs', ".$arr[$required[2]].", ".$arr[$required[3]].", '0')";
                            $res = mysqli_query($conn, $query);
                            if(!$res)
                                {
                                    $e++;
                                }
                        }
                    }
                    else{
                        echo "Error in formatting Date. Please check and submit again, if same error persists, please contact System Administrator."
                    }
                    // break;
                }
                echo '<script type="text/javascript">
                    alert("Receipts Data Uploaded Successfully...");
                </script>';
                if($e>0)
                {
                    echo "<p style='color:red;text-align:center;margin-top:5%;' class='blink_me'>$e Records have not updated in the database. This could be because of duplicate records or error in the system</p>";
                    echo "<p style='color:red;text-align:center;' class='blink_me'>Please report to System Administrator for issue clearance</p>";
                }
        }
        else{
                echo "Some of the required columns might be missing from the file. Please check and try reuploading";
            }
	}		
?>