<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;


    public function mount(Post $post)
    {
        $this->isLiked = auth()->user() ? $post->checkLike(auth()->user()) : false;
        $this->likes = $post->likes->count();
    }

    public function like()
    {
        if($this->post->checkLike(auth()->user())) {   
            auth()->user()->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.components.like-post');
    }
}
