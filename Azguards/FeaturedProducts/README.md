#  Module Azguards FeaturedProducts

    ``azguards/module-featuredProducts``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
FeaturedProducts

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Azguards`
 - Enable the module by running `php bin/magento module:enable Azguards_FeaturedProducts`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require azguards/module-featuredProducts`
 - enable the module by running `php bin/magento module:enable Azguards_FeaturedProducts`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

- Enable Featured Product
    - Navigate to Stores > Configuration > Catalog > Featured Products.
    - Enable/disable “Featured Products” block.
    - Set the maximum number of products to display


## Specifications

- Dynamically retrieves products marked as featured using the is_featured attribute
- Displays the featured products on the homepage with a responsive design
- Fully configurable via the admin panel.


## Attributes

- is_featured (Product Attribute)

