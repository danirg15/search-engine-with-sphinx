<?php


require 'sphinxapi.php';

$sphinx = new SphinxClient();
$sphinx->setServer('10.0.0.10', 9312 );
$sphinx->setMatchMode( SPH_MATCH_EXTENDED2  );
$sphinx->setRankingMode(SPH_RANK_PROXIMITY_BM25);


//public bool SphinxClient::setFilterRange ( string $attribute , int $min , int $max [, bool $exclude = false ] )
$sphinx->setLimits(0, 5);
$result = $sphinx->query($argv[1]);


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
