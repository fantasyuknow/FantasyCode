<?php

namespace App\Observers;

use App\Models\Tag;

class TagObserver
{
    /**
     * Handle the tag "created" event.
     *
     * @param  \App\Models\Tag  $tag
     * @return void
     */
    public function created(Tag $tag)
    {
        //
    }

    /**
     * Handle the tag "updated" event.
     *
     * @param  \App\Models\Tag
     * @return void
     */
    public function updated(Tag $tag)
    {
        //
    }

    /**
     * Handle the tag "deleted" event.
     *
     * @param  \App\Models\Tag
     * @return void
     */
    public function deleted(Tag $tag)
    {
        //
    }

    /**
     * Handle the tag "restored" event.
     *
     * @param  \App\Models\Tag
     * @return void
     */
    public function restored(Tag $tag)
    {
        //
    }

    /**
     * Handle the tag "force deleted" event.
     *
     * @param  \App\Models\Tag
     * @return void
     */
    public function forceDeleted(Tag $tag)
    {
        //
    }
}
