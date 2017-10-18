<?php

namespace Tests\Components\Validation;

use App\Validation\DoesNotContainUrlRule;
use Tests\TestCase;

class DoesNotContainUrlRuleTest extends TestCase
{
    const STRING_WITH_URL = 'This is a string http://example.com with an url in it.';
    const STRING_WITHOUT_URL = 'This is a string without an url in it.';
    const STRING_WITH_A_REGRESSION = 'JSON not possible with MSSQL running on Windows platform?';

    /** @test */
    public function it_detects_a_url_in_a_string()
    {
        $this->assertFalse($this->runRule(self::STRING_WITH_URL));
    }

    /** @test */
    public function it_passes_when_no_url_is_present()
    {
        $this->assertTrue($this->runRule(self::STRING_WITHOUT_URL));
    }

    private function runRule(string $value): bool
    {
        return $this->app->make(DoesNotContainUrlRule::class)->validate(null, $value);
    }
}
