<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    //
    public function getActiveProfiles()
    {
        $profiles = Profile::where('pro_status', 'active')->get();
        
         // Vérifie si l'utilisateur est authentifié avec Sanctum
         if (!auth('sanctum')->check()) {
            $profiles->makeHidden('pro_status');
        }
        
        return response()->json($profiles);
    }



    public function store(ProfileRequest $request)
    {

        $data = $request->validated();

        // Créer le profil
        $profile = Profile::create($data);

        // Gestion de l'image
        if ($request->hasFile('pro_image_path')) {
            $image = $request->file('pro_image_path');
            $profileFolder = 'profiles/' . $profile->id; // Utilisation de l'ID du profil créé comme nom de dossier

            $imageName = $image->hashName(); 
            $imagePath = $image->storeAs($profileFolder, $imageName, 'public');
            $profile->update(['pro_image_path' => $imagePath]); // Mettre à jour le chemin de l'image dans le profil
        }

        return response()->json($profile, 201);
    }



    public function update(ProfileRequest $request, Profile $profile)
    {
        $data = $request->validated();

        // Si une nouvelle image est envoyée
        if ($request->hasFile('pro_image_path')) {
            $image = $request->file('pro_image_path');
            $profileFolder = 'profiles/' . $profile->id; 

             // Supprimer l'ancienne image s'il en existe une
            if ($profile->pro_image_path) {
                Storage::disk('public')->delete($profile->pro_image_path);
            }
            
            $imageName = $image->hashName(); // Utilise un nom de fichier unique basé sur le hachage
            $imagePath = $image->storeAs($profileFolder, $imageName, 'public');
            $data['pro_image_path'] = $imagePath;
        }

        // Mettre à jour le profil avec les nouvelles données
        $profile->update($data);

        return response()->json($profile, 200);
    }
    


    public function destroy(Profile $profile)
    {
       // Supprimer l'image associée si elle existe
        if ($profile->pro_image_path) {
            // Supprimer le dossier complet associé au profil
            $profileFolder = 'profiles/' . $profile->id;
            Storage::disk('public')->deleteDirectory($profileFolder);
        }

        // Supprimer le profil de la base de données
        $profile->delete();

        return response()->json(['message' => 'Profil supprimé avec succès'], 200);
    }
}
