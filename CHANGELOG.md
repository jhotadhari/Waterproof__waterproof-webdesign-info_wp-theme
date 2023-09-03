# waterproof-webdesign Theme
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## 1.0.2 - 2023-09-03
Small fix

### Fixed
- Heading blocks alignments for xs screensize

## 1.0.1 - 2023-09-03
Prepare everything to use cf7 with hCaptcha

### Changed
- Updated to generator-wp-dev-env#1.6.8 ( wp-dev-env-grunt#1.6.2 wp-dev-env-frame#0.16.0 )
- Update dependencies
- Prepare theme to use cf7 with hCaptcha. Use Croox__asset-cleaner-loader_wp-plugin to load hCaptcha. Remove reCaptcha cf7 support

## 1.0.0 - 2020-05-02
Ready for deploy

### Added
- Polylang support and custom lang switch into nav-bar
- Css class .wp-block-heading-topo for styled heading blocks
- Plugin support rain-effect, add class .rain-effect to header img
- Footer menu and styled Footer
- Load cf7 google recaptcha only on contact pages

### Changed
- Header layout
- Font GlacialIndifference-Regular
- Remove page title and use active breadcrumb as h1
- Custom style for wp-block-cover
- Contact form 7 style
- Stripped bootstrap and fontawesome

### Removed
- Classic Editor Support

### Fixed
- And more small fixes
