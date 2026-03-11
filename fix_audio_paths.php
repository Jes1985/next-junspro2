use App\Models\FormationModule;
FormationModule::all()->each(function($m){
    $changed = false;
    if($m->audio_path && str_contains($m->audio_path, "-mixed")) {
        $m->audio_path = str_replace("-fr-mixed", "-fr", $m->audio_path);
        $changed = true;
    }
    if($m->audio_path_en && str_contains($m->audio_path_en, "-mixed")) {
        $m->audio_path_en = str_replace("-en-mixed", "-en", $m->audio_path_en);
        $changed = true;
    }
    if($changed) $m->save();
    echo $m->slug . " audio_path=" . $m->audio_path . "\n";
});
