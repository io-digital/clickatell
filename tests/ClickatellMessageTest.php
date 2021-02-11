<?php

namespace IoDigital\Clickatell\Test;

use Clickatell\Rest;
use IoDigital\Clickatell\ClickatellMessage;
use PHPUnit\Framework\TestCase;

class ClickatellMessageTest extends TestCase
{
    protected $clickatellMessage;
    private $rest;

    public function setUp(): void
    {
        parent::setUp();
        $this->rest = \Mockery::mock(Rest::class);
        $this->clickatellMessage = new ClickatellMessage($this->rest);
    }

    /** @test */
    public function it_sets_a_clickatell_message()
    {
        $this->assertInstanceOf(
            ClickatellMessage::class,
            $this->clickatellMessage
        );
    }

    /** @test */
    public function it_can_construct_with_a_new_message()
    {
        $actual = ClickatellMessage::create('This is some content');

        $this->assertEquals('This is some content', $actual->getContent());
    }

    /** @test */
    public function it_can_set_new_content()
    {
        $actual = ClickatellMessage::create();

        $this->assertEmpty($actual->getContent());

        $actual->content('Hello');

        $this->assertEquals('Hello', $actual->getContent());
    }
}
