<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function class_rate($score) {
    $result = '';
    if ($score < 5) {
        $result = 'score-1-5';
    } elseif ($score < 7) {
        $result = 'score-5-6';
    } elseif ($score < 8) {
        $result = 'score-7-8';
    } elseif ($score < 9) {
        $result = 'score-8-9';
    } else {
        $result = 'score-10';
    }

    return $result;
}

function public_rate($score) {
    $result = '';
    if ($score < 2) {
        $result = 'score-1-5';
    } elseif ($score < 3) {
        $result = 'score-7-8';
    } elseif ($score < 4) {
        $result = 'score-8-9';
    } else {
        $result = 'score-10';
    }

    return $result;
}

function result_rate($score) {
    $result = '';
    if ($score == 1) {
        $result = 'Dở';
    } elseif ($score == 2) {
        $result = 'Tạm';
    } elseif ($score == 3) {
        $result = 'Khá';
    } else {
        $result = 'Tốt';
    }

    return $result;
}

function getClassRating($score) {
    $result = '';
    if ($score < 5) {
        $result = 'score-1-5';
    } elseif ($score < 7) {
        $result = 'score-5-6';
    } elseif ($score < 8) {
        $result = 'score-6-7';
    } elseif ($score < 9) {
        $result = 'score-8-9';
    } else {
        $result = 'score-10';
    }

    return $result;
}

?>