This document is a draft, it's not complete but you can read it before contributing.

Contributions are welcome !
However, you can't just _throw_ some code and let the others do the job to polish your work.

## Development installation

- Fork the repository
- checkout this forked repository
- do some coding
- validate your code : see Coding standards

## Coding standards

This repository relies on some tools to free reviewers from the tedious tasks.

This tools are processed by GitHub's actions and can be processed on your local copy.
Be sure to run this tools before submitting a Pull request, otherwise it can't be merged.

- `vendor/bin/phpstan analyse ./`
- `vendor/bin/php-cs-fixer fix ./ --dry-run` (remove `--dry-run` to fix the code.)

## Create your owns Commands

The official documentation from PrestaShop and Symfony Core teams are still right, but you need
to extend our class.

```php
<?php

// psr-4 autoloader

// if the command is located at src/Commands
namespace MCM\Console\Commands; 
// or if command is located in a subfolder
namespace MCM\Console\Commands\Domain; // e.g. namespace MCM\Console\Commands\Configuration

use MCM\Console\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class MyCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('mcm:mycommand') // e.g 'mcm:shop-status'
            // or
            ->setName('mcm:domain:mycommand') // e.g 'mcm:configuration:export' 
            ->setDescription('Describe the command on a user perspective.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io->text('Hello Module Console Manager!!');

        return 0; // return 0 on success or 1 on failure.        
    }
}
```
