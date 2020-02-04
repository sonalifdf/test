<?php

namespace Laracademy\Commands;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class jokeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
	protected $signature = 'command:name';
     */
    protected $signature = 'joke';

    /**
     * The console command description.
     *
     * @var string
	 protected $description = 'Command description';
     */
    protected $description = 'its just a little joke';

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
    public function handle()
    {
        $client = new Client();
	$esponse = $client->request('GET','https://icanhazdadjoke.com',[
	'header' => [
		'Accept' => 'text/plain',
	],
	]);
	if($response->getstatuscode() != 200){
		$this->error('cannot contact joke API');
		return;
	}
	$this->info((string)$response->gtBody());
    }
}
