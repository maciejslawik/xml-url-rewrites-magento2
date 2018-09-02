<?php
declare(strict_types=1);

/**
 * File: SchemaLocatorTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Test\Unit\Model;

use MSlwk\XmlUrlRewrites\Model\Config\SchemaLocator;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Magento\Framework\Module\Dir\Reader;

/**
 * Class SchemaLocatorTest
 * @package MSlwk\XmlUrlRewrites\Test\Unit\Model
 */
class SchemaLocatorTest extends TestCase
{
    /**
     * @test
     */
    public function testCorrectPathAreSet()
    {
        $etcPath = '/var/www/html/app/code/MSlwk/XmlUrlRewrites/etc';
        /** @var MockObject|Reader $moduleReader */
        $moduleReader = $this->getMockBuilder(Reader::class)
            ->disableOriginalConstructor()
            ->getMock();
        $moduleReader->expects($this->once())
            ->method('getModuleDir')
            ->with('etc', 'MSlwk_XmlUrlRewrites')
            ->willReturn($etcPath);

        $schemaLocator = new SchemaLocator($moduleReader);

        $expectedPath = $etcPath . '/url_rewrites.xsd';

        $this->assertEquals($expectedPath, $schemaLocator->getPerFileSchema());
        $this->assertEquals($expectedPath, $schemaLocator->getSchema());
    }
}
