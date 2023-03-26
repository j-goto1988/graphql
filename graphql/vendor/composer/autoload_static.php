<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit95e32a22d472be051d335b63d91c9544
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'GraphQL\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'GraphQL\\' => 
        array (
            0 => __DIR__ . '/..' . '/webonyx/graphql-php/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit95e32a22d472be051d335b63d91c9544::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit95e32a22d472be051d335b63d91c9544::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit95e32a22d472be051d335b63d91c9544::$classMap;

        }, null, ClassLoader::class);
    }
}