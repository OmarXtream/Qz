<?php

require 'config/phphead.php';
require_once('includes/header.php');
require_once('includes/topbar.php');
require_once('includes/sidebar.php');
    // ini_set('display_errors', 'On');
    // error_reporting(E_ALL);

    $db1['type1']="mysql";
    $db1['host1']="localhost";
    $db1['user1']="root";
    $db1['pass1']="qvaGN6vy9EaZMw5l";
    $dbname = "Rankqz";	
    $dbname2 = "simple";	
    if ($db1['type1'] == 'mysql') {
        $dboptions = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true
        );
    } else {
        $dboptions = array();
    }

    $dbserver  = $db1['type1'].':host1='.$db1['host1'].';';

    try {
        $mysqlcon = new PDO($dbserver, $db1['user1'], $db1['pass1'], $dboptions);
    } catch (PDOException $e) {
        $sqlconerr = "ERROR cfg #97 - Please Contact Administrators.";
        echo $sqlconerr;
        exit;
    }




    $exceptgroup = array (1553,1556,1554,1557,1555,1672,10,89,90,75,1007,1146,131);

    if ( isset($_GET['top']) ){
        if ( $_GET['top'] === 'week'){
            $dbdata = $mysqlcon->query("SELECT s.uuid,count,s.count_week,s.idle_week,u.name,u.online,u.cldgroup FROM $dbname.stats_user AS s INNER JOIN $dbname.user AS u ON s.uuid = u.uuid WHERE s.removed='0' ORDER BY s.count_week DESC LIMIT 11");
		 $texttime = '%s ساعة';	
		$weekI = true ;		 
        }elseif ($_GET['top'] === 'month') {
            $dbdata = $mysqlcon->query("SELECT s.uuid,count,s.count_month,s.idle_month,u.name,u.online,u.cldgroup FROM $dbname.stats_user AS s INNER JOIN $dbname.user AS u ON s.uuid = u.uuid WHERE s.removed='0' ORDER BY s.count_month DESC LIMIT 11");
		 $texttime = '%s ساعة';		
		$monthI = true ;		 
        }else{
            $dbdata = $mysqlcon->query("SELECT uuid,name,count,idle,cldgroup,online,grpid FROM $dbname.user ORDER BY count DESC LIMIT 11");
        }
    }else{
        $dbdata = $mysqlcon->query("SELECT uuid,name,count,idle,cldgroup,online,grpid FROM $dbname.user ORDER BY count DESC LIMIT 11");
		$texttime = '%s ساعة';			
    }

    $searchmysql = 'WHERE uuid LIKE \'%'.$uid.'%\'';

    $medata = $mysqlcon->query("SELECT * FROM $dbname.user $searchmysql");
    $me = $medata->fetchAll();

    $db_arr = $dbdata->fetchAll();
    $count10 = 0;


    foreach ($db_arr as $client_client) {
        $sgroups  = explode(",", $client_client['cldgroup']);
        if (!array_intersect($sgroups, $exceptgroup)) {
            if ($count10 == 10) break;
		if ($substridle == 1) {
			$hours = $client_client['count'] - $client_client['idle'];
		} else {
			$hours = $client_client['count'];
		}			
            foreach($LEVELS_ARRAY as $LEVEL_iD){
                if(in_array($LEVEL_iD,$sgroups)){
                    $TOP_LEVEL = $LEVEL_iD;
                    break;
                };
            }
			
            $client_data[$count10] = array(
            'uid'       => $client_client['uuid'],
            'name'      =>  $client_client['name'],
			'count'		=>	$hours,			
            'groups_bad'=>  $sgroups,
            'groups'    =>  $LEVEL_iD,
            'online'    =>  $client_client['online'],
            );
            $count10++;
        }
    }

    for($count10 = $count10; $count10 < 10; $count10++) {
        $client_data[$count10] = array(
            'uid'       => '',
            'name'      =>  "<i>unkown</i>",
			'count'		=>	$hours,			
            'groups_bad'=>  array(),
            'groups'    => '0',
            'online'    =>  "0",
        );
    }
?>
<link href="dist/css/pages/user-card.css" rel="stylesheet">
        <div class="page-wrapper">
            <div class="container-fluid">
<br>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"></h4>
										<?php
                                            if ( isset($_GET['top']) ){
                                                if ( $_GET['top'] === 'week'){
                                                    echo '<center><br><h4 class="card-title">افضل الاعضاء - لهذا الاسبوع</h4>';
                                                }elseif ($_GET['top'] === 'month') {
                                                    echo '<center><br><h4 class="card-title">افضل الاعضاء - لهذا الشهر';
                                                }else{
                                                    echo '<center><br><h4 class="card-title">افضل الاعضاء - طوال الوقت';
                                                }
                                            }else{
                                                echo '<center><br><h4 class="card-title">افضل الاعضاء - طوال الوقت';
                                            }
                                        ?>
                                <div class="table-responsive">
                                    <table class="table color-table warning-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>الوقت</th>
                                                <th>الحالة</th>
												<th>اللفل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tbody>

                                            <?php
                                                $isInTop = true;
                                                foreach($client_data as $top_num=>$top_client){
                                                    if ( $top_client['uid'] === $uid ){
                                                        $isInTop = true;
                                                    }
                                                    $top_key = $top_num + 1;
                                                    $strii = 'WHERE UID=\''.$top_client['uid'].'\'';
													
                                                    $sql = $mysqlcon->query("SELECT * FROM $dbname2.Users $strii");
                                                    $SQLUsers = $sql->fetchAll();
                                                    if ( isset ( $SQLUsers[0]['UID'] ) ){
                                                        $profile_url = "https://panel.q-z.us/profile/".$SQLUsers[0]['user'];
                                                    }else{
                                                        $profile_url = "#";
                                                    }											
                                                    echo'<tr>';
                                                        echo ( '<td align="center"><font  size="4">'.$top_key.'</td>' );
                                                        if( $top_client['uid'] == 'rLsT0G5kuzvnsftf0jS39LVZUTY=' ){
                                                            echo '<td><div id="s_text" class="terminal font-w600" style="direction:ltr;">'.$top_client['name'].'</div></td>';
                                                        }elseif(in_array(1953,$top_client['groups_bad']) ){
                                                            echo '<td><font  size="4" color="#646464">'.$top_client['name'].'</td>';
                                                        }else{
                                                            echo '<td><font  size="4" color="#646464">'.$top_client['name'].'</td>';
                                                        }
													if ( $weekI == true || $monthI == true   ) {
													echo '<td>~</td>';	
													} else {
													echo '<td>'.sprintf($texttime, round(($top_client['count']/3600))).'</td>';
													}
													if($top_client['online'] == false){ $sta = "<span class='label label-danger'>غير متصل </span>"; }else{ $sta = "<span class='label label-success'>متصل</span>"; }
													echo '<td>'. $sta .'</td>';		
													
                                                    echo '<td align="center"><img src="https://panel.q-z.us/Rank/tsicons/'.$top_client['groups'].'.png" ></td>';
                                                    echo '</tr>';                                                   
                                                }
                                                if ( $isInTop === false ){
                                                    if ( isset ( $me[0]['uuid'] ) ){
                                                        $sgroups  = explode(",", $me[0]['cldgroup']);
                                                        echo'<tr>';
                                                        echo ( '<td align="center"><font  size="4">'.( $me[0]['rank'] ).'</td>' );
                                                        if(in_array(10,$sgroups) ){ 
                                                            echo '<td align="center" style="direction: ltr;">';
                                                            echo '<img src="https://panel.q-z.us/Rank/tsicons/741.png">';
                                                            echo '<img src="https://panel.q-z.us/Rank/tsicons/742.png">';
                                                            echo '<img src="https://panel.q-z.us/Rank/tsicons/743.png">';
                                                            echo '<img src="https://panel.q-z.us/Rank/tsicons/744.png">';
                                                            echo '<img src="https://panel.q-z.us/Rank/tsicons/745.png">';
                                                            echo '<img src="https://panel.q-z.us/Rank/tsicons/746.png">';
                                                            echo '<img src="https://panel.q-z.us/Rank/tsicons/748.png">';
                                                            echo '<img src="https://panel.q-z.us/Rank/tsicons/787.png">';
                                                            echo '<img src="https://panel.q-z.us/Rank/tsicons/788.png">';
                                                            echo '</td>';
                                                        }else{
                                                            echo '<td align="center"><font  size="4">'.$me[0]['name'].'</td>';
                                                        }
                                                        echo '<td align="center"><img src="https://panel.q-z.us/Rank/tsicons/'.$me[0]['grpid'].'.png" ></td>';
                                                        echo '</tr>';        
                                                    }
                                                }
                                            ?>
                                        </tbody>										
                                    </table>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
<?php require_once('includes/footer.php'); ?>