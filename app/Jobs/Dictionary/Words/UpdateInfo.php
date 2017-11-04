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
        $client = new Client;
        $response = $client->get('http://www.kateglo.com/api.php', [
            'query' => [
                'format' => 'json',
                'phrase' => $this->word->word
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            $body = (string)$response->getBody();

            if ($this->isJson($body)) {
                $body = json_decode($body);

                $group = Group::firstOrCreate([
                    'name' => $body->kateglo->lex_class_name
                ]);

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
