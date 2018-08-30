<?php
declare(strict_types=1);

/**
 * File: RewritesProviderInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Api;

/**
 * Interface RewritesProviderInterface
 * @package MSlwk\XmlUrlRewrites\Api
 */
interface RewritesProviderInterface
{
    /**
     * @return array
     */
    public function getRewrites(): array;
}
