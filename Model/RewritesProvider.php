<?php
declare(strict_types=1);

/**
 * File: RewritesProvider.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Model;

use Magento\Framework\Serialize\Serializer\Json;
use MSlwk\XmlUrlRewrites\Api\RewritesProviderInterface;
use MSlwk\XmlUrlRewrites\Model\Cache\Rewrites;
use MSlwk\XmlUrlRewrites\Model\Config\Reader;

/**
 * Class RewritesProvider
 * @package MSlwk\XmlUrlRewrites\Model
 */
class RewritesProvider implements RewritesProviderInterface
{
    /**
     * @var Reader
     */
    private $rewritesXmlReader;

    /**
     * @var Rewrites
     */
    private $rewritesCache;

    /**
     * @var Json
     */
    private $serializer;

    /**
     * RewritesProvider constructor.
     * @param Reader $rewritesXmlReader
     * @param Rewrites $rewritesCache
     * @param Json $serializer
     */
    public function __construct(
        Reader $rewritesXmlReader,
        Rewrites $rewritesCache,
        Json $serializer
    ) {
        $this->rewritesXmlReader = $rewritesXmlReader;
        $this->rewritesCache = $rewritesCache;
        $this->serializer = $serializer;
    }

    /**
     * @return array
     */
    public function getRewrites(): array
    {
        if (!$this->rewritesCache->load(Rewrites::TYPE_IDENTIFIER)) {
            $rewrites = (array)$this->rewritesXmlReader->read();
            $this->rewritesCache->save(
                $this->serializer->serialize($rewrites),
                Rewrites::TYPE_IDENTIFIER
            );
            return $rewrites;
        }
        $serializedRewrites = $this->rewritesCache->load(Rewrites::TYPE_IDENTIFIER);
        return $this->serializer->unserialize($serializedRewrites);
    }
}
