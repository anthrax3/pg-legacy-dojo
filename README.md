# mwiki-php: a markdown wiki

Or: How I Learned to Stop Worrying and Love the Blog

## How Do I Use This?

I *highly* encourage using PHP 5.4+ and typing:

        $ scripts/serve
        PHP 5.4.12 Development Server started at Mon May 13 17:13:44 2013
        Listening on http://localhost:8000
        Document root is /home/you/dojo/mwiki-php
        Press Ctrl-C to quit.

God help you, if you're using something like
[Z-WAMP](http://zwamp.sourceforge.net/) or
[XAMPP](http://www.apachefriends.org).

## How Do I Test This?

That's a very good question!

	$ scripts/test
	PHPUnit 3.7.19 by Sebastian Bergmann.

	F

	Time: 0 seconds, Memory: 2.75Mb

	There was 1 failure:

	1) UglyTest::testDoomed
	Now

	/home/you/dojo/mwiki-php/tests/UglyTest.php:5

	FAILURES!
	Tests: 1, Assertions: 0, Failures: 1.

Well... I think we can agree... that's a start!

## Nothing is working!

> Nowadays everybody wanna code like they got somethin' to make  
> But nothin' comes out when they move their fingertips  
> Just a bunch of gibberish  
> And PHP programmers act like they forgot about `composer`

        $ scripts/prepare
        Loading composer repositories with package information
        Installing dependencies from lock file
        ...
        Generating autoload files

Now give it go.

If it still doesn't work, raise your hand in the air and wave it round like you
just don't care.
