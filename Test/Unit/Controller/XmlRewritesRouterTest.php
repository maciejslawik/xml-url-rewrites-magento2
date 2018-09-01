<?php
declare(strict_types=1);

/**
 * File: XmlRewritesRouterTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Test\Unit\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\Request\Http;
use MSlwk\XmlUrlRewrites\Controller\XmlRewritesRouter;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Magento\Framework\App\ActionInterface;
use MSlwk\XmlUrlRewrites\Api\RewritesProviderInterface;

/**
 * Class XmlRewritesRouterTest
 * @package MSlwk\XmlUrlRewrites\Test\Unit\Controller
 */
class XmlRewritesRouterTest extends TestCase
{
    /**
     * @var MockObject|ActionFactory
     */
    private $actionFactory;

    /**
     * @var MockObject|RewritesProviderInterface
     */
    private $rewritesProvider;

    /**
     * @var XmlRewritesRouter
     */
    private $router;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->actionFactory = $this->getMockBuilder(ActionFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->rewritesProvider = $this->getMockBuilder(RewritesProviderInterface::class)
            ->getMock();

        $this->router = new XmlRewritesRouter($this->actionFactory, $this->rewritesProvider);
    }

    /**
     * @test
     */
    public function testMatchForPathWithoutRewrite()
    {
        $rewrites = [
            'a/b/c' => 'test'
        ];
        $this->rewritesProvider->expects($this->once())
            ->method('getRewrites')
            ->willReturn($rewrites);
        /** @var MockObject|Http $request */
        $request = $this->getMockBuilder(Http::class)
            ->disableOriginalConstructor()
            ->getMock();
        $request->expects($this->once())
            ->method('getPathInfo')
            ->willReturn('b/c/d/');

        $this->assertNull($this->router->match($request));
    }

    /**
     * @test
     */
    public function testMatchForPathWithRewrite()
    {
        $rewrites = [
            'a/b/c' => 'test'
        ];
        $this->rewritesProvider->expects($this->once())
            ->method('getRewrites')
            ->willReturn($rewrites);
        /** @var MockObject|Http $request */
        $request = $this->getMockBuilder(Http::class)
            ->disableOriginalConstructor()
            ->getMock();
        $request->expects($this->once())
            ->method('getPathInfo')
            ->willReturn('a/b/c/');

        $request->expects($this->once())
            ->method('setAlias')
            ->with('rewrite_request_path', 'a/b/c');
        $request->expects($this->once())
            ->method('setPathInfo')
            ->with('test');

        $action = $this->getMockBuilder(ActionInterface::class)
            ->getMock();
        $this->actionFactory->expects($this->once())
            ->method('create')
            ->with('Magento\Framework\App\Action\Forward')
            ->willReturn($action);

        $result = $this->router->match($request);

        $this->assertEquals($action, $result);

    }
}
