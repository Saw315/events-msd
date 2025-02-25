<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit38e7c0bf78055e35f902aac6e4ee4430
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MSDEvents\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MSDEvents\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit38e7c0bf78055e35f902aac6e4ee4430::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit38e7c0bf78055e35f902aac6e4ee4430::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit38e7c0bf78055e35f902aac6e4ee4430::$classMap;

        }, null, ClassLoader::class);
    }
}
