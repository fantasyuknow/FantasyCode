<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;
use Illuminate\Support\Facades\DB;

class TopicJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $topic;

    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }


    public function handle()
    {
        //slug处理
        $slug = app(SlugTranslateHandler::class)->translate($this->topic->title);
        DB::table('topics')->where('id', $this->topic->id)->update(['slug' => $slug]);
    }
}
