<?php
declare(strict_types=1);

/**
 * File: XmlRewritesRouter.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\UrlInterface;
use MSlwk\XmlUrlRewrites\Api\RewritesProviderInterface;

/**
 * Class XmlRewritesRouter
 * @package MSlwk\XmlUrlRewrites\Controller
 */
class XmlRewritesRouter implements RouterInterface
{
    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    private $actionFactory;

    /**
     * @var RewritesProviderInterface
     */
    private $rewritesProvider;

    /**
     * XmlRewritesRouter constructor.
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param RewritesProviderInterface $rewritesProvider
     */
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        RewritesProviderInterface $rewritesProvider
    ) {
        $this->actionFactory = $actionFactory;
        $this->rewritesProvider = $rewritesProvider;
    }

    /**
     * @param RequestInterface $request
     * @return ActionInterface|null
     */
    public function match(RequestInterface $request)
    {
        $rewrites = $this->rewritesProvider->getRewrites();
        $path = trim($request->getPathInfo(), '/');

        if (isset($rewrites[$path])) {
            $request->setAlias(
                UrlInterface::REWRITE_REQUEST_PATH_ALIAS,
                $path
            );
            $request->setPathInfo($rewrites[$path]);
            return $this->actionFactory->create(
                Forward::class
            );
        }
    }
}
