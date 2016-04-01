<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TricksTableSeeder extends Seeder
{
    public function run()
    {
        $updatedAt = $createdAt = Carbon::now()->format('Y-m-d H:i:s');

        $tricks = [
            [
                'id' => '1',
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
                'title' => 'Display all SQL executed in Eloquent',
                'slug' => 'display-all-sql-executed-in-eloquent',
                'content' => 'Put this in your routes.php file and you will see the SQL that Eloquent is executing when you go to pages that have any sort of access to Eloquent models. This helps a lot when debugging SQL in Laravel.
```php
// Display all SQL executed in Eloquent
Event::listen(\'illuminate.query\', function($query)
{
    var_dump($query);
});
```',
                'user_id' => '1',
            ],
            [
                'id' => '2',
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
                'title' => 'Dynamic View assignments',
                'slug' => 'dynamic-view-assignments',
                'content' => 'Laravel offers a dynamic interface for assigning certain data. This can be used e.g. for adding a dynamic \'where\' to your Eloquent queries. However, not everyone know that this same trick also works on View assignments!

```php
// In Eloquent, you can assigned \'where\' clauses dynamically
Post::whereSlug(\'slug\')->get();
// Results in ...WHERE `slug` = \'slug\'...

// The same trick is possible when using Views!
View::make(\'posts.index\')->withPosts($posts);

// Same as: View::make(\'posts.index\')->with(\'posts\', $posts);
```',
                'user_id' => '2',
            ],
            [
                'id' => '3',
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
                'title' => 'Eager loading constraints',
                'slug' => 'eager-loading-constraints',
                'content' => 'Ever find yourself wanting to only find models that have a certain relationship matching certain conditions? Laravel 4.1 makes this really easy, and introduces great eager loading constraints!
```
<?php

// Post model
class Post extends Eloquent {

    public function tags()
    {
        return $this->belongsToMany(\'Tag\');
    }
}

// Tag model
class Tag extends Eloquent()
{

    public function posts()
    {
        return $this->belongsToMany(\'Post\');
    }
}

// Imagine if you want to get ONLY the posts that have the tag \'laravel\', that are posted
// in the last week.
$posts = Post::whereHas(\'tags\', function($query)
{
    // Set the constraint on the tags
    $query->where(\'name\', \'=\', \'laravel\');
})->where(\'published_at\', \' >= \', Carbon\Carbon::now()->subWeek())->get();
```',
                'user_id' => '2',
            ],
        ];

        DB::table('tricks')->insert($tricks);
    }
}
