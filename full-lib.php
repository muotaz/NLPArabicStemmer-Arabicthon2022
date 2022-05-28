<?php
header("Access-Control-Allow-Origin: *");
//header("content-type: application/json");
require "BruteForceGeneratingStemmer.php";

$stemmer = new BruteForceGeneratingStemmer();


$text = trim($_GET['word']);

// ------------------
function html_table($data = array(),$word='')
{
	$thead = array();
    $rows = array();
    foreach ($data as $index => $row) {
        
        $cells = array();
		if($index == 0) $type = 'th'; else $type = 'td';
        foreach ($row as $cell) {
			if($index == 0) $thead[] = "<$type>{$cell}</$type>"; else $cells[] = "<$type>{$cell}</$type>";
        }
        $rows[] = "<tr>" . implode('', $cells) . "</tr>";
    }
    return "<table class='table table-bordered table-dark table-hover'>  <caption>نتائج التحليل لكلمة : $word</caption><thead>" . implode('', $thead) . "</thead><tbody>" . implode('', $rows) . "</tbody></table>";
}
// ------------------
function clean_text($word) {

    $western_arabic = array('0','1','2','3','4','5','6','7','8','9');
    $eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
    $word = str_replace($eastern_arabic, $western_arabic, $word);

    $bad = ["!","”", "“","•", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "؟", "\\", "\"", ":", "،", ".", "؛", "(", ")", "*", "-", "/", '&nbsp;', "—", "[","]","˂",">"];

    return str_replace($bad, " ", $word); //array_merge($english, $bad)
}


$verbose = false;
$total_tokens = 0;

$tokens = explode(" ", clean_text($text));

$stemmed_text = [];
$stemmed_text_classes = [];

$text_pos_count = [];
$text_pos_elements = [];
$text_pos_roots = [];

$detected_roots = [];

$retval = [];

foreach ($tokens as $token) {

    if($token == '') continue;
    $retval[] = $stemmer->stem_and_classify(trim($token));
}

$st = reset($retval[0]);

echo html_table([
["السابقة","الجذع","اللاحقة","الوسم"],
$st
], $text); //json_encode($retval);