<?php
declare(strict_types=1);

/**
 * File: ReaderTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Test\Unit\Model;

use MSlwk\XmlUrlRewrites\Model\Config\Converter;
use MSlwk\XmlUrlRewrites\Model\Config\Reader;
use MSlwk\XmlUrlRewrites\Model\Config\SchemaLocator;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Magento\Framework\Config\FileResolverInterface;
use Magento\Framework\Config\ValidationStateInterface;

/**
 * Class ReaderTest
 * @package MSlwk\XmlUrlRewrites\Test\Unit\Model
 */
class ReaderTest extends TestCase
{
    /**
     * @test
     */
    public function testCorrectPropertiesAreSet()
    {
        /** @var MockObject|FileResolverInterface $fileResolver */
        $fileResolver = $this->getMockBuilder(FileResolverInterface::class)
            ->getMock();
        /** @var MockObject|Converter $converter */
        $converter = $this->getMockBuilder(Converter::class)
            ->disableOriginalConstructor()
            ->getMock();
        /** @var MockObject|SchemaLocator $schemaLocator */
        $schemaLocator = $this->getMockBuilder(SchemaLocator::class)
            ->disableOriginalConstructor()
            ->getMock();
        /** @var MockObject|ValidationStateInterface $validationState */
        $validationState = $this->getMockBuilder(ValidationStateInterface::class)
            ->getMock();

        $reader = new Reader(
            $fileResolver,
            $converter,
            $schemaLocator,
            $validationState
        );
        $reflection = new \ReflectionClass(Reader::class);
        $fileProperty = $reflection->getProperty('_fileName');
        $fileProperty->setAccessible(true);
        $attributesProperty = $reflection->getProperty('_idAttributes');
        $attributesProperty->setAccessible(true);

        $expectedFile = 'url_rewrites.xml';
        $expectedAttributes = ['/config/rewrites/rewrite' => 'target'];

        $this->assertEquals($expectedFile, $fileProperty->getValue($reader));
        $this->assertEquals($expectedAttributes, $attributesProperty->getValue($reader));
    }
}
