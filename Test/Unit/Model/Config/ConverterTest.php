<?php
declare(strict_types=1);

/**
 * File: ConverterTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Test\Unit\Model;

use DOMDocument;
use MSlwk\XmlUrlRewrites\Model\Config\Converter;
use PHPUnit\Framework\TestCase;

/**
 * Class ConverterTest
 * @package MSlwk\XmlUrlRewrites\Test\Unit\Model
 */
class ConverterTest extends TestCase
{
    /**
     * @test
     */
    public function testConvert()
    {
        $converter = new Converter();

        $expected = [
            'a/b/c' => 'catalog/category/view',
            'test' => 'catalog/product/view'
        ];

        $this->assertEquals($expected, $converter->convert($this->getSource()));
    }

    /**
     * @return DOMDocument
     */
    private function getSource(): DOMDocument
    {
        $source = new DOMDocument();
        $source->loadXML(
            '<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                xsi:noNamespaceSchemaLocation="urn:magento:module:MSlwk_XmlUrlRewrites:etc/url_rewrites.xsd">
                <rewrites>
                    <rewrite path="a/b/c" target="catalog/category/view"/>
                    <rewrite path="test" target="catalog/product/view"/>
                </rewrites>
            </config>'
        );
        return $source;
    }
}
