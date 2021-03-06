<?php

class Time
{
    public static function getTime($timestamp)
    {
        date_default_timezone_set('Europe/Brussels');

        // datum vandaag
        $today = date('Y-m-d');

        //net gepost
        $nowTime = date('H:i:s', strtotime('-1 sec'));

        // datum gisteren
        $yesterday = date('Y-m-d', strtotime('-1 days'));

        // vanaf meer dan 1 dag geleden
        $twoDaysAgo = date('Y-m-d', strtotime('-2 days'));

        // datum + tijd van de upload
        $uploadDateTime = date('d M Y', strtotime($timestamp)).' at '.date('H:i', strtotime($timestamp));

        // datum van de upload
        $uploadTime = date('H:i', strtotime($timestamp));

        // datum van de upload
        $uploadDate = date('Y-m-d', strtotime($timestamp));

        //half uur geleden
        $halfHourAgo = date('H:i', strtotime('-30 min'));

        //een uur geleden
        $hourAgo = date('H:i', strtotime('-1 hour'));

        // Is de post gisteren geplaatst?
        if ($uploadDate == $yesterday) {
            $timestamp = 'Yesterday at '.date('H:i', strtotime($uploadTime)).'<br>';
        } elseif ($uploadDate <= $twoDaysAgo) {
            $timestamp = $uploadDateTime;
        } else {
            // ---------indien vandaag gepost: meerdere opties van mededelingen ----------
            switch ($today) {
        //meer dan een uur geleden gepost
        case $uploadTime < $hourAgo:
            $timestamp = 'An hour ago';
        break;

        //meer dan een half uur geleden
        case $uploadTime < $halfHourAgo:
            $timestamp = 'An half hour ago';
        break;

        //minder dan een kwartier
        case $uploadTime < $nowTime:
            $timestamp = 'Just now';
        }
        }

        return $timestamp;
    }
}
