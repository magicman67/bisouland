# Bisouland

Bisouland is a free online strategy-game. In order to play you only need a
web browser.

Take your opponents love points by sending them kisses!

## Requirements

Bisouland uses [npm](https://npmjs.org/), to install it, use the following commands:

    # npm installation (through nodejs)
    wget http://nodejs.org/dist/latest/node-v0.10.7.tar.gz
    tar zxvf node-v0.10.7.tar.gz
    cd node-v0.10.7
    ./configure
    make
    sudo ake install
    cd ..
    rm -rf node-v0.10.7*

## Installation

To install Bisouland, download and use its installation script:

    curl -sS  https://raw.github.com/pyricau/bisouland/master/bin/install.sh | sh

Then follow these 2 small steps to configure it.

### Administration access

The administration area is protected using
[`.htaccess` and `.htpasswd` files](http://weavervsworld.com/docs/other/passprotect.html).

First of all, create them:

    cp web/news/.htaccess.dist web/news/.htaccess
    touch web/news/.htpasswd

Then simply set the absolute path of the project in the `web/news/.htaccess`
file, and put a
[generated password](http://www.htaccesstools.com/htpasswd-generator/) in the
`web/news/.htpasswd` file.

### Emailing

Now that everything is configured, check email sending for registration and
newsletter.

## Structure

Every request will go to the Symfony2 application. If the route is not found
in it, the legacy application will be boostraped.

**Warning**: the legacy application, which lies in the `web` directory,
has been created in 2005 by a someone who was learning web development.
Therefore it probably contains security holes, bugs, low quality code
and bad design pattern.

## Further documentation

You can find more documentation at the following links:

* Copyright and Apache 2 license: [LICENSE.md](LICENSE.md);
* version and change logs: [VERSION.md](VERSION.md)
  and [CHANGELOG.md](CHANGELOG.md);
* versioning and branching models,
  as well as public API: [VERSIONING.md](VERSIONING.md);
* contribution instructions: [CONTRIBUTING.md](CONTRIBUTING.md).

## Project history

* 2013: roll back to the version 1, which becomes the version 3;
* 2012: release of the version 2;
* 2011: Open-sourcing of the project, new team to take over the project with
  Marc Epron, Thomas Gay and Loïc Chardonnet;
* 2005: creation of the project by **Pierre-Yves Ricau**.
