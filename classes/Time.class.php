<?php

class Time
{
    public static function getTime($timestamp)
    {
        date_default_timezone_set('Europe/Brussels');

        // datum vandaag
        $vandaag = date('Y-m-d');

        // datum + tijd vandaag
        $vandaagDateTime = date('Y-m-d H:i:s ');

        //net gepost
        $nuTime = date('H:i:s', strtotime('-1 sec'));

        // datum gisteren
        $yesterday = date('Y-m-d', strtotime('-1 days'));

        // vanaf meer dan 1 dag geleden
        $eergisteren = date('Y-m-d', strtotime('-2 days'));

        // datum + tijd van de upload
        $uploadDateTime = date('Y-m-d H:i', strtotime($timestamp));

        // datum van de upload
        $uploadTime = date('H:i', strtotime($timestamp));

        // datum van de upload
        $uploadDate = date('Y-m-d', strtotime($timestamp));

        //half uur geleden
        $halfHourAgo = date('H:i', strtotime('-30 min'));

        //15 min geleden
        $quarterAgo = date('H:i', strtotime('-15 min'));

        //een uur geleden
        $hourAgo = date('H:i', strtotime('-1 hour'));

        // Is de post gisteren geplaatst?
        if ($uploadDate == $yesterday) {
            $timestamp = 'gisteren gepost om: '.date('H:i', strtotime($uploadTime)).'<br>';
        }

        if ($uploadDate <= $eergisteren) {
            $timestamp = $uploadDateTime;
        }

        // ---------indien vandaag gepost: meerdere opties van mededelingen ----------
        switch ($vandaag) {
        //meer dan een uur geleden gepost
        case $uploadTime < $hourAgo:
            $timestamp = '1 uur geleden';
        break;

        //meer dan een half uur geleden
        case $uploadTime < $halfHourAgo:
            $timestamp = 'Half uur geleden';
        break;

        //minder dan een kwartier
        case $uploadTime < $nuTime:
            $timestamp = 'Zonet';
        }

        return $timestamp;
    }
}
