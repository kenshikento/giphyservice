<?php

namespace App\Console;

use App\Giphy;
use App\Support\GiphyManager;
use Illuminate\Console\Command;

class GiphySearch extends Command
{

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GiphyManager $giphyManager)
    {
        parent::__construct();
        $this->giphyManager = $giphyManager;
    }

    /**
     * @inheritDoc
     */
    protected $signature = 'gif:search {query}';
    
    /**
     * @inheritDoc
     */
    protected $description = 'Retrieves a random GIF';

    /**
     * @inheritDoc
     */
    public function handle()
    {
        $giphy = $this->getGif();

        if (!$giphy) {
            throw new Exception('Something gone wrong');
        }

        $output = $this->output($giphy);

        $this->line($output);
    }

    public function getGif(): Giphy
    {
        return $this->giphyManager->search($this->argument('query'));
    }

    /**
     * takes data from giphy model and json encodes as data is protected
     *
     * @return string the JSON string
     */
    public function output(Giphy $giphy)
    {
        return json_encode(get_giphy($giphy));
    }
}
