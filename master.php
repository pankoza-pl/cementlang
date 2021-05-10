<?php

namespace pankoza\cementLang;

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

class Compiler
{
	public static function compile(String $text)
	{
		$data = explode(";", $text);
		$count = 0;
		foreach ($data as $key => $value) {
			$v = str_replace("	", "", $value);
			$v = str_replace("\n", "", $v);
			if ($v == "cement+") {
				$count++;
			} else if ($v == "cement-") {
				$count--;
			} else if ($v == "cement") {
				echo $count . " ";
			} else if (preg_match("/cement_([a-z]+).php/", $v)) {
				preg_match_all("/cement_([a-z]+).php/", $v, $matches);
				require_once $matches[1][0] . ".php";
			}
		}
	}
}
