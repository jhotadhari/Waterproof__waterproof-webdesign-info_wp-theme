<?php return array(
    'root' => array(
        'name' => '__root__',
        'pretty_version' => 'dev-develop',
        'version' => 'dev-develop',
        'reference' => 'a5e42fcd0ceb191decfde9e1ba25f06552722129',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => 'dev-develop',
            'version' => 'dev-develop',
            'reference' => 'a5e42fcd0ceb191decfde9e1ba25f06552722129',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'composer/installers' => array(
            'pretty_version' => 'v1.12.0',
            'version' => '1.12.0.0',
            'reference' => 'd20a64ed3c94748397ff5973488761b22f6d3f19',
            'type' => 'composer-plugin',
            'install_path' => __DIR__ . '/./installers',
            'aliases' => array(),
            'dev_requirement' => true,
        ),
        'croox/wp-dev-env-frame' => array(
            'pretty_version' => '0.17.1',
            'version' => '0.17.1.0',
            'reference' => '930abe20002c3ff25134ee072ec2b3ea32497412',
            'type' => 'library',
            'install_path' => __DIR__ . '/../croox/wp-dev-env-frame',
            'aliases' => array(),
            'dev_requirement' => true,
        ),
        'roundcube/plugin-installer' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'shama/baton' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'wp-bootstrap/wp-bootstrap-navwalker' => array(
            'pretty_version' => 'v4.3.0',
            'version' => '4.3.0.0',
            'reference' => '5d39044bcee8703d1402f7371b033c460b2e0a71',
            'type' => 'library',
            'install_path' => __DIR__ . '/../wp-bootstrap/wp-bootstrap-navwalker',
            'aliases' => array(),
            'dev_requirement' => true,
        ),
    ),
);
