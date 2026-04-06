<?php
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$mods = DB::table("formation_modules")
    ->whereIn("slug", ["07-je-maitrise-la-vision","09-je-transmets-le-rituel"])
    ->where("track","praticien")
    ->select("id","slug","description","audio_path","audio_path_en",
             DB::raw("LENGTH(activities) as act_len"),
             DB::raw("LENGTH(activities_en) as act_en_len"),
             DB::raw("LENGTH(intro_text) as intro_len"))
    ->get();
foreach($mods as $m){
    echo "ID={$m->id} {$m->slug}\n";
    echo "  desc=".(strlen($m->description)>5?"OK(".strlen($m->description).")":"VIDE")."\n";
    echo "  intro=".($m->intro_len>5?"OK ".$m->intro_len:"VIDE")."\n";
    echo "  activities=".($m->act_len>50?"OK ".$m->act_len:"VIDE")."\n";
    echo "  activities_en=".($m->act_en_len>50?"OK ".$m->act_en_len:"VIDE")."\n";
    echo "  audio_fr=".($m->audio_path?$m->audio_path:"NULL")."\n";
    echo "  audio_en=".($m->audio_path_en?$m->audio_path_en:"NULL")."\n\n";
}
