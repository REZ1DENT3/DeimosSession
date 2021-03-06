<?php

namespace Test;

use DeimosTest\TestSetUp;

class SessionTest extends TestSetUp
{

    /**
     * @runInSeparateProcess
     */
    public function testTest()
    {

        $mt_rand = mt_rand();
        $this->session->set('test', $mt_rand);

        $this->session->set('required', $mt_rand);

        $this->session->getRequired('required');

        $this->assertTrue(isset($this->session->required));

        $rand = mt_rand();

        $this->assertNull($this->session->flash('test'));

        $this->session->flash('test', $rand);

        $this->assertEquals(
            $rand,
            $this->session->flash('test')
        );

        $this->assertNull($this->session->flash('test'));

        $this->session->testSet = 'magic';

        $this->assertEquals(
            'magic',
            $this->session->get('testSet')
        );

        $this->assertEquals(
            $mt_rand,
            $this->session->test
        );

    }

    /**
     * @runInSeparateProcess
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function testGetRequired()
    {
        $this->session->getRequired('required');
    }

    /**
     * @runInSeparateProcess
     * @expectedException \Deimos\Helper\Exceptions\ExceptionEmpty
     */
    public function testRemoveAll()
    {
        $storage = range(1, 100);
        foreach ($storage as $key => $item)
        {
            $keyName = 'item' . $key;
            $this->session->set($keyName, $item);
        }

        $this->session->removeAll();

        $this->assertNull($this->session->get('item0'));
        $this->session->getRequired('item99');
    }

}
