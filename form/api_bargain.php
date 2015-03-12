<?php
if ($Module == 'bargain') {
    header('Content-type: application/json');
//    $token = getallheaders();
//    $token = $token['Authorization'];
//    $token = substr($token, 7);
//
//    $arr = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `user_id`, `expired` FROM `oauth_apps_codes`
//    WHERE `token`='$token'"));
//    $user_id = $arr['user_id'];
//    if (floatval($arr['expired']) >= floatval(strtotime('now'))) {
        $Row = mysqli_query($CONNECT, "SELECT * FROM bargain WHERE managerID='$user_id'");
        $response = array(
            "page"=>1,
            "count_entry"=>0,
            "per_page"=>5,
            "count_page" => 0

        );
        $i = 0;

        while ($myrowbargain = mysqli_fetch_array($Row))
        {
//            $selclient = mysqli_query($CONNECT, "SELECT * FROM clients WHERE clientID='$myrowbargain[clientID]'");
//            $myrowclient = mysqli_fetch_array($selclient);


            $response[$i] = array(
//                "company"=>$myrowclient['company'],
//                "fio"=>$myrowclient['lastName'].' '.$myrowclient['firstName'].' '.$myrowclient['secondName'],
                "clientID"=>$myrowbargain['clientID'],
                "link"=>'http://www.rosescrm.brottys.ru/edit_bargain_form.php?bargainID='.$myrowbargain['bargainID'],
//                "telephone"=>$myrowclient['telephone'],
                "statusBargain"=>$myrowbargain['statusBargain'],
                "budget"=>$myrowbargain['budget']
            );
            $i++;
        }

        if ($_GET['per_page'] != 'all')
        {
            $per_page = 5;
            if ($_GET['per_page']) {$per_page = $_GET['per_page'];}

            $page_count = round($i/$per_page, 0, PHP_ROUND_HALF_UP);
            if ($i%$per_page != 0) {$page_count++;}

            if ($_GET['page']){
                $response_paging = array_slice($response, ($_GET['page']-1)*5, $per_page);
            }
            else {$response_paging = $response;}

            $response_paging['page']=floatval($_GET['page']);
            $response_paging['count_entry']=$i;
            $response_paging['per_page']=floatval($per_page);
            $response_paging['count_page']= $page_count;

            $jsonString = json_encode($response_paging);
        }
        else {
            $response['page']=1;
            $response['count_entry']=$i;
            $response['per_page']=$per_page;
            $response['count_page']= 1;
            $jsonString = json_encode($response);
        }

        echo $jsonString;
//    }
//    else {
//        $response = array(
//            "token"=>$token,
//            "Error"=>"Истекло время действия сессии"
//        );
//        $jsonString = json_encode($response);
//        echo $jsonString;
//        header("HTTP/1.0 401 Unauthorized");
////        echo 'Expired: '.floatval($arr['expired']).'     Текущее время: '.floatval(strtotime('now'));
//    }
}
//
//if ($Module == 'edit_bargain') {
//# Полученние всех необходимых данных с формы и из базы данных
//if (isset($_POST['bargainID'])) {$bargainID = $_POST['bargainID']; if ($bargainID == '') {unset($bargainID);} }
//if (isset($_POST['managerName'])) {$managerName = $_POST['managerName']; if ($managerName == '') {unset($managerName);} }
//if (isset($_POST['clientID'])) {$clientID = $_POST['clientID']; if ($clientID == '') {unset($clientID);} }
//if (isset($_POST['plantation'])) {$plantation = $_POST['plantation']; if ($plantation == '') {unset($plantation);} }
//if (isset($_POST['sort'])) {$sort = $_POST['sort']; if ($sort == '') {unset($sort);} }
//if (isset($_POST['length'])) {$length = $_POST['length']; if ($length == '') {unset($length);} }
//if (isset($_POST['count'])) {$count = $_POST['count']; if ($count == '') {unset($count);} }
////if (isset($_POST['managerID'])) {$managerID = $_POST['managerID'];if ($managerID == '') {unset($managerID);}}
////if (isset($_POST['zakazID'])) {$zakazID = $_POST['zakazID'];if ($zakazID == '') {unset($zakazID);}}
//if (isset($_POST['city'])) {$city = $_POST['city'];if ($city == '') {unset($city);}}
//if (isset($_POST['statusBargain'])) {$statusBargain = $_POST['statusBargain'];if ($statusBargain == '') {unset($statusBargain);}}
//if (isset($_POST['budget'])) {$budget = $_POST['budget'];if ($budget == '') {unset($budget);}}
//if (isset($_POST['note'])) {$note = $_POST['note'];if ($note == '') {unset($note);}}
//# Получение ID сорта
//$db = mysql_connect("localhost", "user43199_roses", "jGTlDnaC");
//mysql_select_db("user43199_roses", $db);
//mysql_set_charset('utf8');
//$result = mysql_query("SELECT sortID FROM zakaz WHERE zakazID = (SELECT zakazID FROM bargain WHERE bargainID=".$bargainID.")");
//$myrow = mysql_fetch_array($result);
//$sortID = $myrow['sortID'];
//
//
//
////if (isset($_POST['statusClient']) && isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['secondName'])
//// && isset($_POST['sex']) && isset($_POST['company']) && isset($_POST['carier']))
////{
//// $result = mysql_query("INSERT INTO clients (statusClient, lastName, firstName, secondName, sex, company, carier, telephone, email, city, web, skype, address, verificity)
////VALUES (N'$statusClient', N'$lastName', N'$firstName', N'$secondName', N'$sex', N'$company', N'$carier', N'$telephone', N'$email', N'$city', N'$web', N'$skype', N'$address', N'$verificity')");
//
//
////обновляю данные плантации, сорта и необходимой длины розы
//
//$result = mysql_query("UPDATE  `user43199_roses`.`sort` SET
//`sort` =  '$sort',
//`plantation` =  '$plantation',
//`length` =  '$length'
//WHERE  `sort`.`sortID` =".$sortID);
//
//$result = mysql_query("UPDATE  `user43199_roses`.`bargain` SET
//`statusBargain` =  '$statusBargain',
//`budget` =  '$budget',
//`note` =  '$note'
//WHERE  `bargain`.`bargainID` =".$bargainID);
//
//$result = mysql_query("select cityID from city where city ='$city'");
//$myrow = mysql_fetch_array($result);
//$cityID = $myrow['cityID'];
//
//$result = mysql_query("UPDATE  `user43199_roses`.`bargain` SET
//`cityID` =  '$cityID'
//WHERE  `bargain`.`bargainID` =".$bargainID);
//
//$result = mysql_query("select zakazID from bargain where bargainID =".$bargainID);
//$myrow = mysql_fetch_array($result);
//$zakazID = $myrow['zakazID'];
//
//$result = mysql_query("UPDATE  `user43199_roses`.`zakaz` SET
//`count` =  '$count'
//WHERE  `zakaz`.`zakazID` =".$zakazID);
//
//if ($result)
//{
//
//    echo "<br> <br> Вы успешно добавили данные в базу данных";
//    header("HTTP/1.1 301 Moved Permanently");
//    header("Location: http://www.rosescrm.brottys.ru/bargain.php");
//    exit();
//
//}
//
//else
//{
//    echo "<br> <br>Вы ввели не полную информацию по сделке";
//
//    /* Возврат на предыдущую страницу с восстановлением прежде введенных данных */
//}
//
//}
?>