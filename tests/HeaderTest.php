<?php

namespace Quadram\LaravelUtils\Tests;

use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase;
use Quadram\LaravelUtils\Http\Middleware\LocalizationMiddleware;

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
                'de' => 'en'
            ],
        ];

        Config::set('laravel-utils', array_merge(include(__DIR__.'/../config/config.php'),$this->languageOverride));
    }

    /** @test */
    public function it_creates_a_copy()
    {
        $middleware = new LocalizationMiddleware;

        foreach ($this->languageOverride['language_override'] as $key => $value){
            request()->headers->set('language',$key);
            $this->assertEquals($value, $middleware->getLocale());
        }
    }
}
