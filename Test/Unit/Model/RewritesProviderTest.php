<?php
declare(strict_types=1);

/**
 * File: RewritesProviderTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Test\Unit\Model;

use MSlwk\XmlUrlRewrites\Model\RewritesProvider;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Magento\Framework\Serialize\Serializer\Json;
use MSlwk\XmlUrlRewrites\Model\Cache\Rewrites;
use MSlwk\XmlUrlRewrites\Model\Config\Reader;

/**
 * Class RewritesProviderTest
 * @package MSlwk\XmlUrlRewrites\Test\Unit\Model
 */
class RewritesProviderTest extends TestCase
{
    /**
     * @var MockObject|Reader
     */
    private $rewritesXmlReader;

    /**
     * @var MockObject|Rewrites
     */
    private $rewritesCache;

    /**
     * @var MockObject|Json
     */
    private $serializer;

    /**
     * @var RewritesProvider
     */
    private $rewritesProvider;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->rewritesXmlReader = $this->getMockBuilder(Reader::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->rewritesCache = $this->getMockBuilder(Rewrites::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->serializer = $this->getMockBuilder(Json::class)
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        $this->rewritesProvider = new RewritesProvider(
            $this->rewritesXmlReader,
            $this->rewritesCache,
            $this->serializer
        );
    }

    /**
     * @test
     */
    public function testGetRewritesFromCache()
    {
        $this->rewritesCache->expects($this->exactly(2))
            ->method('load')
            ->with('xml_url_rewrites')
            ->willReturn('{"a\/b\/c":"catalog\/category\/view","test":"catalog\/product\/view"}');

        $expected = [
            'a/b/c' => 'catalog/category/view',
            'test' => 'catalog/product/view'
        ];

        $this->assertEquals($expected, $this->rewritesProvider->getRewrites());
    }

    /**
     * @test
     */
    public function testGetRewritesFromReader()
    {
        $this->rewritesCache->expects($this->once())
            ->method('load')
            ->with('xml_url_rewrites')
            ->willReturn(null);

        $this->rewritesXmlReader->expects($this->once())
            ->method('read')
            ->willReturn(
                [
                    'a/b/c' => 'catalog/category/view',
                    'test' => 'catalog/product/view'
                ]
            );

        $this->rewritesCache->expects($this->once())
            ->method('save')
            ->with(
                '{"a\/b\/c":"catalog\/category\/view","test":"catalog\/product\/view"}',
                'xml_url_rewrites'
            );

        $expected = [
            'a/b/c' => 'catalog/category/view',
            'test' => 'catalog/product/view'
        ];

        $this->assertEquals($expected, $this->rewritesProvider->getRewrites());
    }
}
