<?php

namespace Benmag\Namor;

/**
 * Namor - A domain-safe name generator
 *
 * @package  Namor
 * @author   @benmagg
 */
class Namor
{

    /**
     * Generate a random name
     *
     * @param  int  $words
     * @param  int  $numbers
     * @param  string  $char
     * @return string
     */
    public static function generate($words = 2, $numbers = 4, $char = "-")
    {
        return static::addTrailingNumber(static::processPattern(static::getPattern($words), $char), $numbers, $char);
    }

    /**
     * Returns a language pattern based on the word count of the name.
     *
     * @param  int  $words
     * @return array
     * @throws \Error
     */
    private static function getPattern($words)
    {

        if($words < 1) {
            throw new \Error("word count must be above 0");
        }

        if($words > 4) {
            throw new \Error("word count cannot be above 4");
        }

        switch ($words) {
            default:
            case 1:
                $pattern = "noun";
                break;

            case 2:
                $pattern = collect(['adjective|noun', 'noun|verb'])->random();
                break;

            case 3:
                $pattern = "adjective|noun|verb";
                break;

            case 4:
                $pattern = "adjective|noun|noun|verb";
                break;

        }

        return explode("|", $pattern);
    }

    /**
     * Fills a language pattern with actual words from our
     * dictionary, and turn it into a pipe-cased string.
     *
     * @param  array  $pattern
     * @param  string  $char
     * @return string
     */
    private static function processPattern($pattern, $char)
    {
        return implode($char, collect($pattern)->map(function($type) {
            return collect(config('namor.' . str_plural($type)))->random();
        })->toArray());
    }

    /**
     * Generates and adds a random number to the end of a name.
     *
     * @param  string  $name
     * @param  int  $numbers
     * @param  string  $char
     * @return string
     */
    private static function addTrailingNumber($name, $numbers, $char)
    {
        return $name . ($numbers ? $char . static::randomNumber($numbers) : '');
    }

    /**
     * Generate a random number with a fixed length.
     *
     * @param $length
     * @return string
     */
    private static function randomNumber($length)
    {
        $number = '';

        for($i = 0; $i < $length; $i++) {
            $number .= mt_rand(0, 9);
        }

        return $number;
    }

}