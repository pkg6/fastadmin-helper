<?php

namespace Tp5er\FastadminHelper\commands;

use think\addons\AddonException;
use think\addons\Service;
use think\Config;
use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use think\Exception;

class AddonImportTestDataCommand extends Command
{
    protected function configure()
    {
        $this->setName('addon:import:test-data')
            ->addOption('name', 'a', Option::VALUE_REQUIRED, 'addon name', null)
            ->setDescription('Addon import test data');
    }

    protected function execute(Input $input, Output $output)
    {
        $name = $input->getOption('name');
        if (empty($name)) {
            $output->error('Addon name is required');
            return;
        }
        try {
            Service::importsql($name, 'testdata.sql');
        }catch (Exception $e) {
            $output->error($e->getMessage());
        }
        $output->info("import Successed!");
    }
}