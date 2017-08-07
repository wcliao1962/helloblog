<?php

use Illuminate\Database\Seeder;

use App\User as UserEloquent;
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;
use App\Comment as CommentEloquent;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = factory(UserEloquent::class)->create();
    	$postTypes = factory(PostTypeEloquent::class,10)->create();
    	$posts = factory(PostEloquent::class,50)->create()->each(function($post) use ($user,$postTypes){
    		$post->type=$postTypes[mt_rand(0, (count($postTypes)-1))]->id;
    		$post->user_id=$user->id;
    		$post->save();
    	});
        $comments = factory(CommentEloquent::class,300)->create()->each(function($comment) use ($posts,$user){
            $comment->post_id=$posts[mt_rand(0, (count($posts)-1))]->id;
            $comment->user_id=$user->id;
            $comment->save();
        });
    }
}
