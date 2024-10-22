<?php
require_once 'ProcessCsv.php';
use App\ProcessCsv;
$processCsv = new ProcessCsv();
$inputFile = 'data.csv';
$outputFile = 'sorted_data.csv';
$processCsv->readAndSortCsv($inputFile, $outputFile);
