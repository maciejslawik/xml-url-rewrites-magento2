<?php
declare(strict_types=1);

/**
 * File: Converter.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Model\Config;

use DOMDocument;
use DOMNode;
use DOMXPath;
use Magento\Framework\Config\ConverterInterface;

/**
 * Class Converter
 * @package MSlwk\XmlUrlRewrites\Model\Config
 */
class Converter implements ConverterInterface
{
    /**
     * @param DOMDocument $source
     * @return array
     */
    public function convert($source)
    {
        $xpath = new DOMXPath($source);
        $rewrites = [];
        /** @var $rewriteNode DOMNode */
        foreach ($xpath->query('/config/rewrites/rewrite') as $rewriteNode) {
            $rewriteAttributes = $rewriteNode->attributes;
            $pathAttribute = $rewriteAttributes->getNamedItem('path');
            $targetAttribute = $rewriteAttributes->getNamedItem('target');
            $rewrites[$pathAttribute->nodeValue] = $targetAttribute->nodeValue;
        }
        return $rewrites;
    }
}
