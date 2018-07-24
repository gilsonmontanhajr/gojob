<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit00bc70f9d034283bd5af86a1aa857f95
{
    public static $files = array (
        'e40631d46120a9c38ea139981f8dab26' => __DIR__ . '/..' . '/ircmaxell/password-compat/lib/password.php',
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Cache\\' => 10,
            'Project\\App\\' => 12,
            'PHPixie\\Tests\\' => 14,
            'PHPixie\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'Project\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/bundles/app/src',
        ),
        'PHPixie\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpixie/auth/tests/PHPixie/Tests',
            1 => __DIR__ . '/..' . '/phpixie/auth-http/tests/PHPixie/Tests',
            2 => __DIR__ . '/..' . '/phpixie/auth-login/tests/PHPixie/Tests',
            3 => __DIR__ . '/..' . '/phpixie/auth-orm/tests/PHPixie/Tests',
            4 => __DIR__ . '/..' . '/phpixie/auth-processors/tests/PHPixie/Tests',
            5 => __DIR__ . '/..' . '/phpixie/auth-social/tests/PHPixie/Tests',
            6 => __DIR__ . '/..' . '/phpixie/bundle-framework/tests/PHPixie/Tests',
            7 => __DIR__ . '/..' . '/phpixie/bundles/tests/PHPixie/Tests',
            8 => __DIR__ . '/..' . '/phpixie/cache/tests/PHPixie/Tests',
            9 => __DIR__ . '/..' . '/phpixie/cli/tests/PHPixie/Tests',
            10 => __DIR__ . '/..' . '/phpixie/config/tests/PHPixie/Tests',
            11 => __DIR__ . '/..' . '/phpixie/console/tests/PHPixie/Tests',
            12 => __DIR__ . '/..' . '/phpixie/database/tests/PHPixie/Tests',
            13 => __DIR__ . '/..' . '/phpixie/debug/tests/PHPixie/Tests',
            14 => __DIR__ . '/..' . '/phpixie/default-bundle/tests/PHPixie/Tests',
            15 => __DIR__ . '/..' . '/phpixie/di/tests/PHPixie/Tests',
            16 => __DIR__ . '/..' . '/phpixie/filesystem/tests/PHPixie/Tests',
            17 => __DIR__ . '/..' . '/phpixie/framework/tests/PHPixie/Tests',
            18 => __DIR__ . '/..' . '/phpixie/framework-bundle/tests/PHPixie/Tests',
            19 => __DIR__ . '/..' . '/phpixie/http/tests/PHPixie/Tests',
            20 => __DIR__ . '/..' . '/phpixie/http-processors/tests/PHPixie/Tests',
            21 => __DIR__ . '/..' . '/phpixie/image/tests/PHPixie/Tests',
            22 => __DIR__ . '/..' . '/phpixie/migrate/tests/PHPixie/Tests',
            23 => __DIR__ . '/..' . '/phpixie/orm/tests/PHPixie/Tests',
            24 => __DIR__ . '/..' . '/phpixie/paginate/tests/PHPixie/Tests',
            25 => __DIR__ . '/..' . '/phpixie/paginate-orm/tests/PHPixie/Tests',
            26 => __DIR__ . '/..' . '/phpixie/processors/tests/PHPixie/Tests',
            27 => __DIR__ . '/..' . '/phpixie/route/tests/PHPixie/Tests',
            28 => __DIR__ . '/..' . '/phpixie/security/tests/PHPixie/Tests',
            29 => __DIR__ . '/..' . '/phpixie/slice/tests/PHPixie/Tests',
            30 => __DIR__ . '/..' . '/phpixie/social/tests/PHPixie/Tests',
            31 => __DIR__ . '/..' . '/phpixie/template/tests/PHPixie/Tests',
            32 => __DIR__ . '/..' . '/phpixie/validate/tests/PHPixie/Tests',
        ),
        'PHPixie\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpixie/auth/src/PHPixie',
            1 => __DIR__ . '/..' . '/phpixie/auth-http/src/PHPixie',
            2 => __DIR__ . '/..' . '/phpixie/auth-login/src/PHPixie',
            3 => __DIR__ . '/..' . '/phpixie/auth-orm/src/PHPixie',
            4 => __DIR__ . '/..' . '/phpixie/auth-processors/src/PHPixie',
            5 => __DIR__ . '/..' . '/phpixie/auth-social/src/PHPixie',
            6 => __DIR__ . '/..' . '/phpixie/bundle-framework/src/PHPixie',
            7 => __DIR__ . '/..' . '/phpixie/bundles/src/PHPixie',
            8 => __DIR__ . '/..' . '/phpixie/cache/src/PHPixie',
            9 => __DIR__ . '/..' . '/phpixie/cli/src/PHPixie',
            10 => __DIR__ . '/..' . '/phpixie/config/src/PHPixie',
            11 => __DIR__ . '/..' . '/phpixie/console/src/PHPixie',
            12 => __DIR__ . '/..' . '/phpixie/database/src/PHPixie',
            13 => __DIR__ . '/..' . '/phpixie/debug/src/PHPixie',
            14 => __DIR__ . '/..' . '/phpixie/default-bundle/src/PHPixie',
            15 => __DIR__ . '/..' . '/phpixie/di/src/PHPixie',
            16 => __DIR__ . '/..' . '/phpixie/filesystem/src/PHPixie',
            17 => __DIR__ . '/..' . '/phpixie/framework/src/PHPixie',
            18 => __DIR__ . '/..' . '/phpixie/framework-bundle/src/PHPixie',
            19 => __DIR__ . '/..' . '/phpixie/http/src/PHPixie',
            20 => __DIR__ . '/..' . '/phpixie/http-processors/src/PHPixie',
            21 => __DIR__ . '/..' . '/phpixie/image/src/PHPixie',
            22 => __DIR__ . '/..' . '/phpixie/migrate/src/PHPixie',
            23 => __DIR__ . '/..' . '/phpixie/orm/src/PHPixie',
            24 => __DIR__ . '/..' . '/phpixie/paginate/src/PHPixie',
            25 => __DIR__ . '/..' . '/phpixie/paginate-orm/src/PHPixie',
            26 => __DIR__ . '/..' . '/phpixie/processors/src/PHPixie',
            27 => __DIR__ . '/..' . '/phpixie/route/src/PHPixie',
            28 => __DIR__ . '/..' . '/phpixie/security/src/PHPixie',
            29 => __DIR__ . '/..' . '/phpixie/slice/src/PHPixie',
            30 => __DIR__ . '/..' . '/phpixie/social/src/PHPixie',
            31 => __DIR__ . '/..' . '/phpixie/template/src/PHPixie',
            32 => __DIR__ . '/..' . '/phpixie/validate/src/PHPixie',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
        1 => __DIR__ . '/../..' . '/tests',
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PHPixie' => 
            array (
                0 => __DIR__ . '/..' . '/phpixie/test/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit00bc70f9d034283bd5af86a1aa857f95::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit00bc70f9d034283bd5af86a1aa857f95::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInit00bc70f9d034283bd5af86a1aa857f95::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit00bc70f9d034283bd5af86a1aa857f95::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}