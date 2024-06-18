<?php
/**
 * Copyleft (c) Since 2024 Marco Salvatore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file docs/licenses/LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/afl-3.0.php
 *
 * @author    Marco Salvatore <hi@marcosalvatore.dev>
 * @copyleft since 2024 Marco Salvatore
 * @license   https://opensource.org/licenses/AFL-3.0  Academic Free License ("AFL") v. 3.0
 *
 */

declare(strict_types=1);

namespace MCM\Console\Tests\Validator;

use ArrayIterator;
use Iterator;
use IteratorAggregate;
use MCM\Console\Tests\Validator\Exception\CantValidateEmptyValidationResults;

/**
 * Class ValidationResults
 *
 * @implements IteratorAggregate<ValidationResult>
 */
class ValidationResults implements IteratorAggregate
{
    /**
     * @var array<int, ValidationResult>
     */
    private $results = [];

    public function isValidationSuccessful(): bool
    {
        if (empty($this->results)) {
            throw new CantValidateEmptyValidationResults();
        }

        return array_reduce($this->results, function (bool $successful, ValidationResult $result) {
            return $successful && $result->isSuccessful();
        }, true);
    }

    /**
     * @return \Iterator<ValidationResult>
     */
    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->results);
    }

    public function addResult(ValidationResult $result): void
    {
        $this->results[] = $result;
    }

    /**
     * @return array<int, \MCM\Console\Tests\Validator\ValidationResult>
     */
    public function getFailures(): array
    {
        return array_filter(
            iterator_to_array($this),
            function (ValidationResult $result) {
                return !$result->isSuccessful();
            }
        );
    }
}
