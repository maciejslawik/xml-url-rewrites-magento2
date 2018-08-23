<?php
declare(strict_types=1);

/**
 * File: SchemaLocator.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Model\Config;

use Magento\Framework\Config\SchemaLocatorInterface;
use Magento\Framework\Module\Dir;
use Magento\Framework\Module\Dir\Reader;

/**
 * Class SchemaLocator
 * @package MSlwk\XmlUrlRewrites\Model\Config
 */
class SchemaLocator implements SchemaLocatorInterface
{
    /**
     * @var string
     */
    protected $schema = null;

    /**
     * @var string
     */
    protected $perFileSchema = null;

    /**
     * @param Reader $moduleReader
     */
    public function __construct(Reader $moduleReader)
    {
        $etcDir = $moduleReader->getModuleDir(Dir::MODULE_ETC_DIR, 'MSlwk_XmlUrlRewrites');
        $this->schema = $etcDir . '/url_rewrites.xsd';
        $this->perFileSchema = $etcDir . '/url_rewrites.xsd';
    }

    /**
     * Get path to merged config schema
     *
     * @return string|null
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Get path to pre file validation schema
     *
     * @return string|null
     */
    public function getPerFileSchema()
    {
        return $this->perFileSchema;
    }
}
