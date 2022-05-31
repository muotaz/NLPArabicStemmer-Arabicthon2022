# ArabicHackathon2022

This is our entry to the Arabic Hackathon 2022

## Assaf - Brute Force Generative Stemmer

```php
<?php

class BruteForceGeneratingStemmer
{

    public function __construct() {} // class constructor
    protected function clean_text($word) {} // text sanitization function

    protected function is_english($word) {} // detect non-arabic tokens

    function is_numeral($string) {} // detect numeral tokens

    protected function is_stopword($word) {} // detect stop words

    protected function strip_tashkeel($text) {} // remove tashkeel from word

    protected function classify_word($word, $label, $mp_array, $prefixes, $suffixes) {} // classify word based on a label and a set of morphological weights and affixes

    public function stem_and_classify($word) {} // main function of class

    private function normalize_hamza(string $word) {} // function to normalize hamzas
}
```

## Usage Sample

```php

require "BruteForceGeneratingStemmer.php";

$stemmer = new BruteForceGeneratingStemmer();
$stemmer->stem_and_classify("والمشاركين");
```


