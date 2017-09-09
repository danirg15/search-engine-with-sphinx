<?php
require 'sphinxapi.php';

$sphinx = new SphinxClient();
$sphinx->setServer('10.0.0.10', 9312 );
$sphinx->setMatchMode( SPH_MATCH_EXTENDED2  );
$sphinx->setRankingMode(SPH_RANK_PROXIMITY_BM25);

$keywords = $argv[1];

//Check if query has car year.
//If positive the proper filters are applied 
//in column year_from & year_to
if(preg_match('/\b\d{4}\b/', $keywords, $year_match)) {
    $year = $year_match[0];
    $sphinx->setFilterRange('year_from', $year, 9999, false);
    $sphinx->setFilterRange('year_to', 0, $year, false);

    //Remove year from query to avoid noise of year value
    $keywords = str_replace($year, '', $keywords);
}

$sphinx->setLimits(0, 5);
$result = $sphinx->query($keywords);

//var_dump($result);

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
