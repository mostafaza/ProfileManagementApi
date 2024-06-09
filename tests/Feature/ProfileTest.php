<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Profile;
use Storage;
use App\Models\Administrator;
use Laravel\Sanctum\Sanctum;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_profile()
    {
        // Création d'un utilisateur pour générer un jeton Sanctum
        $admin = Administrator::factory()->create();

        // Génération du jeton Sanctum
        Sanctum::actingAs($admin);

        // Création du profil 
        $profileData = [
            'pro_first_name' => 'Toto', 
            'pro_last_name' => 'Tata',
            'pro_image_path' => UploadedFile::fake()->image('image.jpg'),
            'pro_status' => 'active',
        ];

        $response = $this->json('POST', '/api/createProfile', $profileData);
        $response->assertStatus(201);
    }


    public function test_update_profile()
    {
        $admin = Administrator::factory()->create();
        
        Sanctum::actingAs($admin);

        // Création d'un profil  
        $profile = Profile::factory()->create();

        $updatedData = [
            'pro_first_name' => 'Tonton',
            'pro_last_name' => 'Test',
            'pro_status' => 'active',
        ];

        $response = $this->json('PUT', "/api/updateProfile/{$profile->id}", $updatedData);

        $response->assertStatus(200);

        // Vérification dans la bdd que les données sont correctes 
        $this->assertDatabaseHas('profiles', [
            'id' => $profile->id,
            'pro_first_name' => 'Tonton',
            'pro_last_name' => 'Test',
            'pro_status' => 'active',
        ]);
    }
  

    public function test_delete_profile()
    {
        $admin = Administrator::factory()->create();
        
        Sanctum::actingAs($admin);
        $profile = Profile::factory()->create();

        $image = UploadedFile::fake()->image('image.jpg');

        $profileFolder = 'profiles/' . $profile->id;
        $imagePath = $image->storeAs($profileFolder, 'image.jpg', 'public');
        $profile->update(['pro_image_path' => $imagePath]);

        // Verification de l'existence de l'image
        Storage::disk('public')->assertExists($imagePath);

        $response = $this->json('DELETE', "/api/delProfile/{$profile->id}");

        $response->assertStatus(200);

        // Vérification que le profil existe plus dans la BDD
        $this->assertDatabaseMissing('profiles', ['id' => $profile->id]);

        // Vérification que le dossier du profil existe plus  
        Storage::disk('public')->assertMissing($profileFolder);
    }

    public function testGetActiveProfiles()
    {
        $admin = Administrator::factory()->create();
        
        Sanctum::actingAs($admin);

        // Créer des profils avec différents statuts
        Profile::factory()->create(['pro_status' => 'active']);
        Profile::factory()->create(['pro_status' => 'inactive']);
        Profile::factory()->create(['pro_status' => 'pending']);
        Profile::factory()->create(['pro_status' => 'active']);

        $response = $this->json('GET', '/api/getActiveProfiles');

        $response->assertStatus(200);

        // Vérifier que la réponse contient uniquement les profils actifs
        $response->assertJsonCount(2); // Il devrait y avoir 2 profils actifs
        $response->assertJsonFragment(['pro_status' => 'active']);
    }
    
}
