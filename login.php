<?php
//$rights = $myPage->getPageAuthorizations();
$username = $_POST["name"];
$password = $_POST["email"];;

echo $username;

try
  {
  
if($username && $password){

  echo "this is true"+$username+$password; 
}
else{
  header( 'Location: http://192.168.50.56/secure/login.html' ) ;
}
} catch(exception $e) {echo $e->getMessage();}
/*
function sksort(&$array, $subkey="id", $sort_ascending=false) {

    if (count($array))
        $temp_array[key($array)] = array_shift($array);

    foreach($array as $key => $val){
        $offset = 0;
        $found = false;
        foreach($temp_array as $tmp_key => $tmp_val)
        {
            if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
            {
                $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                                            array($key => $val),
                                            array_slice($temp_array,$offset)
                                          );
                $found = true;
            }
            $offset++;
        }
        if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
    }

    if ($sort_ascending) $array = array_reverse($temp_array);

    else $array = $temp_array;
}

function getTeamValues($readers, $teamNumber, $teamType, $dbApp){
  $teamReadCount = 0 ; 
      $teamQueue = 0 ; 
     if($teamNumber == false){
        foreach($readers as $reader){
        
          $id = $reader['reader_id']; 
          $read_count =  $dbApp->getReaderReadCount($id); 

          $reader['read_count'] = $read_count; 
          $teamReadCount += $read_count; 
          //$teamMembers[$title][] = $reader;
          //$myPage->setWebValue($title, $teamMembers[$title]);
          $info ["readers"][] = $reader;  
        
      }

     }
     else{
      foreach($readers as $reader){
        if($teamNumber == $reader['group_number'] && $teamType == $reader['group_type']){
          $id = $reader['person_id']; 
          $read_count =  $dbApp->getReaderReadCount($id); 
          $read_assigned =  $dbApp->getReaderAssignedCount($id); 
      
          $reader['read_count'] = $read_count; 
          $teamReadCount += $read_count; 
          $reader['read_assigned'] = $read_assigned; 
          $teamQueue += $read_assigned; 
          //$teamMembers[$title][] = $reader;
          //$myPage->setWebValue($title, $teamMembers[$title]);
          $info ["readers"][] = $reader;  
        }
        $teams["team_queue"] = $teamQueue;
      }
     }
      

      $teams["team_count"] =  $teamReadCount;
      
      $info ["teams"] = $teams ; 
      return $info; 
      
      
    
}

function webValues($readers, $team_list, $total_count, $total_queue, $myPage){

  /*print('<pre>');
           print_r($team_list);
  print('</pre>');

    $myPage->setWebValue("readers", $readers); 
    $myPage->setWebValue("team_list", $team_list);
    $myPage->setWebValue("total_count", $total_count);
    $myPage->setWebValue("total_queue", $total_queue);
}

function getUserTeam($userId, $readers, $dbApp){
  foreach($readers as $reader){
      if($reader['person_id'] == $userId){
        $userTeamInfo['teamNumber'] = $reader['group_number']; 
        $userTeamInfo['teamType'] = $reader['group_type'];
      }
    }
    return $userTeamInfo;
}

function createReassignTable($readers_select, $readerId){

  $table='<tr class="reassign-table"><td colspan="4"><div class="section"><div class="reassign-wrapper"><div class="gray">Reassign selected applicant(s)';
  $table =$table.'</div><select class="reassign-input" id="select'.$readerId.'"name="readers">';
  $table =$table.'<option disabled selected>Select One</option>';
  sksort($readers_select, "reader_name", TRUE);
  foreach($readers_select as $reader){
    $table  =$table.'<option value="'.$reader['person_id'].'">'.$reader['reader_name'].'</option>';
  }
  $table =$table.'</select><div class="blue save-reassign admin" data-newId="'.$reader['person_id'].'" value="'.$readerId.'">Save</div></div>';
  $table =$table.'</td></tr>';
  return $table; 
}

function createIndividualTable($dbApp, $readerId, $readers_select, $readers_all){
  $appQueue = $dbApp->getAllAssignedByReader($readerId); 
  $appRead = $dbApp ->getAllScoresByReader($readerId); 


  if($appQueue!=Null){
     $indTable = '<div class="section" id=table"'.$readerId.'"><table class="part-table gray-table" id="'.$readerId.'"><tr><th class="ind-id app-queue-wrapper">Applicants in Queue</th><th class="ind-name">Also Read by</th><th class="ind-date">Date</th><th class="ind-drop"></th></tr>'; 
    foreach($appQueue as $queue){
    $appId = $dbApp->getApplicationIdFromPersonId($queue['person_id']);
    $indTable =$indTable.'<tr><td>'.$appId.'</td><td>John</td><td>6/10/1992</td><td><i aria-hidden="true" value="'.$readerId.'"id="'.$appId.'" class="fa fa-square-o blue check"></i></td></tr>';


  }
  if($readers_all){
  $indTable=$indTable.createReassignTable($readers_all, $readerId); 

  }
  else{
  $indTable=$indTable.createReassignTable($readers_select, $readerId); 
   }
 
     $indTable=$indTable."</table>";
}
  else{
  $indTable= "<div class='section' id='table".$readerId."'><br><br><div class='gray'>No Applicants in Queue!</div><br><br>";
  }
  

  

                                  
                                

 
  $indTable=$indTable.'<table class="part-table gray-table"><tr><th class="ind-id">Applicants Read</th><th class="ind-name">Also Read by</th><th class="ind-date">Date</th><th class="ind-drop"><i aria-hidden="true" class="arrow fa blue fa-chevron-circle-down"></i></th></tr><tr class="info-row"><td colspan="4"><table class="part-table gray-table">';
  foreach($appRead as $read){
     $appId = $dbApp->getApplicationIdFromPersonId($read['person_id']); 
    $indTable =$indTable.'<tr><td class="ind-id">'.$appId.'</td><td class="ind-name">John SoandSo'./*$read['read_by'].'</td><td class="ind-date">06/10/92'/*.$read['date'].'</td><td></td></tr>';
  }
  $indTable=$indTable."</table></td></tr></table></div>";
  return $indTable;  
}

function createTeamTable($dbApp, $readers_select, $readers_all){
  $teamTable='<div class="section1"><table class="gray-table full-table"><tr>';
  
  $teamTable= $teamTable.'<th id="summary-table">Team Member</th>';
  $teamTable=$teamTable.'<th>Ind. Queue</th><th>Ind. Total</th><th></th></tr>';
  sksort($readers_select, "reader_name", TRUE);
  sksort($readers_select, "group_admin", False);
  foreach($readers_select as $reader){
    

    $teamTable=$teamTable.'<tr><td>'.$reader['reader_name'].'</td><td id="que-'.$reader['person_id'].'">'.$reader['read_assigned'].'</td>';
    $teamTable=$teamTable.'<td>'.$reader['read_count'].'</td><td><i aria-hidden="true" class="arrow fa fa-chevron-circle-down blue indivTable" value="'.$reader['person_id'].'"></i></td></tr>';
    $teamTable=$teamTable.'<tr class="info-row"><td class="table-info" colspan="4"><div class="section" id="table'.$reader['person_id'].'"></div></tr></td>'; 
  }
  $teamTable=$teamTable.'</table><br><br></div>';
  
  return $teamTable; 
}

function createMissingTeamTable($dbApp, $unassignedReaders){
  
  

  $teamTable='<div class="section1"><table class="gray-table full-table"><tr>';
  
  $teamTable= $teamTable.'<th id="summary-table">Team Member</th>';
  $teamTable=$teamTable.'<th>Ind. Queue</th><th>Ind. Total</th><th></th></tr>';
  
  sksort($unassignedReaders, "sort_name", TRUE);
  
  foreach($unassignedReaders as $reader){
    

    $teamTable=$teamTable.'<tr><td>'.$reader['sort_name'].'</td>';
    $teamTable=$teamTable.'<td>'.$reader['read_count'].'</td><td><i aria-hidden="true" class="arrow fa fa-chevron-circle-down blue noTeamTable" value="'.$reader['reader_id'].'"></i></td></tr>';
    $teamTable=$teamTable.'<tr class="info-row"><td class="table-info" colspan="4"><div class="section" id="table'.$reader['reader_id'].'"></div></tr></td>'; 
  }
  $teamTable=$teamTable.'</table><br><br></div>';
  
  return $teamTable; 
}

function getLeaders($allReaders){
  foreach($allReaders as $reader){
    if($reader['group_admin'] =='Y'){
      $leader[]=$reader;
    }
  
  }

  
  if($leader){

  }
  else{
  	$leader=False;
  }
  return $leader; 
}

function createAdminTable($dbApp, $readers_all){
  $adminTable = '<div class="section"><table id="insert_table" class="full-table admin-table main-table">';
  $adminTable= $adminTable.'<tr><th id="admin-number">Team</th><th id="admin-type">Type</th><th id="admin-lead">Team Leader</th><th>Team Queue</th><th>Team Total</th>';
  $adminTable= $adminTable.'<th></th></tr>';
  $leaders = getLeaders($readers_all); 
        sksort($leaders, "group_number", False);
        sksort($leaders, "group_type", True);

  foreach($leaders as $leader){
    $info = getTeamValues($readers_all,$leader['group_number'], $leader['group_type'], $dbApp);
    $teams  = $info['teams'];
    $teamTable = createTeamTable($dbApp, $info['readers'], $readers_all);
    $adminTable= $adminTable.'<tr><td>'.$leader['group_number'].'</td><td>'.$leader['group_type'].'</td><td>'.$leader['reader_name'].'</td><td class="team-queue team-'.$leader['group_number'].$leader['group_type'].'">'.$teams['team_queue'].'</td>';
    $adminTable= $adminTable.'<td>'.$teams['team_count'].'</td><td><i aria-hidden="true" class="arrow fa fa-chevron-circle-down blue"></i></td>';
    $adminTable= $adminTable.'</tr><tr class="admin-expand"><td colspan="6">';
   
    $adminTable= $adminTable.$teamTable; 
  }
  
$unassignedReaders = $dbApp->getAdmdecReadersNoLongerAssigned(); 
  
  

    $info = getTeamValues($unassignedReaders,false, false, $dbApp);
    $teams  = $info['teams'];

    $missingTable = createMissingTeamTable($dbApp, $info['readers']);
    $adminTable= $adminTable.'<tr><td>None</td><td>---</td><td>No Team</td><td class="team-queue team-00">---</td>';
    $adminTable= $adminTable.'<td>'.$teams['team_count'].'</td><td><i aria-hidden="true" class="arrow fa fa-chevron-circle-down blue"></i></td>';
    $adminTable= $adminTable.'</tr><tr class="admin-expand"><td colspan="6">';
   
    $adminTable= $adminTable.$missingTable; 


  
  $adminTable= $adminTable.'<br><br></table></div>'; 
  return $adminTable; 
}

function getAllTotals($readers_all, $dbApp){
  $total_queue=0; 
  $total_count=0; 
  foreach($readers_all as $reader){
          $total_count = $total_count+ $dbApp->getReaderReadCount($reader['person_id']); 
          $total_queue = $total_queue+ $dbApp->getReaderAssignedCount($reader['person_id']);  
  }
  $numbers['count'] = $total_count;
  $numbers['queue'] = $total_queue;
  return $numbers; 
}

function getAllTechnicalDifficulties($readers_all, $dbApp, $rights, $userId){
  $html =""; 

  
   //all tech problems are being forwarded to Kelly so if you only look through hers it will go faster

      if($rights == 'admin'){
      $tech_problems =$dbApp->getAllTechProblems(); 
      if(!empty($tech_problems)){ 
      sksort($tech_problems, "send_date", False);

        foreach($tech_problems as $tech){
          foreach($readers_all as $read){
            if($read['person_id']== $tech['sender_id']){
              $name = $read["reader_name"];
              
            }
            print("<pre>");
            print_r($tech);
            print("</pre>");
           
          }
           if(!$name){
              $name= $tech['sender_id'];
            }
           $date = explode(" ", $tech['send_date']);
          $appId = $dbApp->getApplicationIdFromPersonId($tech['person_id']);
          $html =$html.'<tr><td>'.$appId.'</td><td>'.$name.'</td><td>'.$date[0].'</td><td class="reason">'.$tech['score_note'].'</td>' ;
          $html =$html.'<td class="blue send-back tech" value="'.$appId.'" data-ownerId="'.$tech['reader_id'].'" data-newId="'.$tech['sender_id'].'" id=attention'.$appId.$tech['sender_id'].'>send back</td><td><i id='.$appId.' value="'.$tech['sender_id'].'" aria-hidden="true" class="fa fa-square-o blue check tech" data-ownerId="'.$tech['reader_id'].'"  data-userId="'.$tech['sender_id'].'"></i></td></tr>'; 

        }

    }
  }
  
  
     
         
          
  
return $html;

}

function getAllGl($readers_all, $dbApp, $rights, $userId){
  $html =""; 

  
    if($rights == 'admin'){
      $tech_problems =$dbApp->getAllGlProblems(); 
      if(!empty($tech_problems)){ 
        sksort($tech_problems, "send_date", False);
        foreach($tech_problems as $tech){
          foreach($readers_all as $read){
            if($read['person_id']== $tech['sender_id']){
              $name = $read["reader_name"];
              
            }
           
          }
           
           if(!$name){
              $name= $tech['sender_id'];
            }
           $date = explode(" ", $tech['send_date']);
          $appId = $dbApp->getApplicationIdFromPersonId($tech['person_id']);
          $html =$html.'<tr><td>'.$appId.'</td><td>'.$name.'</td><td>'.$date[0].'</td><td class="reason">'.$tech['score_note'].'</td>' ;
          $html =$html.'<td class="blue send-back" value="'.$appId.'" data-ownerId="'.$tech['reader_id'].'" data-newId="'.$tech['sender_id'].'" id=attention'.$appId.$tech['sender_id'].'>Clear</td><td><i id='.$appId.' value="'.$tech['sender_id'].'" aria-hidden="true" class="fa fa-square-o blue check" data-ownerId="'.$tech['reader_id'].'"  data-userId="'.$tech['sender_id'].'"></i></td></tr>'; 

        }

    }
  }
  else{
    $tech_problems =$dbApp->getAllGlProblemsByReader($userId);    
       if(!empty($tech_problems)){
		sksort($tech_problems, "send_date", False);
        foreach($tech_problems as $tech){
          foreach($readers_all as $read){
            if($read['person_id']== $tech['sender_id']){
              $name = $read["reader_name"];
              
            }
           
          }
           if(!$name){
              $name= $tech['sender_id'];
            }
           $date = explode(" ", $tech['send_date']);
          $appId = $dbApp->getApplicationIdFromPersonId($tech['person_id']);
          $html =$html.'<tr><td>'.$appId.'</td><td>'.$name.'</td><td>'.$date[0].'</td><td class="reason">'.$tech['score_note'].'</td>' ;
          $html =$html.'<td class="blue send-back" value="'.$appId.'" data-ownerId="'.$userId.'"  data-newId="'.$tech['sender_id'].'" id=attention'.$appId.$tech['sender_id'].'>Clear</td><td><i id='.$appId.' value="'.$tech['sender_id'].'" aria-hidden="true" class="fa fa-square-o blue check" data-ownerId="'.$userId.'" data-userId="'.$tech['sender_id'].'"></i></td></tr>'; 

        }
          
    }
  }
       
         
          
  
return $html;

}
function buildAttentionTable($readers_all, $dbApp, $group_leader, $rights, $userId){

 
   $technicalDifficulties = getAllTechnicalDifficulties($readers_all, $dbApp, $rights, $userId); 
$glDifficulties = getAllGl($readers_all, $dbApp, $rights, $userId); 
  if($glDifficulties!=""){
    $attentionTable1 = "<div class='full-header'>Group Leader Table</div>";
     $attentionTable1  =  $attentionTable1.'<table class="full-table glTable"><tr><th id="techAppId" class="app-queue-wrapper">Applicant</th><th id="techReader">Forwarded by</th><th id="techDate">Date</th>';
  $attentionTable1  =  $attentionTable1.'<th id="techReasons">Reason</th><th id="techSend"></th><th id="techCheck"></th></tr><tr></tr>';
  $attentionTable1  =  $attentionTable1.$glDifficulties; 
  $attentionTable1 = $attentionTable1.createReassignTable($readers_all, 'gl');
  $attentionTable1 = $attentionTable1."</table>";
}
else{
  $attentionTable1='<div class="full-header">Group Leader Table</div><div class="gray">There are no more items in the Group Leader Table</div><br><br>';
}
 if($technicalDifficulties!=""&& $group_leader){

  $attentionTable2 = "<div class='full-header'>Technical Table</div>";
  $attentionTable2  =  $attentionTable2.'<table class="full-table techTable"><tr><th id="techAppId" class="app-queue-wrapper">Applicant</th><th id="techReader">Forwarded by</th><th id="techDate">Date</th>';
  $attentionTable2  =  $attentionTable2.'<th id="techReasons">Reason</th><th id="techSend"></th><th id="techCheck"></th></tr><tr></tr>';
  $attentionTable2  =  $attentionTable2.$technicalDifficulties; 
  $attentionTable2 = $attentionTable2.createReassignTable($readers_all, 'tech');
  $attentionTable2 = $attentionTable2."</table>";
  }
  else{
    $attentionTable2='<div class="full-header">Technical Table</div><div class="gray">There are no more items in the Tech Table</div><br><br>';
  }

  $attentionTableCombined=$attentionTable1.$attentionTable2;

  return $attentionTableCombined; 
}

*/
?>
