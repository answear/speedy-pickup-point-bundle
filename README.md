# Wide Eyes Bundle
Wide Eyes integration for Symfony.  
Documentation of the API can be found here: https://wideeyes.ai/.

## Installation

* install with Composer
```
composer require answear/wide-eyes-bundle
```

`Answear\WideEyesBundle\AnswearWideEyesBundle::class => ['all' => true],`  
should be added automatically to your `config/bundles.php` file by Symfony Flex.

## Setup

* provide required config data: `privateKey`

```yaml
# config/packages/answear_wide_eyes.yaml
answear_wide_eyes:
    publicKey: 'your_public_key'
```

config will be passed to `\Answear\WideEyesBundle\Service\ConfigProvider` class.

## Usage

### Similar recommendations

For similar recommendations use `SimilarClient` and its method `getSimilar`.

```php
use Answear\WideEyesBundle\Service\SimilarClient;

$similarResponse = $similarClient->getSimilar('uid', 'country');
```

Your agruments are: `uid` - your unique id for product and `country` - country for which products your asking.
In result you're getting `SimilarResponse` that has `getUids` method - with similar uids returned by api.

### Search by image

For search by image use `SearchByImageClient`.

#### Detect and features

To detect products on image and find theirs features use `detectAndFeatures`

```php
use Answear\WideEyesBundle\Service\SearchByImageClient;

$detectAndFeturesResponse = $searchByImageClient->getSimilar('url');
```

Your agrument is: `url` - url to the image on which you want to detect products and features.
In result you're getting `DetectAndFeaturesResponse` that contains all detection returned by api.

#### Search by feature

To search products with previously found feature use `searchByFeature`

```php
use Answear\WideEyesBundle\Service\SearchByImageClient;

$detectAndFeturesResponse = $searchByImageClient->searchByFeature('featureId', 'label', 'gender', 'filters');
```

Your agruments are:
 * `featureId` - featureId you got form DetectAndFeatures
 * `label` - label you got form DetectAndFeatures
 * `gender` - gender you got from DetectAndFeatures (optional)
 * `filters` - result filters (optional)

In result you're getting `SearchByFeatureResponse` that contains all found products uids meeting your criteria.

Final notes
------------

Feel free to open pull requests with new features, improvements or bug fixes. The Answear team will be grateful for any comments.

