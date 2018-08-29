<?php
declare(strict_types=1);

/**
 * File: Reader.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Model\Config;

use Magento\Framework\Config\FileResolverInterface;
use Magento\Framework\Config\Reader\Filesystem;
use Magento\Framework\Config\ValidationStateInterface;

/**
 * Class Reader
 * @package MSlwk\XmlUrlRewrites\Model\Config
 */
class Reader extends Filesystem
{
    const XML_FILE_NAME = 'url_rewrites.xml';
    const ID_ATTRIBUTES = ['/config/rewrites/rewrite' => 'target'];

    /**
     * Reader constructor.
     * @param FileResolverInterface $fileResolver
     * @param Converter $converter
     * @param SchemaLocator $schemaLocator
     * @param ValidationStateInterface $validationState
     * @param string $fileName
     */
    public function __construct(
        FileResolverInterface $fileResolver,
        Converter $converter,
        SchemaLocator $schemaLocator,
        ValidationStateInterface $validationState,
        $fileName = self::XML_FILE_NAME
    ) {
        parent::__construct(
            $fileResolver,
            $converter,
            $schemaLocator,
            $validationState,
            $fileName,
            self::ID_ATTRIBUTES
        );
    }
}
