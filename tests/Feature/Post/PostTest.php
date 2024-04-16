<?php


namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PostTest extends TestCase{
    use RefreshDatabase;

    // <!-- Est-ce que l'on arrive à avoir un 200 sur la page -->
    public function test_post_page_can_be_rendered(): void
    {
        $response = $this->get("/posts");

        $response->assertStatus(302);
    }

    public function test_users_can_create_a_post(): void
    {
        $user = User::factory()->create();
        $image = UploadedFile::fake()->image("image.jpg");

        

        $response = $this->actingAs($user)->post('/posts', [
            'message' => "Hello ceci est un test",
            'image' => $image,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect("posts");
    }
    public function test_users_can_update_a_post(): void{
        //$user = User::factory()->create();
        $post = Post::factory()->create();
        $route = "/posts/$post->id";
        $user = $post->user;
        print($route);

        $response = $this
            ->actingAs($user)
            ->patch($route, [
                'message' => 'updated message',
                
            ]);

        $response
            ->assertFound();
            // ->assertRedirect('/posts');

        $post->refresh();
        print($post->message);
        

        $this->assertSame('updated message', $post->message);
        
    }
}






// <!--est-ce que l'on arrive à poster quelque chose  -->
// <!-- est-ce que les posts s'affichent bien -->
// <!-- est-ce que l'on peut les modifier -->
// <!-- est-ce que l'on peut les supprimer -->
// <!-- est-ce que l'on peut supprimer les images ds le storage -->
// <!-- est-ce que l'on modifier que nos posts -->