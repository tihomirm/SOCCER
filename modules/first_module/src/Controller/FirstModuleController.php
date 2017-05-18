<?php

namespace Drupal\first_module\Controller;

class FirstModuleController {

  public function hello() {

    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => 'http://api.football-data.org/v1/soccerseasons/436/leagueTable',
      CURLOPT_USERAGENT => 'Codular Sample cURL Request',
    ));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'X-Auth-Token: 4572da93b0224c96925673a5a392018a',
      'Accept: application/json',
    ));
    // Send the request & save response to $resp
    $resp = curl_exec($curl);
    // Close request to clear up some resources
    curl_close($curl);

    $data = json_decode($resp, true);

    $result='<table class="table">
       <thead>
         <tr>
           <th>Position</th>
           <th>Team</th>
           <th>Points</th>
           <th>Goals</th>
           <th>Goals Against</th>
           <th>Goals Difference</th>
           <th>Wins</th>
           <th>Draws</th>
           <th>Losses</th>
         </tr>
       </thead>
       <tbody>';
    foreach ($data['standing'] as $key => $value) {
      
      $result= $result.'
       <tr>
        <td>'.$value['position']. '</td>
        <td>'.$value['teamName']. '</td>
        <td>'. $value['points'] .'</td>
        <td>'. $value['goals'] .'</td>
        <td>'. $value['goalsAgainst'] .'</td>
        <td>'. $value['goalDifference'] .'</td>
        <td>'. $value['wins'] .'</td>
        <td>'. $value['draws'] .'</td>
        <td>'. $value['losses'] .'</td>
      </tr>';
    }
    $result=$result.'</tbody>';

    return array(
      '#markup' => t($result),
    );
  }
}
