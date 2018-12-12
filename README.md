Trivial Silex Demonstration
===========================

This solution was developed and tested on Gentoo Linux using:

    PHP 7.2.12 (cli) (built: Dec  4 2018 06:00:22) ( ZTS )
    Copyright (c) 1997-2018 The PHP Group
    Zend Engine v3.2.0, Copyright (c) 1998-2018 Zend Technologies
        with Zend OPcache v7.2.12, Copyright (c) 1999-2018, by Zend Technologies

and

    QupZilla
    Application version 2.2.5
    QtWebEngine version 5.11.2
    © 2010-2018 David Rosca
    https://www.qupzilla.com
    Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) QupZilla/2.2.5 Chrome/65.0.3325.230 Safari/537.36

## Running

    $ unzip silex.zip
    $ cd silex
    $ composer install
    $ php -S localhost:3000

then open a browser and navigate to http://localhost:3000

## Further Information

The required packages are included in the .zip file;  if the vendor/ directory is missing or corrupted,
they can be re-installed with these commands:

    $ rm -rf vendor
    $ composer install
