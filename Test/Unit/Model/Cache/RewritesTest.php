<?php
declare(strict_types=1);

/**
 * File: RewritesTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Test\Unit\Model;

use Magento\Framework\App\Cache\Type\FrontendPool;
use Magento\Framework\Cache\FrontendInterface;
use MSlwk\XmlUrlRewrites\Model\Cache\Rewrites;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Class RewritesTest
 * @package MSlwk\XmlUrlRewrites\Test\Unit\Model
 */
class RewritesTest extends TestCase
{
    /**
     * @test
     */
    public function testTags()
    {
        /** @var MockObject|FrontendPool $cachePool */
        $cachePool = $this->getMockBuilder(FrontendPool::class)
            ->disableOriginalConstructor()
            ->getMock();
        $frontendInterface = $this->getMockBuilder(FrontendInterface::class)
            ->getMock();
        $cachePool->expects($this->once())
            ->method('get')
            ->with('xml_url_rewrites')
            ->willReturn($frontendInterface);

        $cacheClass = new Rewrites($cachePool);

        $expectedTag = 'XML_URL_REWRITES';
        $this->assertEquals($expectedTag, $cacheClass->getTag());
    }
}
