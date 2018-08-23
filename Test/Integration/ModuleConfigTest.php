<?php
/**
 * File: ModuleConfigTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\XmlUrlRewrites\Test\Integration;

use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\Helper\Bootstrap;
use PHPUnit\Framework\TestCase;

/**
 * Class ModuleConfigTest
 *
 * @package MSlwk\XmlUrlRewrites\Test\Integration
 */
class ModuleConfigTest extends TestCase
{
    /**
     * @var string
     */
    private $moduleName = 'MSlwk_XmlUrlRewrites';

    /**
     * @test
     */
    public function testTheModuleIsRegistered()
    {
        $registrar = new ComponentRegistrar();
        $this->assertArrayHasKey($this->moduleName, $registrar->getPaths(ComponentRegistrar::MODULE));
    }

    /**
     * @test
     */
    public function testTheModuleIsConfiguredAndEnabled()
    {
        $objectManager = Bootstrap::getObjectManager();
        $moduleList = $objectManager->create(ModuleList::class);
        $this->assertTrue($moduleList->has($this->moduleName));
    }
}
