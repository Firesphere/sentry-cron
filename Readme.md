# Sentry-cron

Installation:

`composer require firesphere/sentry-cron`

# Usage

Create a cronjob in Sentry, and get its key.

Get your Sentry DSN key

In your PHP task that is supposed to run periodically, include the Sentry Trait:

```php
class MyPeriodicClass
{
    use \Firesphere\SentryCron\SentryTrait;
    
    public function doTheThing()
    {
        $this->start($dsn, $cronjob_id);
        
        // Your code actions here
        $error = false; // Or true if an error happened in your code.
        
        $this->end($error);
    }
}
```

That's pretty much all there's to it :)


# Cow?

Cow!

```

             /( ,,,,, )\
            _\,;;;;;;;,/_
         .-"; ;;;;;;;;; ;"-.
         '.__/`_ / \ _`\__.'
            | (')| |(') |
            | .--' '--. |
            |/ o     o \|
            |           |
           / \ _..=.._ / \
          /:. '._____.'   \
         ;::'    / \      .;
         |     _|_ _|_   ::|
       .-|     '==o=='    '|-.
      /  |  . /       \    |  \
      |  | ::|         |   | .|
      |  (  ')         (.  )::|
      |: |   |;  U U  ;|:: | `|
      |' |   | \ U U / |'  |  |
      ##V|   |_/`"""`\_|   |V##
         ##V##         ##V##
```
