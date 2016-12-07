<?php
/**
 * Created by PhpStorm.
 * User: Mr_liang
 * Date: 16/4/4
 * Time: 17:11
 */

namespace App\Markdown;


class Markdown{
    protected $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function markdown($text){
        $html = $this->parser->makeHtml($text);
        return $html;
    }
}