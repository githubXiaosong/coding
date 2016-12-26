<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Helper;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * HelperSet represents a set of helpers to be used with a command.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class HelperSet implements \IteratorAggregate
{
    private $helpers = array();
    private $command;

    /**
     * Constructor.
     *
     * @param Helper[] $helpers An array of Helper.
     */
    public function __construct(array $helpers = array())
    {
        foreach ($helpers as $alias => $helper) {
            $this->set($helper, is_int($alias) ? null : $alias);
        }
    }

    /**
     * Sets a Helper.
     *
     * @param HelperInterface $helper The Helper instance
     * @param string          $alias  An alias
     */
    public function set(HelperInterface $helper, $alias = null)
    {
        $this->helpers[$helper->getName()] = $helper;
        if (null !== $alias) {
            $this->helpers[$alias] = $helper;
        }

        $helper->setHelperSet($this);
    }

    /**
     * Returns true if the Helper if defined.
     *
     * @param string $name The Helper name
     *
     * @return bool true if the Helper is defined, false otherwise
     */
    public function has($name)
    {
        return isset($this->helpers[$name]);
    }

    /**
     * Gets a Helper value.
     *
     * @param string $name The Helper name
     *
     * @return HelperInterface The Helper instance
     *
     * @throws InvalidArgumentException if the Helper is not defined
     */
    public function get($name)
    {
        if (!$this->has($name)) {
            throw new InvalidArgumentException(sprintf('The Helper "%s" is not defined.', $name));
        }

        return $this->helpers[$name];
    }

    /**
     * Sets the command associated with this Helper set.
     *
     * @param Command $command A Command instance
     */
    public function setCommand(Command $command = null)
    {
        $this->command = $command;
    }

    /**
     * Gets the command associated with this Helper set.
     *
     * @return Command A Command instance
     */
    public function getCommand()
    {
        return $this->command;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->helpers);
    }
}
