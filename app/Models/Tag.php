<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = ['name'];

    /**
     * ------------------------------------------------------------------------
     * 表关联
     * ------------------------------------------------------------------------
     */

    /**
     * 标签与文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_tags', 'tag_id', 'topic_id');
    }

    /**
     * --------------------------------------------------------------------------
     * 方法
     * --------------------------------------------------------------------------
     */

    /**
     * @param $name
     * @return mixed
     */
    public function hasTag($name)
    {
        return $this->where('name', $name)->exists();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getTag($name)
    {
        return $this->where('name', $name)->pluck('id');
    }

    /**
     * 更新标签数据
     *
     * @param $tag_str
     * @return array|bool
     */
    public function updateTags($tag_str)
    {
        if (!$tag_str) return false;
        $tagIds = [];
        $tagArr = array_unique(array_filter(explode(',', $tag_str)));
        if (empty($tagArr)) return false;
        foreach ($tagArr as $tag) {
            if (!$this->hasTag($tag)) {
                $this->name = $tag;
                $this->save();
            }
            $tag_id_arr = $this->getTag($tag);
            foreach ($tag_id_arr as $item) {
                $tagIds[] = $item;
            }
        }
        return $tagIds;
    }


}
