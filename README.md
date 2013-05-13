# mwiki-php: a markdown wiki

Or: How I Learned to Stop Worrying and Love the Blog

## How Do I Use This?

I *highly* encourage using PHP 5.4+ and typing:

        $ php -S localhost:8000
        PHP 5.4.12 Development Server started at Mon May 13 17:13:44 2013
        Listening on http://localhost:8000
        Document root is /home/you/dojo/mwiki-php
        Press Ctrl-C to quit.

God help you, if you're using something like
[Z-WAMP](http://zwamp.sourceforge.net/) or
[XAMPP](http://www.apachefriends.org).

## How Do I Test This?

That's a very good question!

        $ vendor/bin/phing
        Buildfile: /home/you/dojo/mwiki-php/build.xml

        mwiki-php > phpunit:

          [phpunit] Testsuite: UglyTest
          [phpunit] Tests run: 1, Failures: 1, Errors: 0, Incomplete: 0, Skipped: 0, Time elapsed: 0.00294 s
          [phpunit] testDoomed FAILED
          [phpunit] Now
        Execution of target "phpunit" failed for the following reason: /home/you/dojo/mwiki-php/build.xml:5:35: Test FAILURE (testDoomed in class UglyTest): Now

        BUILD FAILED
        /home/you/dojo/mwiki-php/build.xml:5:35: Test FAILURE (testDoomed in class UglyTest): Now
        Total time: 0.0892 seconds

Well... I think we can agree... that's a start!

## Nothing is working!

> Nowadays everybody wanna code like they got somethin' to make  
> But nothin' comes out when they move their fingertips  
> Just a bunch of gibberish  
> And PHP programmers act like they forgot about `composer`

        $ composer install
        Loading composer repositories with package information
        Installing dependencies from lock file
        ...
        Generating autoload files

Now give it go.

If it still doesn't work, raise your hand in the air and wave it round like you
just don't care.
