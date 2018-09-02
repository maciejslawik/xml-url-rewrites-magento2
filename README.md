[![Latest Stable Version](https://poser.pugx.org/mslwk/module-xml-url-rewrites/v/stable)](https://packagist.org/packages/mslwk/module-xml-url-rewrites)
[![License](https://poser.pugx.org/mslwk/module-xml-url-rewrites/license)](https://packagist.org/packages/mslwk/module-xml-url-rewrites)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/maciejslawik/xml-url-rewrites-magento2/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maciejslawik/xml-url-rewrites-magento2/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/maciejslawik/xml-url-rewrites-magento2/badges/build.png?b=master)](https://scrutinizer-ci.com/g/maciejslawik/xml-url-rewrites-magento2/build-status/master)

# Magento 2 XML URL Rewrites module #

The extension allows to create custom url rewrites in a Magento1-like way using XML files

### Installation ###

##### Via Composer #####

To install the extension using Composer use the 
following commands:

```bash
 composer require mslwk/module-xml-url-rewrites
 php bin/magento module:enable MSlwk_XmlUrlRewrites
 php bin/magento setup:upgrade
 ```
 
##### From GitHub #####
 
You can download the extension directly from GitHub and 
put it inside `` app/code/MSlwk/XmlUrlRewrites `` directory. Then run the
following commands:

```bash
 php bin/magento module:enable MSlwk_XmlUrlRewrites
 php bin/magento setup:upgrade
 ```
 
## Usage ##

To create new rewrites add ```etc/url_rewrites.xml``` file to your module.

Example:

```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:MSlwk_XmlUrlRewrites:etc/url_rewrites.xsd">
    <rewrites>
        <rewrite path="a/b/c" target="catalog/category/view" />
        <rewrite path="test" target="catalog/product/view" />
    </rewrites>
</config>
```

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/maciejslawik/xml-url-rewrites-magento2/tags). 

## Authors

* **Maciej Sławik** - https://github.com/maciejslawik

See also the list of [contributors](https://github.com/maciejslawik/xml-url-rewrites-magento2/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details