<?php

$gpxFileName = "2022490.gpx";
$csvFileName = $gpxFileName . '.csv';
$colsName = array('date', 'ele', 'lon', 'lat');
$simplify = true;
$ctrSimplif = 1;
$simplifyRange = 30;

if (file_exists($gpxFileName)) {
    $xml = simplexml_load_file($gpxFileName);
    
    // Ouverture du csv
    if ($handle_dest = fopen($csvFileName, "a+")) {
        fputcsv($handle_dest, $colsName);
    }else {
        echo "impossible d'ouvrir le fichier $csvFileName";
        exit;
    }
    
    foreach ($xml->trk->trkseg->trkpt as $point) {
        $aLonLat = $point->attributes();
        
        $lon = $aLonLat['lon'];
        $lat = $aLonLat['lat'];
        $dt = $point->time;
        $ele = $point->ele;
        
        // Ecrire la ligne dans le  csv
        if($ctrSimplif == $simplifyRange) {
            fputcsv($handle_dest, array($dt, $ele, $lon, $lat));
            $ctrSimplif = 1;    
        }
        $ctrSimplif++;
    }
    
    @fclose($handle_dest);
    
} else {
    exit('Echec lors de l\'ouverture du fichier test.xml.');
}