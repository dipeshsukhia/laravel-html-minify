<?php

namespace DipeshSukhia\LaravelHtmlMinify;

class LaravelHtmlMinify
{
    /**
     * @param $html
     * @return array|string|null
     */
    public function htmlMinify($html = null): array|string|null
    {
        $replace = [

            //remove tabs before and after HTML tags
            '/\>[^\S ]+/s'                                                      => '>',
            '/[^\S ]+\</s'                                                      => '<',

            //shorten multiple whitespace sequences; keep new-line characters because they matter in JS!!!
            '/([\t ])+/s'                                                       => ' ',

            //remove leading and trailing spaces
            '/^([\t ])+/m'                                                      => '',
            '/([\t ])+$/m'                                                      => '',

            // remove JS line comments (simple only); do NOT remove lines containing URL (e.g. 'src="http://server.com/"')!!!
            '~//[a-zA-Z0-9 ]+$~m'                                               => '',

            //remove empty lines (sequence of line-end and white-space characters)
            '/[\r\n]+([\t ]?[\r\n]+)+/s'                                        => "\n",

            //remove empty lines (between HTML tags); cannot remove just any line-end characters because in inline JS they can matter!
            '/\>[\r\n\t ]+\</s'                                                 => '><',

            //remove "empty" lines containing only JS's block end character; join with next line (e.g. "}\n}\n</script>" --> "}}</script>"
            '/}[\r\n\t ]+/s'                                                    => '}',
            '/}[\r\n\t ]+,[\r\n\t ]+/s'                                         => '},',

            //remove new-line after JS's function or condition start; join with next line
            '/\)[\r\n\t ]?{[\r\n\t ]+/s'                                        => '){',
            '/,[\r\n\t ]?{[\r\n\t ]+/s'                                         => ',{',

            //remove new-line after JS's line end (only most obvious and safe cases)
            '/\),[\r\n\t ]+/s'                                                  => '),',

            //remove quotes from HTML attributes that does not contain spaces; keep quotes around URLs!
            //'~([\r\n\t ])?([a-zA-Z0-9]+)=\"([a-zA-Z0-9_\\-]+)\"([\r\n\t ])?~s'  => '$1$2=$3$4',
            '/(\n|^)(\x20+|\t)/' => "\n",
            '/(\n|^)\/\/(.*?)(\n|$)/' => "\n",
            '/\n/' => " ",
            '/\<\!--.*?-->/' => "",

            # Delete multispace (Without \n)
            '/(\x20+|\t)/' => " ",

            # strip whitespaces between tags
            '/\>\s+\</' => "><",

            # strip whitespaces between quotation ("') and end tags
            '/(\"|\')\s+\>/' =>  "$1>",

            # strip whitespaces between = "'
            '/=\s+(\"|\')/' => "=$1"

        ];

        return preg_replace(array_keys($replace), array_values($replace), $html);
    }
}
