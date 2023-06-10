<?php

/**
 * CommonTraitTest
 * PHP version 8.1
 *
 * @category Test/Unit
 * @package  Tests\Unit\Traits
 * @author   Parth Gajjar <parthgajjar34@gmail.com>
 */

namespace Tests\Unit\Traits;

use App\Traits\Common;
use Carbon\Carbon;
use Tests\TestCase;

/**
 * Class CommonTraitTest
 *
 * @category Tests
 * @package  Tests\Unit\Traits
 * @author   Parth Gajjar <parthgajjar34@gmail.com>
 */
class CommonTraitTest extends TestCase
{
    use Common;

    /**
     * The setUp function that arranges the tests
     *
     * @author Parth Gajjar <parthgajjar34@gmail.com>
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Test errorMsg method
     *
     * @author Parth Gajjar <parthgajjar34@gmail.com>
     * @return void
     */
    public function testErrorMsg(): void
    {
        $result = $this->errorMsg('test');
        $this->assertSame($result->content(), '{"success":false,"error":"test"}');
    }

    /**
     * Test successMsg method
     *
     * @author Parth Gajjar <parthgajjar34@gmail.com>
     * @return void
     */
    public function testSuccessMsg(): void
    {
        $result = $this->successMsg('test');
        $this->assertSame($result->content(), '{"success":true,"data":"test"}');
    }

}
