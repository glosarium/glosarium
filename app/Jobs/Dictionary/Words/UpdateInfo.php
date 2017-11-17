<?php
namespace App\Jobs\Dictionary\Words;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Dictionary\Word;
use GuzzleHttp\Client;
use App\Dictionary\Group;
use App\Dictionary\Description;
use Log;
use GuzzleHttp\TransferStats;

class UpdateInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $word;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Word $word)
    {
        $this->word = $word;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client([
            'base_uri' => config('services.dictionary.url')
        ]);

        $response = $client->get('api.php', [
            'query' => [
                'format' => 'json',
                'phrase' => $this->word->word,
            ],
            'http_errors' => false,
            'on_stats' => function(TransferStats $stats) use (&$url) {
                $url = $stats->getEffectiveUri();
            }
        ]);

        if ($response->getStatusCode() === 200) {
            $body = (string)$response->getBody();

            Log::debug(sprintf('Melakukan permintaan data ke %s: %s', $url, $body));

            if ($this->isJson($body)) {
                $body = json_decode($body);

                $group = Group::firstOrCreate([
                    'name' => $body->kateglo->lex_class_name
                ]);

                $this->word->group_id = $group->id;
                $this->word->pronounciation = $body->kateglo->pronounciation ?? '';
                $this->word->source = $body->kateglo->ref_source_name;
                $this->word->save();
                
                // create descriptions for word
                if (!empty($body->kateglo->definition)) {
                    $descriptions = [];
                    foreach ($body->kateglo->definition as $definition) {
                        $descriptions[] = [
                            'word_id' => $this->word->id,
                            'text' => $definition->def_text,
                            'sample' => $definition->sample ?? '',
                            'source' => $definition->reference->url ?? null
                        ];
                    }

                    Description::insert($descriptions);
                }
            }
        }
        else {
            Log::error(sprintf('Request to %s returned %s.', $url, $response->getStatusCode()));
        }
    }

    /**
     * Check if string is JSON formatted.
     *
     * @param string $string
     * @return boolean
     */
    function isJson(string $string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
