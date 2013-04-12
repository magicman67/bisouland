# Bisouland

Bisouland is a free online strategy-game. In order to play you only need a
web browser.

Take your opponents love points by sending them kisses!

## Installation

 1. Create the file `web/news/.htpasswd`;
 2. configure the database in [web/phpincludes/bd.php](web/phpincludes/bd.php);
 3. check email sending for registration;
 4. put the admin email in the variable `$destinataire`
 	from [web/news/mail.php](web/news/mail.php).

## Structure

A Symfony2 application will be the entry point of every requests. If the route
is not found, the legacy application will be boostraped.

**Warning**: this legacy application lies in the `web` directory
and has been created in 2005 while learning web development,
which means that tt probably contains security holes, bugs, low quality code
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
 * 2011: the project became open source, Marc Epron, Thomas Gay
   and Loïc Chardonnet take over the work;
 * 2005: **Pierre-Yves Ricau** creates the project.
