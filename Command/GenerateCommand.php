<?php

namespace Jane\JsonSchema\Command;

use Jane\JsonSchema\Jane;
use Jane\JsonSchema\Printer;
use Jane\JsonSchema\Registry;
use Jane\JsonSchema\Schema;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenerateCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('generate');
        $this->setDescription('Generate a set of class and normalizers given a specific Json Schema file');
        $this->addOption('config-file', 'c', InputOption::VALUE_REQUIRED, 'File to use for jane configuration', '.jane');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $configFile = $input->getOption('config-file');

        if (!file_exists($configFile)) {
            throw new \RuntimeException(sprintf('Config file %s does not exist', $configFile));
        }

        $options = require $configFile;

        if (!\is_array($options)) {
            throw new \RuntimeException(sprintf('Invalid config file specified or invalid return type in file %s', $configFile));
        }

        $options = $this->resolveConfiguration($options);
        $registry = new Registry();

        if (\array_key_exists('json-schema-file', $options)) {
            $registry->addSchema($this->resolveSchema($options['json-schema-file'], $options));
            $registry->addOutputDirectory($options['directory']);
        } else {
            foreach ($options['mapping'] as $schema => $schemaOptions) {
                $registry->addSchema($this->resolveSchema($schema, $schemaOptions));
                $registry->addOutputDirectory($schemaOptions['directory']);
            }
        }

        $jane = Jane::build($options);
        $fixerConfigFile = '';

        if (\array_key_exists('fixer-config-file', $options) && null !== $options['fixer-config-file']) {
            $fixerConfigFile = $options['fixer-config-file'];
        }

        $printer = new Printer(new Standard(), $fixerConfigFile);

        if (\array_key_exists('use-fixer', $options) && \is_bool($options['use-fixer'])) {
            $printer->setUseFixer($options['use-fixer']);
        }
        if (\array_key_exists('clean-generated', $options) && \is_bool($options['clean-generated'])) {
            $printer->setCleanGenerated($options['clean-generated']);
        }

        $jane->generate($registry);
        $printer->output($registry);

        return 0;
    }

    protected function resolveConfiguration(array $options = [])
    {
        $optionsResolver = new OptionsResolver();
        $optionsResolver->setDefaults([
            'reference' => true,
            'strict' => true,
            'date-format' => \DateTime::RFC3339,
            'full-date-format' => 'Y-m-d',
            'use-fixer' => false,
            'fixer-config-file' => null,
            'clean-generated' => true,
            'use-cacheable-supports-method' => null,
        ]);

        if (\array_key_exists('json-schema-file', $options)) {
            $optionsResolver->setRequired([
                'json-schema-file',
                'root-class',
                'namespace',
                'directory',
            ]);
        } else {
            $optionsResolver->setRequired([
                'mapping',
            ]);
        }

        return $optionsResolver->resolve($options);
    }

    protected function resolveSchema($schema, array $options = [])
    {
        $optionsResolver = new OptionsResolver();

        // To support old schema
        $optionsResolver->setDefined([
            'json-schema-file',
            'reference',
            'date-format',
            'full-date-format',
            'strict',
            'use-fixer',
            'fixer-config-file',
            'clean-generated',
            'use-cacheable-supports-method',
        ]);

        $optionsResolver->setRequired([
            'root-class',
            'namespace',
            'directory',
        ]);

        $options = $optionsResolver->resolve($options);

        return new Schema($schema, $options['namespace'], $options['directory'], $options['root-class']);
    }
}
