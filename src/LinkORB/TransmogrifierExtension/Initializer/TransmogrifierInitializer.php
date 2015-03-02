<?php

namespace LinkORB\TransmogrifierExtension\Initializer;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;
use LinkORB\TransmogrifierExtension\TransMogrifierContext;

/**
 * Transmogrifier contexts initializer.
 * Sets parameters to the Transmogrifier contexts.
 *
 * @author Joost Faassen <j.faassen@linkorb.com>
 */
class TransmogrifierInitializer implements ContextInitializer
{
    private $dbconf_dir;
    private $dataset_dir;

    /**
     * Initializes initializer.
     *
     */
    public function __construct($dataset_dir, $dbconf_dir)
    {
        $this->dataset_dir = $dataset_dir;
        $this->dbconf_dir = $dbconf_dir;
    }

    /**
     * Checks if initializer supports provided context.
     *
     * @param ContextInterface $context
     *
     * @return Boolean
     */
    public function supports(ContextInterface $context)
    {
        // if context/subcontext is an instance of TransMogrifierContext
        if ($context instanceof TransMogrifierContext) {
            return true;
        }

        return false;
    }

    /**
     * Initializes provided context.
     *
     * @param Context $context
     */
    public function initializeContext(Context $context)
    {
        $context->setDatasetDir($this->dataset_dir);
        $context->setDbConfDir($this->dbconf_dir);
    }
}
