<?php

/**
 * @author Nguyen
 * @copyright 2013
 */


function elarn_certificate_elearning_division() {
 
  $output = '';
  $result =  db_query("SELECT qnrs.score, n.title, n.nid
          FROM {quiz_node_results} qnrs
          LEFT JOIN {node} n ON n.nid = qnrs.nid
          LEFT JOIN {quiz_node_properties} qnp ON qnrs.vid = qnp.vid WHERE  qnrs.uid > 1 AND
           qnrs.score >= qnp.pass_rate GROUP by n.nid");
     $header1 = array();
     $completeRate = array();
     $Course = array();
     $scoreR = array();
     while ($row = db_fetch_object($result)) {
       $header1[] = array('data' =>$row->title);
       $Course[] = $row->nid;
      
     }
    
    $header = array(
      array('data' => t('Venue Name'), 'field' => 'division'),
      array('data' => t('Course Title') , 'field' => 'title'),
      array('data' => t('Completion Percentage'), 'field' => 'nid'),
      array('data' => t('Results by Users')),
      

      
    );
    $header = array_merge($header, $header1);
    
    $data = array();
    $query = pager_query("SELECT n.nid, COUNT(og.uid) AS c, n.title, ctc.field_division_value as division
          FROM {og_uid} og
          LEFT JOIN {users} u ON u.uid = og.uid          
          LEFT JOIN {node} n ON n.nid = og.nid
          LEFT JOIN {content_type_club} ctc ON ctc.nid = n.nid 
          WHERE og.uid > 1
          GROUP by n.nid".tablesort_sql($header), $limit = variable_get('cert_reports_pager' , 20));
        
      while ($row = db_fetch_object($query)) { //each group of Club
      $eLearners = 0;  
      $users = array(); 
         
        $result1 = db_query('SELECT uid FROM {og_uid} WHERE nid = :nid AND uid <> 1', array(':nid' => $row->nid));
         while ($user = db_fetch_object($result1)) {//each group of Club
     
         $result2 =  db_query("SELECT qnrs.score
          FROM {quiz_node_results} qnrs
          LEFT JOIN {node} n ON n.nid = qnrs.nid
          LEFT JOIN {quiz_node_properties} qnp ON qnrs.vid = qnp.vid WHERE qnrs.score >= qnp.pass_rate AND qnrs.uid = :uid", array(':uid' => $user->uid));
         
          while ($score = db_fetch_object($result2)) {         
            $eLearners += $score->score;
          }
          
          $users[] = $user->uid;
          $c = count($users);  
          $eLearners = $eLearners/$c;
        }//end user
      $scores= array();
      $c1 = count($Course);
      //
      foreach($Course as $score){
        
          $result3 =  db_query("SELECT qnrs.score, qnrs.uid
          FROM {quiz_node_results} qnrs
          LEFT JOIN {node} n ON n.nid = qnrs.nid
          LEFT JOIN {quiz_node_properties} qnp ON qnrs.vid = qnp.vid WHERE qnrs.score >= qnp.pass_rate AND qnrs.nid = :nid", array(':nid' => $score));
          $score1 = 0;
          while ($row1 = db_fetch_object($result3)) {           
              $score1 = $row1->score;  
              $user1 = $row1->uid;        
          }
          if (!in_array($user1, $users)){
            $score1 = 0;
          }
          $scores[] = round($score1/$c1).'%';       
      }
      $completeRate = $scores;
      $eLearners = $eLearners.'%';
     
      if(empty($lname) AND empty($fname)){
        $fullname = $row->name;
      }else{
        $fullname = $fname .' '. $lname;
      }
      
      $data[] = array_merge(array($row->division, l($row->title, 'node/'.$row->nid), $eLearners), $completeRate);       
  
    } //end group Club
  
  $output .= theme('table', $header, $data, $attributes = array(), $caption = t('Completion Rate by Course'));
  $output .= theme('pager');
  $output .= '<li>'.l('Export to csv', 'admin/quiz/certificate&cert-csv', array('attributes' => array('class' => 'cert-csv'))).'</li>';
  
 return $output;
}

?>