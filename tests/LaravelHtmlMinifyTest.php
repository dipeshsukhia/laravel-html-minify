<?php
namespace DipeshSukhia\LaravelHtmlMinify\Tests;

use PHPUnit\Framework\TestCase;
use DipeshSukhia\LaravelHtmlMinify\LaravelHtmlMinify;

class LaravelHtmlMinifyTest extends TestCase {

    protected $htmlMinify;

    protected function setUp() : void {
        parent::setUp();
        $this->htmlMinify = new LaravelHtmlMinify();
    }

    /**
     * @dataProvider dataHtmlProvider
     */
    public function testHtmlMinification( ?string $html, string $expectedMinifiedHtml ) : void {
        $minifiedHtml = $this->htmlMinify->htmlMinify( $html );
        static::assertSame( $expectedMinifiedHtml, $minifiedHtml );
    }



    public static function dataHtmlProvider() : array {
        return [
            [
                "<html><body><p>This is a paragraph</p></body></html>",
                "<html><body><p>This is a paragraph</p></body></html>"
            ],
            [
                "<html>   <body>   <p>This is a paragraph</p>   </body>   </html>",
                "<html><body><p>This is a paragraph</p></body></html>"
            ],
        ];
    }
}
