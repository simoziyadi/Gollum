[33mcommit d9c5047722174471b174c00ba604923cad022990[m
Author: ZYADI Mohammed <simoziyadi@gmail.com>
Date:   Fri Feb 26 17:43:56 2016 +0100

    New Bundle Directory

[1mdiff --git a/app/AppKernel.php b/app/AppKernel.php[m
[1mindex 93f05e6..d8069cb 100644[m
[1m--- a/app/AppKernel.php[m
[1m+++ b/app/AppKernel.php[m
[36m@@ -18,6 +18,7 @@[m [mclass AppKernel extends Kernel[m
             new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),[m
             new AppBundle\AppBundle(),[m
             new MIT\FinanceBundle\MITFinanceBundle(),[m
[32m+[m[32m            new MIT\DirectoryBundle\MITDirectoryBundle(),[m
         );[m
 [m
         if (in_array($this->getEnvironment(), array('dev', 'test'))) {[m
[1mdiff --git a/app/config/routing.yml b/app/config/routing.yml[m
[1mindex ec1176a..2b3dbb0 100644[m
[1m--- a/app/config/routing.yml[m
[1m+++ b/app/config/routing.yml[m
[36m@@ -1,3 +1,7 @@[m
[32m+[m[32mmit_directory:[m
[32m+[m[32m    resource: "@MITDirectoryBundle/Resources/config/routing.yml"[m
[32m+[m[32m    prefix:   /[m
[32m+[m
 mit_finance:[m
     resource: "@MITFinanceBundle/Resources/config/routing.yml"[m
     prefix:   /finance[m
[1mdiff --git a/src/MIT/DirectoryBundle/Controller/DefaultController.php b/src/MIT/DirectoryBundle/Controller/DefaultController.php[m
[1mnew file mode 100644[m
[1mindex 0000000..0bafa4f[m
[1m--- /dev/null[m
[1m+++ b/src/MIT/DirectoryBundle/Controller/DefaultController.php[m
[36m@@ -0,0 +1,13 @@[m
[32m+[m[32m<?php[m
[32m+[m
[32m+[m[32mnamespace MIT\DirectoryBundle\Controller;[m
[32m+[m
[32m+[m[32muse Symfony\Bundle\FrameworkBundle\Controller\Controller;[m
[32m+[m
[32m+[m[32mclass DefaultController extends Controller[m
[32m+[m[32m{[m
[32m+[m[32m    public function indexAction()[m
[32m+[m[32m    {[m
[32m+[m[32m        return $this->render('MITDirectoryBundle:Default:index.html.twig');[m
[32m+[m[32m    }[m
[32m+[m[32m}[m
[1mdiff --git a/src/MIT/DirectoryBundle/DependencyInjection/Configuration.php b/src/MIT/DirectoryBundle/DependencyInjection/Configuration.php[m
[1mnew file mode 100644[m
[1mindex 0000000..f7580c9[m
[1m--- /dev/null[m
[1m+++ b/src/MIT/DirectoryBundle/DependencyInjection/Configuration.php[m
[36m@@ -0,0 +1,29 @@[m
[32m+[m[32m<?php[m
[32m+[m
[32m+[m[32mnamespace MIT\DirectoryBundle\DependencyInjection;[m
[32m+[m
[32m+[m[32muse Symfony\Component\Config\Definition\Builder\TreeBuilder;[m
[32m+[m[32muse Symfony\Component\Config\Definition\ConfigurationInterface;[m
[32m+[m
[32m+[m[32m/**[m
[32m+[m[32m * This is the class that validates and merges configuration from your app/config files.[m
[32m+[m[32m *[m
[32m+[m[32m * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}[m
[32m+[m[32m */[m
[32m+[m[32mclass Configuration implements ConfigurationInterface[m
[32m+[m[32m{[m
[32m+[m[32m    /**[m
[32m+[m[32m     * {@inheritdoc}[m
[32m+[m[32m     */[m
[32m+[m[32m    public function getConfigTreeBuilder()[m
[32m+[m[32m    {[m
[32m+[m[32m        $treeBuilder = new TreeBuilder();[m
[32m+[m[32m        $rootNode = $treeBuilder->root('mit_directory');[m
[32m+[m
[32m+[m[32m        // Here you should define the parameters that are allowed to[m
[32m+[m[32m        // configure your bundle. See the documentation linked above for[m
[32m+[m[32m        // more information on that topic.[m
[32m+[m
[32m+[m[32m        return $treeBuilder;[m
[32m+[m[32m    }[m
[32m+[m[32m}[m
[1mdiff --git a/src/MIT/DirectoryBundle/DependencyInjection/MITDirectoryExtension.php b/src/MIT/DirectoryBundle/DependencyInjection/MITDirectoryExtension.php[m
[1mnew file mode 100644[m
[1mindex 0000000..e4e1771[m
[1m--- /dev/null[m
[1m+++ b/src/MIT/DirectoryBundle/DependencyInjection/MITDirectoryExtension.php[m
[36m@@ -0,0 +1,28 @@[m
[32m+[m[32m<?php[m
[32m+[m
[32m+[m[32mnamespace MIT\DirectoryBundle\DependencyInjection;[m
[32m+[m
[32m+[m[32muse Symfony\Component\DependencyInjection\ContainerBuilder;[m
[32m+[m[32muse Symfony\Component\Config\FileLocator;[m
[32m+[m[32muse Symfony\Component\HttpKernel\DependencyInjection\Extension;[m
[32m+[m[32muse Symfony\Component\DependencyInjection\Loader;[m
[32m+[m
[32m+[m[32m/**[m
[32m+[m[32m * This is the class that loads and manages your bundle configuration.[m
[32m+[m[32m *[m
[32m+[m[32m * @link http://symfony.com/doc/current/cookbook/bundles/extension.html[m
[32m+[m[32m */[m
[32m+[m[32mclass MITDirectoryExtension extends Extension[m
[32m+[m[32m{[m
[32m+[m[32m    /**[m
[32m+[m[32m     * {@inheritdoc}[m
[32m+[m[32m     */[m
[32m+[m[32m    public function load(array $configs, ContainerBuilder $container)[m
[32m+[m[32m    {[m
[32m+[m[32m        $configuration = new Configuration();[m
[32m+[m[32m        $config = $this->processConfiguration($configuration, $configs);[m
[32m+[m
[32m+[m[32m        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));[m
[32m+[m[32m        $loader->load('services.yml');[m
[32m+[m[32m    }[m
[32m+[m[32m}[m
[1mdiff --git a/src/MIT/DirectoryBundle/MITDirectoryBundle.php b/src/MIT/DirectoryBundle/MITDirectoryBundle.php[m
[1mnew file mode 100644[m
[1mindex 0000000..18b7990[m
[1m--- /dev/null[m
[1m+++ b/src/MIT/DirectoryBundle/MITDirectoryBundle.php[m
[36m@@ -0,0 +1,9 @@[m
[32m+[m[32m<?php[m
[32m+[m
[32m+[m[32mnamespace MIT\DirectoryBundle;[m
[32m+[m
[32m+[m[32muse Symfony\Component\HttpKernel\Bundle\Bundle;[m
[32m+[m
[32m+[m[32mclass MITDirectoryBundle extends Bundle[m
[32m+[m[32m{[m
[32m+[m[32m}[m
[1mdiff --git a/src/MIT/DirectoryBundle/Resources/config/routing.yml b/src/MIT/DirectoryBundle/Resources/config/routing.yml[m
[1mnew file mode 100644[m
[1mindex 0000000..0276a80[m
[1m--- /dev/null[m
[1m+++ b/src/MIT/DirectoryBundle/Resources/config/routing.yml[m
[36m@@ -0,0 +1,3 @@[m
[32m+[m[32mmit_directory_homepage:[m
[32m+[m[32m    path:     /[m
[32m+[m[32m    defaults: { _controller: MITDirectoryBundle:Default:index }[m
[1mdiff --git a/src/MIT/DirectoryBundle/Resources/config/services.yml b/src/MIT/DirectoryBundle/Resources/config/services.yml[m
[1mnew file mode 100644[m
[1mindex 0000000..4b2e92a[m
[1m--- /dev/null[m
[1m+++ b/src/MIT/DirectoryBundle/Resources/config/services.yml[m
[36m@@ -0,0 +1,4 @@[m
[32m+[m[32mservices:[m
[32m+[m[32m#    mit_directory.example:[m
[32m+[m[32m#        class: MIT\DirectoryBundle\Example[m
[32m+[m[32m#        arguments: ["@service_id", "plain_value", %parameter%][m
[1mdiff --git a/src/MIT/DirectoryBundle/Resources/views/Default/index.html.twig b/src/MIT/DirectoryBundle/Resources/views/Default/index.html.twig[m
[1mnew file mode 100644[m
[1mindex 0000000..980a0d5[m
[1m--- /dev/null[m
[1m+++ b/src/MIT/DirectoryBundle/Resources/views/Default/index.html.twig[m
[36m@@ -0,0 +1 @@[m
[32m+[m[32mHello World![m
[1mdiff --git a/src/MIT/DirectoryBundle/Tests/Controller/DefaultControllerTest.php b/src/MIT/DirectoryBundle/Tests/Controller/DefaultControllerTest.php[m
[1mnew file mode 100644[m
[1mindex 0000000..0762342[m
[1m--- /dev/null[m
[1m+++ b/src/MIT/DirectoryBundle/Tests/Controller/DefaultControllerTest.php[m
[36m@@ -0,0 +1,17 @@[m
[32m+[m[32m<?php[m
[32m+[m
[32m+[m[32mnamespace MIT\DirectoryBundle\Tests\Controller;[m
[32m+[m
[32m+[m[32muse Symfony\Bundle\FrameworkBundle\Test\WebTestCase;[m
[32m+[m
[32m+[m[32mclass DefaultControllerTest extends WebTestCase[m
[32m+[m[32m{[m
[32m+[m[32m    public function testIndex()[m
[32m+[m[32m    {[m
[32m+[m[32m        $client = static::createClient();[m
[32m+[m
[32m+[m[32m        $crawler = $client->request('GET', '/');[m
[32m+[m
[32m+[m[32m        $this->assertContains('Hello World', $client->getResponse()->getContent());[m
[32m+[m[32m    }[m
[32m+[m[32m}[m
