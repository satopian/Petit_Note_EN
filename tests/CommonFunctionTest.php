<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CommonFunctionTest extends TestCase
{
    /**
     * @covers t
     */
    public function testT(): void
    {
        $actual = t("foo\tbar\tbaz");

        $this->assertEquals('foobarbaz', $actual);
    }

    /**
     * @covers s
     */
    public function testStripTags(): void
    {
        $actual = s('<p>foo<font class="#ffffff">bar<span>baz</span></font></p>');

        $this->assertEquals('foobarbaz', $actual);
    }

    /**
     * @covers h
     */
    public function testHtmlspecialchars(): void
    {
        $actual = h('&t="100"&s=\'200\'');

        $this->assertEquals('&amp;t=&quot;100&quot;&amp;s=&#039;200&#039;', $actual);
    }

    /**
     * @dataProvider commentProvider
     * @covers       com
     * @covers       auto_link
     * @covers       md_link
     */
    public function testComment(bool $useAutolink, string $text, string $expected): void
    {
        global $use_autolink;
        $use_autolink = $useAutolink;

        $actual = com($text);

        $this->assertEquals($expected, $actual);
    }

    public function commentProvider(): array
    {
        return [
            [true, '', ''],
            [false, '', ''],
            [
                false,
                "foo\nbar\nbaz",
                "foo<br>\nbar<br>\nbaz"
            ],
            [
                true,
                "foo\nbar\nbaz",
                "foo<br>\nbar<br>\nbaz"
            ],
            [
                // markdown
                false,
                "[foo](https://foo.com)\nbar\nbaz",
                "[foo](https://foo.com)<br>\nbar<br>\nbaz"
            ],
            [
                // markdown
                true,
                "[foo](https://foo.com)\nbar\nbaz",
                "<a href=\"https://foo.com\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">foo</a><br>\nbar<br>\nbaz"
            ],
            [
                // normal URL
                false,
                "<a href=\"https://foo.com\">foo</a>\nbar\nbaz",
                "<a href=\"https://foo.com\">foo</a><br>\nbar<br>\nbaz"
            ],
            [
                // normal URL
                true,
                "<a href=\"https://foo.com\">foo</a>\nbar\nbaz",
                "<a href=\"https://foo.com\">foo</a><br>\nbar<br>\nbaz"
            ],
            [
                // URL without <a tag
                false,
                "https://foo.com\nbar\nbaz",
                "https://foo.com<br>\nbar<br>\nbaz"
            ],
            [
                // URL has no <a tag
                true,
                "https://foo.com\nbar\nbaz",
                "<a href=\"https://foo.com\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">https://foo.com</a><br>\nbar<br>\nbaz"
            ],
            [
                // one of the two URLs has no <a tag
                true,
                "<a href=\"https://foo.com\">https://foo.com</a>\nhttps://bar.com\nbaz",
                "<a href=\"https://foo.com\">https://foo.com</a><br>\nhttps://bar.com<br>\nbaz"
            ],
        ];
    }

    /**
     * @dataProvider ngWordsProvider
     * @covers       is_ngword
     */
    public function testIsNgword(array $ngWords, array|string $strs, bool $expected): void
    {
        $actual = is_ngword($ngWords, $strs);

        $this->assertEquals($expected, $actual);
    }

    public function ngWordsProvider(): array
    {
        return [
            [[], [], false],
            [[], '', false],
            [['example.com'], '', false],
            [[], 'foo', false],
            [
                ['example.com', '大量入荷', 'シャネル'],
                ['foo'],
                false
            ],
            [
                ['example.com', '大量入荷', 'シャネル'],
                ['大量', '入荷'],
                false
            ],
            [
                ['example.com', '大量入荷', 'シャネル'],
                ['シャネル'],
                true
            ],
            [
                ['example.com', '大量入荷', 'シャネル'],
                ['fooシャネル', 'bar', 'baz'],
                true
            ],
            [
                ['example.com', '大量入荷', 'シャネル'],
                'シャネル',
                true
            ],
            [
                ['example.com', '大量入荷', 'シャネル'],
                'foo シャネル bar baz',
                true
            ],
            [
                ['example.com', '大量入荷', 'シャネル'],
                'fooシャネルbar baz',
                true
            ]
        ];
    }

    /**
     * @dataProvider imageReductionDisplayProvider
     * @covers       image_reduction_display
     */
    public function testImageReductionDisplay($width, $height, $maxWidth, $maxHeight, array|null $expected): void
    {
        $actual = image_reduction_display($width, $height, $maxHeight, $maxHeight);

        $this->assertEquals($expected, $actual);
    }

    public function imageReductionDisplayProvider(): array
    {
        return [
            ['', 0, 0, 0, ['', '']],
            [0, '', 0, 0, ['', '']],
            ['', '', 0, 0, ['', '']],
            [500, '', 400, 400,  ['', '']],
            [0, 0, 0, 0, [0, 0]],
            [400, 400, 0, 0, [0, 0]],
            [400, 400, 400, 400, [400, 400]],
            [200, 200, 400, 400, [200, 200]],
            [500, 500, 400, 400, [400, 400]],
            [200, 500, 400, 400, [160, 400]],
            [200, 500, 400, 300, [120, 300]],
            [500, 200, 400, 300, [300, 120]]
        ];
    }

    /**
     * @dataProvider calculatePaintTimeProvider
     * @covers       calcPtime
     */
    public function testCalcPtime($psec, array $expected): void
    {

        $actual = calcPtime($psec);

        $this->assertEquals($expected, $actual);
    }

    public function calculatePaintTimeProvider(): array
    {
        return [
            [0, ['ja' => '0秒', 'en' => '0 sec']],
            [1, ['ja' => '1秒', 'en' => '1 sec']],
            [60, ['ja' => '1分0秒', 'en' => '1 min 0 sec']],
            [61, ['ja' => '1分1秒', 'en' => '1 min 1 sec']],
            [3600, ['ja' => '1時間0分0秒', 'en' => '1 hour 0 min 0 sec']],
            [3661, ['ja' => '1時間1分1秒', 'en' => '1 hour 1 min 1 sec']],
            [7322, ['ja' => '2時間2分2秒', 'en' => '2 hours 2 min 2 sec']],
            [86400, ['ja' => '1日0時間0分0秒', 'en' => '1 day 0 hour 0 min 0 sec']],
            [86461, ['ja' => '1日0時間1分1秒', 'en' => '1 day 0 hour 1 min 1 sec']],
            [194766, ['ja' => '2日6時間6分6秒', 'en' => '2 days 6 hours 6 min 6 sec']],
        ];
    }
    /**
     * @dataProvider microtime2TimeProvider
     * @covers       microtime2time
     */
    public function testMicrotime2time($microtime, int $expected): void
    {

        $actual = microtime2time($microtime);

        $this->assertEquals($expected, $actual);
    }

    public function microtime2TimeProvider(): array
    {
        return [
            ["1620000000000000", 1620000000],
            ["1620000000000", 1620000000],
        ];
    }
    /**
     * @dataProvider calc_remaining_time_to_close_thread_Provider
     * @covers       calc_remaining_time_to_close_thread
     */
    public function test_calc_remaining_time_to_close_thread(bool $globalEn, $psec, string $expected): void
    {
        global $en;
        $en = $globalEn;
        $actual = calc_remaining_time_to_close_thread($psec);

        $this->assertEquals($expected, $actual);
    }

    public function calc_remaining_time_to_close_thread_Provider(): array
    {

        return [
            // $en = false (日本語)
            [false, 0, '0分'],
            [false, 1, '0分'],
            [false, 60, '1分'],
            [false, 61, '1分'],
            [false, 120, '2分'],
            [false, 121, '2分'],
            [false, 3600, '1時間'],
            [false, 3661, '1時間'],
            [false, 7200, '2時間'],
            [false, 86400, '1日'],
            [false, 86461, '1日'],
            [false, 172861, '2日'],
            // $en = true (英語)
            [true, 0, '0 min'],
            [true, 1, '0 min'],
            [true, 60, '1 min'],
            [true, 61, '1 min'],
            [true, 120, '2 min'],
            [true, 121, '2 min'],
            [true, 3600, '1 hour'],
            [true, 3661, '1 hour'],
            [true, 7200, '2 hours'],
            [true, 86400, '1 day'],
            [true, 86461, '1 day'],
            [true, 172861, '2 days'],
        ];
    }

    /**
     * @dataProvider createFormattedTextFromPostProvider
     * @covers       create_formatted_text_from_post
     */
    public function testCreateFormattedTextFromPost(bool $globalEn, $name, $subject, $url, $comment, array $expected): void
    {
        global $en, $name_input_required, $subject_input_required;
        $en = $globalEn;
        $name_input_required = false;
        $subject_input_required = false;

        $actual = create_formatted_text_from_post($name, $subject, $url, $comment);

        $this->assertEquals($expected, $actual);
    }

    public function createFormattedTextFromPostProvider(): array
    {
        return [
            [false, '', '', '', '', ['name' => 'anonymous', 'sub' => '無題', 'url' => '', 'com' => '']],
            [
                false,
                'foo',
                'bar',
                'baz',
                'qux',
                ['name' => 'foo', 'sub' => 'bar', 'url' => '', 'com' => 'qux']
            ],
            [
                false,
                'foo',
                'bar',
                'https://example.com/baz',
                'qux',
                ['name' => 'foo', 'sub' => 'bar', 'url' => 'https://example.com/baz', 'com' => 'qux']
            ],
            [
                false,
                'foo',
                'bar',
                'https;//example.com/baz',
                'qux',
                ['name' => 'foo', 'sub' => 'bar', 'url' => '', 'com' => 'qux']
            ],
            [
                false,
                "f\no\no",
                "b\nar",
                "https://example.com/ba\nz",
                "q\nux",
                ['name' => 'foo', 'sub' => 'bar', 'url' => '', 'com' => 'q"\n"ux']
            ],
            [
                false,
                'foo',
                'bar',
                'https://example.com/baz',
                "qux\nquux\ncorge",
                ['name' => 'foo', 'sub' => 'bar', 'url' => 'https://example.com/baz', 'com' => 'qux"\n"quux"\n"corge']
            ],
            [
                false,
                'foo',
                'bar',
                'https://example.com/baz',
                "qux\r\nquux\r\ncorge",
                ['name' => 'foo', 'sub' => 'bar', 'url' => 'https://example.com/baz', 'com' => 'qux"\n"quux"\n"corge']
            ],
            [
                false,
                "fo\to",
                "ba\tr",
                "https://example.com/ba\tz",
                "qux\tquuxcorge",
                ['name' => 'foo', 'sub' => 'bar', 'url' => '', 'com' => 'quxquuxcorge']
            ],
            [true, '', '', '', '', ['name' => 'anonymous', 'sub' => 'No subject', 'url' => '', 'com' => '']],
        ];
    }
    /**
     * @dataProvider createFormattedTextForSearchProvider
     * @covers       create_formatted_text_for_search
     */
    public function createFormattedTextForSearch($str,string $expected): void
    {

        $actual = create_formatted_text_for_search($str);

        $this->assertEquals($expected,$actual);
    }

    public function createFormattedTextForSearchProvider(): array
    {
        return [
            ['Hello World', 'helloWorld'], // スペース削除、全角から半角変換
            ['　全角スペース　', '全角スペース'], // 全角スペースを削除
            ['テスト〜です', 'テスト～です'], // 波ダッシュを全角チルダに
            ['abc123', 'abc123'], // 半角英数字そのまま
            ['ＡＢＣ 123', 'abc123'],      // 全角英字と半角数字
            ['１２３', '123'],              // 全角数字の変換
            ['123 456', '123456'], // スペース削除
            ['あいうえお', 'あいうえお'], // ひらがなはそのまま
            ['HELLO', 'hello'], // 大文字を小文字に変換
            ['半角英数ＡＢＣ', '半角英数abc'], // 全角英数から半角変換
            ['A〜B', 'a～b'], // 大文字から小文字変換と波ダッシュ
            ['   Hello   ', 'hello'], // スペースの前後を削除
            ['~ test', '~test'], // 前のスペース削除、チルダはそのまま
        ];
    }
}
