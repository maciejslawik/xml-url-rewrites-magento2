<?php
declare(strict_types=1);

/**
 * File: Rewrites.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Model\Cache;

use Magento\Framework\App\Cache\Type\FrontendPool;
use Magento\Framework\Cache\Frontend\Decorator\TagScope;

/**
 * Class Rewrites
 * @package MSlwk\XmlUrlRewrites\Model\Cache
 */
class Rewrites extends TagScope
{
    const TYPE_IDENTIFIER = 'xml_url_rewrites';
    const CACHE_TAG = 'XML_URL_REWRITES';

    /**
     * Rewrites constructor.
     * @param FrontendPool $cacheFrontendPool
     */
    public function __construct(FrontendPool $cacheFrontendPool)
    {
        parent::__construct($cacheFrontendPool->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
    }
}
