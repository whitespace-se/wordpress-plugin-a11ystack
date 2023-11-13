## [2.0.0](https://github.com/whitespace-se/wordpress-plugin-a11ystack/compare/v1.4.0...v2.0.0) (2023-11-13)


### ⚠ BREAKING CHANGES

* Event occasion field structure
* Move code from municipio-gatsby plugin

### Features

* Add "card" format to Billboard module ([c86f75f](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/c86f75fc8c94c46d926de03f567b1f431407170c))
* Add "read-more page" field to alert posts ([056e2d0](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/056e2d07844c9dc19cdd32f4e035b33cdfa11c51))
* Add `eventDates` on Event graphql type ([208ea7e](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/208ea7e13e61911b8b1f6b0e5f25a35935239105))
* Add `hasPageContent` field to `ContentNode` type ([f39b16a](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/f39b16a22c5119d1b5c73b45d2174496b0ecba9e))
* Add `manualExcerpt` field to `NodeWithExcerpt` interface ([73fb754](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/73fb75410fd84f1ebbc6a2f53d596475fa4eeafe))
* Add `whitespace_a11ystack_billboard_fields/{field}` filter ([0c668ed](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/0c668ed35625f50ef275f2e2df6aada065617353))
* Add `whitespace_a11ystack_get_icons` function ([8f59abf](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/8f59abfd2d682dcdb0c2e1d2b35a076502ca4596))
* Add `whitespace_a11ystack_post_has_modules` util ([5e7547c](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/5e7547c7239da9e5265a4028ed2d0ba47401aadd))
* Add ability to toggle post type UIs ([0fb1cb8](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/0fb1cb8489f2c6a633452b6f5a09ec65f082ba55))
* Add alert post type ([df15f83](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/df15f838599acc6a2e9cf328420019c166d78d61))
* Add align and background to modularity editory ([e9aa5ce](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/e9aa5cee2f8eed27ca69cb04dad5dea9cdb9521a))
* Add Billboard module ([46d69ef](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/46d69efd022516d0f7c362fdc3ff4cf27a55c451))
* Add buttons field to text module ([300f912](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/300f912af813458b702ac34e799ec14101d3cc95))
* Add color field to manual posts ([6a8294e](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/6a8294e7c9145c11afa9e4e23b91c72d1386d874))
* Add content editor to modules ([e78ecd0](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/e78ecd0fab41fca405e6ed924b9d09101871a0c3))
* Add event post type ([1376bb8](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/1376bb8d08c740e6a1daa7685bf1a8fc9c6c8c98))
* Add excerpt support to alert posts ([e3c2011](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/e3c2011157c1446e99596a82fc8cd1c45c3a38dd))
* Add expandable option to text modules ([38a223a](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/38a223adc85d191ff4a7b62eed8c03081af42c26))
* Add image aspect ratio and placement to billboard module ([e092f38](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/e092f38a58e006673f79bdfa639617c85da52b34))
* Add location field to events and `whitespace_a11ystack_event_fields` filter ([b717dc0](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/b717dc0960555d50713b98db1133fdfef1971d5e))
* Add menu item fields from municipio-gatsby plugin ([887c087](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/887c0872001706c5070329c64b268f389e52472f))
* Add posts module fields from municipio-gatsby plugin ([d20a97d](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/d20a97d10249bba6afae42cc9d34dbcd6c770471))
* Add translations ([699d60e](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/699d60eec552cc73005ffcf56e872beb6bf57529))
* Add util functions ([45a0802](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/45a0802a61c8295b07e145eb6e3fe56acb18b5e8))
* Allow thumbnails on events ([44342d7](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/44342d72a67b67becbc053c82dee137f3425f93d))
* Disable more options ([6ecf2fc](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/6ecf2fc5e0e5e3d2dcf376f81b44c9af1f99a369))
* Make alert post type ui optional ([4f4c936](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/4f4c936664a80ddbeffeb16d8bd3cdb4307b9a3d))
* Make event end date optional ([5a34b70](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/5a34b70ee247a070f12d9bac6814c2ca55c5554d))
* Remove event location field ([54239df](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/54239df7c96d07282e8a415030ee2f195b257fa9))


### Bug Fixes

* Add cache bust to js file ([428d89a](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/428d89a2171eb5ef383ef0baf65ee7f05eb1faf2))
* Broken js ([56345b1](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/56345b19526eb5c07f60faf0925fb3d51c99a468))
* Broken js ([2ee3de2](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/2ee3de2624c3c25f2e591f95b95d97a8c5478b45))
* Change default billboard color to transparent ([6dde9a7](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/6dde9a7552319c8064cd64ecfb62cb8a759d154f))
* Error with field definition ([efd8e6b](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/efd8e6bdec3e5da7daf17ca81095f57551a8b30c))
* Event dates for event without end date was empty ([255a64e](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/255a64ec080677e2608fd34e7b364e02cae956b2))
* Event occasion field structure ([e7be777](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/e7be777e10ae39910adce7a2c32ccc7c51927cbe))
* Event sorting in posts module ([220fbfc](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/220fbfce6fd39682ffaa33f5d7681bbb5ae083ce))
* Modularity sections script was not idempotent ([5d1ba90](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/5d1ba9060ba4c98915283472c6411c5785609aa5))
* Post type graphql names ([bec4f88](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/bec4f88b6380a20301ea977a13cdebfb9b1bb040))
* Remove extranumerous image field ([f4455e1](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/f4455e1459fce1fee6e2cf5ce78605ed13a69a20))
* Revert to previous name for color fields ([ca89b5b](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/ca89b5b2b27e43d3fa35d1b224f0b3677642c758))
* Script error in Chrome due to timing ([140da7d](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/140da7d55fdf75678fefbbde4a7a2dd7dbf16ab0))
* Update instructions for manual input icon field ([8b5165a](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/8b5165aeea5f1027bc9e4d4e5d4939db1c02f1e0))
* Update post meta for event posts immediately first time it's scheduled ([19c3984](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/19c3984beb5d91f3a033bcfad64e19b0ecf4f788))
* Wrong format on archiveDates and archiveDatesGmt on events ([0446c93](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/0446c931112d33878998728c076a021527401012))


### Code Refactoring

* Move code from municipio-gatsby plugin ([6af240e](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/6af240e0f03664c7b522239f2b9ba7e8b6541b8e))

## [1.4.0](https://github.com/whitespace-se/wordpress-plugin-a11ystack/compare/v1.3.0...v1.4.0) (2022-07-05)


### Features

* Add support for feedback comments ([8c77e20](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/8c77e206654918029f4c8f06c01dd4d4e7eaa4bf))


### Bug Fixes

* Remove debug code ([85477e5](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/85477e593a5b5df6d0db120fb8d78ac92dddcb2f))

## [1.3.0](https://github.com/whitespace-se/wordpress-plugin-a11ystack/compare/v1.2.0...v1.3.0) (2022-05-09)


### Features

* Change module editor publish button label ([d176a8a](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/d176a8aadaeacff05442bd29c3d059d630c18ddb))
* Hide module editor preview button ([96f611a](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/96f611ab5ef3d94884956001f4ff3e7529ebbacb))
* Replace taxonomy metaboxes with ACF ([765792c](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/765792ce76f6b7b2d0b49028e66254ae5634f908))
* Update translations ([4aa9e0f](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/4aa9e0f346ab6f3cf5062c87be573592f43225bb))

## [1.2.0](https://github.com/whitespace-se/wordpress-plugin-a11ystack/compare/v1.1.0...v1.2.0) (2022-05-05)


### Features

* Add feature flag for feedback module ([b2553ef](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/b2553ef6de9b62a0da62f068d6324e5c828910f6))
* Add feature flag for open graph fields ([cdd872d](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/cdd872d8fa14e005a7ad129552ff96207e8ae52b))
* Add Feedback module ([90b558d](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/90b558df82b5c66e86fa00f2f668d08bce585251))

## [1.1.0](https://github.com/whitespace-se/wordpress-plugin-a11ystack/compare/v1.0.0...v1.1.0) (2022-03-04)


### Features

* create custom WP filter for overriding default ACF location of `openGraph` fields ([0c39a9a](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/0c39a9a83f5edf02adbf818bc468fe8e48bc6bb6))


### Bug Fixes

* Allow install on Composer 1 ([ea54d0c](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/ea54d0c995453e35a7cfcc0310d5318cad37ebc6))
* rename filter and use a one-dimensional array of post types ([5eb29be](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/5eb29be80ee6e5408b128d968bc5d2d355e3713f))

## [1.0.0](https://github.com/whitespace-se/wordpress-plugin-a11ystack/compare/9e1ca13afde4d83c521d0d997970abfe06555cdd...v1.0.0) (2022-03-02)


### Bug Fixes

* Install to correct folder ([9e1ca13](https://github.com/whitespace-se/wordpress-plugin-a11ystack/commit/9e1ca13afde4d83c521d0d997970abfe06555cdd))

