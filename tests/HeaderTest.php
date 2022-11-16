<?php

namespace Quadram\LaravelUtils\Tests;

use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase;
use Quadram\LaravelUtils\Classes\Headers;

class HeaderTest extends TestCase
{
    protected $languageOverride;

    protected function setUp(): void
    {
        parent::setUp();

        $this->languageOverride = [
            'language_override' => [
                'ca' => 'es',
                'gl' => 'es',
                'eu' => 'es',
                'de' => 'en'
            ],
            'default_language' => 'test'
        ];

        Config::set('laravel-utils', array_merge(include(__DIR__.'/../config/config.php'),$this->languageOverride));
    }

    /** @test */
    public function it_creates_a_copy()
    {
        foreach ($this->languageOverride['language_override'] as $key => $value){
            request()->headers->set('language',$key);
            $this->assertEquals($value, Headers::getLanguage());
        }

        request()->headers->set('language','fr');
        $this->assertEquals('test', Headers::getLanguage());
    }
}
