<?php
require 'sphinxapi.php';

$sphinx = new SphinxClient();
$sphinx->setServer('10.0.0.10', 9312);
$sphinx->setMatchMode(SPH_MATCH_EXTENDED2);
$sphinx->setRankingMode(SPH_RANK_PROXIMITY_BM25);
$sphinx->setLimits(0, 5); //Limit 5

$keywords = $argv[1];

//Check if query has car year.
//If positive the proper filters are applied 
//in column year_from & year_to
if(preg_match('/(19|20)\d{2}/', $keywords, $year_match)) {
    $year = $year_match[0];

    //1st Step: Select between range: 0 >= year_from <= $year
    $sphinx->setFilterRange('year_from', 0, $year, false);
    //2st Step: Select over the matches above the range: $year >= year_to <= 9999
    //Important Note: This requires to set 'year_to' value to 9999 when the field is zero.
    $sphinx->setFilterRange('year_to', $year, 9999, false);

    //Remove year from query to avoid noise of year value
    $keywords = str_replace($year, '', $keywords);
}

$result = $sphinx->query($keywords);

if ( $result === false ) {
  echo "Query failed: " . $sphinx->GetLastError() . ".\n";
}
else {
  if ( $sphinx->GetLastWarning() ) {
      echo "WARNING: " . $sphinx->GetLastWarning() . "<br>";
  }

  if ( ! empty($result["matches"]) ) {
      foreach ( $result["matches"] as $doc => $docinfo ) {
            echo "$doc\n";
      }
       
      print_r( $result );
  }
}

exit;

?>
