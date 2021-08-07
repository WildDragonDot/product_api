<?php
require_once 'php/link.php';
$data2 = array();
$result_data = array();
function CallAPI($url)
{
    // create & initialize a curl session
    $curl = curl_init();

    // set our url with curl_setopt()
    curl_setopt($curl, CURLOPT_URL, $url);

    // return the transfer as a string, also with setopt()
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    // curl_exec() executes the started curl session
    // $output contains the output string
    $result = curl_exec($curl);
    if (!$result) {
        return (curl_error($curl));
    } else {
        return ($result);
    }
    // close curl resource to free up system resources
    // (deletes the variable made by curl_init)
    curl_close($curl);
}
//get 10 result url = https://mocki.io/v1/e45f8ee3-bfb4-4d53-8b7a-c4c330d43a2f
//$result_data = CallAPI("", 'http://50.72.174.188:5000/ERPRest/Api/getfiltereditems?SID=AB202106gR$e@T&ItemFilterFIeld=DESC&ItemFilter=*MANGO*');
$result_data = CallAPI('https://youtube2030.000webhostapp.com/api_new.php');

//get 5 result url = https://mocki.io/v1/cb965a2c-7ef9-4024-9f78-10ead866f811
// $result_data = CallAPI("","https://mocki.io/v1/cb965a2c-7ef9-4024-9f78-10ead866f811");


$array = json_decode($result_data);
$deleteFromDatabase_tmparr2 = array();
/* if (is_array($array) || is_object($array))
{ */
foreach ($array as $data) {
    $ItemDescription = $data->ItemDescription;
    $ItemDescriptionNew = str_replace("'", "\'", $ItemDescription);
    $ItemNumber = $data->ItemNumber;
    $ItemNumberFmt = $data->ItemNumberFmt;
    $StockingUOM = $data->StockingUOM;
    $PricingUOM = $data->PricingUOM;
    $Category = $data->Category;
    $WeightQty = $data->WeightQty;
    $WeightUnit = $data->WeightUnit;
    //$size=$WeightQty.$WeightUnit;
    $BasePrice = $data->BasePrice;
    $SalePrice = $data->SalePrice;
    $SaleDateStart = $data->SaleDateStart;
    $SaleDateEnd = $data->SaleDateEnd;
    //$AccountSet = $data->AccountSet;
    $ItemComment1 = $data->ItemComment1;
    $ItemComment1New = str_replace("'", "\'", $ItemComment1);
    $ItemComment2 = $data->ItemComment2;
    $ItemComment2New = str_replace("'", "\'", $ItemComment2);
    if (!empty($data->AccountSet)) {
        $AccountSet = $data->AccountSet;
    } else {
        $AccountSet = '';
    }

    if (!empty($data->TaxAuthorities->ADMIN)) {
        $ADMIN = $data->TaxAuthorities->ADMIN;
    } else {
        $ADMIN = '';
    }

    if (!empty($data->TaxAuthorities->GST)) {
        $GST = $data->TaxAuthorities->GST;
    } else {
        $GST = '';
    }

    if (!empty($data->TaxAuthorities->HST)) {
        $HST = $data->TaxAuthorities->HST;
    } else {
        $HST = '';
    }

    if (!empty($data->TaxAuthorities->PST)) {
        $PST = $data->TaxAuthorities->PST;
    } else {
        $PST = '';
    }

    if (!empty($data->OtherAttributes->ITEMCLASS)) {
        $ItemClass = $data->OtherAttributes->ITEMCLASS;
    } else {
        $ItemClass = '';
    }

    if (!empty($data->OtherAttributes->BAKERY)) {
        $category_name = 'BAKERY';
        $subcategory_name = $data->OtherAttributes->BAKERY;
    } else if (!empty($data->OtherAttributes->CLEANING)) {
        $category_name = 'CLEANING';
        $subcategory_name = $data->OtherAttributes->CLEANING;
    } else if (!empty($data->OtherAttributes->HEALTH)) {
        $category_name = 'HEALTH';
        $subcategory_name = $data->OtherAttributes->HEALTH;
    } else if (!empty($data->OtherAttributes->MEATSEAFOOD)) {
        $category_name = 'MEATSEAFOOD';
        $subcategory_name = $data->OtherAttributes->MEATSEAFOOD;
    } else if (!empty($data->OtherAttributes->FROZEN)) {
        $category_name = 'FROZEN';
        $subcategory_name = $data->OtherAttributes->FROZEN;
    } else if (!empty($data->OtherAttributes->PRODUCE)) {
        $category_name = 'PRODUCE';
        $subcategory_name = $data->OtherAttributes->PRODUCE;
    } else if (!empty($data->OtherAttributes->ORGSPEC)) {
        $category_name = 'ORGSPEC';
        $subcategory_name = $data->OtherAttributes->ORGSPEC;
    } else if (!empty($data->OtherAttributes->DELI)) {
        $category_name = 'DELI';
        $subcategory_name = $data->OtherAttributes->DELI;
    } else if (!empty($data->OtherAttributes->DAIRY)) {
        $category_name = 'DAIRY';
        $subcategory_name = $data->OtherAttributes->DAIRY;
    } else if (!empty($data->OtherAttributes->BEVERAGES)) {
        $category_name = 'BEVERAGES';
        $subcategory_name = $data->OtherAttributes->BEVERAGES;
    } else if (!empty($data->OtherAttributes->SNACKS)) {
        $category_name = 'SNACKS';
        $subcategory_name = $data->OtherAttributes->SNACKS;
    } else if (!empty($data->OtherAttributes->SOUPCANNED)) {
        $category_name = 'SOUPCANNED';
        $subcategory_name = $data->OtherAttributes->SOUPCANNED;
    } else if (!empty($data->OtherAttributes->BAKING)) {
        $category_name = 'BAKING';
        $subcategory_name = $data->OtherAttributes->BAKING;
    } else if (!empty($data->OtherAttributes->WORLD)) {
        $category_name = 'WORLD';
        $subcategory_name = $data->OtherAttributes->WORLD;
    } else if (!empty($data->OtherAttributes->CONDIMENTS)) {
        $category_name = 'CONDIMENTS';
        $subcategory_name = $data->OtherAttributes->CONDIMENTS;
    } else if (!empty($data->OtherAttributes->GROCERY)) {
        $category_name = 'GROCERY';
        $subcategory_name = $data->OtherAttributes->GROCERY;
    } else if (!empty($data->OtherAttributes->BABYCHILD)) {
        $category_name = 'BABYCHILD';
        $subcategory_name = $data->OtherAttributes->BABYCHILD;
    } else if (!empty($data->OtherAttributes->BREAKFAST)) {
        $category_name = 'BREAKFAST';
        $subcategory_name = $data->OtherAttributes->BREAKFAST;
    } else if (!empty($data->OtherAttributes->PASTA)) {
        $category_name = 'PASTA';
        $subcategory_name = $data->OtherAttributes->PASTA;
    } else if (!empty($data->OtherAttributes->HOME)) {
        $category_name = 'HOME';
        $subcategory_name = $data->OtherAttributes->HOME;
    } else if (!empty($data->OtherAttributes->PETNEEDS)) {
        $category_name = 'PETNEEDS';
        $subcategory_name = $data->OtherAttributes->PETNEEDS;
    } else if (!empty($data->OtherAttributes->MEATSPOULTRY)) {
        $category_name = 'MEATSPOULTRY';
        $subcategory_name = $data->OtherAttributes->MEATSPOULTRY;
    } else if (!empty($data->OtherAttributes->GLUTEN)) {
        $category_name = 'GLUTEN';
        $subcategory_name = $data->OtherAttributes->GLUTEN;
    } else if (!empty($data->OtherAttributes->ALCOHOL)) {
        $category_name = 'ALCOHOL';
        $subcategory_name = $data->OtherAttributes->ALCOHOL;
    } else {
        $category_name = '';
        $subcategory_name = '';
    }

    //Database insert start one by one...
    // echo ($userId." and ".$id." and ".$title." and ".$complated."<br>");
    /* if (count($deleteFromDatabase_tmparr2) > 0) { 
       // query = '';
    } else {
        $query = "INSERT IGNORE INTO `product_tbl2`(`UPC_CODE`, `COSTCO_ITEM`, `DESCRIPTION`, `StockingUOM`, `PricingUOM`, `SIZE`, `MAIN_CATEGORY`, `COST`, `sale_price`, `sale_date_start`, `sale_date_end`, `ItemComment1`, `ItemComment2`,`ADMIN`,`GST`,`HST`,`PST`,`category_name`,`subcategory_name`) VALUES('$ItemNumber','$ItemNumberFmt','$ItemDescriptionNew','$StockingUOM','$PricingUOM','$size','$Category','$BasePrice','$SalePrice','$SaleDateStart','$SaleDateEnd','$ItemComment1New','$ItemComment2New','$ADMIN','$GST','$HST','$PST','$category_name','$subcategory_name')";
    } */

    $status = '1';

    $query = "INSERT IGNORE INTO `product_tbl2`(`UPC_CODE`, `COSTCO_ITEM`, `DESCRIPTION`, `StockingUOM`, `PricingUOM`, `SIZE`,`WeightUnit`, `MAIN_CATEGORY`, `COST`, `sale_price`, `sale_date_start`, `sale_date_end`, `ItemComment1`, `ItemComment2`,`NNC_DESC`,`ADMIN`,`GST`,`HST`,`PST`,`category_name`,`subcategory_name`,`item_class`,`status`) VALUES('$ItemNumber','$ItemNumberFmt','$ItemDescriptionNew','$StockingUOM','$PricingUOM','$WeightQty','$WeightUnit','$Category','$BasePrice','$SalePrice','$SaleDateStart','$SaleDateEnd','$ItemComment1New','$ItemComment2New','$AccountSet','$ADMIN','$GST','$HST','$PST','$category_name','$subcategory_name','$ItemClass','1')";
    if ($result = mysqli_query($link, $query)) {
        $data2['status'] = 201;
        echo json_encode($data2);
    } else {
        $data2['status'] = 601;
        $data2['error'] = $link->error;
        echo json_encode($data2);
    }
    //api data insert one by one in 2nd array for matching the database array.
    array_push($deleteFromDatabase_tmparr2, $ItemNumber);
}
/* } */
//test start
$deleteFromDatabase_mainquery = mysqli_query($link, "SELECT `UPC_CODE` FROM `product_tbl2`");
$deleteFromDatabase_tmparr1 = array();
// Push local table ItemNumber's in empty array
foreach ($deleteFromDatabase_mainquery as $row) {
    //table data insert one by one in 1st array for matching the database array.
    array_push($deleteFromDatabase_tmparr1, $row['UPC_CODE']);
}
// Add a joint array excluding excess records.
$deleteFromDatabase_finalqr = array_intersect($deleteFromDatabase_tmparr2, $deleteFromDatabase_tmparr1);
//print_r('<p style="color:red">'.$deleteFromDatabase_finalqr.'</p>');
//echo '<p style="color:red">'.implode("', '", $deleteFromDatabase_finalqr).'</p>';
// Delete data from live table where ItemNumbers are not present in new joint array
//$in = "'".implode("', '", $deleteFromDatabase_finalqr)."'";
//mysqli_query($link, "DELETE FROM `product_tbl2` WHERE `UPC_CODE` NOT IN ('$in')");
//mysqli_query($link, "DELETE FROM `product_tbl2` WHERE `UPC_CODE` NOT IN ('" . implode( "', '" , $deleteFromDatabase_finalqr ) . "' )");
//test end
//$deleteIfStatus = $wpdb->query('DELETE FROM '.$table_name_temp.' WHERE id NOT IN (' . implode(',',  $updateJobsDatabase_mainquery) . ')');

// $link->query('DELETE FROM product_tbl2 WHERE UPC_CODE NOT IN (\'' . implode("','", $deleteFromDatabase_finalqr) . '\')');

//delete to update
$link->query('UPDATE product_tbl2 SET status = "2" WHERE UPC_CODE NOT IN (\'' . implode("','", $deleteFromDatabase_finalqr) . '\')');
?>