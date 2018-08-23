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