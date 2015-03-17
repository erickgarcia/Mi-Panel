<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SetUpMainPanel extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'app:setup';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Configuracion inicial de la aplicacion.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $this->info("This is some information.");

        $this->comment("This is a comment.");

        $this->question("This is a question.");

        $this->error("This is an error.");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	/*protected function getArguments()
	{
		return array(
			array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}*/

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
